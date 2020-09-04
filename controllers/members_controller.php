<?php
	session_start();
	include dirname(__FILE__).'/../utils/control_session.php';
	empty_session(); // check if session is empty

	include dirname(__FILE__).'/../utils/get_scriptname.php';

	$title = 'Liste des membres de votre entreprise';
	$description = 'Consultez les membres de votre entreprise, consultez leur profil et commencez à leur envoyer des messages.';
	require_once dirname(__FILE__).'/../views/includes/header.php'; // include header

	require_once dirname(__FILE__).'/../views/includes/navbar.php'; // include navbar

	require_once dirname(__FILE__).'/../views/members_view.php'; // include view

	require_once dirname(__FILE__).'/../views/includes/footer.php'; // include footer