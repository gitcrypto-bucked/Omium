<?php 

namespace Facades;

include_once('Facades/View.php');

class Unauthorized
{
    public static function handle()
    {
        echo @include_once(dirname(__DIR__)."/Templates/views/templates"."/".'unauthorized.blaze.php'); exit;
    }
}

?>