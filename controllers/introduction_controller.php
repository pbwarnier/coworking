<?php
	session_start();
	include dirname(__FILE__).'/../utils/control_session.php';
	empty_session(); // check if session is empty

	include dirname(__FILE__).'/../utils/image_treatment.php';
	include dirname(__FILE__).'/../utils/get_scriptname.php';
	require_once dirname(__FILE__).'/../models/User.php';
	require_once dirname(__FILE__).'/../models/Work.php';

	$isSubmitted = false;
	$personalPic = false;
	$errors = [];

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$isSubmitted = true;

		if (!empty($_FILES["userPicture"]['name']) && !empty($_FILES['userPicture']['tmp_name']) && $_FILES['userPicture']['size'] > 0) {
			$personalPic = true;
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
		else {
			$target_file = '/assets/pictures/user.png';
		}

		$birthdate = trim(filter_input(INPUT_POST, 'birthdate', FILTER_SANITIZE_STRING));
    	if (!empty($birthdate)) {
    		// convert birthdate in standart format
    		$birthdate = DateTime::createFromFormat('d/m/Y', $birthdate);
    		$birthdate = $birthdate -> format('Y-m-d');

    		// créé le timestamp d'aujourd'hui
    		$today = strtotime("NOW");
    		// timestamp de mon input date
    		$convertBirthdate = strtotime($birthdate);
    		if (!preg_match('/^((?:19|20)[0-9]{2})-((?:0[1-9])|(?:1[0-2]))-((?:0[1-9])|(?:1[0-9])|(?:2[0-9])|(?:3[01]))$/', $birthdate)) {
    			$errors['birthdate'] = 'Veuillez renseigner une date correcte';
    		}
    		// vérifie que la date reste inférieur à NOW
    		elseif ($convertBirthdate > $today) {
    			$errors['birthdate'] = 'La date ne peut pas être postérieure à ce jour';
    		}
    	}

    	$city = trim(filter_input(INPUT_POST, 'city', FILTER_SANITIZE_NUMBER_INT));
    	if (isset($city) && !ctype_digit($city)) {
    		$errors['city'] = 'Choisir une ville parmi la liste';
    	}

    	$phone = trim(strip_tags($_POST['phone']));
    	if (!empty($phone)) {
    		if (!preg_match('/^(?:\+33|0033|0)[1-79]((?:([\-\/\s\.])?[0-9]){2}){4}$/', $phone)) {
	    		$errors['phone'] = 'Le format de votre numéro n\'est valide';
	    	}
	    	else {
	    		$phone = str_replace('+33', '0', $phone);
		    	$phone = str_replace(' ', '', $phone);
		    	$phone = str_replace('.', '', $phone);
		    	$phone = str_replace('-', '', $phone);
	    	}
	    }

	    $occupation = trim(filter_input(INPUT_POST, 'occupation', FILTER_SANITIZE_STRING));
	    if (empty($occupation)){
	        $errors['occupation'] = 'Veuillez préciser votre profession actuelle';
	    }
	    elseif (!preg_match('/^[a-zA-Zéèîïêëçô]+((?:\-|\s)[a-zA-Zéèéîïêëçô]+){0,}$/i', $occupation)) {
	        $errors['occupation'] = 'Veuillez saisir une donnée valide';
	    }

	    $date = trim(filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING));
    	if (!empty($date)) {
    		// convert birthdate in standart format
    		$date = DateTime::createFromFormat('d/m/Y', $date);
    		$date = $date -> format('Y-m-d');

    		// créé le timestamp d'aujourd'hui
    		$today = strtotime("NOW");
    		// timestamp de mon input date
    		$convertBirthdate = strtotime($date);
    		if (!preg_match('/^((?:19|20)[0-9]{2})-((?:0[1-9])|(?:1[0-2]))-((?:0[1-9])|(?:1[0-9])|(?:2[0-9])|(?:3[01]))$/', $date)) {
    			$errors['date'] = 'Veuillez renseigner une date correcte';
    		}
    		// vérifie que la date reste inférieur à NOW
    		elseif ($convertBirthdate > $today) {
    			$errors['date'] = 'Votre date ne peut pas être supérieur à la date du jour';
    		}
    	}
    	else {
    		$date = date("Y-m-d");
    	}

    	$biography = trim(filter_input(INPUT_POST, 'biography', FILTER_SANITIZE_STRING));

    	$skill_1 = trim(filter_input(INPUT_POST, 'skill_1', FILTER_SANITIZE_STRING));
    	$skill_2 = trim(filter_input(INPUT_POST, 'skill_2', FILTER_SANITIZE_STRING));
    	$skill_3 = trim(filter_input(INPUT_POST, 'skill_3', FILTER_SANITIZE_STRING));
    	$skill_4 = trim(filter_input(INPUT_POST, 'skill_4', FILTER_SANITIZE_STRING));
    	$skill_5 = trim(filter_input(INPUT_POST, 'skill_5', FILTER_SANITIZE_STRING));
	}

	if ($isSubmitted && count($errors) == 0){
		if ($personalPic === true) {
			$path = pathinfo($target_file);
			move_uploaded_file($_FILES["userPicture"]["tmp_name"], $target_file);
			resize_crop_image(1000, 1000, $target_file, $target_dir.$path['filename'].'_resize.'.$path['extension']);
			unlink($target_file); // delete file
			if (file_exists($target_dir.$path['filename'].'_resize.'.$path['extension'])) {
				$target_file = $target_dir.$path['filename'].'_resize.'.$path['extension'];
			}
			else{
				$target_file = '/assets/pictures/user.png';
			}
		}
		else{
			$target_file = '/assets/pictures/user.png';
		}

		$userArray = array(
			'id' => $_SESSION['user']['id'],
			'img' => $target_file,
			'birthdate' => $birthdate,
			'phone_number' => $phone,
			'city' => $city,
			'biography' => $biography
		);

		$workArray = array(
			'occupation' => $occupation,
			'start' => $date,
			'company_id' => $_SESSION['user']['company_id'],
			'users_id' => $_SESSION['user']['id']
		);

		$user = new User($userArray);
		$work = new Work($workArray);

		$updateSuccess = $user->update();
		$insertSuccess = $work->insert();

		if ($updateSuccess == true && $insertSuccess == true) {
			header('location: news');
			exit();
		}
		else{
			header('refresh: 10, url=news');
			$errors['save'] = 'Un problème est survenu pendant la modification de votre profil, contactez l\'administrateur';
		}
	}

	$title = 'Commencez par compléter votre profil Co\'working';
	$description = 'Personnalisez votre profil pour mieux vous connaître et améliorer votre expérience Co\'working.';
	require_once dirname(__FILE__).'/../views/includes/header.php'; // include header

	require_once dirname(__FILE__).'/../views/introduction_view.php'; // include view

	require_once dirname(__FILE__).'/../views/includes/footer.php'; // include footer
?>