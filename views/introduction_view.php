<nav class="navbar fixed-top mx-lg-5 px-lg-3 px-md-5 px-3">
	<a class="navbar-brand font-weight-bold" href="news.php">Co'working</a>
</nav>
<!-- Erreur compétences -->
<div class="modal fade" id="errorSkills" tabindex="-1" role="dialog" aria-labelledby="errorSkills" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
        		<h5 class="modal-title">Nombre max atteint</h5>
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">&times;</span>
        		</button>
      		</div>
      		<div class="modal-body">
        		<p class="text-justify">
        			Vous avez enregistré le nombre maximal de compétences. Mais pas de panique ! Après cette étape, rendez-vous dans votre profil pour ajouter d'autres compétences &#128521;
        		</p>
      		</div>
	      	<div class="modal-footer">
	        	<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Fermer</button>
	      	</div>
    	</div>
  	</div>
</div>
<div class="w-100 h-100 d-flex">
	<?php if (empty($_POST)) : ?>
		<div id="div_text" class="mx-lg-5 my-auto px-lg-3 px-md-5 px-3">
			<div class="text-giant font-weight-bold text-center text-light">
				Commençons par personnaliser votre profil
			</div>
		</div>
		<div id="div_loader" class="m-auto d-none">
			<div  class="loader"></div>
			<div class="mt-3 w-100 text-center text-light h4">Patientez</div>
		</div>
	<?php endif; ?>
	<div id="div_form" class="m-auto p-3 bg-light <?= empty($_POST) ? 'd-none' : '' ?>">
		<form id="personalizedForm" class="h-100" action="introduction" method="POST" enctype="multipart/form-data">
			<div id="user-pic" class="preview rounded-circle"></div>
			<button id="remove-btn" class="btn btn-danger rounded-circle remove-btn d-none" type="button" name="remove_pic"><i class="fas fa-times"></i></button>
			<div id="step1" class="w-100 h-100 d-flex">
				<div class="mt-auto w-100">
					<?php if (isset($errors['userPicture'])) : ?>
						<div class="alert alert-danger" role="alert">
							<?= $errors['userPicture']; ?>
						</div>
					<?php endif; ?>
					<label class="px-3 py-2 w-100 custom-file-upload">
						<input id="data-preview" data-preview=".preview" name="userPicture" type="file" accept="image/*">
						Choisir mon image
					</label>
					<button class="px-3 py-2 w-100 btn-customized d-none" type="button" name="next">Passer à mon profil</button>
					<button class="w-100 bg-light text-secondary border-0 rounded-pill small" type="button" name="skip">Passer cette étape</button>
				</div>
			</div>
			<div id="step2" class="w-100 h-100 d-none align-content-between flex-wrap">
				<button class="px-1 bg-light text-secondary border-0" type="button" name="prev"><i class="fas fa-arrow-left"></i></button>
				<div class="w-100">
					<div class="mb-2 w-100">
						<div class="font-weight-bold text-dark">Pierre-Baptiste Warnier</div>
					</div>
					<div class="my-2 w-100">
						<input id="birthdate" class="px-3 py-2 w-100 border <?= isset($errors['birthdate']) ? 'border-danger invalid-shadow' : '' ?>" type="text" name="birthdate" placeholder="Votre date de naissance" autocomplete="off">
						<?php if (isset($errors['birthdate'])) { ?><div class="small text-danger"><?= $errors['birthdate']; ?></div><?php } ?>
					</div>
					<div class="my-2 w-100">
						<input id="localisation" class="px-3 py-2 w-100 border" type="text" placeholder="Votre ville" autocomplete="off">
						<input type="hidden" name="city">
						<small class="text-secondary font-italic">Entrez la ville ou le code postal</small>
					</div>
					<div class="my-2 w-100">
						<input class="px-3 py-2 w-100 border <?= isset($errors['phone']) ? 'border-danger invalid-shadow' : '' ?>" type="tel" name="phone" placeholder="Votre numéro de téléphone" autocomplete="off">
						<?php if (isset($errors['phone'])) { ?><div class="small text-danger"><?= $errors['phone']; ?></div><?php } ?>
					</div>
				</div>
				<div class="w-100">
					<div class="text-secondary font-italic small">
						Les données saisies seront visibles par l'ensemble du personnel de l'entreprise
					</div>
					<button class="mt-2 px-3 py-2 w-100 btn-customized" type="button" name="next">Etape suivante</button>
				</div>
			</div>
			<div id="step3" class="w-100 h-100 d-none align-content-between flex-wrap">
				<button class="px-1 bg-light text-secondary border-0" type="button" name="prev"><i class="fas fa-arrow-left"></i></button>
				<div class="w-100">
					<div class="mb-2 w-100">
						<input class="px-3 py-2 w-100 border <?= isset($errors['occupation']) ? 'border-danger invalid-shadow' : '' ?>" type="text" name="occupation" maxlength="50" placeholder="Votre profession (obligatoire)" autocomplete="off">
						<?php if (isset($errors['occupation'])) { ?><div class="small text-danger"><?= $errors['occupation']; ?></div><?php } ?>
					</div>
					<div class="my-2 w-100">
						<input id="date" class="px-3 py-2 w-100 border <?= isset($errors['date']) ? 'border-danger invalid-shadow' : '' ?>" type="text" name="date" placeholder="Date d'arrivée dans l'entreprise" autocomplete="off">
						<?php if (isset($errors['date'])) { ?><div class="small text-danger"><?= $errors['date']; ?></div><?php } ?>
					</div>
					<div class="my-2 w-100 d-flex">
						<input class="px-3 py-2 w-100 border" type="text" name="skills" maxlenght="20" placeholder="Vos compétences" autocomplete="off">
						<?php for ($i = 1; $i <= 5; $i++): ?>
							<input type="hidden" name="skill_<?= $i ?>">
						<?php endfor; ?>
						<button class="px-3 text-white bg-info border-0" type="button" name="add_skills"><i class="fas fa-plus"></i></button>
					</div>
					<div id="list_skills" class="mt-2 w-100"></div>
				</div>
				<div class="w-100">
					<div class="text-secondary font-italic small">
						Les données saisies seront visibles par l'ensemble du personnel de l'entreprise
					</div>
					<button class="mt-2 px-3 py-2 w-100 btn-customized" type="button" name="next">Etape suivante</button>
				</div>
			</div>
			<div id="step4" class="w-100 h-100 d-none align-content-between flex-wrap">
				<button class="px-1 bg-light text-secondary border-0" type="button" name="prev"><i class="fas fa-arrow-left"></i></button>
				<div class="w-100">
					<textarea class="mt-4 px-3 py-2 w-100 border" name="biography" maxlength="300" rows="8" placeholder="Partagez un message"></textarea>
					<div class="mb-2 w-100 text-secondary small">
						<span id="compteur">0</span>/300 caractères
					</div>
				</div>
				<div class="w-100">
					<div class="text-secondary font-italic small">
						Les données saisies seront visibles par l'ensemble du personnel de l'entreprise
					</div>
					<button class="mt-2 px-3 py-2 w-100 btn-customized" type="submit" name="save">Valider mes informations</button>
				</div>
			</div>
		</form>
	</div>
</div>