<?php 


namespace Core;

include_once('Facades/View.php');
use \Core\Auth;
use \Facades\Route;

class View
{
    public function __construct()
    {
        
    }
    
    
    public static function renderTemplate(string $template, array $args = [], $message): void
    {
        
        if(file_exists(dirname(__DIR__)."/Templates/views"."/".$template.'.blaze.php')==true)
        {
            if($message!='' | $message !=null)
            {
                $_SESSION['flask_message'] = $message;
            }
            if(!empty($args))
            {
                extract($args);
            }
            
            include_once(dirname(__DIR__)."/Templates/views"."/".$template.'.blaze.php');exit;
        }
		
    }
    
}

?>