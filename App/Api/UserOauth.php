<?php

namespace App\Api;

use App\Models\User as UserModel;
use Core\Auth;
use \Facades\Redirect;
use \Facades\Storage;


class UserOauth
{
    public function login()
    {       

        $request = $_REQUEST;
        $validation = [
            'username' => 'required',
            'password' => 'required:6'
        ];
        if(Auth::validade($request, $validation) && Auth::attempt($request))
        {
            $user = Auth::user();
            unset($user['password']);
            $token = Auth::via('sanctum')->createToken();
         

            http_response_code(200);
            header('HTTP/1.1 200 Ok', true, 200);
            header('Content-type: application/json; charset=UTF-8;');
            echo json_encode(['error'=>false, 'success'=>true, 'access_token'=>$token, 'user' => $user]); exit();
        }
        else
        {
            Auth::logout();
            Auth::guard('web');
            http_response_code(401);
            header('HTTP/1.1 200 Ok', true, 401);
            header('Content-type: application/json; charset=UTF-8;');
            echo json_encode(['error'=>'Usuário/Senha inválidos.', 'success'=> false, 'redir'=> false ]); exit();
        }
    }
}
