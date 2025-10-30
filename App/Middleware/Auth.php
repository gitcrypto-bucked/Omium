<?php

namespace App\Middleware;

use \Facades\Redirect;

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
               Redirect::to('logout'); ;
            }
        }
    }
}