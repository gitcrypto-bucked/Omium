<?php 

namespace Facades;
include_once('Facades/View.php');
use \Facades\DB;

class Guard
{
    public static function PreventApiTroughtWeb()
    {
        echo @include_once(dirname(__DIR__)."/Templates/views/templates"."/".'401.blaze.php'); exit();
    }

    public static function InvalidAuth()
    {
        http_response_code(401); // Unauthorized
        header('HTTP/1.0 401 Unauthorized');
        header('WWW-Authenticate: Basic realm="Restricted Area"');exit();
    }

    private static function invalidToken()
    {
        http_response_code(401); // Unauthorized
        header('HTTP/1.0 401 Unauthorized');
        header('WWW-Authenticate: Basic realm="Restricted Area"');
        return print_r(json_encode(['error'=>true,'success'=>false,'msg'=>'Informed token is not valid'])); exit();
    }

    public static function isTokenValid($token):bool
    {
        $dba  =  DB::getInstance()->table(self::getTable())->where('bearerToken', '=', $token)->get();
        if(!empty($dba) && isset($dba[0]) && $dba[0]['active']== '1')
        {
            return true;
        }
       return false;
    }

    public static function getTable()
    {
        return 'api_tokens';
    }
}