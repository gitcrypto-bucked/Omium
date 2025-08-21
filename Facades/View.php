<?php



function asset($file)
{
    $path = getcwd();
    //return ($path.'/public/'.$file);
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
    // $token = bin2hex(random_bytes(32));
    // $_SESSION['csrf_token'] = $token;
    // return $token;
    return \Facades\CSRF::generate();
}

function csrf_token()
{
    return csrf();
}

function csrf_field()
{
    return '<input type="hidden" name="csrf_token" value="'.csrf_token().'">';
}

