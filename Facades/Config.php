<?php
namespace Facades;


class Config
{
    public static function env()
    {   
        $env = [];
        $file_handle = fopen( dirname(__DIR__) . '/.env', "r");
        while (!feof($file_handle)) 
        {
            $line = fgets($file_handle);
            // Process the $line here
            if($line!=NULL)
            {
                $env[] =(explode('=', $line)); 
            }
        }
        for($i =0 ; $i < sizeof($env); $i++)
        {
            if(isset($env[$i][1]))
            {
                putenv($env[$i][0].'='.@trim(preg_replace('/\s\s+/', ' ',$env[$i][1])));

            }
            
        }
    }
}
