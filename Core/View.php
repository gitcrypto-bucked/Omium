<?php 


namespace Core;

include_once('Facades/View.php');



class View
{
    public function __construct()
    {
        
    }
    
    
    public static function renderTemplate(string $template, array $args = [], $message): void
    {
        if(file_exists(dirname(__DIR__)."/App/Views"."/".$template.'.blaze.php')==true)
        {
            if($message!='' | $message !=null)
            {
                $_SESSION['flask_message'] = $message;
            }
            if(!empty($args))
            {
                //var_dump($args); exit;
                extract($args);
            }
            
            include_once(dirname(__DIR__)."/App/Views"."/".$template.'.blaze.php');exit;
        }
		
    }
    
}

?>