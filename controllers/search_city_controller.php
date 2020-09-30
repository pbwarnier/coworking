<?php
	require_once dirname(__FILE__).'/../models/Ville.php';

	$city = new Ville; // instance of class

	if (isset($_POST['form']) && $_POST['form'] == 'create') {
		if (!empty($_POST['zipcode']) && preg_match('/^\d{5}$/i', $_POST['zipcode'])) {
			$zipcode = trim(filter_var($_POST['zipcode'], FILTER_VALIDATE_INT)); // cleaning number
			$city->ville_code = '%'.$zipcode.'%';
			$city_list = $city->searchCity();
			echo json_encode($city_list);
		}
		else{
			echo json_encode(0);
		}
	}
	elseif (isset($_POST['form']) && $_POST['form'] == 'update') {
		$localisation = trim(filter_var($_POST['localisation'], FILTER_SANITIZE_STRING));

		if (strtolower(substr($localisation, 0, 2)) == 'st') {
			$localisation = 'Saint'.substr($localisation, 2);
		}
		
		$city->ville_name = $localisation.'%';
		$city_list = $city->searchCityandZipcode();
		if (count($city_list) > 0) {
			echo json_encode($city_list);
		}
		else {
			echo json_encode(0);
		}
	}
?>