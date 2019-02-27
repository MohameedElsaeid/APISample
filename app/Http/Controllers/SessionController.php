<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookSessionRequest;
use App\Session;
use App\Transformers\SessionTransformers;
use App\UserSessions;
use Illuminate\Http\Request;

class SessionController extends APIController
{
    /**
     * Display a listing of the resource.
     *
     * @param $sportId
     * @return \Illuminate\Http\Response
     */
    public function getSessionBySportId($sportId)
    {
        $session = Session::query()
            ->where('sport_id', $sportId)
            ->orderBy('sport_id')
            ->get();
        
        $session = SessionTransformers::transform($session);
        
        return $this->jsonResponse(1, $session, 'success', [], 200);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllSession()
    {
        
        $session = Session::query()
            ->join('sports', 'sports.id', '=', 'sessions.sport_id')
            ->orderBy('sports.sport_name')
            ->get();
        
        $session = SessionTransformers::transform($session);
        
        return $this->jsonResponse(1, $session, 'success', [], 200);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAvailableSession()
    {
        /*
         * is_available is boolean flag
         * change when current_attendees = max_attendees
         */
        $session = Session::query()
            ->join('sports', 'sports.id', '=', 'sessions.sport_id')
            ->where('sessions.is_available', 1)
            ->orderBy('sports.sport_name')
            ->get(['sessions.*']);
        
        $session = SessionTransformers::transform($session);
        
        return $this->jsonResponse(1, $session, 'success', [], 200);
    }
    
    
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function getUserSessions(Request $request)
    {
        $user = $request->user('api');

        $session = $user->Sessions()->orderBy('user_sessions.created_at','DESC')->get();
    
        $session = SessionTransformers::transform($session);
    
        return $this->jsonResponse(1, $session, 'success', [], 200);
    }
    
    public function bookSession(BookSessionRequest $request)
    {
        //store user object
        $user = $request->user('api');
        
        //store request data
        $data = $request->all();
        
        //get session to check on current_attendees and max_attendees
        $session = Session::query()->where('id', $data['session_id'])->first();
        
        
        if ($session->check()) {
            return $this->jsonResponse(0, null, 'error', "this session is fully booked", 200);
        }
        
        if ($session->checkIfBooked($user->id)) {
            return $this->jsonResponse(0, null, 'error', "you already booked this session", 200);
        }
        
        //prepare data to store
        $data = [
            'user_id' => $user->id,
            'session_id' => $request->session_id
        ];
        
        $bookSession = UserSessions::query()->create($data);
        
        $session->incrementCurrentAttendees();
        
        $session = SessionTransformers::transform($session);
        
        return $this->jsonResponse(1, $session, 'session booked successfully', [], 201);
    }
}
