<?php 
date_default_timezone_set('America/Sao_Paulo');

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

$router->before('GET', '/dash', function()use($request)  {
     \App\Middleware\Auth::beforeAction();
});

$router->get( '/dash', function() use($request) 
{
    $request->handle(Request::CALLABLE, "App\Controllers\Dash@indexAction" ,$_REQUEST); 
});

$router->get( '/blog', function() use($request) 
{
    $request->handle(Request::CALLABLE, "App\Controllers\Blog@indexAction" ,$_REQUEST); 
});

$router->before('GET', '/profile', function()use($request)  {
     \App\Middleware\Auth::beforeAction();
});

$router->get( '/profile', function() use($request) 
{
    $request->handle(Request::CALLABLE, "App\Controllers\User@profileAction" ,$_REQUEST); 
});

$router->before('POST', '/profile', function()use($request)  {
     \App\Middleware\Auth::beforeAction();
});

$router->post('/profile', function() use($request) 
{
    $request->handle(Request::CALLABLE, "App\Controllers\User@updateProfile" ,$_REQUEST); 
});

$router->before('POST', '/user.avatar', function()use($request)  {
    $request->handle(Request::CALLABLE, "App\Controllers\User@avatarAction" ,$_REQUEST); 
});

$router->post( '/user.avatar', function() use($request) 
{
    $request->handle(Request::CALLABLE, "App\Controllers\User@avatarAction" ,$_REQUEST); 
});

$router->before('GET', '/admin', function()use($request)  {
     \App\Middleware\Auth::beforeAction();
});

$router->get( '/admin', function() use($request) 
{
    $request->handle(Request::CALLABLE, "App\Controllers\Admin@indexAction" ,$_REQUEST); 
});


$router->get( '/users/{fn}/{id}', function($fn, $id) use($request) 
{
    $request->handle(Request::CALLABLE, "App\Controllers\Admin@usersAction" ,['fn'=>$fn, 'id'=>$id]); 
});

$router->post('/update/users', function() use($request) 
{
    $request->handle(Request::CALLABLE, "App\Controllers\Admin@updateUsersAction" ,$_REQUEST); 
});


$router->before('GET', '/logout', function() use($request)
{
    \App\Middleware\PreventBack::handle($request);
});

$router->get( '/logout', function() use($request) 
{
    $request->handle(Request::CALLABLE, "App\Controllers\User@logoutAction" ,$_REQUEST); 
});


$router->run();


?>