<?php 
require __DIR__.'/vendor/autoload.php';
require __DIR__.'/Core/Session.php';
use Facades\Config;
use Facades\Requisition as Request;
use Facades\Router;
use \Core\Auth;

Config::env();


$router = new Router();
$request = new Request();

$router->get( '/', function() use($request) 
{
  $request->handle(Request::CALLABLE, "App\Controllers\Home@indexAction" ,$_REQUEST); 
});

$router->get( '/index', function() use($request) 
{
    $request->handle(Request::CALLABLE, "App\Controllers\Home@indexAction" ,$_REQUEST); 
});

$router->get( '/login', function() use($request) 
{
    $request->handle(Request::CALLABLE, "App\Controllers\User@loginIndex" ,$_REQUEST); 
});

$router->before('POST', '/dologin', function()use($request)  {
    \App\Middleware\Auth::beforeAction();
});

$router->post( '/dologin', function() use($request) 
{
    $request->handle(Request::CALLABLE, "App\Controllers\User@loginAction" ,$_REQUEST); 
});

$router->before('GET', '/afterlogin', function()use($request)  {
     \App\Middleware\Auth::beforeAction();
});

$router->get( '/afterlogin', function() use($request) 
{
    $request->handle(Request::CALLABLE, "App\Controllers\Home@indexAction" ,$_REQUEST); 
});

$router->get( '/logout', function() use($request) 
{
    $request->handle(Request::CALLABLE, "App\Controllers\User@logoutAction" ,$_REQUEST); 
});


$router->run();


?>