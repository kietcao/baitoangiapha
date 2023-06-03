<?php

namespace App\Traits;

use Illuminate\Http\Response;

trait ResponseTrait
{
    public function errorMessage($messages)
    {
        return response()->json([
            'messages' => $messages
        ], Response::HTTP_BAD_REQUEST);
    }
}