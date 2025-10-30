<?php


namespace App\Controllers;


class Dash extends \Core\Controller
{
    public function indexAction()
    {
       $this->beforeExecute();
       \Core\View::renderTemplate('dash',@$_SESSION['login'], null);
    }

    protected function beforeExecute(): void
	{
        if(!\Core\Auth::logged())
        {
             header('Location: '.url('login'));
        }
	}

	protected function afterExecute(): void
	{
		
	}
}
