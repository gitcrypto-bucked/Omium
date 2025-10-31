<?php

namespace Core;
use \Facades\Guard;
use \Facades\DB;
use \Core\PersonalAccessToken;
use Core\Auth;

class Sanctum
{
    public static function createToken()
    {
        $user = Auth::user();
        $userID = $user['id'];
        $token =  PersonalAccessToken::createToken($userID);
        static::registerSession($user, $token);
        return $token;
    }

    public static function registerSession($user, $token)
    {
        session_unset();
        $sessid = base64_encode($token);
		$now = new \DateTime(); // Get current date and time
		$now->add(new \DateInterval('PT5H')); // Add 5 hours
		$expire = $now->format('Y-m-d H:i:s'); // Format the result

		session_regenerate_id(true);
		$_SESSION['api'] = array(
			'sessid' =>  $sessid,
			'uagent' =>  hash('sha3-224', $_SERVER["HTTP_USER_AGENT"]),
			'user'   =>  $user['name'],
			'expire' =>  $expire
		);
		
    }

    public static function user()
    {
        $headers  = getallheaders();
        $token = str_replace('Bearer ','',$headers['Authorization']);
        if(PersonalAccessToken::findToken($token))
        {
            return  PersonalAccessToken::getUserByToken($token);
        }
    }

    public static function getInstance()
    {
        if(static::$instance == null)
        {
            static::$instance = new self;
        }
        return static::$instance;
    }


    private static $instance = null;
}

?>