<?php
	// remove index.php in url
	if (basename($_SERVER['REQUEST_URI']) != 'authentification') {
		header('location: ./authentification');
		exit();
	}

	session_start(); // start the session
	require dirname(__FILE__).'/config/config.php'; // include const
	include dirname(__FILE__).'/utils/control_session.php';
	isset_session(CRYPT_KEY); // check the existence of the session

	include dirname(__FILE__).'/utils/get_scriptname.php';
	require_once dirname(__FILE__).'/utils/login_treatment.php'; // include the login treatment

	$title = 'Bienvenue sur Co\'working';
	$description = 'Co\'working c\'est stocker et partager son travail, créer son équipe, communiquer avec ses collègues et faciliter les démarches administrative gratuitement.';
	require_once dirname(__FILE__).'/views/includes/header.php'; // include header
?>
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
		<ul class="navbar-nav ml-auto d-lg-none d-block">
			<li class="nav-item">
				<a class="nav-link text-shadow" href="#down" name="login_link">S'identifier</a>
			</li>
		</ul>
	</div>
</nav>
<!-- Main -->
<div class="h-100 w-100 d-lg-flex">
	<!-- Div to the left - with slogan -->
	<div class="h-100 w-left d-flex">
		<div id="slogan" class="mx-md-5 mx-auto my-auto px-lg-3 px-md-0 px-3 py-2 text-white font-weight-bold text-shadow">
			Devenez plus proche de votre entreprise
		</div>
	</div>
	<!-- Button to scroll down in mobile view -->
	<div id="down" class="scroll-down d-lg-none d-block bg-light shadow" address="true" title="M'identifier"></div>
	<!-- Div to the right - login form -->
	<div class="h-100 w-right d-flex vertical-background-color">
		<div class="my-auto mr-auto ml-lg-0 ml-auto pr-lg-5">
			<div class="mb-2 px-3 py-4 light-background">
				<div class="w-100 text-center">
					<h2 class="mb-3 text-dark">Identifiez-vous</h2>
				</div>
				<form action="authentification" method="post">
					<div class="my-2 form-group">
						<input class="px-3 py-2 w-100 border <?= isset($errors['code']) ? 'border-danger invalid-shadow' : '' ?>" type="text" name="code_company" maxlength="6" placeholder="Code entreprise" autocomplete="off">
						<?php if (isset($errors['code'])) { ?><div class="small text-danger"><?= $errors['code']; ?></div><?php } ?>
					</div>
						<div class="my-2 form-group">
						<input class="px-3 py-2 w-100 border <?= isset($errors['email']) ? 'border-danger invalid-shadow' : '' ?>" type="email" name="email" placeholder="Adresse email">
						<?php if (isset($errors['password'])) { ?><div class="small text-danger"><?= $errors['password']; ?></div><?php } ?>
					</div>
					<div class="my-2 form-group">
						<div class="w-100 d-flex border <?= isset($errors['password']) ? 'border-danger invalid-shadow' : '' ?>">
							<input class="px-3 py-2 w-100" style="border: none;" type="password" name="password" placeholder="Mot de passe">
							<button id="viewpassword" class="px-3 bg-white text-secondary d-flex" type="button"><i class="m-auto far fa-eye"></i></button>
						</div>
						<?php if (isset($errors['password'])) { ?><div class="small text-danger"><?= $errors['password']; ?></div><?php } ?>
						<div class="w-100">
							<a class="text-secondary small" href="#">Mot de passe oublié ?</a>
						</div>
					</div>
					<button class="mt-3 px-3 py-2 w-100 btn-customized" type="submit" name="login">Rejoindre mon Co'working</button>
				</form>
			</div>
			<div class="mt-2 p-3 light-background">
				<div class="text-dark">
					Vous ne faites pas encore parti de la communauté Co'working ?
				</div>
				<a id="create_link" href="create-account">Créez votre compte ici</a>
			</div>
		</div>
	</div>
</div>
<?php
	require_once dirname(__FILE__).'/views/includes/footer.php'; // include footer