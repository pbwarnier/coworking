<?php
	include dirname(__FILE__).'/../utils/get_scriptname.php';
	require dirname(__FILE__).'/../config/config.php'; // include const
	require_once dirname(__FILE__).'/../models/User.php'; // insert class User
	require_once dirname(__FILE__).'/../models/Company.php'; // insert class Company
	require_once dirname(__FILE__).'/../models/Inscription.php'; // insert class Inscription
	require_once dirname(__FILE__).'/../utils/mails.php';

	if (ctype_digit($_GET['id']) && isset($_GET['token'])) {
		$user = new User(['id' => $_GET['id']]);
		$permission = $user->permission();
		$permission = openssl_decrypt($permission, 'AES-128-ECB', CRYPT_KEY);
		var_dump($permission);
	}

	$title = 'Activation du compte Co\'working';
	$description = 'Activer mon comptre Co\'working et commencer à personnaliser mon compte';

	require_once dirname(__FILE__).'/../views/includes/header.php'; // include header

	require_once dirname(__FILE__).'/../views/activation_view.php'; // include view

	require_once dirname(__FILE__).'/../views/includes/footer.php'; // include footer
	