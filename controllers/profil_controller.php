<?php
	session_start();
	include dirname(__FILE__).'/../utils/control_session.php';
	empty_session(); // check if session is empty

	if (!empty($_GET['id']) && $_GET['id'] > 0 && ctype_digit($_GET['id'])) {
		include dirname(__FILE__).'/../utils/get_scriptname.php';
		require_once dirname(__FILE__).'/../utils/convert_date.php'; // insert function to convert date in french
		require_once dirname(__FILE__).'/../models/User.php'; // insert class User
		require_once dirname(__FILE__).'/../models/Skill.php'; // insert class Skill
		require_once dirname(__FILE__).'/../models/Work.php'; // insert class Work

		$user = new User(['id' => $_SESSION['user']['id']]);
		$skill = new Skill(['users_id' => $_GET['id']]);
		$work = new Work(['users_id' => $_GET['id']]);

		$navInfo = $user->getNavInfo();
		$user->id = $_GET['id'];
		$userInfo = $user->selectProfil();
		$list_skills = $skill->selectAll();
		$list_experience = $work->selectAll();

		$title = 'A déterminer';
		$description = 'A déterminer';
		require_once dirname(__FILE__).'/../views/includes/header.php'; // include header

		require_once dirname(__FILE__).'/../views/includes/navbar.php'; // include navbar

		require_once dirname(__FILE__).'/../views/profil_view.php'; // include view

		require_once dirname(__FILE__).'/../views/includes/footer.php'; // include footer
	}
	else{
		header('location: news');
		exit();
	}