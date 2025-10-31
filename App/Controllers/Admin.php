<?php 

namespace App\Controllers;
use Core\Auth;
use \Facades\Redirect;

class Admin 
{
    public function indexAction($request)
    {
        Auth::admin();
        $users = \App\Models\User::allPaginated(8, @$request['page']);
        \Core\View::renderTemplate('users', ['users'=>$users],null);
    }

    public function usersAction($request)
    {
        Auth::admin();
        $fn = $request['fn'];
        $id = base64_decode($request['id']);
        
        switch($fn)
        {
            case 'edit':
                    $user = \App\Models\User::find($id);
                    \Core\View::renderTemplate('users.edit', ['user'=>$user[0]],null);
                break;
            case 'delete':
                    if(!isset($_GET['status']))
                    {
                         \Core\View::renderTemplate('templates/prompt', ['yes'=>\Facades\Redirect::url('/users/delete/'.$request['id'].'?status=yes'),
                                                                    'no'=>\Facades\Redirect::url('admin'),
                                                                    'text'=>'Esta ação não pode ser desfeita. Por favor, confirme para prosseguir.'
                                                                ],null);
                    }
                    if(isset($_GET['status']) && $_GET['status']=='yes')
                    {
                        if(\App\Models\User::delete($id))
                        {
                            Redirect::with('success', 'Usuário excluido com sucesso');
                            return Redirect::to('/admin');
                        }
                        else
                        {
                            Redirect::with('error','Erro ao excluir o  usuário');
                            return Redirect::to('/admin');
                        }
                    }
          
                    break;
            default:
                return Redirect::back();
        }
    }

    public function updateUsersAction($request)
    {
       Auth::admin();
        $validation = [
            'id' => 'required',
            'name' => 'required',
            'email' => 'required',
            'nivel' => 'required',
            'ativo' => 'required'
        ];

        if(Auth::validade($request, $validation))
        {
            $id = $request['id'];
            $admin =  str_contains($request['nivel'],'admin')? '1' : '0';
            #$ativo =  strpos($request['ativo'],'ativo')? '1' : '0';

            $ativo = '0';
            if($request['ativo']=='ativo')
            {
                $ativo = '1';
            }

             $data = [
                'name' => $request['name'],
                'email' => $request['email'],
                'admin' => $admin,
                'active' => $ativo,
            ];

         
            if(\App\Models\User::save($id, $data))
            {
                Redirect::with('success', 'Usuário atualizado com sucesso');
                return Redirect::back();
            }
            else
            {
                Redirect::with('error','Erro ao atualizar o  usuário');
                return Redirect::back();
            }
        }
        else
        {
            Redirect::with('error','Erro ao atualizar o  usuário');
            Redirect::back();   
        }
    }
}

?>