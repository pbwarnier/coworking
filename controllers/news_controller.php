<?php
	session_start();
	include dirname(__FILE__).'/../utils/control_session.php';
	empty_session(); // check if session is empty

	include dirname(__FILE__).'/../utils/get_scriptname.php';

	$link = [];

	if ($filename == 'news') {
		$link['news'] = true;
	}
	elseif ($filename == 'team') {
		$link['team'] = true;
	}
	elseif ($filename == 'dashboard') {
		$link['dashboard'] = true;
	}

	$title = 'Vos actualités sur Co\'working';
	$description = 'Consultez les actualités de votre entreprise, réagissez aux diverses publications et discutez sans plus attendre avec les autres membres.';
	require_once dirname(__FILE__).'/../views/includes/header.php'; // include header

	require_once dirname(__FILE__).'/../views/includes/navbar.php'; // include navbar

	require_once dirname(__FILE__).'/../views/news_view.php'; // include view

	require_once dirname(__FILE__).'/../views/includes/footer.php'; // include footer