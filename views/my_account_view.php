<!-- fullwidth pic -->
<div id="zoom" class="zoom">
	<span class="close_zoom" onclick="closing_zoom()">&times;</span>
	<img src="<?= $userInfo->img; ?>" alt="name-user">
</div>
<!-- Edit profil modal -->
<div class="modal fade" id="profil-picture" tabindex="-1" aria-labelledby="profil-picture" aria-hidden="true">
 	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="profil-picture">Changer ma photo de profil</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="my-account" method="POST" enctype="multipart/form-data">
					<div class="w-100 d-flex justify-content-center">
						<div class="p-1 rounded-circle bg-white shadow-sm border" style="height: 200px; width: 200px;">
							<div class="rounded-circle preview" style="background-image: url('<?= $userInfo->img; ?>');"></div>
						</div>
					</div>
					<div class="mt-3 w-100 d-flex justify-content-center">
						<label class="btn btn-sm btn-outline-secondary">
							<input id="data-preview" class="d-none" data-preview=".preview" name="userPicture" type="file" accept="image/*">
							Telecharger une image
						</label>
					</div>
					<div id="divSaving" class="mt-2 w-100 d-none justify-content-center">
						<button class="btn btn-sm btn-primary" type="submit" name="change-picture">Enregistrer mon image</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- Edit profil modal -->
