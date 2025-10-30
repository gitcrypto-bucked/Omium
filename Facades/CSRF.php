<?php

namespace Facades;


class CSRF
{
    public static function generate()
    {
         unset($_SESSION['csrf_token']);
         unset($_SESSION['csrf_token_time']);

         $token = bin2hex(random_bytes(32));
         $timestamp = strtotime(date('H:i:s')) + 60*60;
         $time = date('H:i:s', $timestamp);
         $_SESSION['csrf_token'] = $token;
         $_SESSION['csrf_token_time'] = $time;
         return $token;
    }

    public static function validate()
    {
        if(isset($_SESSION['csrf_token']))
        {
            $bool =  strtotime($_SESSION['csrf_token_time']) <= strtotime(date('H:i'));
            if($bool==false)
            {
                \Facades\ExpiredPage::render(); exit;
            }
        }
        else 
        {
            return false;
        }
        #return isset($_SESSION['csrf_token']) && strtotime($_SESSION['csrf_token_time']) <= strtotime(date('H:i')) && $_SESSION['csrf_token'] == $token;
    }
}