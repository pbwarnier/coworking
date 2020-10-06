<nav class="navbar fixed-top navbar-expand-md mx-lg-5 px-lg-3 px-md-5 px-3">
	<a class="navbar-brand font-weight-bold text-shadow" href="authentification">Co'working</a>
	<button class="navbar-toggler py-2 bg-white text-dark" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation" style="outline: none;">
	    <span><i class="fas fa-bars"></i></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbar">
		<ul class="navbar-nav ml-md-5">
			<li class="mx-md-2 nav-item">
				<a class="nav-link text-shadow" href="#">A propos</a>
			</li>
			<li class="mx-md-2 nav-item">
				<a class="nav-link text-shadow" href="#">Aide</a>
			</li>
			<li class="mx-md-2 nav-item">
				<a class="nav-link text-shadow" href="#">Confidentialité</a>
			</li>
		</ul>
		<ul id="login_link" class="navbar-nav ml-auto d-none">
			<li class="nav-item">
				<a class="nav-link text-shadow" href="#down">M'inscrire</a>
			</li>
		</ul>
	</div>
</nav>
<?php if ($successCreate == true && isset($_GET['type']) && $_GET['type'] == 'factory') : ?>
	<div class="modal fade" id="success" tabindex="-1" aria-labelledby="success" aria-hidden="true">
  		<div class="modal-dialog modal-dialog-centered">
    		<div class="modal-content border-0 rounded-lg">
    			<div class="modal-body">
       				<h3 class="mb-3 font-weight-bold" style="color: #2a9d8f;">Votre espace Co'working est pret !</h3>
       				<p class="text-dark text-justify">
       					Félicitations pour ce premier pas vers Co'working !
       					<br>
       					Pour activer votre réseau Co'working et obtenir votre code d'identification, nous vous avons envoyé un email avec un lien d'activation valide jusqu'au <?= $date->format('d/m/Y'); ?> à <?= $date->format('H:i'); ?>
       					<br>
       					Après cette étape validée, profitez plainement de l'expérience Co'working et commencez à inviter vos employés.
       				</p>
       				<div class="w-100 d-flex justify-content-end">
       					<a href="authentification" class="btn btn-primary rounded-pill">Retour à l'écran d'accueil</a>
       				</div>
      			</div>
    		</div>
    	</div>
	</div>
<?php elseif ($successCreate == true && isset($_GET['type']) && $_GET['type'] == 'employee') : ?>
	<div class="modal fade" id="success" tabindex="-1" aria-labelledby="success" aria-hidden="true">
  		<div class="modal-dialog modal-dialog-centered">
    		<div class="modal-content border-0 rounded-lg">
    			<div class="modal-body">
       				<h3 class="mb-3 font-weight-bold" style="color: #2a9d8f;">Notification d'inscription</h3>
       				<p class="text-dark text-justify">
       					Félicitations pour ce premier pas vers Co'working !
       					<br>
       					Pour envoyer une demande d'adhésion à votre employeur, nous devons vérifier votre identité au préalable. Nous vous avons envoyé un lien de vérification par email qui est à valider au plus tard le <?= $date->format('d/m/Y'); ?> à <?= $date->format('H:i'); ?>.
       				</p>
       				<div class="w-100 d-flex justify-content-end">
       					<a href="authentification" class="btn btn-primary rounded-pill">Retour à l'écran d'accueil</a>
       				</div>
      			</div>
    		</div>
    	</div>
	</div>
<?php endif; ?>
<div id="contain" class="h-100 w-100 d-flex horizon-background-color">
	<div id="choice_form" class="m-auto p-md-5 p-3 d-sm-flex d-block">
		<div class="mr-sm-2">
			<button class="p-md-5 p-3 border bg-light rounded shadow" name="employee">
				<div class="w-100 d-flex">
					<img class="m-auto w-50" src="assets/pictures/human.png" alt="employé">
				</div>
				<div class="mt-sm-5 mt-3 w-100 text-center">
					<div class="text-dark">Je suis salarié</div>
					<div class="small text-secondary">Rejoignez votre entreprise</div>
				</div>
			</button>
		</div>
		<div class="ml-sm-2 mt-sm-0 mt-3">
			<button class="p-md-5 p-3 border bg-light rounded shadow" name="factory">
				<div class="w-100 d-flex">
					<img class="m-auto w-50" src="assets/pictures/factory.png" alt="employeur">
				</div>
				<div class="mt-sm-5 mt-3 w-100 text-center">
					<div class="text-dark">Je suis cadre</div>
					<div class="small text-secondary">Enregistrez votre entreprise</div>
				</div>
			</button>
		</div>
	</div>
</div>