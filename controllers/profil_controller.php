<?php
	session_start();
	include dirname(__FILE__).'/../utils/control_session.php';
	empty_session(); // check if session is empty

	if (!empty($_GET['id']) && $_GET['id'] > 0 && ctype_digit($_GET['id'])) {
		include dirname(__FILE__).'/../utils/get_scriptname.php';

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