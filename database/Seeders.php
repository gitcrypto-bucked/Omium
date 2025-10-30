<?php 

namespace database;

use \Core\Datatables;
use database\factories\UserFactory;
use database\migrations\UserMigration;

class Seeders
{
    public static function run() :void
    {
        UserMigration:up();
        UserFactory::up();
        return;
    }
}

?>