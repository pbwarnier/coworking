<?php
	session_start();
	include dirname(__FILE__).'/../utils/control_session.php';
	empty_session(); // check if session is empty

	include dirname(__FILE__).'/../utils/get_scriptname.php';
	include dirname(__FILE__).'/../utils/image_treatment.php';
	require_once dirname(__FILE__).'/../utils/convert_date.php'; // insert function to convert date in french
	require_once dirname(__FILE__).'/../models/User.php'; // insert class User
	require_once dirname(__FILE__).'/../models/Skill.php'; // insert class Skill
	require_once dirname(__FILE__).'/../models/Work.php'; // insert class Work

	$user = new User(['id' => $_SESSION['user']['id']]);
	$skill = new Skill(['users_id' => $_SESSION['user']['id']]);
	$work = new Work(['users_id' => $_SESSION['user']['id']]);
	$isSubmitted = false;
	$updateSuccess = false;
	$lastname = null;
	$firstname= null;
	$birthdate = null;
	$img = null;
	$city = null;
	$biography = null;
	$errors = [];
	$nbDiv = 1;

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
	elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['change-picture'])) {
		$isSubmitted = true;
		if (!empty($_FILES["userPicture"]['name']) && !empty($_FILES['userPicture']['tmp_name']) && $_FILES['userPicture']['size'] > 0) {
			$target_dir = '../users/'.$_SESSION['user']['id'].'/img/';
			$target_file = $target_dir.basename($_FILES["userPicture"]["name"]);
			$imgFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

			// check if $_FILES is a picture
			$check = getimagesize($_FILES["userPicture"]["tmp_name"]);
			if ($check === false){
				$errors['userPicture'] = 'Votre fichier n\'est pas une image';	
			}

			// check image size
			if ($_FILES["userPicture"]["size"] > 10000000){
				$errors['userPicture'] = 'Pour être prise en charge, votre image ne dois pas dépasser 10 Mo';
			}

			// check image extension
			if ($imgFileType != "jpg" && $imgFileType != "png" && $imgFileType != "jpeg" && $imgFileType != "gif"){
				$errors['userPicture'] = 'Seuls les formats JPG, JPEG, PNG et GIF sont accéptés';
			}

			// checks if the file already exists
			if (file_exists($target_file)){
				// function to create copy
				$target_file = copyFile($target_dir, $_FILES["userPicture"]["name"]);
			}
		}
		else{
			$errors['file'] = 'Aucune image n\'est sélectionnée';
		}

		if (count($errors) == 0) {
			$path = pathinfo($target_file);
			if (move_uploaded_file($_FILES["userPicture"]["tmp_name"], $target_file)) {
				resize_crop_image(1000, 1000, $target_file, $target_dir.$path['filename'].'_resize.'.$path['extension']);
				$img = $target_dir.$path['filename'].'_resize.'.$path['extension'];
			}
			else {
				$errors['file'] = 'Erreur upload';
			}
		}

		// create array with columns which can be modified
		$arrayUpdates = array('img' => $img);
	}
	elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
		$isSubmitted = true;

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

	    $birthdate = trim(filter_input(INPUT_POST, 'birthdate', FILTER_SANITIZE_STRING));
	    if (!empty($birthdate)) {
    		// convert birthdate in standart format
    		$birthdate = DateTime::createFromFormat('d/m/Y', $birthdate);
    		$birthdate = $birthdate -> format('Y-m-d');

    		// today timestamp
    		$today = strtotime("NOW");
    		// input timestamp
    		$convertBirthdate = strtotime($birthdate);
    		if (!preg_match('/^((?:19|20)[0-9]{2})-((?:0[1-9])|(?:1[0-2]))-((?:0[1-9])|(?:1[0-9])|(?:2[0-9])|(?:3[01]))$/', $birthdate)) {
    			$errors['birthdate'] = 'Veuillez renseigner une date correcte';
    		}
    		// check if birthdate was before today
    		elseif ($convertBirthdate > $today) {
    			$errors['birthdate'] = 'La date ne peut pas être postérieure à ce jour';
    		}
    	}

    	$city = trim(filter_input(INPUT_POST, 'city', FILTER_SANITIZE_NUMBER_INT));
    	if (!empty($city) && !ctype_digit($city)) {
    		$errors['city'] = 'Choisir une ville parmi la liste';
    	}

    	$biography = trim(filter_input(INPUT_POST, 'biography', FILTER_SANITIZE_STRING));

    	// create array with columns which can be modified
		$arrayUpdates = array(
			'lastname' => $lastname,
			'firstname' => $firstname,
			'birthdate' => $birthdate,
			'city' => intval($city),
			'biography' => $biography
		);
	}
	elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['skillName'])) {
		$skillName = trim(filter_var($_POST['skillName'], FILTER_SANITIZE_STRING));
		$skill->skill_name = $skillName;
		$insertSuccess = $skill->insert();
		
		$response = array(
			'insertSuccess' => $insertSuccess,
			'lastId' => $skill->id,
			'skill_name' => $skillName
		);

		echo json_encode($response);
		exit();
	}
	elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['skill_id'])) {
		$skill_id = trim(filter_var($_POST['skill_id'], FILTER_SANITIZE_NUMBER_INT));
		$skill->id = $skill_id;
		$deleteSuccess = $skill->delete();
		echo $deleteSuccess;
		exit();
	}

	if ($isSubmitted && count($errors) == 0) {
		foreach ($arrayUpdates as $key => $value) {
			$arrayColumns[] = '`'.$key.'` = :'.$key; // insert columns and params in array

			if (!empty($value)) {
				$user->$key = $value; // hydrate user object
			}
			else{
				$user->$key = null;
			}
		}

		$updateSuccess = $user->update($arrayColumns, $arrayUpdates); // update user and send columns names for update request
	}

	$userInfo = $user->selectProfil();
	$list_skills = $skill->selectAll();
	$list_experience = $work->selectAll();

	$title = 'Mon profil Co\'working';
	$description = 'Personnalisez votre profil et paramétrez votre compte Co\'working';
	require_once dirname(__FILE__).'/../views/includes/header.php'; // include header

	require_once dirname(__FILE__).'/../views/includes/navbar.php'; // include navbar

	require_once dirname(__FILE__).'/../views/my_account_view.php'; // include view

	require_once dirname(__FILE__).'/../views/includes/footer.php'; // include footer