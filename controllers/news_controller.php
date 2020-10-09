<?php
	session_start();
	include dirname(__FILE__).'/../utils/control_session.php';
	empty_session(); // check if session is empty

	include dirname(__FILE__).'/../utils/get_scriptname.php';
	include dirname(__FILE__).'/../utils/image_treatment.php';
	require_once dirname(__FILE__).'/../utils/convert_date.php'; // insert function to convert date in french
	require_once dirname(__FILE__).'/../models/User.php'; // insert class User
	require_once dirname(__FILE__).'/../models/Post.php'; // insert class Post
	require_once dirname(__FILE__).'/../models/Company.php'; // insert class Company
	require_once dirname(__FILE__).'/../models/Inscription.php'; // insert class Inscription
	require_once dirname(__FILE__).'/../models/Like.php'; // insert class Like

	$link = [];
	$isSubmitted = false;
	$checkMime = null;
	$typeFile = null;
	$errors = [];
	$listMime = array(
		'application/msword',
		'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
		'image/gif',
		'image/jpeg',
		'image/png',
		'application/pdf',
		'application/vnd.ms-excel',
		'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
		'application/zip',
		'text/plain'
	);

	$userArray = array(
		'id' => $_SESSION['user']['id'],
		'birthdate' => date('m-d'),
		'company_id' => $_SESSION['user']['company_id']
	);

	$post = new Post(['users_id' => $_SESSION['user']['id']]);
	$user = new User($userArray);
	$inscription = new Inscription(['company_id' => $_SESSION['user']['company_id']]);
	$company = new Company(['id' => $_SESSION['user']['company_id']]);
	$like = new Like(['users_id' => $_SESSION['user']['id']]);
	$post->ban = 0;
	$post->company_id = $_SESSION['user']['company_id'];

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		if (!empty($_POST['idPost']) && !empty($_POST['action'])) {
			$id = trim(filter_var($_POST['idPost'], FILTER_SANITIZE_NUMBER_INT));
			$id = intval($id);

			if ($_POST['action'] == 'delete') {
				$post->id = $id;
				$deleteSuccess = $post->delete();
				echo $deleteSuccess;
				exit();
			}
			elseif ($_POST['action'] == 'like') {
				$like->posts_id = $id;
				$likeSuccess = $like->insert();
				$nb_likes = $like->count();
				$response = array('success' => $likeSuccess, 'count' => intval($nb_likes));
				echo json_encode($response);
				exit();
			}
			elseif ($_POST['action'] == 'dislike') {
				$like->posts_id = $id;
				$likeSuccess = $like->delete();
				$nb_likes = $like->count();
				$response = array('success' => $likeSuccess, 'count' => intval($nb_likes));
				echo json_encode($response);
				exit();
			}	
		}
		elseif (!empty($_FILES["fileToUpload"]['name']) && !empty($_FILES['fileToUpload']['tmp_name']) && $_FILES['fileToUpload']['size'] > 0) {
			$isSubmitted = true;
			$target_dir = '../users/'.$_SESSION['user']['id'].'/publications/';
			$target_file = $target_dir.basename($_FILES["fileToUpload"]["name"]);
			$text = trim(filter_input(INPUT_POST, 'edit-post', FILTER_SANITIZE_STRING));

			$checkMime = in_array($_FILES['fileToUpload']['type'], $listMime);

			if ($_FILES['fileToUpload']['type'] == 'image/gig' || $_FILES['fileToUpload']['type'] == 'image/jpeg' || $_FILES['fileToUpload']['type'] == 'image/png') {
				$typeFile = 'image';
			}
			else {
				$typeFile = 'document';
			}

			if ($checkMime == false) {
				$errors['file'] == 'L\'extension de votre fichier n\'est pas prise en charge';
			}

			if ($_FILES['fileToUpload']['size'] > 10000000){
				$errors['file'] = 'Votre fichier ne peut pas exceder 10 Mo';
			}

			if (file_exists($target_file)){
				// function to create copy
				$target_file = copyFile($target_dir, $_FILES['fileToUpload']['name']);
			}

			if ($isSubmitted && count($errors) == 0) {
				$post->text = $text;
				$post->attachment = $_FILES['fileToUpload']['name'];
				$post->type_attachment = $typeFile;

				$insertSuccess = $post->insert();

				if ($insertSuccess == false) {
					$errors['file'] = 'Une erreur est survenue lors de la publication de votre post';
				}
				elseif (!move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
					$errors['file'] = 'Une erreur est survenue lors de la publication de votre post';
				}
			}
		}
	}

	if ($filename == 'news') {
		$link['news'] = true;
	}
	elseif ($filename == 'team') {
		$link['team'] = true;
	}
	elseif ($filename == 'dashboard') {
		$link['dashboard'] = true;
	}

	if (isset($_POST['close-info-box'])) {
		setcookie('close-info-box', 1, time() + 365*24*3600, null, null, false, true);
	}

	$userInfo = $user->getNavInfo();
	$nb_post = $post->countContribution();
	$company->readName();
	$countNewers = $inscription->countNewers();
	$countBirthday = $user->countBirthday();
	$listPost = $post->readAll();

	$title = 'Vos actualités sur Co\'working';
	$description = 'Consultez les actualités de votre entreprise, réagissez aux diverses publications et discutez sans plus attendre avec les autres membres.';
	require_once dirname(__FILE__).'/../views/includes/header.php'; // include header

	require_once dirname(__FILE__).'/../views/includes/navbar.php'; // include navbar

	require_once dirname(__FILE__).'/../views/news_view.php'; // include view

	require_once dirname(__FILE__).'/../views/includes/footer.php'; // include footer