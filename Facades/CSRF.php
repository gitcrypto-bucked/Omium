<?php

namespace Facades;


class CSRF
{
    public static function generate()
    {
         $token = bin2hex(random_bytes(32));
         $timestamp = strtotime(date('H:i:s')) + 60*60;
         $time = date('H:i:s', $timestamp);
         $_SESSION['csrf_token'] = $token;
         $_SESSION['csrf_token_time'] = $time;
         return $token;
    }

    public static function validate($token)
    {
        return isset($_SESSION['csrf_token']) && strtotime($_SESSION['csrf_token_time']) >= strtotime(date('H:i')) && $_SESSION['csrf_token'] == $token;
    }
}