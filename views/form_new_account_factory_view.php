<div class="h-100 w-100 mx-md-5 mx-3 my-auto w-100 d-lg-flex d-block">
	<div class="h-100 w-100 d-flex">
		<div class="my-auto mr-lg-3 w-100">
			<div id="carousel" class="carousel slide carousel-slide h-customized" data-ride="carousel">
  				<div class="carousel-inner">
    				<div class="carousel-item h-customized active">
    					<div class="h-100 d-flex">
	      					<div class="my-auto text-customized text-white text-shadow font-weight-bold">
								Facilitez les échanges avec vos employés
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
								Centralisez vos outils sur une seule et unique plateforme numérique
							</div>
						</div>
    				</div>
    				<div class="carousel-item h-customized">
    					<div class="h-100 d-flex">
	      					<div class="my-auto text-customized text-white text-shadow font-weight-bold">
								Partagez des documents administratifs et des informations plus rapidement
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
		<div class="m-auto p-3 w-100 bg-light rounded">
			<h2 class="text-dark">Enregistrer mon entreprise</h2>
			<form id="subscribeForm" action="create-account" method="POST">
				<div id="step1" class="w-100 step">
					<div class="my-2 w-100 d-sm-flex d-block">
						<div class="mr-sm-2 w-100">
							<select class="px-3 py-2 w-100 border text-secondary" name="sexe" onchange="changeColor('sexe')">
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
					<div class="my-2 w-100">
						<input class="px-3 py-2 w-100 border" type="email" name="email" placeholder="Adresse email">
						<div class="font-italic text-secondary small">
							Le code de votre entreprise vous sera envoyé à cette adresse.
						</div>
					</div>
					<div class="my-2 w-100 d-sm-flex d-block">
						<div class="mr-sm-2 w-100">
							<input id="input_password" class="px-3 py-2 w-100 border" type="password" name="password" onfocus="slideDown('forcePassword')" onblur="slideUp('forcePassword')" onkeyup="force()" placeholder="Mot de passe">
						</div>
						<div class="mt-sm-0 mt-2 ml-lg-2 my-2 w-100">
							<input id="confirm_password" class="px-3 py-2 w-100 border" type="password" name="confirm_password"  on onfocus="slideDown('check_passwords')" onblur="slideUp('check_passwords')" onkeyup="compare_passwords()" placeholder="Confirmer le mot de passe">
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
			        <div id="check_passwords" class="px-2 py-1 bg-white border" style="display: none;">
			            <span id="checked_info" class="invalid">Les mots de passe ne correspondent pas</span>
			        </div>
			        <button class="mt-2 px-5 py-2 btn-customized" type="button" name="next" onclick="next_step('1')">Etape suivante</button>
			    </div>
			    <div id="step2" class="w-100 step d-none">
			        <div class="my-2 w-100">
			            <input class="px-3 py-2 w-100 border" type="text" name="name_company" placeholder="Nom ou dénomination de l'entreprise">
			        </div>
			        <div class="my-2 w-100">
			            <input class="px-3 py-2 w-100 border" type="text" name="siret" placeholder="Numéro de SIRET">
			        </div>
			        <div class="my-2 w-100 d-sm-flex d-block">
						<div class="mr-sm-2 w-100">
							<input class="px-3 py-2 w-100 border" type="text" name="adress_number" maxlength="4" placeholder="Numéro">
						</div>
						<div class="mt-sm-0 mt-2 ml-lg-2 w-100">
							<select id="number_add" class="px-3 py-2 w-100 border text-secondary" name="number_add" onchange="changeColor('number_add')">
								<option value="" selected="selected" disabled="disabled" hidden="hidden">Complément de numéro</option>
								<option value="bis">Bis</option>
								<option value="ter">Ter</option>
								<option value="quarter">Quarter</option>
							</select>
						</div>
					</div>
					<div class="my-2 w-100">
						<input class=" px-3 py-2 w-100 border" type="text" name="adress" placeholder="Adresse">
					</div>
					<div class="my-2 w-100">
						<input class="px-3 py-2 w-100 border" type="text" name="adress_add" placeholder="Complément d'adresse">
					</div>
					<div class="my-2 w-100 d-sm-flex d-block">
						<div class="mr-sm-2 w-100">
							<input class="px-3 py-2 w-100 border" type="text" name="postal_code" placeholder="Code postal">
						</div>
						<div class="mt-sm-0 mt-2 ml-lg-2 my-2 w-100">
							<select class="px-3 py-2 w-100 border" name="city" disabled="disabled">
								<option value="" disabled="disabled" selected="selected" hidden="hidden">Ville</option>
							</select>
						</div>
					</div>
					<div class="mt-2 w-100 d-flex">
						<button class="mt-2 mr-2 px-3 py-2 rounded-pill btn-light border border-secondary" type="button" name="prev" onclick="last_step(2)"><i class="fas fa-arrow-left"></i></button>
						<button class="mt-2 px-5 py-2 btn-customized" type="button" name="next" onclick="next_step(2)">Etape suivante</button>
					</div>		
			    </div>
			    <div id="step3" class="w-100 step d-none">
			        <div class="my-2 w-100">
						<div class="w-100 d-sm-flex d-block">
							<div class="mr-sm-2 w-100">
								<input class="px-3 py-2 w-100 border" type="tel" name="phone" maxlength="15" placeholder="Numéro de téléphone">
							</div>
							<div class="mt-sm-0 mt-2 ml-lg-2 w-100">
								<input class="px-3 py-2 w-100 border" type="tel" name="mobile" maxlength="15" placeholder="Numéro de portable">
							</div>
						</div>
						<div class="font-italic text-secondary small">L'un des deux numéros est obligatoire</div>
					</div>
					<div class="my-2 w-100 d-flex">
						<div class="w-75">
							Etes-vous le propriétaire de l'entreprise ?
						</div>
						<div class="w-25 d-flex">
							<div class="ml-auto d-flex">
								<div id="owner-result" class="mr-2">Non</div>
								<div class="custom-control custom-switch" onclick="checkbox()">
			  						<input type="checkbox" class="custom-control-input" id="owner" name="owner">
			  						<label class="custom-control-label" for="owner"></label>
								</div>
							</div>
						</div>
					</div>
					<div class="my-3 w-100">
						<div class="alert alert-primary" role="alert">
  							Pour nous aider à lutter contre les faux-comptes et les doublons, nous vous recommandons de renseigner le plus d'informations possible
						</div>
					</div>
					<div class="mt-3 mb-2 font-italic text-secondary small text-justify">
			            En vous inscrivant vous acceptez les conditions générales d'utilisations. Nous vous invitons à consulter notre politique de confidentialité ainsi que notre potlitique de recueil des données via les cookies.
			        </div>
			        <div class="mt-2 w-100 d-flex">
			            <button class="mr-2 px-3 py-2 rounded-pill btn-light border border-secondary" type="button" name="prev" onclick="last_step(3)"><i class="fas fa-arrow-left"></i></button>
			            <button id="subscribe" class="px-3 py-2 btn-customized" type="submit" name="subscribe" data-target="factory">Enregistrer mon entreprise</button>
			        </div>
			    </div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript" src="/coworking/assets/js/form_new_account.js"></script>