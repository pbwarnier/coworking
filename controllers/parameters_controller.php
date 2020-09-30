<?php
	session_start();
	include dirname(__FILE__).'/../utils/control_session.php';
	empty_session(); // check if session is empty

	include dirname(__FILE__).'/../utils/get_scriptname.php';
	require_once dirname(__FILE__).'/../models/User.php'; // insert class User

	$user = new User(['id' => $_SESSION['user']['id']]);

	$isSubmitted = false;
	$errors = [];

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$isSubmitted = true;

		if (isset($_GET['tab']) && $_GET['tab'] == 'username') {
			$lastname = trim(filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING));
			if (empty($lastname)){
	        	$errors['lastname'] = 'Veuillez renseigner votre nom.';
	    	}
	    	elseif (!preg_match('/^[a-zéèîïêëç]+((?:\-|\s)[a-zéèéîïêëç]+)?$/i', $lastname)) {
	        	$errors['lastname'] = 'Le format attendu n\'est pas respecté';
	    	}

	    	$firstname = trim(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING));
	    	if (empty($firstname)){
	        	$errors['firstname'] = 'Veuillez renseigner votre prénom.';
	    	}
	    	elseif (!preg_match('/^[a-zéèîïêëç]+((?:\-|\s)[a-zéèéîïêëç]+)?$/i', $firstname)) {
	        	$errors['firstname'] = 'Le format attendu n\'est pas respecté';
	    	}
		}

		if (isset($_GET['tab']) && $_GET['tab'] == 'birthdate') {
			$day = trim(filter_input(INPUT_POST, 'day', FILTER_SANITIZE_NUMBER_INT));
			$month = trim(filter_var($_POST['month'], FILTER_SANITIZE_NUMBER_INT));
			$year = trim(filter_input(INPUT_POST, 'year', FILTER_SANITIZE_NUMBER_INT));

			if ($month < 10) { $month = '0'.$month; }

			$birthdate = $year.'-'.$month.'-'.$day;
			$convertDate = strtotime($birthdate);
			$today = strtotime('NOW');

			if (!preg_match('/^((?:19|20)[0-9]{2})-((?:0[1-9])|(?:1[0-2]))-((?:0[1-9])|(?:1[0-9])|(?:2[0-9])|(?:3[01]))$/', $birthdate)) {
    			$errors['birthdate'] = 'Veuillez renseigner une date correcte';
    		}
    		// vérifie que la date reste inférieur à NOW
    		elseif ($convertDate > $today) {
    			$errors['birthdate'] = 'Votre date ne peut pas être supérieur à la date du jour';
    		}
		}

		if (isset($_GET['tab']) && $_GET['tab'] == 'gender') {
			$gender = trim(filter_var($_POST['gender'], FILTER_SANITIZE_NUMBER_INT));
			if (empty($gender)) {
				$errors['gender'] = 'Veuillez choisir une civilité';
			}
			elseif ($gender != '1' && $gender != '2' && $gender != '3') {
				$errors['gender'] = 'La donnée n\'est pas valide';
			}

			if ($gender == '3') {
				$personalized = trim(filter_input(INPUT_POST, 'gender_personalized', FILTER_SANITIZE_STRING));
				if (empty($personalized)) {
					$errors['gender-p'] = 'Veuillez saisir votre civilité';
				}
				elseif (!preg_match('/^[a-zéèîïêëç]+((?:\-|\s)[a-zéèéîïêëç]+)?$/i', $personalized)) {
		        	$errors['gender-p'] = 'Le format attendu n\'est pas respecté';
		    	}
			}
		}
	}

	$userInfo = $user->getNavInfo();

	$title = 'Paramètres de mon compte Co\'working';
	$description = 'Modifiez les informations de votre compte, renforcez votre sécurité et gérez vos notifications.';
	require_once dirname(__FILE__).'/../views/includes/header.php'; // include header

	require_once dirname(__FILE__).'/../views/includes/navbar.php'; // include navbar

	require_once dirname(__FILE__).'/../views/parameters_view.php'; // include view

	require_once dirname(__FILE__).'/../views/includes/footer.php'; // include footer