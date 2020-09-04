<div class="h-100 w-100 mx-md-5 mx-3 my-auto w-100 d-lg-flex d-block">
	<div class="h-100 w-100 d-flex">
		<div class="my-auto mr-lg-3 w-100">
			<div id="carousel" class="carousel slide carousel-slide h-customized" data-ride="carousel">
  				<div class="carousel-inner">
    				<div class="carousel-item h-customized active">
    					<div class="h-100 d-flex">
	      					<div class="my-auto text-customized text-white text-shadow font-weight-bold">
								Facilitez les échanges avec vos collègues de travail
							</div>
						</div>
    				</div>
    				<div class="carousel-item h-customized">
    					<div class="h-100 d-flex">
	      					<div class="my-auto text-customized text-white text-shadow font-weight-bold">
								Créez ou rejoingnez votre équipe pour optimiser votre organisation
							</div>
						</div>
    				</div>
    				<div class="carousel-item h-customized">
    					<div class="h-100 d-flex">
	      					<div class="my-auto text-customized text-white text-shadow font-weight-bold">
								Centralisez vos outils sur une seule et unique plateforme numérique
							</div>
						</div>
    				</div>
    				<div class="carousel-item h-customized">
    					<div class="h-100 d-flex">
	      					<div class="my-auto text-customized text-white text-shadow font-weight-bold">
								Partagez vos documents, vos informations et vos opinions plus facilement
							</div>
						</div>
    				</div>
    				<div class="carousel-item h-customized">
    					<div class="h-100 d-flex">
	      					<div class="my-auto text-customized text-white text-shadow font-weight-bold">
								Récupérez vos documents n'importe où avec votre espace de stockage en ligne
							</div>
						</div>
    				</div>
				</div>
			</div>
		</div>
	</div>
	<!-- scrolldown button -->
	<div id="down" class="scroll-down d-lg-none d-block bg-light shadow" address="true" onclick="scrollDown()" title="M'inscrire"></div>
	<!-- new account form -->
	<div class="py-3 w-100 d-flex">
		<div class="m-auto p-3 bg-light rounded">
			<h2 class="text-dark">Créer un compte</h2>
			<form id="subscribeForm" action="create-account" method="POST">
				<div class="my-2 w-100 d-sm-flex d-block">
					<div class="mr-sm-2 w-100">
						<select class="px-3 py-2 w-100 text-secondary border" name="sexe" onchange="changeColor('sexe')">
							<option value="" selected="selected" disabled="disabled" hidden="hidden">Votre civilité</option>
							<option value="1">Monsieur</option>
							<option value="2">Madame</option>
						</select>
					</div>
					<div class="ml-lg-2 my-2 w-100"></div>
				</div>
				<div class="my-2 w-100 d-sm-flex d-block">
					<div class="mr-sm-2 w-100">
						<input class="px-3 py-2 w-100 border" type="text" name="lastname" maxlength="30" onkeyup="upperCase(this.value, 'lastname')" placeholder="Votre nom">
					</div>
					<div class="mt-sm-0 mt-2 ml-lg-2 w-100">
						<input class="px-3 py-2 w-100 border" type="text" name="firstname" maxlength="30" onkeyup="upperCase(this.value, 'firstname')" placeholder="Votre prénom">
					</div>
				</div>
				<div class="my-2 w-100 d-sm-flex d-block">
					<div class="mr-sm-2 w-100">
						<input class="px-3 py-2 w-100 border" type="text" name="code_company" maxlength="6" placeholder="Code entreprise" autocomplete="off">
					</div>
					<div class="mt-sm-0 mt-2 ml-sm-2 w-100">
						<div class="font-italic text-secondary small">
							Ce code permet d'accéder à l'espace de votre entreprise.
						</div>
					</div>
				</div>
				<div class="my-2 w-100">
					<input class="px-3 py-2 w-100 border" type="email" name="email" placeholder="Adresse email">
				</div>
				<div class="my-2 w-100 d-sm-flex d-block">
					<div class="mr-sm-2 w-100">
						<input id="input_password" class="px-3 py-2 w-100 border" type="password" name="password" onfocus="slideDown('forcePassword')" onblur="slideUp('forcePassword')" onkeyup="force()" placeholder="Mot de passe">
					</div>
					<div class="mt-sm-0 mt-2 ml-lg-2 my-2 w-100">
						<input id="confirm_password" class="px-3 py-2 w-100 border" type="password" name="confirm_password" onfocus="slideDown('check_passwords')" onblur="slideUp('check_passwords')" onkeyup="compare_passwords()" placeholder="Confirmer le mot de passe">
					</div>
				</div>
				<!-- check force password -->
				<div id="forcePassword" class="bg-white border">
					<div class="force-progress w-100 rounded-pill">
	  					<div id="progress" class="p-bar" role="progressbar" aria-valuemin="0" aria-valuemax="4"></div>
					</div>
					<div id="force" class="small text-secondary">Faible</div>
				</div>
		        <!-- validation of the passwords values -->
		        <div id="check_passwords" class="bg-white border">
		        	<span id="checked_info" class="invalid">Les mots de passe ne correspondent pas</span>
		        </div>
		        <div class="my-2 font-italic text-secondary small text-justify">
		        	En vous inscrivant vous acceptez les conditions générales d'utilisations. Nous vous invitons à consulter notre politique de confidentialité ainsi que notre potlitique de recueil des données via les cookies.
		        </div>
				<button id="subscribe" class="mt-2 px-3 py-2 btn-customized" type="submit" name="subscribe" data-target="employee">Créer mon compte Co'working</button>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript" src="/coworking/assets/js/form_new_account.js"></script>