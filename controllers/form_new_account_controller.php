<?php
	require_once dirname(__FILE__).'/../models/User.php'; // insert class User
	require_once dirname(__FILE__).'/../models/Company.php'; // insert class Company

	$user = new User(); // instance of the class user
	$company = new Company(); // instance of the class company

	// common variables to both forms
	$isSubmitted = false;
	$sexe = null;
	$lastname = null;
	$firstname = null;
	$email = null;
	$password = null;
	$confirm_password = null;

	// variable for employee form
	$code_company = null;

	// variable pour factory form
	$name_company = null;
	$siret = null;
	$adress_number = null;
	$number_add = null;
	$address = null;
	$adress_add = null;
	$postal_code = null;
	$postal_code = null;
	$phone = null;
	$mobile = null;
	$owner = null;	

	// error table
	$errors = [];

	// when the form is submitted
	// checks the presence of POST
	if (count($_POST) > 0) {
		$isSubmitted = true;
		// verifies that gender exists
		if (empty($_POST['sexe'])) {
			$errors['sexe'] = 'Veuillez choisir votre civilité';
		}
		elseif ($_POST['sexe'] != '1' && $_POST['sexe'] != '2') {
			$errors['sexe'] = 'La donnée choisie n\'est pas correcte';
		}

		// filters the first and last name
		$firstname = trim(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING));
	    if (empty($firstname)){
	        $errors['firstname'] = 'Veuillez saisir votre prénom';
	    }
	    elseif (!preg_match('/^[a-zéèîïêëçà]+((?:\-|\s)[a-zéèéîïêëçà]+)?$/i', $firstname)) {
	        $errors['firstname'] = 'Le format attendu n\'est pas respecté';
	    }

	    $lastname = trim(filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING));
	    if (empty($lastname)){
	        $errors['lastname'] = 'Veuillez saisir votre nom';
	    }
	    elseif (!preg_match('/^[a-zéèîïêëçà]+((?:\-|\s)[a-zéèéîïêëçà]+)?$/i', $lastname)) {
	        $errors['lastname'] = 'Le format attendu n\'est pas respecté';
	    }

	    // filters the email address
	    $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING));
	    if (empty ($email)){
	        $errors['email'] = 'Veuillez saisie votre adresse email';
	    }
	    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	        $errors['email'] = 'Le format attendu n\'est pas respecté';
	    }
	    else{
	    	$user->email = $email;
	    	$nb_user = $user->checkMail();
	    	if ($nb_user > 0) {
	    		$errors['email'] = 'Votre adresse email est déjà utilisée';
	    	}
	    }

		// removes spaces before and after
	    $password = trim($_POST['password']);
	    $confirmPassword = trim($_POST['confirm_password']);
	    if (!empty($password)) {
	    	//verifies that the two passwords are identical
	    	if ($password != $confirmPassword) {
	    		$errors['confirm_password'] = 'Les mots de passe ne sont pas identiques';
	    	}
	    	else{
	    		$_POST['password'] = password_hash($password, PASSWORD_BCRYPT);
	    	}
	    }
	    else{
	    	$errors['password'] = 'Veuillez choisir un mot de passe';
	    }

	    // processing for employee forms
	    if (isset($_POST['type']) && $_POST['type'] == 'employee') {
	    	// filters the company code
		    $code = trim(filter_input(INPUT_POST, 'code_company', FILTER_SANITIZE_NUMBER_INT));
		    if (empty($code)) {
		    	$errors['code_company'] = 'Veuillez saisir votre code entreprise';
		    }
		    elseif (!preg_match('/^[0-9]{6}$/', $code)) {
		    	$errors['code_company'] = 'Un code à 6 chiffres est attendu';
		    }
		    else{
		    	$company->company_code = $code;
	    		$nb_company = $company->checkCompany();
	    		if ($nb_company == 0) {
	    			$errors['code_company'] = 'Aucune entreprise ne correspond à ce code';
	    		}
		    }
	    }

	    // treatment employer form
	    elseif (isset($_POST['type']) && $_POST['type'] == 'factory') {
	    	$name_company = trim(filter_input(INPUT_POST, 'name_company', FILTER_SANITIZE_STRING));
	    	if (empty($name_company)) {
	    		$errors['name_company'] = 'Veuillez saisir le nom de votre entreprise'; 
	    	}

	    	$siret = trim(filter_input(INPUT_POST, 'siret', FILTER_SANITIZE_NUMBER_INT));
	    	if (empty($siret)) {
	    		$errors['siret'] = 'Veuillez saisir votre numéro de SIRET';
	    	}
	    	elseif (!preg_match('/^[0-9]{14}$/', $siret)) {
	    		$errors['siret'] = 'Veuillez entrer un numéro de SIRET valide';
	    	}

	    	$adress_number = trim(filter_input(INPUT_POST, 'adress_number', FILTER_SANITIZE_NUMBER_INT));
	    	if (!empty($adress_number)) {
	    		if (!preg_match('/^[0-9]{1,4}$/', $adress_number)) {
	    			$errors['adress_number'] = 'Veuillez saisir un numéro correcte';
	    		}
	    	}

	    	if (!empty($_POST['number_add'])) {
	    		if ($_POST['number_add'] != 'bis' || $_POST['number_add'] != 'ter' || $_POST['number_add'] != 'quarter') {
	    			$errors['number_add'] = 'La donnée choisie n\'est pas correcte';
	    		}
	    	}

	    	$adress = trim(strip_tags($_POST['adress']));
	    	$adress_add = trim(strip_tags($_POST['adress_add']));
	    	if (!empty($adress_add) && empty($adress)) {
	    		$errors['adress'] = 'Veuillez renseigner votre adresse en plus du complément';
	    	}

	    	$postal_code = trim(filter_input(INPUT_POST, 'postal_code', FILTER_SANITIZE_NUMBER_INT));
	    	if (empty($postal_code)) {
	    		$errors['postal_code'] = 'Veuillez renseigner votre code postale';
	    	}
	    	elseif (!preg_match('/^[0-9]{5}$/', $postal_code)) {
	    		$errors['postal_code'] = 'Le format attendu n\'est pas respecté';
	    	}

	    	$phone = trim(strip_tags($_POST['phone']));
	    	$mobile = trim(strip_tags($_POST['mobile']));
	    	if (empty($phone) && empty($mobile)) {
	    		$errors['phone'] = 'Renseignez au moins un numéro';
	    	}
	    	else{
	    		if (!empty($phone) && !preg_match('/^(?:\+33|0033|0)[1-59]((?:([\-\/\s\.])?[0-9]){2}){4}$/', $phone)) {
	    			$errors['phone'] = 'Le format de votre numéro n\'est valide';
	    		}

	    		if (!empty($mobile) && !preg_match('/^(?:\+33|0033|0)[6-7]((?:([\-\/\s\.])?[0-9]){2}){4}$/', $mobile)) {
	    			$errors['mobile'] = 'Le format de votre numéro n\'est valide';
	    		}
	    	}
	    }

	    // convert datas to json
	    exit(json_encode($errors));
	}

	if (isset($_GET['type']) && $_GET['type'] == "employee") {
		require_once dirname(__FILE__).'/../views/form_new_account_employee_view.php';
	}
	elseif (isset($_GET['type']) && $_GET['type'] == "factory") {
		require_once dirname(__FILE__).'/../views/form_new_account_factory_view.php';
	}
?>