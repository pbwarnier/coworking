<?php
	session_start();
	include dirname(__FILE__).'/../utils/get_scriptname.php';

	$title = 'Page non trouvée | Co\'working';
	$description = 'Cette pas n\'est pas trouvée ou n\'existe plus.';
	require_once dirname(__FILE__).'/../views/includes/header.php'; // include header

	if (!empty($_SESSION['user']) && $filename != 'introduction') {
		require_once dirname(__FILE__).'/../views/includes/navbar.php'; // include navbar
	}	

	require_once dirname(__FILE__).'/../views/404_view.php'; // include view

	require_once dirname(__FILE__).'/../views/includes/footer.php'; // include footer