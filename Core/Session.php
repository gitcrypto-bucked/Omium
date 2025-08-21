<?php


if (session_status() !== PHP_SESSION_ACTIVE) 
{
			/**
			 * Marks the cookie as accessible only through the HTTP protocol.
			 * This means that the cookie won't be accessible by scripting languages, such as JavaScript.
			 * This setting can effectively help to reduce identity theft through XSS attacks (although it is not supported by all browsers).
			 */
			ini_set('session.cookie_httponly', true);

			/**
			 * Specifies whether the module will only use cookies to store the session id on the client side.
			 * Enabling this setting prevents attacks involved passing session ids in URLs.
			 * This setting was added in PHP 4.3.0. Defaults to 1 (enabled) since PHP 5.3.0.
			 */
			ini_set('session.use_only_cookies', true);

			/**
			 * Essa opção evita que o módulo de sessão utilize um ID de sessão que não tenha sido inicializado.
			 * Em outras palavras, o módulo de sessão aceita apenas ID de sessão válido e que tenha sido gerado pelo módulo de sessão.
			 * O módulo de sessão rejeita o ID caso ele tenha sido fornecido pelo usuário.
			 */
			ini_set('session.use_strict_mode', true);

			/**
			 * Specifies whether cookies should only be sent over secure connections.
			 * Defaults to off. This setting was added in PHP 4.0.4.
			 * See also session_get_cookie_params() and session_set_cookie_params().
			 */
			ini_set('session.cookie_secure', true);

			/**
			 * Allows you to specify the hash algorithm used to generate the session IDs.
			 * '0' means MD5 (128 bits) and '1' means SHA-1 (160 bits).
			 * Since PHP 5.3.0 it is also possible to specify any of the algorithms provided by the hash extension (if it is available), like sha512 or whirlpool.
			 * A complete list of supported algorithms can be obtained with the hash_algos() function.
			 */
			ini_set('session.hash_function', 'whirlpool');

			/**
			 * Allows you to define how many bits are stored in each character when converting the binary hash data to something readable.
			 * The possible values are '4' (0-9, a-f), '5' (0-9, a-v), and '6' (0-9, a-z, A-Z, "-", ",").
			 */
			ini_set('session.hash_bits_per_character', 6);

			/**
			 * Gives a path to an external resource (file) which will be used as an additional entropy source in the session id creation process.
			 * Examples are /dev/random or /dev/urandom which are available on many Unix systems.
			 * This feature is supported on Windows since PHP 5.3.3.
			 * Setting session.entropy_length to a non zero value will make PHP use the Windows Random API as entropy source.
			 */
			ini_set('session.entropy_file', '/dev/urandom');

			/**
			 * Specifies the number of bytes which will be read from the file specified above. Defaults to 0 (disabled).
			 */
			ini_set('session.entropy_length', 512);

			/**
			 * Whether transparent sid support is enabled or not. Defaults to 0 (disabled).
			 * Note: URL based session management has additional security risks compared to cookie based session management.
			 * Users may send a URL that contains an active session ID to their friends by email or users may save a URL that contains a session ID to their bookmarks and access your site with the same session ID always, for example.
			 */
			ini_set('session.use_trans_sid', 0);

			/**
			 * "0" tem um sentido especial. Ele diz para o navegador não armazenar cookies no armazenamento permanente.
			 * Sendo assim, quando o navegador é encerrado, o cookie com o ID de sessão é deletado imediatamente.
			 * Se o desenvolvedor configurar um valor diferente de "0", pode permitir que outros usuários utilizem o ID de sessão.
			 * A maioria das aplicações devem utilizar "0"
			 */
			ini_set('session.cookie_lifetime', 0);

			/**
			 * As of PHP 7.3 the "SameSite" attribute can be set for the session ID cookie.
			 * This attribute is a way to mitigate CSRF (Cross Site Request Forgery) attacks.
			 * The difference between Lax and Strict is the accessibility of the cookie in requests originating from another registrable domain employing the HTTP GET method.
			 * Cookies using Lax will be accessible in a GET request originated from another registrable domain, whereas cookies using Strict will not.
			 */
			ini_set('session.cookie_samesite', 'Strict');

			/**
			 * Certifique-se de que o conteúdo HTTP não é armazenado em cache para sessões autenticadas.
			 * Permita o armazenamento em cache apenas quando o conteúdo não é privado. Caso contrário, o conteúdo pode ser exposto.
			 * "private" pode ser usado se o conteúdo HTTP não incluir dados sensíveis/confidenciais.
			 * Note que "private" pode fazer com que dados privados sejam armazenados em cache em clientes compartilhados.
			 * "public" pode ser usado somente quando o conteúdo HTTP não contém dados privados e ou confidenciais.
			 */
			ini_set('session.cache_limiter', 'nocache');

			session_start();
}
