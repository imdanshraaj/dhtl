<?php namespace app\Controllers;

use \Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Symfony\Component\HttpFoundation\Request;

class AuthController
{

    public function login()
    {
        $request = Request::createFromGlobals();

        $apiToken = $request->request->get('apiToken');

        if($apiToken)
        {
            $decoded = JWT::decode($apiToken, new Key($_ENV['JWT_SECRET'], 'HS256'));

            return $decoded->data->id ?? null;
        }
        else
        {
            http_response_code(401);

            echo json_encode(array(
                "message" => "Invalid JWT Token.",
            ));

            die;
        }
    }
}