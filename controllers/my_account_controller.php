<?php
	session_start();
	include dirname(__FILE__).'/../utils/control_session.php';
	empty_session(); // check if session is empty

	include dirname(__FILE__).'/../utils/get_scriptname.php';

	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['logout'])) {
		// parcourt le tableaux des cookies
		foreach ($_COOKIE as $cookie_name => $cookie_value) {
			// vide la variable cookie
			unset($_COOKIE[$cookie_name]);
			// désactive le cookie avec une valeur dans le passé
			setcookie($cookie_name, '', time() - 3600, null, null, false, true);
		}
		// vide la variable session
		unset($_SESSION['user']);
		// détruit la session
		session_destroy();
		header('location: authentification');
		exit();
	}

	$title = 'Mon profil Co\'working';
	$description = 'Personnalisez votre profil et paramétrez votre compte Co\'working';
	require_once dirname(__FILE__).'/../views/includes/header.php'; // include header

	require_once dirname(__FILE__).'/../views/includes/navbar.php'; // include navbar

	require_once dirname(__FILE__).'/../views/my_account_view.php'; // include view

	require_once dirname(__FILE__).'/../views/includes/footer.php'; // include footer