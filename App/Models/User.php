<?php


namespace App\Models;
use \Facades\DB;

class User  extends \Core\Model
{
    public static function login($username, $password)
    {
        return DB::getInstance()->table('users')->where('email', '=', $username)->get();

        // DB::table('users');
        // DB::where('email', '=', $username);
        // return  DB::get();


    }
}
