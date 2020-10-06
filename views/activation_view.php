<!-- navbar fixed top -->
<nav class="navbar fixed-top navbar-expand-md mx-lg-5 px-lg-3 px-md-5 px-3">
	<a class="navbar-brand font-weight-bold text-shadow" href="authentification">Co'working</a>
	<!-- Button responsive navbar -->
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
	</div>
</nav>
<div class="h-100 w-100 d-flex justify-content-center align-items-center">
	<div class="p-3 bg-white rounded-lg shadow">
	<?php if (isset($error['token'])) : ?>
		<div class="mb-3 w-100 text-center">
			<i class="fal fa-exclamation-circle fa-3x"></i>
		</div>
		<div class="text-dark"><?= $error['token']; ?></div>
	<?php elseif ($permission == 2 && $activateSuccess == true) : ?>
		<div class="w-100 text-dark">
			<div class="w-100 text-center">
				<h4>Votre code entreprise</h4>
			</div>
			<div class="my-4 w-100 d-flex justify-content-center">
				<div class="p-2 bg-customized rounded-lg border-secondary">
					<div class="my-0 h1 font-weight-bold"><?= $company->company_code; ?></div>
				</div>
			</div>
			<p>
				Votre compte entreprise est désormait activé !
				<br>
				Ce code unique vous permet de s'identifier sur le réseau privé de votre entreprise.
				<br>
				Pour ajouter vos employés sur votre réseau privé, rien de plus simple :
			</p>
			<ul>
				<li>Transmettez ce code à vos employés</li>
				<li>Acceptez leur demande d'hadésion</li>
			</ul>
		</div>
	<?php elseif ($permission == 1 && $activateSuccess == true) : ?>
		
	<?php elseif ($activateSuccess == false) : ?>
		<div class="mb-3 w-100 text-center">
			<i class="fal fa-exclamation-circle fa-3x"></i>
		</div>
		<div class="text-dark">Un problème technique est survenu, contactez l'administrateur</div>
	<?php endif ?>
	</div>
</div>