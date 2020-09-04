<?php
	session_start(); // start the session
	require dirname(__FILE__).'/../config/config.php'; // include const
	include dirname(__FILE__).'/../utils/control_session.php';
	isset_session(CRYPT_KEY); // check the existence of the session

	include dirname(__FILE__).'/../utils/get_scriptname.php';

	$title = 'Créez votre compte Co\'working';
	$description = 'Créez votre compte Co\'working et rejoingnez vos coéquipier ou enregistrez votre entreprise pour avoir un suivi de la santé de votre entreprise';
	require_once dirname(__FILE__).'/../views/includes/header.php'; // include header

	require_once dirname(__FILE__).'/../views/create_account_view.php'; // include view

	require_once dirname(__FILE__).'/../views/includes/footer.php'; // include footer