<?php

namespace App\Http\Controllers;

use App\Club;
use App\Transformers\ClubTransformers;

class ClubController extends APIController
{
    /**
     * Display a listing of the resource.
     *
     * @return Club[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        $clubs = Club::all();

        $clubs = ClubTransformers::transform($clubs);

        return $this->jsonResponse(1, $clubs, 'success', [], 200);
    }
}
