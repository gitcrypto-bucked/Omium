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

		session_unset();
		$now = new \DateTime(); // Get current date and time
		$now->add(new \DateInterval('PT5H')); // Add 5 hours
		$expire = $now->format('Y-m-d H:i:s'); // Format the result

		session_regenerate_id(true);
		$_SESSION['login'] = array(
			'sessid' => $sessid,
			'uagent' => hash('sha3-224', $_SERVER["HTTP_USER_AGENT"]),
			'user' => $user,
			'expire'=>$expire
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
		
		if(isset($user[0]) && !is_null($user) && $user[0]['password']!='' && \Facades\Hash::verify($request['password'], $user[0]['password'] )!=false )
		{
			if($user[0]['active']!='1')
			{
				return false;
			}
			Auth::login(md5(time()), $user[0]['name'], $user[0]['id']);
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
		if(isset($_SESSION['login']['sessid']) && !empty($_SESSION['login']))
		{
			if(strtotime($_SESSION['login']['expire']) <=  strtotime(Date('Y-m-d H:i:s')))
			{
				Redirect::with('info','Sua sessão expirou por favor logue novamente');
				return Redirect::to('logout');
			}
			$result =  DB::getInstance()->table('sessions')->where('sessid', 'LIKE', $_SESSION['login']['sessid'])->get();
			if ($result !=false && !empty($result[0])) 
			{
				return true;
			} 
			else 
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}

	/**logi
	 * Logout
	 * @return void
	 */
	public static  function logout(): void
	{
		if (isset($_SESSION['login']['sessid']) && $_SESSION['login']['sessid'] != '') 
		{
			# apaga sessao do banco
			$res=  DB::getInstance()->table('sessions')->delete('sessid', 'LIKE', @$_SESSION['login']['sessid']);
			unset($_SESSION['login']['sessid']);
		}

		$params = session_get_cookie_params();
		setcookie(session_name(), "", time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
		if (session_status() == PHP_SESSION_ACTIVE ) {
			// No session has been started, so start one
			#session_destroy();
			session_unset();
			session_write_close();
			$_COOKIE = array();
			unset($_COOKIE);
		}
		
	}

	public static function validade(array $request, $validation)
	{
		foreach(@$validation as $k => $v)
		{
			if(!isset($request[$k]) || is_null($request[$k]))
			{
				 Redirect::with('error',"Verifique os campos preenchidos,{$request[$k]}");
				 Redirect::back(); 
			}
			$rules = explode(':', $v);
			if(isset($rules[1]))
			{
				$rule = $rules[1];
				if((strlen($request[$k]) < intval($rules))!=false )
				{
					header('Location: '.Redirect::back()->with('error',"Verifique os campos preenchidos,{$request[$k]}"));
				}
			}
			return true;		
	
		}


	}

	public static function user()
	{
		if (isset($_SESSION['login']))
		{
			$user = DB::getInstance()->table('users')->where('name', '=', $_SESSION['login']['user'])->get();
			if ($user[0] !=false && !empty($user[0])) 
			{
				return $user[0];
			} 
			else 
			{
				return false;
			}
		} 
	}

	public static function check()
	{
		if(!static::logged())
		{
			echo "<script>window.location.href='".url('login')."'</script>";
		}
	}

	public static function public()
	{
		if(static::logged())
		{
			return true;
		}
		
	}

	public static function admin()
	{
		if(static::user()['admin']!='1')
		{
			#return \Facades\Redirect::back();
			return \Facades\Unauthorized::handle();
		}
	}
}
