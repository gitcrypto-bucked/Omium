<?php


namespace App\Models;
use \Facades\DB;

class User  extends \Core\Model
{
    public static function login($username, $password)
    {
        return DB::getInstance()->table('users')->where('email', '=', $username)->where('active', '=','1')->get();
    }

    public static function find($id)
    {
        return DB::getInstance()->table(self::getTable())->where('id', '=', $id)->get();
    }

    public static function save($id, $data)
    {
        return DB::getInstance()->table(self::getTable())->where('id', '=', $id)->update($data);
    }

    public static function all()
    {
        return DB::getInstance()->table(self::getTable())->order('id', 'ASC')->get();
    }

    public static function delete($id)
    {
        return DB::getInstance()->table(self::getTable())->delete('id', '=', $id);
    }

     /**
     * Retorna o nome da tabela
     * @return string
     */
    public static function getTable()
    {
        return 'users';
    }
}
