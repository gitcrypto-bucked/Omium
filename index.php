<?php 

date_default_timezone_set('America/Sao_Paulo');

require __DIR__.'/vendor/autoload.php';
use Facades\Config;

Config::env();
require __DIR__.'/Core/Session.php';
require __DIR__.'/routes/web.php';
require __DIR__.'/routes/api.php';

?>

