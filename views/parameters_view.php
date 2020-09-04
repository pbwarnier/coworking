<div class="container">
	<div class="p-customized pb-3 w-100">
		<div class="mt-3 w-100 border rounded-lg">
			<div class="m-3 h4 text-dark">Informations personnelles</div>
			<a href="parameters-userpic">
				<div class="px-3 py-2 w-100 d-flex">
					<div class="w-100 text-secondary d-md-flex">
						<div class="w-title my-md-auto">PHOTO</div>
						<div class="my-md-auto">Personnalisez votre compte avec une photo</div>
					</div>
					<div class="ml-1 d-flex">
						<img id="mini_userpic" class="m-auto border rounded-circle" src="/coworking/assets/pictures/user.png" alt="userpic">
					</div>
				</div>
			</a>
			<?php if (isset($_GET['tab']) && $_GET['tab'] == 'userpic'): ?>
				<div class="p-3 w-100 bg-white text-center">
					<div>
						<img class="mb-2 preview rounded-circle border" src="/coworking/assets/pictures/user.png" alt="userpic">
					</div>
					<div>
						<label class="mr-2 px-2 py-1 custom-file-upload">
									<input id="data-preview" data-preview=".preview" name="imgToUpload" type="file" accept="image/*">
							Choisir mon image
						</label>
					</div>	
				</div>
			<?php endif; ?>
			<a href="parameters-username">
				<div class="px-3 py-md-3 py-2 w-100 border-top d-flex">
				<?php if (isset($_GET['tab']) && $_GET['tab'] == 'username'): ?>
					<div class="w-100 text-secondary">NOM</div>
				<?php else: ?>
					<div class="w-100 d-md-flex">
						<div class="w-title text-secondary">NOM</div>
						<div class="text-dark">Pierre-Baptiste Warnier</div>
					</div>
					<div class="w-45 text-dark d-flex">
						<i class="m-auto fas fa-chevron-right"></i>
					</div>
				<?php endif; ?>
				</div>
			</a>
			<?php if (isset($_GET['tab']) && $_GET['tab'] == 'username'): ?>
				<div class="p-3 w-100 bg-white">
					<form action="parameters-username" method="POST">
						<div class="w-100 d-md-flex">
							<div class="w-100 d-flex">
								<div class="mx-auto mb-auto input-customized-lg">
									<div class="input-customized-lg border <?= isset($errors['firstname']) ? 'border-danger' : ''; ?> rounded-lg">
										<label class="px-1 small text-secondary">Prénom</label>
										<input class="p-3 w-100 border-0 rounded-lg" type="text" name="firstname" maxlenght="50" value="Pierre-Baptiste" autocomplete="off">
									</div>
									<?php if (isset($errors['firstname'])): ?>
										<div class="small text-danger"><?= $errors['firstname']; ?></div>
									<?php endif; ?>
								</div>
							</div>
							<div class="mt-md-0 mt-3 w-100 d-flex">
								<div class="mx-auto mb-auto input-customized-lg">
									<div class="mx-auto input-customized-lg border <?= isset($errors['lastname']) ? 'border-danger' : ''; ?> rounded-lg">
										<label class="px-1 small text-secondary">Nom de famille</label>
										<input class="p-3 w-100 border-0 rounded-lg" type="text" name="lastname" maxlength="50" value="Warnier" autocomplete="off">
									</div>
									<?php if (isset($errors['lastname'])): ?>
										<div class="small text-danger"><?= $errors['lastname']; ?></div>
									<?php endif; ?>
								</div>
							</div>
						</div>
						<div class="mt-3 w-100 text-center">
							<button class="px-3 py-1 btn-outline-customized rounded-pill" type="submit" name="update">Modifier</button>
						</div>
					</form>
				</div>
			<?php endif; ?>
			<a href="parameters-birthdate">
				<div class="px-3 py-md-3 py-2 w-100 border-top d-flex">
				<?php if (isset($_GET['tab']) && $_GET['tab'] == 'birthdate'): ?>
					<div class="w-100 text-secondary">NAISSANCE</div>
				<?php else: ?>
					<div class="w-100 d-md-flex">
						<div class="w-title text-secondary">NAISSANCE</div>
						<div class="text-dark">22 Février 1998</div>
					</div>
					<div class="w-45 text-dark d-flex">
						<i class="m-auto fas fa-chevron-right"></i>
					</div>
				<?php endif; ?>
				</div>
			</a>
			<?php if (isset($_GET['tab']) && $_GET['tab'] == 'birthdate'): ?>
				<div class="p-3 w-100 bg-white">
					<form action="parameters-birthdate" method="POST">
						<div class="w-100 d-flex justify-content-center">
							<div class="d-sm-flex">
								<div class="mr-sm-1 mr-0 input-customized-xs border <?= isset($errors['birthdate']) ? 'border-danger' : ''; ?> rounded-lg">
									<label class="px-1 small text-secondary">Jour</label>
									<input class="p-3 w-100 border-0 rounded-lg" type="text" name="day" value="22" autocomplete="off">
								</div>
								<div class="mt-sm-0 mt-3 mx-sm-1 mx-0 input-customized-md border <?= isset($errors['birthdate']) ? 'border-danger' : ''; ?> rounded-lg">
									<label class="px-1 small text-secondary">Mois</label>
									<select class="p-3 w-100 border-0 rounded-lg" name="month">
										<option value="1">Janvier</option>
										<option value="2" selected="selected">Février</option>
										<option value="3">Mars</option>
										<option value="4">Avril</option>
										<option value="5">Mai</option>
										<option value="6">Juin</option>
										<option value="7">Juillet</option>
										<option value="8">Août</option>
										<option value="9">Septembre</option>
										<option value="10">Octobre</option>
										<option value="11">Novembre</option>
										<option value="12">Décembre</option>
									</select>
								</div>
								<div class="mt-sm-0 mt-3 ml-sm-1 ml-0 input-customized-sm border <?= isset($errors['birthdate']) ? 'border-danger' : ''; ?> rounded-lg">
									<label class="px-1 small text-secondary">Année</label>
									<input class="p-3 w-100 border-0 rounded-lg" type="text" name="year" value="1998" autocomplete="off">
								</div>
							</div>
						</div>
						<?php if (isset($errors['birthdate'])): ?>
							<div class="small text-danger text-center"><?= $errors['birthdate']; ?></div>
						<?php endif; ?>
						<div class="mt-3 w-100 text-center">
							<button class="px-3 py-1 btn-outline-customized rounded-pill" type="submit" name="update">Modifier</button>
						</div>
					</form>
				</div>
			<?php endif; ?>
			<a href="parameters-gender">
				<div class="px-3 py-md-3 py-2 w-100 border-top d-flex">
				<?php if (isset($_GET['tab']) && $_GET['tab'] == 'gender'): ?>
					<div class="w-100 text-secondary">CIVILITÉ</div>
				<?php else: ?>
					<div class="w-100 d-md-flex">
						<div class="w-title text-secondary">CIVILITÉ</div>
						<div class="text-dark">Monsieur</div>
					</div>
					<div class="w-45 text-dark d-flex">
						<i class="m-auto fas fa-chevron-right"></i>
					</div>
				<?php endif; ?>
				</div>
			</a>
			<?php if (isset($_GET['tab']) && $_GET['tab'] == 'gender'): ?>
				<div class="p-3 w-100 bg-white">
					<form action="parameters-gender" method="POST">
						<div class="w-100 d-md-flex">
							<div class="w-100 d-flex">
								<div class="mx-auto mb-auto input-customized-lg">
									<div class="input-customized-lg border <?= isset($errors['gender']) ? 'border-danger' : ''; ?> rounded-lg">
										<label class="px-1 small text-secondary">Civilité</label>
										<select class="p-3 w-100 border-0 rounded-lg" name="gender">
											<option value="1" selected="selected">Monsieur</option>
											<option value="2">Madame</option>
											<option value="3">Autre</option>
										</select>
									</div>
									<?php if (isset($errors['gender'])): ?>
										<div class="small text-danger text-center"><?= $errors['gender']; ?></div>
									<?php endif; ?>
									<?php if (isset($errors['gender-p'])): ?>
										<div class="small text-danger text-center"><?= $errors['gender-p']; ?></div>
									<?php endif; ?>
								</div>
							</div>
							<div id="gender_personlised" class="mt-md-0 mt-3 w-100 d-none">
								<div class="mx-auto input-customized-lg border rounded-lg">
									<label class="px-1 small text-secondary">Préciser</label>
									<input class="p-3 w-100 border-0 rounded-lg" type="text" maxlength="50" name="gender_personalized" placeholder="Entrez votre civilité">
								</div>
							</div>
						</div>
						<div class="mt-3 w-100 text-center">
							<button class="px-3 py-1 btn-outline-customized rounded-pill" type="submit" name="update">Modifier</button>
						</div>
					</form>
				</div>
			<?php endif; ?>
			<a href="access-login-password">
				<div class="px-3 py-md-3 py-2 w-100 border-top d-flex">
					<div class="w-100 d-md-flex">
						<div class="w-title my-md-auto text-secondary">MOT DE PASSE</div>
						<div>
							<div class="text-dark">&bull;&bull;&bull;&bull;&bull;&bull;</div>
							<div class="small text-secondary">Dernière modification le 27/07/2019</div>
						</div>
					</div>
					<div class="w-45 text-dark d-flex">
						<i class="m-auto fas fa-chevron-right"></i>
					</div>
				</div>
			</a>
		</div>
		<div class="mt-3 w-100 border rounded-lg">
			<div class="m-3 h4 text-dark">Coordonnées</div>
			<a href="access-login-email">
				<div class="px-3 py-md-3 py-2 w-100 border-bottom d-flex">
					<div class="w-100 d-md-flex">
						<div class="w-title my-md-auto text-secondary">ADRESSES EMAIL</div>
						<div class="text-dark">warnier.pb@gmail.com</div>
					</div>
					<div class="w-45 text-dark d-flex">
						<i class="m-auto fas fa-chevron-right"></i>
					</div>
				</div>
			</a>
			<a href="access-login-phone">
				<div class="px-3 py-md-3 py-2 w-100 d-flex">
					<div class="w-100 d-md-flex">
						<div class="w-title text-secondary">TELEPHONE</div>
						<div class="text-dark">0623359407</div>
					</div>
					<div class="w-45 text-dark d-flex">
						<i class="m-auto fas fa-chevron-right"></i>
					</div>
				</div>
			</a>
		</div>
		<div class="mt-3 w-100 border rounded-lg">
			<div class="m-3 h4 text-dark">Historique</div>
			<a href="historic">
				<div class="px-3 py-md-3 py-2 w-100 d-flex">
					<div class="w-100 d-md-flex">
						<div class="w-title my-md-auto text-secondary">MON ACTIVITÉ</div>
						<div>
							<div class="text-secondary">Redécouvrez les étapes de votre navigation</div>
						</div>
					</div>
					<div class="w-45 text-dark d-flex">
						<i class="m-auto fas fa-chevron-right"></i>
					</div>
				</div>
			</a>
		</div>
				<div class="mt-3 w-100 border rounded-lg">
			<div class="m-3 h4 text-dark">Sécurité</div>
			<a href="access-login-password">
				<div class="px-3 py-md-3 py-2 w-100 border-bottom d-flex">
					<div class="w-100 d-md-flex">
						<div class="w-title my-md-auto text-secondary">MOT DE PASSE</div>
						<div>
							<div class="text-secondary">Dernière modification le 27/07/2019</div>
						</div>
					</div>
					<div class="w-45 text-dark d-flex">
						<i class="m-auto fas fa-chevron-right"></i>
					</div>
				</div>
			</a>
			<a href="parameters.php-steps">
				<div class="px-3 py-md-3 py-2 w-100 border-bottom d-flex">
					<div class="w-100 d-md-flex">
						<div class="w-title my-md-auto text-secondary">CONNEXION EN DEUX ÉTAPES</div>
						<div class="my-auto">
							<div class="text-dark">Désactivé</div>
						</div>
					</div>
					<div class="w-45 text-dark d-flex">
						<i class="m-auto fas fa-chevron-right"></i>
					</div>
				</div>
			</a>
			<a href="parameters.php-devices">
				<div class="px-3 py-md-3 py-2 w-100 d-flex">
					<div class="w-100 d-md-flex">
						<div class="w-title my-md-auto text-secondary">VOS APPAREILS</div>
						<div>
							<div class="text-secondary">Liste des appareils connectés</div>
						</div>
					</div>
					<div class="w-45 text-dark d-flex">
						<i class="m-auto fas fa-chevron-right"></i>
					</div>
				</div>
			</a>
		</div>
		<div class="mt-3 w-100 border rounded-lg">
			<div class="m-3 h4 text-dark">Membres</div>
			<a href="parameters-ban">
				<div class="px-3 py-md-3 py-2 w-100 d-flex">
					<div class="w-100 d-md-flex">
						<div class="w-title my-md-auto text-secondary">BLOQUÉS</div>
						<div>
							<div class="text-secondary">Aucun utilisateur bloqué</div>
						</div>
					</div>
					<div class="w-45 text-dark d-flex">
						<i class="m-auto fas fa-chevron-right"></i>
					</div>
				</div>
			</a>
		</div>
		<div class="mt-3 w-100 border rounded-lg">
			<div class="m-3 h4 text-dark">Désactivation du compte</div>
			<a href="unsuscibre">
				<div class="px-3 py-md-3 py-2 w-100 d-flex">
					<div class="w-100">
						<div class="text-secondary">Procéder à la désactivation de votre compte Co'working</div>
					</div>
					<div class="w-45 text-dark d-flex">
						<i class="m-auto fas fa-chevron-right"></i>
					</div>
				</div>
			</a>
		</div>
	</div>
</div>