<div class="modal fade" id="editing-profile" tabindex="-1" aria-labelledby="editing-profile" aria-hidden="true">
 	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="editing-profile">Editer mon profil</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="my-account" method="POST">
					<div class="w-100 d-sm-flex">
						<div class="mr-sm-2 w-100 d-flex">
							<div class="mx-auto mb-auto input-customized-lg">
								<div class="input-customized-lg border <?= isset($errors['firstname']) ? 'border-danger' : ''; ?> rounded-lg">
									<label class="px-1 small text-secondary">Prénom</label>
									<input class="p-3 w-100 border-0 rounded-lg" type="text" name="firstname" maxlenght="50" value="<?= (isset($userInfo->firstname)) ? $userInfo->firstname : ''; ?>" autocomplete="off">
								</div>
								<?php if (isset($errors['firstname'])): ?>
									<div class="small text-danger"><?= $errors['firstname']; ?></div>
								<?php endif; ?>
							</div>
						</div>
						<div class="ml-sm-2 mt-sm-0 mt-3 w-100 d-flex">
							<div class="mx-auto mb-auto input-customized-lg">
								<div class="mx-auto input-customized-lg border <?= isset($errors['lastname']) ? 'border-danger' : ''; ?> rounded-lg">
									<label class="px-1 small text-secondary">Nom de famille</label>
									<input class="p-3 w-100 border-0 rounded-lg" type="text" name="lastname" maxlength="50" value="<?= (isset($userInfo->lastname)) ? $userInfo->lastname : ''; ?>" autocomplete="off">
								</div>
								<?php if (isset($errors['lastname'])): ?>
									<div class="small text-danger"><?= $errors['lastname']; ?></div>
								<?php endif; ?>
							</div>
						</div>
					</div>
					<div class="mt-3 w-100 d-sm-flex">
						<div class="mr-sm-2 w-100 d-flex">
							<div class="mx-auto mb-auto input-customized-lg">
								<div class="input-customized-lg border <?= isset($errors['birthdate']) ? 'border-danger' : ''; ?> rounded-lg">
									<label class="px-1 small text-secondary">Date de naissance</label>
									<input id="birthdate" class="p-3 w-100 border-0 rounded-lg" type="text" name="birthdate" maxlenght="50" value="<?= (isset($userInfo->birthSlash)) ? $userInfo->birthSlash : ''; ?>" autocomplete="off">
								</div>
								<?php if (isset($errors['birthdate'])): ?>
									<div class="small text-danger"><?= $errors['birthdate']; ?></div>
								<?php endif; ?>
							</div>
						</div>
						<div class="ml-sm-2 mt-sm-0 mt-3 w-100 d-flex">
							<div class="mx-auto mb-auto input-customized-lg">
								<div class="mx-auto input-customized-lg border <?= isset($errors['city']) ? 'border-danger' : ''; ?> rounded-lg">
									<label class="px-1 small text-secondary">Votre ville</label>
									<input id="localisation" class="p-3 w-100 border-0 rounded-lg" type="text" maxlength="50" value="<?= (isset($userInfo->city)) ? $userInfo->ville_nom_reel.' ('.$userInfo->ville_departement.')' : ''; ?>" autocomplete="none">
									<input type="hidden" name="city" value="<?= (isset($userInfo->city)) ? $userInfo->city : ''; ?>">
								</div>
								<?php if (isset($errors['city'])): ?>
									<div class="small text-danger"><?= $errors['city']; ?></div>
								<?php endif; ?>
							</div>
						</div>
					</div>
					<div class="mt-3 w-100">
						<div class="mx-auto mb-auto input-customized-lg">
							<div class="input-customized-lg border <?= isset($errors['biography']) ? 'border-danger' : ''; ?> rounded-lg">
								<label class="px-1 small text-secondary">Biographie</label>
								<textarea class="p-3 w-100 border-0 rounded-lg" type="text" name="biography" maxlenght="200" rows="5" autocomplete="off"><?= (isset($userInfo->biography)) ? $userInfo->biography : ''; ?></textarea>
							</div>
							<?php if (isset($errors['biography'])): ?>
								<div class="small text-danger"><?= $errors['biography']; ?></div>
							<?php endif; ?>
						</div>
					</div>
					<div class="mt-3 w-100 d-flex justify-content-center">
						<button class="btn btn-sm btn-primary" type="submit" name="update">Enregistrer les modifications</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="container">
	<div class="p-customized w-100">
		<?php if ($isSubmitted && $updateSuccess) : ?>
			<div class="mt-3 alert alert-success" role="alert">
				<i class="mr-2 far fa-check"></i>Votre profil est mis à jour, visionnez votre profil en tant qu'invité <a class="alert-link" href="profil-<?= $_SESSION['user']['id']; ?>">ici</a>
			</div>
		<?php elseif ($isSubmitted && $updateSuccess == false) : ?>
			<div class="mt-3 alert alert-danger" role="alert">
				<i class="mr-2 fal fa-exclamation-circle"></i></i>Une erreur est survenue pendant la modification de votre profil
			</div>
		<?php endif; ?>
		<div class="mt-3 w-100 shadow-sm border rounded">
			<div class="w-100 cover rounded-top">
				<div class="p-1 bg-white personnal-picture rounded-circle shadow-sm">
					<figure class="m-0 w-100 rounded-circle">
						<img class="w-100 rounded-circle" src="<?= $userInfo->img; ?>" alt="<?= htmlspecialchars($userInfo->firstname); ?> <?= htmlspecialchars($userInfo->lastname); ?>">
						<figcaption class="d-flex">
							<div class="m-auto">
								<div><button id="change-picture" class="small">Changer ma photo</button></div>
								<div><button class="mt-2 small" onclick="zoom()">Voir ma photo</button></div>
							</div>
						</figcaption>
					</figure>
				</div>
			</div>
			<div class="mt-md-0 mt-5 p-3 w-100">
				<div class="w-100 d-flex">
					<div class="ml-personalized my-auto h4 text-dark"><?= htmlspecialchars($userInfo->firstname); ?> <?= htmlspecialchars($userInfo->lastname); ?></div>
					<div class="ml-auto d-flex">
						<div class="text-success d-flex">
							<span class="my-auto d-lg-block d-none">Disponible</span>
							<span class="my-auto d-lg-none d-block" title="En ligne"><i class="far fa-power-off"></i></span>
						</div>
						<div class="dropdown">
							<button class="ml-3 btn btn-light border" type="button" id="options_user" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Plus</button>
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
						<?= htmlspecialchars($userInfo->section_name); ?>
					</div>
					<?php endif; ?>
					<?php if (isset($userInfo->birthdate)) : ?>
					<div class="mx-auto mt-lg-0 mt-3 px-3 py-1 text-dark rounded-pill border border-secondary text-center">
						<i class="mr-3 far fa-birthday-cake"></i>
						<?= dateFR($userInfo->birthdate); ?>
					</div>
					<?php endif; ?>
					<?php if (isset($userInfo->ville_nom_reel)) : ?>
					<div class="mx-auto mt-lg-0 mt-3 px-3 py-1 text-dark rounded-pill border border-secondary text-center">
						<i class="mr-3 far fa-home-lg"></i>
						De <?= $userInfo->ville_nom_reel; ?> (<?= $userInfo->ville_departement; ?>)
					</div>
					<?php endif; ?>
				</div>
				<?php if (isset($userInfo->biography)) : ?>
				<div class="mt-3 w-100 text-dark text-justify">
					<?= nl2br($userInfo->biography); ?>
				</div>
				<?php endif; ?>
				<div class="mt-3 w-100 d-flex justify-content-end">
					<button class="btn btn-light border" type="button" data-toggle="modal" data-target="#editing-profile">Editer mon profil</button>
				</div>
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
				<?php if (count($list_skills) == 0) : ?>
					<div id="skill-none" class="my-1 mr-2 px-3 py-2 rounded bg-white d-inline-block rounded-pill text-secondary border border-secondary">Aucune compétence enregistrée</div>
				<?php else : ?>
				<?php foreach ($list_skills as $skillInfo) : ?>
					<div id="skill_<?= $skillInfo->skills_id; ?>" class="my-1 mr-2 px-3 py-2 rounded bg-info d-inline-block text-light rounded-pill">
						<?= htmlspecialchars($skillInfo->skill_name); ?>
						<button class="ml-2 px-1 py-0 border-0 bg-info text-light rounded" name="removeSkill" data-skill="<?= $skillInfo->skills_id; ?>">&times;</button>
					</div>
				<?php endforeach; ?>
				<?php endif; ?>
				<button class="mr-2 my-1 btn btn-outline-info d-inline-block rounded-pill" title="Ajouter une compétence" name="add_skill"><i class="fal fa-plus"></i></button>
			</div>
		</div>
		<div class="my-3 p-3 w-100 shadow-sm border rounded">
			<div class="h4 text-dark">Expérience professionnelle</div>
			<div class="mt-4 row">
				<?php foreach ($list_experience as $expInfo) : ?>
				<div class="<?= ($nbDiv == 1) ? 'mt-0' : ($nbDiv == 2) ? 'mt-md-0 mt-3' : 'mt-3'; ?> col-md-6">
					<div class="w-100 shadow">
						<div class="p-3 bg-customized text-light"><?= $expInfo->occupation; ?></div>
						<?php if (isset($expInfo->img)) : ?>
						<div class="p-3 w-100 d-flex">
							<img class="mx-auto company_logo" src="<?= $expInfo->img; ?>" alt="Logo <?= $expInfo->company_name; ?>">
						</div>
						<?php endif; ?>
						<div class="p-3 bg-light text-dark">Chez <?= (isset($expInfo->company_id)) ? htmlspecialchars($expInfo->company_name) : htmlspecialchars($expInfo->company_name_edit); ?></div>
						<div class="p-3 text-secondary">
							<?= (isset($expInfo->end)) ? 'Du '.dateFR($expInfo->start) : 'Depuis le '.dateFR($expInfo->start); ?>
							<?= (isset($expInfo->end)) ? ' au '.dateFR($expInfo->end) : ''; ?>
						</div>
						<div class="p-3 text-dark">
						<?php if (isset($expInfo->description)) : ?>
							<?= nl2br($expInfo->description); ?>
						<?php else : ?>
							<div class="text-secondary">Aucune description</div>
						<?php endif; ?>
						</div>
						<div class="p-3 w-100 d-flex justify-content-end">
							<button class="<?= ($expInfo->company_id != $_SESSION['user']['company_id']) ? 'mr-1 ' : ''; ?>btn btn-sm btn-outline-info" type="button">Modifier</button>
							<?php if ($expInfo->company_id != $_SESSION['user']['company_id']) : ?>
								<button class="ml-1 btn btn-sm btn-outline-danger" type="button">Supprimer</button>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<?php $nbDiv++; ?>
				<?php endforeach; ?>
				<div class="<?= ($nbDiv == 2) ? 'mt-md-0 mt-3' : 'mt-3'; ?> col-md-6">
					<button class="h-100 w-100 btn btn-light text-secondary border"><i class="fal fa-plus-circle fa-5x"></i></button>
				</div>
			</div>
		</div>
	</div>
</div>