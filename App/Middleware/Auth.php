<?php

namespace App\Middleware;

use \Facades\Redirect;

class Auth
{
    public static function beforeAction()
    {
        //var_dump($_SERVER['REQUEST_URI']); exit;

        $requestMethod = $_SERVER['REQUEST_METHOD'];
        if($requestMethod == "POST")
        {
            if(!isset($_REQUEST['csrf_token']))
            {
                Redirect::to('login'); exit;
            }
            else if(\Facades\CSRF::validate($_REQUEST['csrf_token'])!=true)
            {
                \Facades\ExpiredPage::render(); exit;
            }
            return true;
        }
        if($requestMethod == 'GET')
        {
            if(!empty($_SESSION['login']) || !isset($_SESSION['login']))
            {
                Redirect::to('afterlogin'); exit;
            }
            else  Redirect::to('login'); exit;
        }
    }
}