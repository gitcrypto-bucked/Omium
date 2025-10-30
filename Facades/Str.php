<?php

declare(strict_types=1);
namespace Facades;


class Str
{
    public static function random(int $length  = 16)
    {
       $bytes = random_bytes(intval(ceil(intval($length) / 2)));     
        // Convert the random bytes to a hexadecimal string
        $hexString = bin2hex($bytes);    
        // Truncate the string to the desired length
        return substr($hexString, 0, $length);
    }
}