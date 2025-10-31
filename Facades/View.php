<?php


function css($file = null , $url = null)
{
    if(!is_null($file))
    {
         return '<link rel="stylesheet" href="'.asset($file).'">';
    }
    if(!is_null($url))
    {
         return '<link rel="stylesheet" href="'.($url).'">';
    }

}

function Roboto()
{
    return css(null,'https://fonts.googleapis.com/css?family=Roboto');
}

function Raleway()
{
    return css(null,'https://fonts.googleapis.com/css?family=Raleway');
}

function fontAwesome($version)
{
    switch($version)
    {
        case '4.7':
            return css(null,'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
        break;
        case '7.0': 
        default:
            return css(null,'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css');
        break;
    }
}

function boostrapIcons()
{
    return css(null,'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.13.1/font/bootstrap-icons.min.css');
}

function Jquery()
{
    return '<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>';
}


function asset($file)
{
    $path = getcwd();
    return (base_url(true, false, false).'/public/'.$file);
}   


function url($to)
{
    $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'];
    $uri = $_SERVER['REQUEST_URI'];
    $full_url = $protocol . '://' . $host . $uri;
    return base_url(true, false, false).$to;

}

if (!function_exists('base_url')) {
    function base_url($atRoot=FALSE, $atCore=FALSE, $parse=FALSE){
        if (isset($_SERVER['HTTP_HOST'])) {
            $http = isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off' ? 'https' : 'http';
            $hostname = $_SERVER['HTTP_HOST'];
            $dir =  str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
            
            $core = preg_split('@/@', str_replace($_SERVER['DOCUMENT_ROOT'], '', realpath(dirname(__FILE__))), -1, PREG_SPLIT_NO_EMPTY);
            $core = $core[0];
            
            $tmplt = $atRoot ? ($atCore ? "%s://%s/%s/" : "%s://%s/") : ($atCore ? "%s://%s/%s/" : "%s://%s%s");
            $end = $atRoot ? ($atCore ? $core : $hostname) : ($atCore ? $core : $dir);
            $base_url = sprintf( $tmplt, $http, $hostname, $end );
        }
        else $base_url = 'http://localhost/';
        
        if ($parse) {
            $base_url = parse_url($base_url);
            if (isset($base_url['path'])) if ($base_url['path'] == '/') $base_url['path'] = '';
        }
        
        return $base_url;
    }
}

function csrf()
{
    return \Facades\CSRF::generate();
}

function csrf_token()
{
    return '<input type="hidden" name="csrf_token" value="'.csrf().'">';
}

function sayHello($name)
{
    $hora = date('H');
    $saudacao = null;

    if($hora <12 && $hora>=6) $saudacao = "Bom dia";

    if($hora >=12 && $hora<18) $saudacao = "Boa tarde";

    if($hora >=18 && $hora <=23) $saudacao = "Boa noite";
    if($hora <6 && $hora>=0) $saudacao = "Boa madrugada";


    echo $saudacao.", ".$name;
}

function template($file)
{
      include_once(dirname(__DIR__)."/Templates/views"."/".$file.'.blaze.php');
}


function paginate($links)
{
    $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'];
    $uri = $_SERVER['REQUEST_URI'];
    $full_url = $protocol . '://' . $host . $uri;
       $path = strtok($full_url, '?');
       $full_url = $path;

    if(isset($links['pages']) && $links['pages']!=1)
    {


        $html= '  <div class="max-w-3xl mx-auto py-12 px-4 mt-3">
                    <div class="flex justify-center items-center space-x-2">
                       ';

        // <a class="px-3 py-2 bg-gray-800 text-gray-300 rounded hover:bg-gray-700" href="'.$full_url.'?page=1'.'">Anterior</a>
        for($i =0; $i< $links['pages']; $i++)
        {
            $html.=' <a class="px-3 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-500" href="'.$full_url.'?page='.($i+1).'">'.($i+1).'</a>';
        }

        //<a href="'.$full_url.'?page='.$links['pages'].'"  class="px-3 py-2 bg-gray-800 text-gray-300 rounded hover:bg-gray-700">Fim</a>
        $html.=' 
            </div>
        </div>';

  
        print_r($html);
    }
}