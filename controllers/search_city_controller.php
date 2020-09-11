<?php
	require_once dirname(__FILE__).'/../models/Ville.php';

	$city = new Ville; // instance of class

	if (!empty($_POST['zipcode']) && preg_match('/^\d{5}$/i', $_POST['zipcode'])) {
		$zipcode = trim(filter_var($_POST['zipcode'], FILTER_VALIDATE_INT)); // cleaning number
		$count = strlen($zipcode); // return length of this strings
		$city->ville_code = '%'.$zipcode.'%';
		$city_list = $city->searchCity();
		echo json_encode($city_list);
	}
	else{
		echo json_encode(0);
	}
?>