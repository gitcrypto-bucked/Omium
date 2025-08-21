<?php


namespace Core;
use Core\Datatables;

class Model
{
    public static function start()
    {
       $dt = new Datatables();
       $db = $dt->getConnection();
    }
}


?>