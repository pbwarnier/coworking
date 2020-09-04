<?php
	if (empty($_SESSION['user'])) {
?>
		<nav class="navbar fixed-top navbar-expand-md px-md-5 px-3" style="background-color: #2a9d8f;">
			<a class="navbar-brand font-weight-bold text-shadow text-white" href="authentification">Co'working</a>
			<!-- Button responsive navbar -->
			<button class="navbar-toggler py-2 bg-white text-dark" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation" style="outline: none;">
				<span><i class="fas fa-bars"></i></span>
			</button>
			<div class="collapse navbar-collapse" id="navbar">
				<ul class="navbar-nav ml-md-5">
					<li class="mx-md-2 nav-item">
						<a class="nav-link text-white" href="#">A propos</a>
					</li>
					<li class="mx-md-2 nav-item">
						<a class="nav-link text-white" href="#">Aide</a>
					</li>
					<li class="mx-md-2 nav-item">
						<a class="nav-link text-white" href="#">Confidentialité</a>
					</li>
				</ul>
			</div>
		</nav>
<?php
	}
?>
<div class="container h-100">
	<div class="p-customized h-100 d-flex align-content-center flex-wrap">
		<div class="w-100 text-dark">
			<h1 class="display-1 font-weight-bold">Oups !</h1>
			<p class="lead">Toutes nos excuses, la page que vous recherchez semble introuvable.</p>
			<p class="lead">Code erreur : 404</p>
			<p class="lead">Quelques liens utiles</p>
			<?php if (!empty($_SESSION['user'])): ?>
				<ul class="nav flex-column">
					<li class="nav-item"><a href="news">Fil d'actualité</a></li>
					<li class="nav-item"><a href="#">Ma section</a></li>
					<li class="nav-item"><a href="dashboard">Mon tableau de bord</a></li>
					<li class="nav-item"><a href="my-account">Mon profil</a></li>
					<li class="nav-item"><a href="#">Mes discussions</a></li>
				</ul>
			<?php else: ?>
				<ul class="nav flex-column">
					<li class="nav-item"><a href="authentification">Retourner à l'accueil</a></li>
					<li class="nav-item"><a href="#">Page d'aide</a></li>
					<li class="nav-item"><a href="create-account">M'inscrire</a></li>
					<li class="nav-item"><a href="dashboard">Confidentialité</a></li>
				</ul>
			<?php endif; ?>
		</div>
	</div>
</div>