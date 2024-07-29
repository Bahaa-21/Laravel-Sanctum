<?php

namespace App\Helper;

use Illuminate\Support\Facades\Mail;

class Qs
{
    static function api_response($status, $code, $message, $data = [])
    {
        if ($status) {
            return ['data' => $data, "message" => $message, "status" => $status];
        } else {
            return response(['data' => $data, "message" => $message, "status" => $status], $code);
        }
    }
}
