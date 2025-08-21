<?php

namespace Core;

use \Facades\Routing;
use App\Models\User as UserModel;
use \Facades\DB;
use \Facades\Redirect;


class Auth
{
	public static function login(string $sessid, string $user, int $user_id): void
	{
		session_register('login');
		session_regenerate_id(true);
		$_SESSION['login'] = array(
			'sessid' => $sessid,
			'uagent' => hash('sha3-224', $_SERVER["HTTP_USER_AGENT"]),
			'user' => $user
		);
		$dt = DB::getInstance()->table('sessions')->insert([
			'sessid' => $sessid,
			'uagent' => hash('sha3-224', $_SERVER["HTTP_USER_AGENT"]),
			'user' => $user,
			'user_id' => $user_id,
			'data_criacao'=> date('Y-m-d H:i:s'),
			'ativo' => '1'
		]);
		
	}	


	public static function attempt(array $request)
	{
		$user = UserModel::login($request['username'], $request['password']);
		if($user && \Facades\Hash::verify($request['password'], $user['password'] ) )
		{
			Auth::login(md5(time()), $user['name'], $user['id']);

		    return true;
		}
		else
		{
		   return false;
		}
	}


	/**
	 * Verifica se usuário está logado
	 * @return bool
	 */
	public static function logged(): ?bool
	{
		if (
			isset($_SESSION['login']) &&
			is_array($_SESSION['login']) &&
			isset($_SESSION['login']['sessid'])
		) 
		{
			$result =  DB::getInstance()->table('sessions')->where('sessid', 'LIKE', '%'.$_SESSION['login']['sessid'])->get();
			if ($result !=false) 
			{
				return true;
			} 
			else 
			{
				return false;
			}
		}
		return false;
	}

	/**logi
	 * Logout
	 * @return void
	 */
	public static  function logout(): void
	{
		if (isset($_SESSION['login']['sessid'])) 
		{
			unset($_SESSION['login']['sessid']);
			# apaga sessao do banco
			$res=  DB::getInstance()->table('sessions')->delete('sessid', 'LIKE', '%'.$_SESSION['login']['sessid']);
		}

		$params = session_get_cookie_params();
		setcookie(session_name(), "", time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
		if (session_status() == PHP_SESSION_ACTIVE ) {
			// No session has been started, so start one
			session_destroy();
			session_write_close();
			$_COOKIE = array();
			unset($_COOKIE);
		}
		session_regenerate_id(true);
		header('Location: '.Redirect::to('/login'));
		exit;
	}

	public static function validade(array $request, $validation)
	{
		foreach($validation as $k => $v)
		{
			if(!isset($request[$k]) || is_null($request[$k]))
			{
				header('Location: '.Routing::url('login'));
			}
			$rules = explode(':', $v);
			if(isset($rules[1]))
			{
				$rule = $rules[1];
				if((strlen($request[$k]) < intval($rules))!=false )
				{
					header('Location: '.Routing::url('login'));
				}
			}
			return true;		
	
		}


	}
}
