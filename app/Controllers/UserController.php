<?php namespace app\Controllers;

use app\Models\User;
use \Firebase\JWT\JWT;
use Symfony\Component\HttpFoundation\Request;

class UserController
{
  public function login()
  {
    $request = Request::createFromGlobals();

    $email = $request->request->get('email');
    $password = $request->request->get('password');

    $user = User::where('email', $email)->first();

    if (!$user) {
      print_r(json_encode(['status'=>'error','data'=>[],'message'=>'Invalid email or password']));
      die;
    }

    if(password_verify($password,$user->password))
    {
      $issuer_claim = $_ENV['APP_URL'];
      $audience_claim = $_ENV['APP_URL'];
      $issuedat_claim = time();
      $notbefore_claim = $issuedat_claim + 10;
      $expire_claim = $issuedat_claim + 3600;

      $payload = array(
        "iss" => $issuer_claim,
        "aud" => $audience_claim,
        "iat" => $issuedat_claim,
        "nbf" => $notbefore_claim,
        "exp" => $expire_claim,
        "data" => array(
            "id" => $user->id,
            "name" => $user->name,
            "email" => $user->email
      ));

      $jwt = JWT::encode($payload, $_ENV['JWT_SECRET'], 'HS256');

      print_r(json_encode(['status'=>'success','data'=>$user,'token'=>$jwt,"expireAt" => $expire_claim])); die;
    }
    else
    {
      print_r(json_encode(['status'=>'error','data'=>[],'message'=>'Invalid email or password'])); die;
    }
  }
 }