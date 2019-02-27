<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class APIController extends Controller
{
    function jsonResponse($Status = [], $Data = null, $Massage = [], $errors = [], $ResponseStatus = 200)
    {
        if ($Data !== null) {
            return response()->json(['status' => $Status, 'data' => $Data, 'message' => $Massage], $ResponseStatus);
        }
        return response()->json(['status' => $Status, 'data' => (object)[], 'message' => $Massage, 'errors' => $errors], $ResponseStatus);
    }
    
}
