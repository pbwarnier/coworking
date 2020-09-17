<?php 
	function dateFR($dateEN){
		$date = date_create($dateEN);
		$listeMois = array('error_convertion', 'Janv.', 'Févr.', 'Mars', 'Avril', 'Mai', 'Juin', 'Juil.', 'Août', 'Sept.', 'Oct.', 'Nov.', 'Déc.');
		$numeroMois = date_format($date, "n");
		$mois = $listeMois[$numeroMois];
		$jour = date_format($date, "j");
		$annee = date_format($date, "Y");
		$dateFR = $jour." ".$mois." ".$annee;
		return $dateFR;
	}