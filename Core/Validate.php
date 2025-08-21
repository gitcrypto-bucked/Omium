<?php

namespace Core;

class Validate
{
	/**
	 * Aceita POST apenas de dentro do site
	 * @throws Exception
	 * @return void
	 */
	public static function doPost(): void
	{
		if (strtolower($_SERVER['REQUEST_METHOD']) !== 'post') {
			if (Config::DEBUG)
				throw new \Exception('ONLY POST METHODS!');
			else
				header('Location: /');
			exit;
		}
		if ($_SERVER['HTTP_ORIGIN'] !== Config::DOMAIN) {
			if (Config::DEBUG)
				throw new \Exception('DOMAIN ERROR!');
			else
				header('Location: /');
			exit;
		}
	}

	/**
	 * Bloqueia métodos
	 * @see chamado por Core\Controller::__call
	 * @throws Exception
	 * @return void
	 */
	public static function blockMethods(): void
	{
		if (!in_array(strtolower($_SERVER['REQUEST_METHOD']), ['get', 'post', 'put', 'delete']))
        {
			if (Config::DEBUG)
				throw new \Exception("{$_SERVER['REQUEST_METHOD']} METHOD NOT ALLOWED", 405);
			else
				header('HTTP/1.0 405 Method Not Allowed');
			exit;
		}
	}
}
