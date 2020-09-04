<?php
	$errors = []; // create errors table
	$nbErrors = 0; // initialized the errors number
	$today = strtotime("NOW"); // create the timestamp of today
	$regex = '/^((?:0[1-9])|(?:1[0-9])|(?:2[0-9])|(?:3[01]))\/((?:0[1-9])|(?:1[0-2]))\/((?:19|20)[0-9]{2})$/';

	if (!empty($_POST['startingDate']) && !empty($_POST['endingDate']) && !empty($_POST['nbDays'])) {
		$startingDate = trim(strip_tags($_POST['startingDate']));
		$endingDate = trim(strip_tags($_POST['endingDate']));
		$nbDays = filter_var($_POST['nbDays'], FILTER_SANITIZE_NUMBER_INT);

		if (!preg_match($regex, $startingDate) || !preg_match($regex , $endingDate)) {
			$errors[$nbErrors] = 'Veuillez renseigner vos dates de congés dans un format correcte';
			$nbErrors++;
		}
		else{
	    	$startingDate = DateTime::createFromFormat('d/m/Y', $startingDate); // create a new start date
	    	$startingDate = $startingDate->format('Y-m-d'); // convert the date in the standart format
	    	$timestamp_startingDate = strtotime($startingDate); // create the timestamp

	    	$endingDate = DateTime::createFromFormat('d/m/Y', $endingDate); // create new end date
	    	$endingDate = $endingDate->format('Y-m-d'); // convert the date in the standart format
	    	$timestamp_endingDate = strtotime($endingDate); // create the timestamp

	    	if ($timestamp_startingDate <= $today) {
	    		$errors[$nbErrors] = 'La date de votre départ en congés ne peut pas être antérieure à aujourd\'hui';
	    		$nbErrors++;
	    	}

	    	if ($timestamp_endingDate <= $today) {
	    		$errors[$nbErrors] = 'La date de votre retour de congés ne peut pas être antérieure à aujourd\'hui';
	    		$nbErrors++;
	    	}
	    	
	    	if ($timestamp_endingDate < $timestamp_startingDate) {
	    		$errors[$nbErrors] = 'La date de votre départ en congés ne peut pas être postérieure à celle de votre retour';
	    		$nbErrors++;
	    	}

	    	if ($nbDays < 1) {
	    		$errors[$nbErrors] = 'Vous ne pouvez pas renseigner un nombre de jours inférieur à 1';
	    		$nbErrors++;
	    	}
		}
	}
	else{
		$errors[$nbErrors] = 'Veuillez remplir le formulaire ci-dessous';
		$nbErrors++;
	}

	if ($nbErrors > 0) {
?>
		<div class="mb-2 alert alert-warning alert-dismissible fade show" role="alert">
		<?php if ($nbErrors > 1) { ?>
			<div class="mb-2"><i class="mr-3 fas fa-exclamation"></i>Votre saisie contient plusieurs erreurs :</div>
			<?php foreach ($errors as $message) { ?>
				<div>&bull; <?= $message; ?></div>
			<?php } }elseif ($nbErrors == 1) { ?><i class="mr-3 fas fa-exclamation"></i><?php echo $errors[0]; } ?>
	  		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    		<span aria-hidden="true">&times;</span>
	  		</button>
		</div>
<?php
	}
	else{
		require dirname(__FILE__).'/../assets/libraries/fpdf-1.82/fpdf.php';

		class PDF extends FPDF {
			// En-tête
			function Header() {
				// Logo
	    		$this->Image('https://lamanu.fr/wp-content/uploads/2019/10/logo_la_manu_formation_400.png', 10, 6, 35);
			    // Police Arial gras 15
			    $this->SetFont('Arial', 'BU', 20);
			    // Décalage à droite
			    $this->Cell(80);
			    // Titre
			    $this->Cell(30, 30, utf8_decode('Demande de congés'), 0, 0, 'C');
			    // Saut de ligne
			    $this->Ln(60);
			}

			// Pied de page
			function Footer() {
			    // Positionnement à 1,5 cm du bas
			    $this->SetY(-15);
			    // Police Arial italique 8
			    $this->SetFont('Arial', 'I', 8);
			    // Numéro de page
			    $this->Cell(0, 10, 'Page '.$this->PageNo().'/{nb}', 0, 0, 'C');
			}

			function AddTitle($title) {
				$this->SetFillColor(200, 220, 255);
				$this->SetFont('Arial', 'B', 20);
				$this->Cell(190, 10, $title, 0, 2, 'C', true);
			}

			function AddInformations($lastname, $firstname, $team) {
				$this->SetFont('Arial', '', 12);
				$this->Cell(30, 10, 'Nom : ');
				$this->SetFont('Arial', 'B', 12);
				$this->Cell(50, 10, $lastname);
				$this->Ln(7);
				$this->SetFont('Arial', '', 12);
				$this->Cell(30, 10, utf8_decode('Prénom').' : ');
				$this->SetFont('Arial', 'B', 12);
				$this->Cell(50, 10, $firstname);
				$this->Ln(7);
				$this->SetFont('Arial', '', 12);
				$this->Cell(30, 10, 'Secteur : ');
				$this->SetFont('Arial', 'B', 12);
				$this->Cell(50, 10, $team);
			}

			function AddDates($startingDate, $endingDate, $nbDay) {
				$this->SetFont('Arial', '', 12);
				$this->Cell(50, 10, utf8_decode('Début en congés le').' : ');
				$this->SetFont('Arial', 'B', 12);
				$this->Cell(50, 10, $startingDate);
				$this->Ln(7);
				$this->SetFont('Arial', '', 12);
				$this->Cell(50, 10, utf8_decode('Retour de congés le').' : ');
				$this->SetFont('Arial', 'B', 12);
				$this->Cell(50, 10, $endingDate);
				$this->Ln(7);
				$this->SetFont('Arial', '', 12);
				$this->Cell(50, 10, 'Nombre de jours : ');
				$this->SetFont('Arial', 'B', 12);
				$this->Cell(50, 10, $nbDay);
			}
		}

		$startingDate = date_create($startingDate);
		$endingDate = date_create($endingDate);

		// Instanciation de la classe dérivée
		$pdf = new PDF();
		$pdf->AliasNbPages();
		$pdf->AddPage();
		$pdf->AddTitle('Demandeur');
		$pdf->AddInformations(utf8_decode('Warnier'), utf8_decode('Pierre-Baptiste'), utf8_decode('Informatique et développement'));
		$pdf->Ln(30);
		$pdf->AddTitle(utf8_decode('Période demandée'));
		$pdf->AddDates(date_format($startingDate, 'd/m/Y'), date_format($endingDate, 'd/m/Y'), $nbDays);
		$pdf->Ln(30);
		$pdf->SetFont('Arial', 'B', 12);
		$pdf->Cell(95, 10, utf8_decode('Signature de l\'employé'));
		$pdf->Cell(95, 10, utf8_decode('Signature de la direction'));
		$pdf->Ln(10);
		$pdf->SetFont('Arial', '', 12);
		$pdf->MultiCell(45, 6, utf8_decode('Signé en ligne').' le '.date('d/m/Y'), 0, 'L', false);
		$pdf->Ln(10);
		$pdf->SetFont('Arial', 'B', 12);
		$pdf->SetFillColor(222, 221, 220);
		$pdf->Cell(190, 10, utf8_decode('Commentaire si refusé :'), 0, 2, 'L', true);
		$pdf->Output('F', 'C:/wamp/www/coworking/users/1/conges/demande_conges_du_'.date_format($startingDate, 'd-m-Y').'_au_'.date_format($endingDate, 'd-m-Y').'.pdf');
?>
		<div class="mb-2 px-2 py-1 w-100 bg-blue d-flex justify-content-between">
  			<a class="text-dark" href="users/1/conges/demande_conges_du_<?= date_format($startingDate, 'd-m-Y'); ?>_au_<?= date_format($endingDate, 'd-m-Y'); ?>.pdf">Demande du <?= date_format($startingDate, 'd/m/Y'); ?> au <?= date_format($endingDate, 'd/m/Y'); ?></a>
  			<div class="text-warning d-lg-block d-md-none d-sm-block d-none">En traitement</div>
  			<div class="my-auto led rounded-circle bg-warning d-lg-none d-md-block d-sm-none s-block"></div>
  		</div>
<?php
	}
?>