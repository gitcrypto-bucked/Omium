<?php

namespace App\Middleware;

use \Facades\Redirect;

class PreventBack
{
    public static function handle($request)
    {
        header('Cache-Control', 'no-cache, no-store,max-age=0, must-revalidate');
        header('Pragma', 'no-cache');
        header('Expires', 'Sat, 26 Jul 1997 05:00:00 GMT');
        return $request;
    }
}