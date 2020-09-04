<?php
	$isSubmitted = false;
	$errors = [];

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$isSubmitted = true;

		// inputs filters
		$code = trim(filter_input(INPUT_POST, 'code_company', FILTER_SANITIZE_NUMBER_INT));
		if (empty($code)) {
			$errors['code'] = 'Un code entreprise est nécessaire';
		}
		elseif (!preg_match('/^[0-9]{6}$/', $code)) {
			$errors['code'] = 'Veuillez entrer un code à 6 chiffres';
		}

		$email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING));
		if (empty ($email)){
			$errors['email'] = 'Veuillez saisie votre adresse email';
		}
		elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$errors['email'] = 'Votre adresse email n\'est pas dans un format correcte';
		}

		if (empty($_POST['password'])) {
			$errors['password'] = 'Veuillez saisir votre mot de passe';
		}
	}

	if($isSubmitted && count($errors) == 0){
		// create session with id, login and permissions
		// create cookies for save session when user close the window
		$_SESSION['user'] = ['auth' => true, 'id' => 1, 'login' => $email, 'permission' => 'employee'];
		$encrypted_id = openssl_encrypt($_SESSION['user']['id'], 'AES-128-ECB', CRYPT_KEY); // crypt ID
		$encrypted_login = openssl_encrypt($_SESSION['user']['login'], 'AES-128-ECB', CRYPT_KEY); // crypt email
		$encrypted_permission = openssl_encrypt($_SESSION['user']['permission'], 'AES-128-ECB', CRYPT_KEY); // crypt permission
		setcookie('user_id', $encrypted_id, time() + 365*24*3600, null, null, false, true);
		setcookie('user_login', $encrypted_login, time() + 365*24*3600, null, null, false, true);
		setcookie('user_permission', $encrypted_permission, time() + 365*24*3600, null, null, false, true);
		header('location: introduction');
		exit();
	}