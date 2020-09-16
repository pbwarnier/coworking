<?php
	require_once dirname(__FILE__).'/../models/User.php';
	require_once dirname(__FILE__).'/../models/Company.php';
	require_once dirname(__FILE__).'/../models/Inscription.php';
	require_once dirname(__FILE__).'/../models/History.php';
	require_once dirname(__FILE__).'/../models/Device.php';
	require_once dirname(__FILE__).'/../utils/info_connexion.php';

	$isSubmitted = false;
	$errors = [];

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$isSubmitted = true;

		// inputs filters
		$code = trim(filter_input(INPUT_POST, 'code_company', FILTER_SANITIZE_NUMBER_INT));
		$email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING));
		$password = trim($_POST['password']);

		if (empty($code)) {
			$errors['code'] = 'Un code entreprise est nécessaire';
		}
		elseif (!preg_match('/^[0-9]{6}$/', $code)) {
			$errors['code'] = 'Veuillez entrer un code à 6 chiffres';
		}

		if (empty ($email)) {
			$errors['email'] = 'Veuillez saisie votre adresse email';
		}
		elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$errors['email'] = 'Votre adresse email n\'est pas dans un format correcte';
		}

		if (empty($password)) {
			$errors['password'] = 'Veuillez saisir votre mot de passe';
		}
	}

	if($isSubmitted && count($errors) == 0){
		$user = new User(['email' => $email]);
		$userInfo = $user->selectAuth(); // get informations for validate authentification

		if (isset($userInfo->email)) {
			if ($userInfo->email != $email) {
				$errors['login'] = 'Identifiants incorrectes';
				$errors['code'] = '';
				$errors['email'] = '';
				$errors['password'] = '';
			}
			elseif (!password_verify($password, $userInfo->password)) {
				$errors['login'] = 'Identifiants incorrectes';
				$errors['code'] = '';
				$errors['email'] = '';
				$errors['password'] = '';
			}
			elseif ($userInfo->ban == 1) {
				$errors['ban'] = 'Votre compte est suspendu suite à de nombreux reports, votre compte sera réactivé dans ... h';
				// check nb report, et motif du dernier report le plus présent
			}

			$inscription = new Inscription(['user_id' => $userInfo->users_id]);
			$inscription->checkAccess();
			if ($inscription->access == 0) {
				$errors['access'] = 'Vous n\'avez pas activé votre compte';
			}

			$permission = openssl_decrypt($userInfo->permission, 'AES-128-ECB', CRYPT_KEY);

			if ($permission == 1) {
				$company = new Company();
				$company->getCodeWithEmployee($userInfo->users_id);
			}
			elseif ($permission == 2) {
				$company = new Company(['users_id_manager' => $userInfo->users_id]);
				$company->getCodeWithManager();
			}

			if ($company->company_code != $code) {
				$errors['login'] = 'Identifiants incorrectes';
				$errors['code'] = '';
				$errors['email'] = '';
				$errors['password'] = '';
			}
		}
	}

	if($isSubmitted && count($errors) == 0){
		$os = detect_os(); // find device os of the user
		$browser = detect_browser(); // find browser used
		$ip = get_ip(); // return ip of user
		$mac = exec('getmac');
		$mac = strtok($mac, ' ');

		$historyArray = array(
			'os' => $os,
			'browser' => $browser,
			'ip' => $ip,
			'mac' => $mac,
			'users_id' => $userInfo->users_id
		);

		$history = new History($historyArray);
		$history->saveLogin();
		$nb_connexion = $history->countLogin();
		$company->getId();

		// create session with id, login and permissions
		// create cookies for save session when user close the window
		$_SESSION['user'] = ['auth' => true, 'id' => $userInfo->users_id, 'login' => $email, 'permission' => $userInfo->permission, 'company_id' =>  $company->company_id];
		$encrypted_id = openssl_encrypt($_SESSION['user']['id'], 'AES-128-ECB', CRYPT_KEY); // crypt ID
		$encrypted_login = openssl_encrypt($_SESSION['user']['login'], 'AES-128-ECB', CRYPT_KEY); // crypt email
		$encrypted_permission = openssl_encrypt($_SESSION['user']['permission'], 'AES-128-ECB', CRYPT_KEY);// crypt permission
		$encrypted_company = openssl_encrypt($_SESSION['user']['company_id'], 'AES-128-ECB', CRYPT_KEY);
		setcookie('user_id', $encrypted_id, time() + 365*24*3600, null, null, false, true);
		setcookie('user_login', $encrypted_login, time() + 365*24*3600, null, null, false, true);
		setcookie('user_permission', $encrypted_permission, time() + 365*24*3600, null, null, false, true);
		setcookie('company_id', $encrypted_company, time() + 365*24*3600, null, null, false, true);

		if ($nb_connexion != false && $nb_connexion == 1) {
			$device = new Device($history->id);
			$device->saveDevice();
			header('location: introduction');
		}
		elseif ($nb_connexion != false && $nb_connexion > 1) {
			header('location: news');
		}

		exit();
	}