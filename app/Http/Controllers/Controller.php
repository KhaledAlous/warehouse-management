<?php

namespace App\Http\Controllers;
use Response;
abstract class Controller
{
    //
     public function sendResponse($result, $message, $code = 200)
    {
        return Response::json(['success' => $code==200, 'data' =>  $result, 'message' => $message], $code);
    }

    public function sendError($error, $code = 400)
    {
        return Response::json(['success' => $code==200, 'data' =>  null, 'message' => $error], $code);
    }
    
}