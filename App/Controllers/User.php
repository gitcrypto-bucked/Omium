<?php 

namespace App\Controllers;
use App\Models\User as UserModel;
use Core\Auth;
use \Facades\Redirect;
use \Facades\Storage;


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
        if(Auth::validade($request, $validation) && Auth::attempt($request))
        {
           Redirect::to('dash');
        }
        else
        {
            #Auth::logout();
            Redirect::with('error','Usuário ou senha inválidos');
            Redirect::to('login');
        }
       
    }

    public function profileAction()
    {
        $user = UserModel::find(Auth::user()['id']);
        \Core\View::renderTemplate('profile', ['user'=>$user[0]],null);
    }

    public function avatarAction($request)
    {
        $id  = $request['id'];
        $check = getimagesize($_FILES["avatar"]["tmp_name"]);
        if($check)
        {

            switch($_FILES['avatar']["type"])
            {
                case "image/jpeg":
                    $imageFileType = '.jpeg';
                break;
                case "image/png":
                    $imageFileType = '.png';
                break;
                case "image/webp":
                     $imageFileType = '.webp';
                break;
                default:
                    Redirect::with('error','Por favor selecione um arquivo válido');
                    Redirect::to('profile');
            }

            if ($_FILES["avatar"]["size"] > 500000)
            {
                Redirect::with('error','Por favor selecione um arquivo menor que 1MB');
                Redirect::to('profile');
            }
            $filename = md5(time()).$imageFileType;
           if(Storage::storeAs($_FILES["avatar"]["tmp_name"],'avatar',$filename))
           {
                \App\Models\User::save($id,['avatar'=>$filename]);
                Redirect::with('success','Arquivo atualizado com sucesso');
                Redirect::to('profile');
           }
           else
            {
                Redirect::with('error','Houve um erro ao atulizar o avatar');
                Redirect::to('profile');
            }
        }
        else
        {
            Redirect::with('error','Arquivo inválido');
            Redirect::to('profile');
        }
    }

    public function updateProfile()
    {
        $request = $_REQUEST;
        
        $validation = [
            'id' => 'required',
            'name' => 'required',
            'email' => 'required',
            'password' => 'required:6'
        ];
        if(Auth::validade($request, $validation))
        {
            $user = UserModel::find($request['id']);
            $old_password = $request['old_password'];

            if($request['password'] != $request['confirm_password'])
            {
                Redirect::with('error','As senhas não coincidem');
                Redirect::to('profile');
            }

            if(\Facades\Hash::verify($request['password'], $old_password))
            {
                Redirect::with('error','Senha não pode ser igual as anteriores');
                Redirect::to('profile'); 
            }

            $password = \Facades\Hash::make($request['password']);
            
            $data = [
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => $password
            ];
            
            if(UserModel::save($request['id'], $data))
            {
                Redirect::with('success','Perfil atualizado com sucesso');
                Redirect::to('profile');
            }
            else
            {
                Redirect::with('error','Erro ao atualizar perfil');
                Redirect::to('profile');
            }
        }
        else
        {
            Redirect::with('error','Erro ao atualizar perfil');
            Redirect::to('profile');
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