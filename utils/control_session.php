<?php
	function isset_session($key){

		// si la session n'est pas vide on autorise la connexion
		if (!empty($_SESSION['user'])) {
			header('location: news');
			exit();
		}
		// sinon on vérifie la présence des cookies pour recréer la session
		elseif (!empty($_COOKIE['user_id']) && !empty($_COOKIE['user_login']) && !empty($_COOKIE['user_permission']) && !empty($_COOKIE['company_id'])) {
			$decrypted_id = openssl_decrypt($_COOKIE['user_id'], 'AES-128-ECB', $key); // decrypt id
			$decrypted_login = openssl_decrypt($_COOKIE['user_login'], 'AES-128-ECB', $key); // decrypt login
			$decrypted_permission = openssl_decrypt($_COOKIE['user_permission'], 'AES-128-ECB', $key); // decrypt permission
			$decrypted_company = openssl_decrypt($_COOKIE['company_id'], 'AES-128-ECB', $key);
			$infoSession = ['auth' => true, 'id' => $decrypted_id, 'login' => $decrypted_login, 'permission' => $decrypted_permission]; // session informations
			$_SESSION['user'] = $infoSession;
			header('location: news');
			exit();
		}
	}

	function empty_session(){
		// redirige vers l'index si la session est vide
		if (!isset($_SESSION['user'])) {
			header('location: authentification');
			exit();
		}
	}
?>