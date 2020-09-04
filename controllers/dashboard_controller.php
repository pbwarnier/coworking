<?php	
	session_start();
	include dirname(__FILE__).'/../utils/control_session.php';
	empty_session(); // check if session is empty

	include dirname(__FILE__).'/../utils/get_scriptname.php';

	require_once dirname(__FILE__).'/../utils/cloud_treatment.php'; // include memory calculation and conversions
	require_once dirname(__FILE__).'/../utils/Calendar.php'; // include Calendar class

	$link = [];
	// Find active link
	if ($filename == 'news') {
		$link['news'] = true;
	}
	elseif ($filename == 'team') {
		$link['team'] = true;
	}
	elseif ($filename == 'dashboard') {
		$link['dashboard'] = true;
	}

	try {
		$calendar = new Calendar($_GET['month'] ?? null, $_GET['year'] ?? null);
	}
	catch (Exception $e){
		$calendar = new Calendar();
	}
	
	$dayInFirstCase = $calendar->getStartingDay()->modify('last monday'); // retrieves the first day of the date

	
	$fullsize = folder_size('../users/1/cloud'); // full size of the cloud folder

	// displays the percentage of memory used
	$pourcentData = ($fullsize/5368709120)*100;
	if ($pourcentData > 0 && $pourcentData <= 1) {
		$pourcentData = 1;
	}
	elseif ($pourcentData > 1) {
		ceil($pourcentData);
	}

	// get pay slips
	$pay_folder = dir('../users/1/fiches_de_paie');
	$list_pay_file = [];
	$i = 0;
  	while (($pay_file = $pay_folder->read()) !== false) {
  		if ($pay_file != '.' && $pay_file != '..') {
  			$list_pay_file[$i] = $pay_file;
  			$i++;
  		}
  	}
  	$pay_folder->close();
  	$list_pay_file = array_reverse($list_pay_file);

  	// get schedules
  	$schedule_folder = dir('../users/1/planning');
  	$list_schedule_file = [];
  	$i = 0;
  	while (($schedule_file = $schedule_folder->read()) !== false) {
  		if ($schedule_file != '.' && $schedule_file != '..') {
  			$list_schedule_file[$i] = $schedule_file;
  			$i++;
  		}
  	}
  	$schedule_folder->close();
  	$list_schedule_file = array_reverse($list_schedule_file);

  	$title = 'Mon tableau de bord personnel';
	$description = 'Organisez votre journée de travail avec l\'agenda éléctronique, sauvegardez vos fichiers dans votre cloud Co\'working et recevez vos informations administratives';
	require_once dirname(__FILE__).'/../views/includes/header.php'; // include header

	require_once dirname(__FILE__).'/../views/includes/navbar.php'; // include navbar

	require_once dirname(__FILE__).'/../views/dashboard_view.php'; // include view

	require_once dirname(__FILE__).'/../views/includes/footer.php'; // include footer