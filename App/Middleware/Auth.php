<?php

namespace App\Middleware;

use \Facades\Redirect;
use \Facades\Guard;
use \Facades\DB;
use \Core\PersonalAccessToken;

class Auth
{
    public static function beforeAction()
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        if($requestMethod == "POST")
        {
            
            if(!isset($_REQUEST['csrf_token']) && \Facades\CSRF::validate()!=true)
            {
               \Facades\ExpiredPage::render(); exit;
            }
            return true;
        }
         if($requestMethod == 'GET')
        {
            if(empty($_SESSION['login']) || !isset($_SESSION['login']) && $_SERVER['REQUEST_URI'] !='/login')
            {
               Redirect::to('login'); ;
            }
        }
    }

    public static function sanctum()
    {
        if(!isset($_REQUEST['csrf_token']) || $_REQUEST['csrf_token']=='')
        {
            http_response_code(400);
            header('HTTP/1.1 400 Bad Request');
            exit();
        }

        $headers  = getallheaders();
        if (!empty($headers)) 
        {
            if (!isset($headers['Authorization']) || $headers['Authorization'] =='') 
            {
                 Guard::InvalidAuth();exit();
            }
            $token = str_replace('Bearer ','',$headers['Authorization']);
            
            if( Guard::isTokenValid($token)!=true  && 
                PersonalAccessToken::findToken($token)!=true)
            {
                http_response_code(401); // Unauthorized
                header('HTTP/1.0 401 Unauthorized');
                header('WWW-Authenticate: Basic realm="Restricted Area"'); exit;
            }
        }
    }
}