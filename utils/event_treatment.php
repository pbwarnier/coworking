<?php
	function dateFR($date){
		$date = date_create($date);
		// récupère le numéro de jour de la semaine
		$dayNumber = date_format($date, 'w');
		// récupère le numéro du mois
		$monthNumber = date_format($date, 'n');
		$dayList = array('Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi');
		$monthList = array(1 => 'Janvier', 2 => 'Fevrier', 3 => 'Mars', 4 => 'Avril', 5 => 'Mai', 6 => 'Juin', 7 => 'Juillet', 8 => 'Août', 9 => 'Septembre', 10 => 'Octobre', 11 => 'Novembre', 12 => 'Décembre');
		$day = $dayList[$dayNumber];
		$month = $monthList[$monthNumber];
		// incrémente le jour prélevé du tableau, le numéro de date, le mois prélevé dans le tableau et l'année à 4 chiffre
		$date = $day." ".date_format($date, 'd').' '.$month.' '.date_format($date, 'Y');
		return $date;
	}

	if (!empty($_GET['date'])) {
		$dateFR = dateFR($_GET['date']);
		echo $dateFR;
	}
?>