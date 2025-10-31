<?php 
date_default_timezone_set('America/Sao_Paulo');

use Facades\Config;
use Facades\Requisition as Request;
use Facades\Router;
use \Core\Auth;

Config::env();

$router = new Router();
$request = new Request();

$router->setBasePath('api/');

// ... this will always be executed
$router->before('GET|POST', '/.*', function()
{
    Auth::guard('web'); 
    \App\Middleware\Auth::sanctum();

});


$router->get('/hello', function() {
        http_response_code(200);
        header('HTTP/1.1 200 Ok', true, 200);
        header('Content-type: application/json; charset=UTF-8;');;echo 'Inadex'; 
});


$router->post('/login', function() use($request) {
       $request->handle(Request::CALLABLE, "App\Api\UserOauth@login" ,$_REQUEST); 
});


$router->run('api/');
