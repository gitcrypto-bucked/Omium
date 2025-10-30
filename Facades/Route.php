<?php

namespace Facades;


class Route
{
     public static function is($routename)
     {
      
        $requestUri = $_SERVER['REQUEST_URI'];
        // Remove query string if present
        $path = strtok($requestUri, '?');
        $path = strtok($requestUri, '/');
        return $path == $routename;
     }
}

?>