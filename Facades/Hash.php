<?php

declare(strict_types=1);


namespace Facades;

class Hash
{
    public static function make(string $raw_password)
    {
        return (password_hash($raw_password, PASSWORD_DEFAULT));
    }


    public static function verify(string $enc_password, string $raw_password)
    {
        return password_verify($enc_password, $raw_password);
    }
}