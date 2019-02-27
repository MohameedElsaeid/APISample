<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewUserRequest;
use App\User;

class UserController extends APIController
{
    /**
     * @param NewUserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createUser(NewUserRequest $request)
    {
        //store request in data array to reuse it
        $data = $request->all();
        
        //create new user
        $newUser = User::query()->create($data);
        
        //create token for this user with passport
        $token = $newUser->createToken('AccessToken')->accessToken;
        
        //store new user data and his token in array to return it again
        $returnedData['user'] = $newUser;
        $returnedData['token'] = $token;
        
        return $this->jsonResponse(1, $returnedData, 'success', [], 201);
    }
}
