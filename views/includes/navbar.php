<nav class="navbar navbar-expand-sm fixed-top px-3 py-sm-0 py-2 w-100">
	<a class="mr-3 my-2 navbar-brand my-auto mr-auto font-weight-bold text-white" href="news">Co'working</a>
	<button id="open_slideNav" class="px-3 py-2 navbar-toggler text-light" type="button" title="Barre de navigation">
    	<i class="far fa-bars"></i>
  	</button>
	<div class="collapse navbar-collapse">
		<div class="mx-auto mt-auto">
			<ul id="tabs" class="navbar-nav flex-row">
				<li class="nav-item <?= isset($link['news']) ? 'active' : '' ?>">
					<a href="news" class="nav-link text-dark" title="Fil d'actualités"><span class="large-link">Fil d'actualités</span><span class="small-link"><i class="far fa-newspaper"></i></span></a>
				</li>
				<li class="nav-item <?= isset($link['team']) ? 'active' : '' ?>">
					<a href="#" class="nav-link text-dark" title="Ma section"><span class="large-link">Ma section</span><span class="small-link"><i class="fas fa-puzzle-piece"></i></span></a>
				</li>
				<li class="nav-item <?= isset($link['dashboard']) ? 'active' : '' ?>">
					<a href="dashboard" class="nav-link text-dark" title="Tableau de bord"><span class="large-link">Tableau de bord</span><span class="small-link"><i class="fab fa-trello"></i></span></a>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link text-dark" title="Comité d'entreprise"><span class="large-link">CE</span><span class="small-link"><i class="fas fa-building"></i></span></a>
				</li>
			</ul>
		</div>
		<div id="account-options" class="ml-2 my-auto d-flex">
			<ul class="navbar-nav my-auto flex-row">
				<li class="nav-item mx-1 my-auto rounded-circle">
					<a href="javascript:void(0)" class="nav-link text-white px-2 py-1" title="Notifications" role="button" id="notifications"><i class="fas fa-bell"></i></a>
				</li>
				<li class="nav-item mx-1 my-auto rounded-circle">
					<a href="#" class="nav-link text-white px-2 py-1" title="Discussions"><i class="fas fa-comment-alt-dots"></i></a>
				</li>
			</ul>
			<a href="my-account" class="ml-2 my-2 p-1 nav-link btn-customized rounded-pill d-flex" title="Mon profil">
				<div class="my-auto mx-2 large-text"><?= $userInfo->firstname; ?> <?= $userInfo->lastname; ?></div>
				<img class="rounded-circle" src="<?= $userInfo->img; ?>" alt="<?= $userInfo->firstname; ?> <?= $userInfo->lastname; ?>">
			</a>
		</div>
		<!-- Notifications window -->
		<div id="drop-notifications" class="dropdown">
			<div class="mt-4 dropdown-menu dropdown-menu-right">
			    <a class="px-2 dropdown-item d-flex" href="#">
			    	<img id="userpic" class="mr-2 rounded-circle border border-light" src="https://cdn3.iconfinder.com/data/icons/avatars-round-flat/33/avat-01-512.png" alt="userpic">
			    	<div class="w-100">
			    		<div class="text-dark">Utilisateur 2 à commenté votre publication</div>
			    		<div class="text-secondary small">A l'instant</div>
			    	</div>
			    </a>
			    <a class="px-2 dropdown-item d-flex" href="#">
			    	<img id="userpic" class="mr-2 rounded-circle border border-light" src="https://cdn3.iconfinder.com/data/icons/avatars-round-flat/33/avat-01-512.png" alt="userpic">
			    	<div class="w-100">
			    		<div class="text-dark">Utilisateur 2 à aimé votre publication</div>
			    		<div class="text-secondary small">Il y a 30 minutes</div>
			    	</div>
			    </a>
			    <a class="px-2 dropdown-item d-flex" href="#">
			    	<img id="userpic" class="mr-2 rounded-circle border border-light" src="https://cdn3.iconfinder.com/data/icons/avatars-round-flat/33/avat-01-512.png" alt="userpic">
			    	<div class="w-100">
			    		<div class="text-dark">Utilisateur 2 à publié un message dans votre section</div>
			    		<div class="text-secondary small">Il y a 1 heure</div>
			    	</div>
			    </a>
			    <a class="px-2 dropdown-item d-flex" href="#">
			    	<img id="userpic" class="mr-2 rounded-circle border border-light" src="https://cdn3.iconfinder.com/data/icons/avatars-round-flat/33/avat-01-512.png" alt="userpic">
			    	<div class="w-100">
			    		<div class="text-dark">Utilisateur 2 à commenté votre publication dans la section</div>
			    		<div class="text-secondary small">Hier</div>
			    	</div>
			    </a>
			    <div class="w-100 d-flex">
			    	<a class="mx-auto" href="#">Voir toutes les notifications</a>
			    </div>
			</div>
		</div>
	</div>
</nav>
<!-- navbar mobile -->
<div id="slideNav" class="pt-4 slideNav bg-light">
	<button type="button" class="mt-2 btn-light text-secondary rounded close_nav">&times;</button>
	<div class="p-3">
		<a href="my-account" class="nav-link d-flex"><img class="rounded-circle mr-3 border" src="<?= $userInfo->img; ?>" alt="userpic"><span class="my-auto text-dark">Mon profil</span></a>
		<a href="news" class="nav-link d-flex"><i class="my-auto mr-3 text-danger far fa-newspaper"></i><span class="my-auto text-dark">Fil d'actualités</span></a>
		<a href="#" class="nav-link d-flex"><i class="my-auto mr-3 text-secondary fas fa-puzzle-piece"></i><span class="my-auto text-dark">Ma section</span></a>
		<a href="dashboard" class="nav-link d-flex"><i class="my-auto mr-3 text-primary fab fa-trello"></i><span class="my-auto text-dark">Tableau de bord</span></a>
		<a href="#" class="nav-link d-flex"><i class="my-auto mr-3 text-dark fas fa-building"></i><span class="my-auto text-dark">Comité d'entreprise</span></a>
		<a href="#" class="nav-link d-flex"><i class="my-auto mr-3 text-info fas fa-comment-alt-dots"></i><span class="my-auto text-dark">Discussions</span></a>
		<a href="#" class="nav-link d-flex"><i class="my-auto mr-3 text-warning fas fa-bell"></i><span class="my-auto text-dark">Notifications</span></a>
		<a href="members" class="nav-link d-flex"><i class="my-auto mr-3 text-success fas fa-users"></i><span class="my-auto text-dark">Membres</span></a>
		<a href="#" class="nav-link d-flex"><i class="my-auto mr-3 text-danger far fa-calendar-day"></i><span class="my-auto text-dark">Evènements</span></a>
		<a href="#" class="nav-link d-flex"><i class="my-auto mr-3 text-purple fas fa-industry-alt"></i><span class="my-auto text-dark">Mon entreprise</span></a>
	</div>
</div>