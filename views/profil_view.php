<div id="zoom" class="zoom">
	<span class="close_zoom" onclick="closing_zoom()">&times;</span>
	<img src="<?= $userInfo->img; ?>" alt="<?= $userInfo->firstname; ?> <?= $userInfo->lastname; ?>">
</div>
<!-- Corps de page -->
<div class="container h-100">
	<div class="p-customized w-100 h-100 d-flex">
		<!-- Profil -->
		<div class="mt-3 mr-md-2 w-100 scroll">
			<div class="w-100 shadow-sm border rounded">
				<div class="w-100 cover rounded-top">
					<div class="p-1 bg-white profil-picture rounded-circle shadow-sm" onclick="zoom()">
						<figure class="m-0 w-100 rounded-circle">
							<img class="w-100 rounded-circle" src="<?= $userInfo->img; ?>" alt="<?= $userInfo->firstname; ?> <?= $userInfo->lastname; ?>">
						</figure>
					</div>
				</div>
				<div class="mt-md-0 mt-5 p-3 w-100">
					<div class="w-100 d-flex">
						<div class="ml-personalized my-auto h4 text-dark">
							<?= htmlspecialchars($userInfo->firstname); ?> <?= htmlspecialchars($userInfo->lastname); ?>
						</div>
						<div class="ml-auto d-flex">
							<div class="text-success d-flex">
								<span class="my-auto d-xl-block d-none">Disponible</span>
								<span class="my-auto d-xl-none d-block" title="En ligne"><i class="far fa-power-off"></i></span>
							</div>
							<div class="dropdown">
								<button class="ml-3 btn btn-light border" type="button" id="options_user" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Plus</button>
								<div class="dropdown-menu" aria-labelledby="options_1">
		    						<button class="dropdown-item d-flex" type="button">Signaler<i class="ml-auto my-auto fas fa-flag"></i></button>
		    						<button class="dropdown-item d-flex" type="button">Bloquer <i class="ml-auto my-auto fas fa-ban"></i></button>
		  						</div>
							</div>
						</div>
					</div>
					<div class="mt-3 w-100 <?= ($nb_stickInfo == 1) ? 'd-flex' : ($nb_stickInfo == 2) ? 'd-lg-flex' : ''; ?>">
						<?php if (isset($userInfo->birthdate)) : ?>
						<div class="<?= ($nb_stickInfo == 1) ? 'mx-auto' : ($nb_stickInfo == 2) ? 'mx-auto mt-lg-0 mt-3' : 'mx-3 my-2 d-md-inline-block'; ?> px-3 py-1 text-dark rounded-pill border border-secondary text-center">
							<i class="mr-3 far fa-birthday-cake"></i>
							<?= dateFR($userInfo->birthdate); ?>
						</div>
						<?php endif; ?>
						<?php if (isset($userInfo->section_name)) : ?>
						<div class="<?= ($nb_stickInfo == 1) ? 'mx-auto' : ($nb_stickInfo == 2) ? 'mx-auto mt-lg-0 mt-3' : 'mx-3 my-2 d-md-inline-block'; ?> px-3 py-1 text-dark rounded-pill border border-secondary text-center">
							<i class="mr-3 fas fa-users"></i>
							<?= htmlspecialchars($userInfo->section_name); ?>
						</div>
						<?php endif; ?>
						<div class="<?= ($nb_stickInfo == 1) ? 'mx-auto' : ($nb_stickInfo == 2) ? 'mx-auto mt-lg-0 mt-3' : 'mx-3 my-2 d-md-inline-block'; ?> px-3 py-1 text-dark rounded-pill border border-secondary text-center">
							<i class="mr-3 far fa-envelope"></i>
							<?= htmlspecialchars($userInfo->email); ?></div>
						<?php if (isset($userInfo->phone_number)) : ?>
						<div class="<?= ($nb_stickInfo == 1) ? 'mx-auto' : ($nb_stickInfo == 2) ? 'mx-auto mt-lg-0 mt-3' : 'mx-3 my-2 d-md-inline-block'; ?> px-3 py-1 text-dark rounded-pill border border-secondary text-center">
							<i class="mr-3 fas fa-phone"></i>
							<?= htmlspecialchars($userInfo->phone_number); ?>
						</div>
						<?php endif; ?>
						<?php if (isset($userInfo->ville_nom_reel)) : ?>
						<div class="<?= ($nb_stickInfo == 1) ? 'mx-auto' : ($nb_stickInfo == 2) ? 'mx-auto mt-lg-0 mt-3' : 'mx-3 my-2 d-md-inline-block'; ?> px-3 py-1 text-dark rounded-pill border border-secondary text-center">
							<i class="mr-3 far fa-home-lg"></i>
							De <?= htmlspecialchars($userInfo->ville_nom_reel); ?> (<?= $userInfo->ville_departement; ?>)
						</div>
						<?php endif; ?>
					</div>
					<div class="mt-3 w-100 text-dark text-justify">
						<?= $userInfo->biography; ?>
					</div>
				</div>
			</div>
			<div class="my-3 p-3 w-100 shadow-sm border rounded">
				<div class="w-100 d-flex">
					<div class="my-auto h4 text-dark">Activité</div>
					<div class="ml-auto my-auto"><a href="#">Voir tout</a></div>
				</div>
				<div class="mt-4 w-100">
					<div class="w-100 d-xl-flex">
						<div class="w-100 d-flex">
							<i class="mr-3 my-auto fal fa-file-alt fa-3x"></i>
							<div class="my-auto" style="line-height: 1.3">
								<div class="text-dark">A publié dans le fil d'actualités</div>
								<a href="post.php?id=1">Texte publié dans le fil d'actualités [...]</a>
								<div class="text-secondary small">1 j'aime · 2 commentaires</div>
							</div>
						</div>
						<div class="mt-xl-0 mt-3 w-100 d-flex">
							<i class="mr-3 my-auto fal fa-file-alt fa-3x"></i>
							<div class="my-auto" style="line-height: 1.3">
								<div class="text-dark">A publié dans votre section</div>
								<a href="post.php?id=1">Texte publié dans la section [...]</a>
								<div class="text-secondary small">1 j'aime · 2 commentaires</div>
							</div>
						</div>
					</div>
					<div class="mt-3 w-100 d-xl-flex">
						<div class="w-100 d-flex">
							<i class="mr-3 my-auto fal fa-map-marker-alt fa-3x"></i>
							<div class="my-auto" style="line-height: 1.3">
								<div class="text-dark">A Modifié son adresse</div>
								<div class="text-secondary small">
									Numéro + adresse
									<br>
									code postal + ville
								</div>
							</div>
						</div>
						<div class="mt-xl-0 mt-3 w-100 d-flex">
							<i class="mr-3 my-auto fal fa-file-alt fa-3x"></i>
							<div class="my-auto" style="line-height: 1.3">
								<div class="text-dark">A publié dans le fil d'actualités</div>
								<a href="post.php?id=1">Texte publié dans le fil d'actualités [...]</a>
								<div class="text-secondary small">1 j'aime · 2 commentaires</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="my-3 p-3 w-100 shadow-sm border rounded">
				<div class="h4 text-dark">Compétences</div>
				<div class="mt-4 w-100">
					<?php if (count($list_skills) == 0) : ?>
						<div class="mr-2 px-3 py-2 bg-secondary d-inline-block text-light rounded-pill">Aucune compétence renseignée</div>
					<?php else : ?>
						<?php foreach ($list_skills as $skillInfo) : ?>
							<div class="mr-2 px-3 py-2 bg-info d-inline-block text-light rounded-pill"><?= htmlspecialchars($skillInfo->skill_name); ?></div>
						<?php endforeach; ?>
					<?php endif; ?>
				</div>
			</div>
			<div class="my-3 p-3 w-100 shadow-sm border rounded">
				<div class="h4 text-dark">Expérience professionnelle</div>
				<div class="mt-4 row">
					<?php foreach ($list_experience as $expInfo) : ?>
					<div class="col-md-6">
						<div class="w-100 shadow">
							<div class="p-3 bg-customized text-light">
								<?= htmlspecialchars($expInfo->occupation); ?>
							</div>
							<?php if (isset($expInfo->img)) : ?>
							<div class="p-3 w-100 d-flex">
								<img class="mx-auto company_logo" src="<?= $expInfo->img; ?>" alt="Logo <?= $expInfo->company_name; ?>">
							</div>
							<?php endif; ?>
							<div class="p-3 bg-light text-dark">
								Chez <?= (isset($expInfo->company_id)) ? htmlspecialchars($expInfo->company_name) : htmlspecialchars($expInfo->company_name_edit); ?>	
							</div>
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
						</div>
					</div>
				<?php endforeach; ?>
				</div>
			</div>
		</div>
		<!-- Discussion -->
		<div class="mt-3 ml-2 bg-light border messenger rounded-top d-lg-block d-none">
			<div class="p-3 h-100 w-100">
				<div class="w-100 d-flex">
					<h4 class="text-dark">Discussion</h4>
					<button class="ml-auto px-2 py-1 btn btn-light" type="button"><i class="fas fa-ellipsis-v"></i></button>
				</div>
				<div id="message_zone" class="msg-zone w-100">
							
				</div>
				<div class="mt-2 w-100">
					<textarea class="px-3 py-2 w-100 bg-white border rounded" rows="2" maxlength="999" name="message" placeholder="Ecrivez à <?= htmlspecialchars($userInfo->firstname); ?>..."></textarea>
					<div class="w-100 d-flex">
						<label id="attachment" class="my-auto px-1 btn-customized-alternativ rounded-pill" title="Joindre un fichier">
							<input class="d-none" name="fileToUpload" type="file" accept="all">
							<span id="file-name"><i class="fal fa-paperclip"></i></span>
						</label>
						<button class="ml-1 my-auto btn-customized-alternativ rounded-pill" type="button" name="send">Envoyer</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>