<?php

namespace App\Http\Controllers;

use Firebase\JWT\JWT;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    function status($message, $success, $data = [])
    {
        $array['message'] = $message;
        $array['success'] = $success;
        if ($data != []) {
            $array['data'] = $data;
        }
        return $array;
    }

    function generateToken($data = [])
    {
        $key = env('APP_KEY');
        $payload = [
            'iat' => time(),
            'exp' => time() + 60 * 60 * 24,
            'data' => $data,
        ];

        $algorithm = 'HS256';

        return JWT::encode($payload, $key, $algorithm);
    }
}
