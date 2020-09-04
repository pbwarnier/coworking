<?php	
	session_start();
	include dirname(__FILE__).'/../utils/control_session.php';
	empty_session(); // check if session is empty

	if (isset($_GET['id']) && $_GET['id'] > 0 && ctype_digit($_GET['id'])) {
		include dirname(__FILE__).'/../utils/get_scriptname.php';

		$title = 'Publication de ...';
		$description = 'Consultez les actualités de votre entreprise, réagissez aux diverses publications et discutez sans plus attendre avec les autres membres.';
		require_once dirname(__FILE__).'/../views/includes/header.php'; // include header

		require_once dirname(__FILE__).'/../views/includes/navbar.php'; // include view

		require_once dirname(__FILE__).'/../views/post_view.php'; // include view

		require_once dirname(__FILE__).'/../views/includes/footer.php'; // include footer
	}
	else{
		header('location: news');
		exit();
	}