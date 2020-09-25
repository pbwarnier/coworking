<?php 
	function dateFR($dateEN){
		$date = date_create($dateEN);
		$listeMois = array('error_convertion', 'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
		$numeroMois = date_format($date, "n");
		$mois = $listeMois[$numeroMois];
		$jour = date_format($date, "j");
		$annee = date_format($date, "Y");
		$dateFR = $jour." ".$mois." ".$annee;
		return $dateFR;
	}