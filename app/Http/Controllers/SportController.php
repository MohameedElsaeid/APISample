<?php

namespace App\Http\Controllers;

use App\Sport;
use App\Transformers\SportTransformers;

class SportController extends APIController
{
    /**
     * Display a listing of the resource.
     *
     * @param $clubId
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($clubId)
    {
        $sports = Sport::query()->where('club_id', $clubId)->get();

        $sports = SportTransformers::transform($sports);

        return $this->jsonResponse(1, $sports, 'success', [], 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMaxSportAttendees()
    {
        $sports = Sport::query()
            ->join('sessions', 'sports.id', '=', 'sessions.sport_id')
            ->orderBy('sessions.current_attendees', 'DESC')
            ->first();

        $sports = SportTransformers::transform($sports);

        return $this->jsonResponse(1, $sports, 'success', [], 200);
    }
}
