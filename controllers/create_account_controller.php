<?php
	session_start(); // start the session
	require dirname(__FILE__).'/../config/config.php'; // include const
	include dirname(__FILE__).'/../utils/control_session.php';
	isset_session(CRYPT_KEY); // check the existence of the session

	include dirname(__FILE__).'/../utils/get_scriptname.php';

	$successCreate = false;

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		require_once dirname(__FILE__).'/../models/User.php'; // insert class User
		require_once dirname(__FILE__).'/../models/Company.php'; // insert class Company
		require_once dirname(__FILE__).'/../models/Inscription.php'; // insert class Inscription
		require_once dirname(__FILE__).'/../utils/mails.php';

		$company = new Company; // instance of the class company

		$successCreate = true;
		$date = new DateTime(); // create new date with now
		$date = $date->setTimezone(new DateTimeZone('Europe/Paris'));
		$date = $date->add(new DateInterval('P2D')); // add 2 days

		// sanitize variables
		$firstname = trim(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING));
		$lastname = trim(filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING));
		$email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING));
		$password = trim($_POST['password']);
		$password = password_hash($password, PASSWORD_BCRYPT); // crypt password

		if (isset($_GET['type']) && $_GET['type'] == "employee") {
				$code = trim(filter_input(INPUT_POST, 'code_company', FILTER_SANITIZE_NUMBER_INT));
		}
		elseif (isset($_GET['type']) && $_GET['type'] == "factory") {
			// sanitize variables
			$name_company = trim(filter_input(INPUT_POST, 'name_company', FILTER_SANITIZE_STRING));
			$siret = trim(filter_input(INPUT_POST, 'siret', FILTER_SANITIZE_NUMBER_INT));
			$address_number = (int) trim(strip_tags($_POST['address_number']));
			$number_add = trim(filter_input(INPUT_POST, 'number_add', FILTER_SANITIZE_STRING));
			$address = trim(filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING));
	    	$address_add = trim(filter_input(INPUT_POST, 'address_add', FILTER_SANITIZE_STRING));
	    	$city = trim(filter_input(INPUT_POST, 'city', FILTER_SANITIZE_NUMBER_INT));
	    	$phone = trim(strip_tags($_POST['phone']));
	    	$mobile = trim(strip_tags($_POST['mobile']));
	    	$owner = trim(filter_input(INPUT_POST, 'owner', FILTER_SANITIZE_NUMBER_INT));

			if (!empty($phone)) {
				$phone = str_replace('+33', '0', $phone);
		    	$phone = str_replace(' ', '', $phone);
		    	$phone = str_replace('.', '', $phone);
		    	$phone = str_replace('-', '', $phone);
		    }

		    if (!empty($mobile)) {
		    	$mobile = str_replace('+33', '0', $mobile);
		    	$mobile = str_replace(' ', '', $mobile);
		    	$mobile = str_replace('.', '', $mobile);
		    	$mobile = str_replace('-', '', $mobile);
		    }

		    if (isset($owner)) {
		    	$owner = 2;
		    	$owner = openssl_encrypt($owner, 'AES-128-ECB', CRYPT_KEY); // crypt permission
		    }
		    else {
		    	$owner = 1;
		    	$owner = openssl_encrypt($owner, 'AES-128-ECB', CRYPT_KEY); // crypt permission
		    }

		    $code = rand(100000, 999999); // create company code
		    $company->company_code = $code;
		    $exist = $company->checkCompany(); // verify if this code already exist
		    while ($exist != 0) { // while this code existe, generate new code
		    	$code = rand(100000, 999999);
		    	$company->company_code = $code;
		    	$exist = $company->checkCompany();
		    }

		    $token = bin2hex(random_bytes(30)); // create token for link validation in mail

			$userArray = array(
				'gender' => $_POST['sexe'],
				'lastname' => $lastname,
				'firstname' => $firstname,
				'email' => $email,
				'password' => $password,
				'permission' => $owner,
				'ban' => 0,
				'temporary_code' => $token,
				'multi_step' => 0,
				'company_id' => null
			);

			try {
				$user = new User($userArray); // instance of the class user

				//hydrate class company
				$company->company_code = $code;
				$company->company_name = $name_company;
				$company->siret = $siret;
				$company->address_number = $address_number;
				$company->number_complement = $number_add;
				$company->address = $address;
				$company->address_complement = $address_add;
				$company->city = $city;
				$company->phone_number = $phone;
				$company->mobile_number = $mobile;

				$user->database->beginTransaction(); // start transaction
				$user->create(); // method for insert new user
    			$company->users_id_manager = $user->id; // hydrate company with the lastInsertId of user  
    			$company->create(); // insert new company
    			$inscriptionArray = array('user_id' => $user->id, 'company_id' => $company->id);
    			$inscription = new Inscription($inscriptionArray);
    			$inscription->create(); // insert new inscription  
      			$user->database->commit(); // send all queries

      			$successCreate = true;
      			$to = $user->email; // affect receiver mail
      			$subject = 'Bienvenue sur Co\'working'; // subject of the mail
      			// text of the welcoming mail
      			$bodyMail = '
      			<p>
      				Bienvenue '.$user->firstname.' !
      			</p>
      			<p>
      				Vous venez de créer le réseau Co\'working pour l\'entreprise <strong>'.$company->company_name.'</strong>.
      				<br>
      				Pour activer votre compte et obtenir le code d\'identification de votre entreprise, cliquez sur le lien suivant : <a href="coworking.fr/activation-'.$user->id.'-'.$token.'">Activer mon compte</a>
      			</p>
      			<p>
      				L\'équipe Co\'working
      			</p>
      			';

      			sendmail($to, $subject, $bodyMail);
			}
			catch (PDOException $e) {
				echo $e->getMessage();
				$user->database->rollBack(); // canceled queries
			}
		}
	}

	$title = 'Créez votre compte Co\'working';
	$description = 'Créez votre compte Co\'working et rejoingnez vos coéquipier ou enregistrez votre entreprise pour avoir un suivi de la santé de votre entreprise';
	require_once dirname(__FILE__).'/../views/includes/header.php'; // include header

	require_once dirname(__FILE__).'/../views/create_account_view.php'; // include view

	require_once dirname(__FILE__).'/../views/includes/footer.php'; // include footer