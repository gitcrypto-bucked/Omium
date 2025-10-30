<?php


namespace Facades;

include_once('./View.php');


class Storage
{
    public static function storeAs( $file, $path, $filename)
    {
        $target_file = getcwd().'/storage'.'/public'.'/'.$path.'/'.$filename;
        return move_uploaded_file($file, $target_file);
    }

    public static function read($path, $file)
    {
        $spath = getcwd().DIRECTORY_SEPARATOR.'storage'.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.$path.DIRECTORY_SEPARATOR;
        return @($spath.$file);
    }

    public static function urlRead($path, $file)
    {
        $spath =  base_url(true, false, false).'storage/public/'.$path.'/'.$file;
        return $spath;
    }
}