<?php 

namespace App\Controllers;
use App\Models\User as UserModel;
use Core\Auth;
use \Facades\Redirect;



class User extends \Core\Controller
{
    public function loginIndex()
    {
        \Core\View::renderTemplate('login',[],null);
    }


    public function loginAction()
    {
        $request = $_REQUEST;
        $validation = [
            'username' => 'required',
            'password' => 'required:6'
        ];
        Auth::validade($request, $validation);
        if(Auth::attempt($request))
        {
           Redirect::to('afterlogin');
        }
        else
        {
             Redirect::with('error','Usuário ou senha inválidos');
             Redirect::to('login');
        }
       
    }

    public function logoutAction():void
    {
        Auth::logout();
        Redirect::to('login');
    }
     
    protected function beforeExecute(): void
	{
		$this->auth = new \Core\Auth();
		$this->logged = $this->auth->logged();
	}

	protected function afterExecute(): void
	{
		$this->auth = null;
		$this->logged = null;
	}
    
    private $auth;
	private $logged;
}