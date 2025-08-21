<?php 


namespace App\Controllers;

class Home extends \Core\Controller
{
    
    
    protected  function indexAction(): void
	{
		\Core\View::renderTemplate('index',[], null);
	}
    
    protected function beforeExecute(): void
	{
	
	}

	protected function afterExecute(): void
	{
		
	}
    
  
    
}
?>