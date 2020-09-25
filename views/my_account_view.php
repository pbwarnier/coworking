<div id="zoom" class="zoom">
			<span class="close_zoom" onclick="closing_zoom()">&times;</span>
			<img src="<?= $userInfo->img; ?>" alt="name-user">
		</div>
		<div class="container">
			<div class="p-customized w-100">
				<div class="mt-3 w-100 shadow-sm border rounded">
					<div class="w-100 cover rounded-top">
						<div class="p-1 bg-white personnal-picture rounded-circle shadow-sm">
							<figure class="m-0 w-100 rounded-circle">
								<img class="w-100 rounded-circle" src="<?= $userInfo->img ?>" alt="name-user">
								<figcaption class="d-flex">
									<div class="m-auto">
										<div><button class="small">Changer ma photo</button></div>
										<div><button class="mt-2 small" onclick="zoom()">Voir ma photo</button></div>
									</div>
								</figcaption>
							</figure>
						</div>
					</div>
					<div class="mt-md-0 mt-5 p-3 w-100">
						<div class="w-100 d-flex">
							<div class="ml-personalized my-auto h4 text-dark"><?= $userInfo->firstname; ?> <?= $userInfo->lastname; ?></div>
							<div class="ml-auto d-flex">
								<div class="text-success d-flex">
									<span class="my-auto d-xl-block d-none">Disponible</span>
									<span class="my-auto d-xl-none d-block" title="En ligne"><i class="far fa-power-off"></i></span>
								</div>
								<div class="dropdown">
									<button class="ml-3 btn btn-light" type="button" id="options_user" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Plus</button>
									<div class="dropdown-menu dropdown-menu-right" aria-labelledby="options_1">
		    							<a href="#" class="dropdown-item d-flex">Mon historique<i class="ml-auto my-auto far fa-history"></i></a>
		    							<a href="parameters" class="dropdown-item d-flex">Paramètres<i class="ml-auto my-auto fas fa-cog"></i></a>
		    							<form action="my-account" method="POST">
		    								<button class="dropdown-item bg-danger text-white" type="submit" name="logout">Me déconnecter<i class="ml-3 my-auto far fa-sign-out"></i></button>
		    							</form>
		  							</div>
								</div>
							</div>
						</div>
						<div class="mt-3 w-100 d-lg-flex">
							<div class="mx-auto mt-lg-0 mt-3 px-3 py-1 text-dark rounded-pill border border-secondary text-center">
								<i class="mr-3 far fa-envelope"></i>
								<?= $_SESSION['user']['login']; ?>
							</div>
							<?php if (isset($userInfo->section_name)) : ?>
							<div class="mx-auto mt-lg-0 mt-3 px-3 py-1 text-dark rounded-pill border border-secondary text-center">
								<i class="mr-3 fas fa-users"></i>
								<?= $userInfo->section_name; ?>
							</div>
							<?php endif; ?>
							<?php if (isset($userInfo->birthdate)) : ?>
							<div class="mx-auto mt-lg-0 mt-3 px-3 py-1 text-dark rounded-pill border border-secondary text-center">
								<i class="mr-3 far fa-birthday-cake"></i>
								<?= dateFR($userInfo->birthdate); ?>
							</div>
						<?php endif; ?>
						</div>
						<?php if (isset($userInfo->biography)) : ?>
						<div class="mt-3 w-100 text-dark text-justify">
							<?= nl2br($userInfo->biography); ?>
						</div>
						<?php endif; ?>
					</div>
				</div>
				<div class="my-3 w-100 d-lg-flex">
					<div class="mr-lg-2 w-100 d-sm-flex">
						<div class="mr-sm-2 p-3 w-100 text-dark shadow-sm border rounded bg-light text-center d-sm-flex d-none align-content-between flex-wrap">
							<div class="w-100 text-center h5">Profil complété à</div>
							<div id="progress" class="w-100 text-center h-customized" data-progress="99"><span id="compteur"></span>%</div>
						</div>
						<div class="ml-sm-2 p-3 w-100 text-dark shadow-sm border rounded bg-light d-flex align-content-between flex-wrap">
							<div class="text-center w-100">
								<div class="text-primary"><i class="far fa-shield-alt fa-5x"></i></div>
							</div>
							<div class="text-center w-100">
								<div class="mb-3 h5 text-dark">Vérifier la sécurité de mon compte</div>
								<a href="#" class="btn btn-primary">Sécuriser mon compte</a>
							</div>
						</div>
					</div>
					<div class="mt-lg-0 mt-3 ml-lg-2 p-3 w-100 shadow-sm border rounded bg-light">
						<div class="h4 text-dark">Contribuer</div>
						<div class="mt-3 h5 text-center text-dark">Etes-vous pour la semaine de 4 jours ?</div>
						<div class="mt-5 w-100 d-flex">
							<div class="mx-auto">
								<button class="px-3 btn btn-light text-center" type="button" name="happy">
									<div class="mb-2 text-customized"><i class="far fa-thumbs-up fa-3x"></i></div>
									<span class="text-dark">Oui</span>
								</button>
							</div>
							<div class="mx-auto">
								<button class="px-3 btn btn-light text-center" type="button" name="bad">
									<div class="mb-2 text-customized"><i class="far fa-thumbs-down fa-3x"></i></div>
									<span class="text-dark">Non</span>
								</button>
							</div>
						</div>
					</div>
				</div>
				<div class="my-3 p-3 w-100 shadow-sm border rounded">
					<div class="h4 mb-4 text-dark">Compétences</div>
					<div class="w-100">
						<div id="skill_1" class="my-1 mr-2 px-3 py-2 rounded bg-info d-inline-block text-light rounded-pill">Compétence 1<button class="ml-2 px-1 py-0 border-0 bg-info text-light rounded">&times;</button></div>
						<div id="skill_2" class="mr-2 my-1 px-3 py-2 bg-info d-inline-block text-light rounded-pill">Compétence 2<button class="ml-2 px-1 py-0 border-0 bg-info text-light rounded">&times;</button></div>
						<div id="skill_3" class="my-1 mr-2 px-3 py-2 bg-info d-inline-block text-light rounded-pill">Compétence 3<button class="ml-2 px-1 py-0 border-0 bg-info text-light rounded">&times;</button></div>
						<button class="mr-2 my-1 btn btn-outline-info d-inline-block rounded-pill" title="Ajouter une compétence" name="add_skill"><i class="fal fa-plus"></i></button>
					</div>
				</div>
				<div class="my-3 p-3 w-100 shadow-sm border rounded">
					<div class="h4 text-dark">Expérience professionnelle</div>
					<div class="mt-4 row">
						<div class="col-md-6">
							<div class="w-100 shadow">
								<div class="p-3 bg-customized text-light">Formateur développeur web et web mobile</div>
								<div class="p-3 w-100 d-flex">
									<img class="mx-auto company_logo" src="/coworking/assets/pictures/logo_la_manu.png" alt="Logo La Manu">
								</div>
								<div class="p-3 bg-light text-dark">A La Manu Amiens</div>
								<div class="p-3 text-secondary">Depuis le jj/mm/yyyy</div>
								<div class="p-3 text-dark">
									Description du poste (max 200 caractères)...
								</div>
							</div>
						</div>
						<div class="mt-md-0 mt-3 col-md-6">
							<button class="h-100 w-100 btn btn-light text-secondary"><i class="far fa-plus-circle fa-5x"></i></button>
						</div>
					</div>
				</div>
			</div>
		</div>