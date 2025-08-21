<?php 


namespace Core;


abstract class Controller
{
    
    protected $route_params = [];
    
   	public function __construct($route_params)
	{
		$this->route_params = $route_params;
	}
    
    
    public function __call(string $name, array $args): void
	{
        include_once("Validate.php");
		Validate::blockMethods();
		
		if(strpos($name,'Action')!=false)
		{
			$method = $name;
		}
		else
        {
             $method = $name . 'Action';
        }
		
		if (method_exists($this, $method)) 
        {
			if ($this->beforeExecute() !== false) 
            {
				call_user_func_array([$this, $method], $args);
				$this->afterExecute();
			}
		} 
        else 
        {
			if (getenv('APP_DEBUG')!=false)
            {
                throw new \Exception("Método {$name} não encontrado.");
            }
			else
            {
                throw new \Exception("", 204);
            }
			exit;
		}
        
	}
  

    abstract protected function beforeExecute(): void;
    
    abstract protected function afterExecute(): void;
    
}
?>