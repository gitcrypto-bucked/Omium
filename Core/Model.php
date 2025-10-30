<?php


namespace Core;
use Core\Datatables;
use \Facades\DB;

class Model
{
     /**
      * Retorna o nome da tabela
      * @return string
      */
     public static function getTable()
     {
        return 'table';
     }
     public static function find($id)
     {
        return DB::getInstance()->table(self::getTable())->where('id', '=', $id)->get();
     }

}


?>