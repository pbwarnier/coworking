<div class="p-customized w-100 h-100 d-flex">
	<div class="h-100 bg-white left-width d-sm-block d-none">
		<div class="py-3 pl-3">
			<a href="my-account" class="nav-link rounded-lg d-flex"><img class="rounded-circle mr-3 border" src="<?= $userInfo->img; ?>" alt="userpic"><span class="my-auto text-dark">Mon profil</span></a>
			<a href="#" class="nav-link rounded-lg d-flex"><i class="my-auto mr-3 text-info fas fa-comment-alt-dots"></i><span class="my-auto text-dark">Discussions</span></a>
			<a href="#" class="nav-link rounded-lg d-flex"><i class="my-auto mr-3 text-warning fas fa-bell"></i><span class="my-auto text-dark">Notifications</span></a>
			<a href="members" class="nav-link rounded-lg d-flex"><i class="my-auto mr-3 text-success fas fa-users"></i><span class="my-auto text-dark">Membres</span></a>
			<a href="#" class="nav-link rounded-lg d-flex"><i class="my-auto mr-3 text-danger far fa-calendar-day"></i><span class="my-auto text-dark">Evènements</span></a>
			<a href="#" class="nav-link rounded-lg d-flex"><i class="my-auto mr-3 text-purple fas fa-industry-alt"></i><span class="my-auto text-dark">Mon entreprise</span></a>
		</div>
		<div class="py-3 pl-3">
			<div class="toast show shadow-sm" role="alert" aria-live="assertive" aria-atomic="true">
	  			<div class="toast-header">
	    			<strong class="mr-auto">Annonce</strong>
	    			<small class="text-muted">Il y a 5 min</small>
	  			</div>
	  			<div class="toast-body">
	    			Ceci est une annonce importante du PDG
	  			</div>
			</div>
		</div>
	</div>
	<!-- News feed -->
	<div class="w-100 h-100 news">
		<div class="px-3 pt-3 w-100 overflow-auto">
			<h3 class="mb-3 text-dark">Bienvenue chez <?= $company->company_name; ?></h3>
			<!-- Publication -->
			<div id="post-contain" class="post-normal">
				<span class="close_zoom d-none">&times;</span>
				<div id="form-contain" class="w-100 d-flex">
					<div class="mr-2">
						<img id="userpic" class="rounded-circle border border-light" src="<?= $userInfo->img; ?>" alt="userpic">
					</div>
					<div class="w-100">
						<form id="posting" action="news" method="POST" enctype="multipart/form-data">
							<textarea class="px-3 py-2 w-100 bg-light border border-light rounded" maxlength="999" name="edit-post" placeholder="Ecrivez quelque chose..."></textarea>
							<div class="mt-2 w-100 text-right">
								<label id="attachment" class="px-1 label-disabled rounded-pill" title="Joindre un fichier">
									  <input class="d-none" name="fileToUpload" type="file" accept="all" disabled="disabled">
									<span id="file-name"><i class="fal fa-paperclip"></i></span>
								</label>
								<button class="ml-1 btn-customized-alternativ rounded-pill posting" type="button" name="posting" disabled="disabled">Publier</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<?php if (isset($errors['file'])) : ?>
			<div class="alert alert-danger" role="danger">
				<i class="mr-2 fal fa-exclamation-circle"></i><?= $errors['file']; ?>
			</div>
			<?php endif; ?>
			<!-- Temporary content -->
			<div id="temporary-content" class="mt-3 mb-3 w-100 d-md-flex">
				<div class="mr-md-2 p-3 w-100 bg-light shadow-sm border rounded-lg d-flex">
					<div class="my-auto">
						<div id="temporary-issue">
							<div class="w-100 text-center">
								<h4 class="text-dark">Comment vous sentez-vous <span>aujourd'hui ?</span></h4>
							</div>
							<div class="mt-5 w-100 d-flex">
								<div class="mx-auto">
									<button class="px-2 btn btn-light text-center" type="button" name="happy">
										<div class="emoji">&#128578;</div>
										<span>Plutôt bien</span>
									</button>
								</div>
								<div class="mx-auto">
									<button class="px-2 btn btn-light text-center" type="button" name="bad">
										<div class="emoji">&#128577;</div>
										<span>Plutôt mal</span>
									</button>
								</div>
							</div>
						</div>
						<div id="temporary-answer">
							<h4 class="text-personalized text-center">Merci d'avoir répondu à cette question</h4>
							<div class="mt-3 w-100">
								<p class="m-0 text-dark text-justify">
									Le bien être des salariés dans une entreprise est un sujet important pour assurer une bonne croissance. Grâce à ce questionnaire, nous pouvont transmettre les résultats de manière anonyme pour contribuer à l'amélioration de votre environnement de travail.
								</p>
							</div>
						</div>
					</div>
				</div>
				<div class="ml-md-2 mt-md-0 mt-3 p-3 w-100 bg-light shadow-sm border rounded-lg d-flex">
					<div class="my-auto w-100">
						<div class="w-100 d-flex">
							<div class="p-3 w-100 text-center text-dark">
								<div class="h3 text-center"><?= $countBirthday; ?></div>
								<div>anniversaire<?= ($countBirthday > 1) ? 's' : '' ?> ce jour</div>
							</div>
							<div class="border-left border-secondary"></div>
							<div class="p-3 w-100 text-center text-dark">
								<div class="h3"><?= $countNewers; ?></div>
								<div>nouve<?= ($countNewers < 2) ? 'l' : 'aux'; ?> employé<?= ($countNewers > 2) ? 's' : ''; ?></div>
							</div>
						</div>
						<div class="p-3 text-center border-top border-secondary text-dark">
							<div class="h3">5</div>
							<div>évènements dans votre agenda à ce jour</div>
						</div>
					</div>
				</div>
			</div>
			<?php if (isset($nb_post) && $nb_post == 0 && empty($_COOKIE['close-info-box'])) : ?>
			<div class="my-3 p-3 w-100 bg-info shadow-sm border rounded-lg info-box">
				<div class="mr-2 my-auto text-white d-md-block d-none"><i class="fal fa-exclamation-circle fa-5x"></i></div>
				<div class="ml-2">
					<p class="text-white text-justify">Vous n'avez pas encore publié dans le fil d'actualité. Postez votre premier message pour vous présenter, par exemple.</p>
					<div class="w-100 d-flex justify-content-end"><button id="writing-post" class="btn btn-light rounded-pill">Rédiger un message</button><button id="close-info" class="ml-2 btn btn-outline-light rounded-pill">Fermer</button></div>
				</div>
			</div>
			<?php endif; ?>
			<!-- Posts -->
			<?php if (count($listPost) == 0) : ?>
				<div class="my-3 p-3 w-100 text-secondary shadow-sm border rounded-lg info-box">
					<div class="mx-auto">Aucun message n'est publié pour le moment</div>
				</div>
			<?php else : ?>
				<?php foreach ($listPost as $postInfo) : ?>
				<div id="post_<?= $postInfo->posts_id; ?>" class="my-3 w-100 shadow-sm border rounded-lg">
					<div class="p-3 w-100 d-flex">
						<a class="mr-3" href="<?= ($postInfo->users_id == $_SESSION['user']['id']) ? 'my-account' : 'profil-'.$postInfo->users_id; ?>"><img id="userpic" class="rounded-circle border border-light" src="<?= $postInfo->img; ?>" alt="<?= $postInfo->firstname ?> <?= $postInfo->lastname; ?>"></a>
						<div class="w-100">
							<div class="font-weight-bold">
								<a href="<?= ($postInfo->users_id == $_SESSION['user']['id']) ? 'my-account' : 'profil-'.$postInfo->users_id; ?>"><?= $postInfo->firstname; ?> <?= $postInfo->lastname; ?></a>
							</div>
							<div class="text-secondary small">
								Publié le <?= dateFR($postInfo->post_date); ?> à <?= $postInfo->post_time; ?>
							</div>
						</div>
						<div class="dropdown position-static">
							<button class="btn btn-light text-secondary" id="options_<?= $postInfo->posts_id; ?>" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button>
							<div class="dropdown-menu" aria-labelledby="options_<?= $postInfo->posts_id; ?>">
				    			<button class="dropdown-item d-flex" type="button">Partager<i class="ml-auto my-auto fas fa-share"></i></button>
				    			<?php if ($postInfo->users_id == $_SESSION['user']['id']) : ?>
				    				<button class="dropdown-item d-flex update-post" type="button">Modifier<i class="ml-auto my-auto fas fa-pencil"></i></button>
				    				<button class="dropdown-item d-flex delete-post" type="button">Supprimer<i class="ml-auto my-auto fas fa-trash-alt"></i></button>
				    			<?php else : ?>
				    				<button class="dropdown-item d-flex" type="button">Signaler<i class="ml-auto my-auto fas fa-flag"></i></button>
				    			<?php endif; ?>
				  			</div>
						</div>
					</div>
					<div class="px-3 w-100">
						<?php if (!empty($postInfo->text)) : ?>
							<p class="text-dark text-justify">
							<?php if (strlen($postInfo->text) > 499) : ?>
								<?= nl2br(substr($postInfo->text, 0, 499)).'...'; ?> <a href="post-<?= $postInfo->posts_id; ?>">Voir plus</a>
							<?php else : ?>
								<?= nl2br($postInfo->text); ?>
							<?php endif; ?>
							</p>
						<?php endif; ?>
						<?php if (!empty($postInfo->attachment) && $postInfo->type_attachment == 'image') : ?>
							<div class="w-100 d-flex justify-content-center">
								<img class="mb-2 attachment" src="../users/<?= $postInfo->users_id; ?>/publications/<?= $postInfo->attachment; ?>">
							</div>
						<?php elseif (!empty($postInfo->attachment) && $postInfo->type_attachment == 'document') : ?>
							<a class="mb-2" href="../users/<?= $postInfo->users_id; ?>/publications/<?= $postInfo->attachment; ?>" download>
								<div class="p-2 border rounded-lg d-inline">
									<i class="mr-2 fal fa-paperclip"></i><?= $postInfo->attachment; ?>
								</div>
							</a>
						<?php endif; ?>
						<?php if ($postInfo->nb_likes != 0 || $postInfo->nb_comments != 0) : ?>
							<div id="reactions_<?= $postInfo->posts_id; ?>" class="text-secondary small text-right">
								<span id="likes_<?= $postInfo->posts_id; ?>"><?= $postInfo->nb_likes ?></span><i class="ml-2 mr-3 far fa-thumbs-up"></i>
								<span id="comments_<?= $postInfo->posts_id; ?>"><?= $postInfo->nb_comments; ?></span><i class="mx-2 far fa-comment"></i>
							</div>
						<?php endif; ?>
					</div>
					<div class="w-100 d-flex">
						<button id="btn-like-<?= $postInfo->posts_id; ?>" type="button" class="w-100 border-0 btn-interaction" data-id="<?= $postInfo->posts_id; ?>" data-action="like">J'aime<i class="ml-2 far fa-thumbs-up"></i></button>
						<button id="btn-comment-<?= $postInfo->posts_id; ?>" type="button" class="w-100 border-0 btn-interaction" data-id="<?= $postInfo->posts_id; ?>" data-action="comment">Commenter<i class="ml-2 far fa-comment"></i></button>
					</div>
					<!-- commentaires -->
					<div id="commentsBloc_<?= $postInfo->posts_id; ?>" class="w-100 bg-light comments_contain">
						<div class="w-100 d-flex">
							<img id="userpic" class="mr-3 rounded-circle border" src="<?= $postInfo->img; ?>" alt="<?= $postInfo->firstname ?> <?= $postInfo->lastname; ?>">
							<textarea class="px-3 py-2 w-100 bg-white border rounded" maxlength="999" name="edit-comment" placeholder="Ecrivez quelque chose..."></textarea>
						</div>
						<div class="mt-2 mb-3 w-100 d-flex">
							<button class="ml-auto btn-customized-alternativ rounded-pill" type="button">Commenter</button>
						</div>
					</div>
				</div>
				<?php endforeach; ?>
			<?php endif; ?>
		</div> 
	</div> 
	<!-- Messagerie -->
	<div class="h-100 message-box bg-light overflow-hidden">
		<div class="p-3 w-100">
			<h3 class="text-dark">Discussions</h3>
			<div class="mt-3 w-100">
				<input class="p-2 w-100 border rounded-lg" type="text" name="search" placeholder="Rechercher une discussion">
			</div>
		</div>
		<div id="chatList" class="w-100">
			<div class="p-1 w-100 d-flex">
				<div class="mx-auto small text-secondary">Aujourd'hui</div>
			</div>
			<div class="p-2 w-100 bg-white d-flex border-top border-bottom">
				<img id="userpic" class="mr-2 rounded-circle border border-light" src="https://i2.wp.com/www.winhelponline.com/blog/wp-content/uploads/2017/12/user.png?resize=256%2C256&quality=100&ssl=1" alt="userpic">
				<div class="w-100">
					<div class="w-100 d-flex">
						<div class="font-weight-bold text-dark">Utilisateur 4</div>
						<button class="ml-auto btn btn-sm btn-light px-1 py-0" type="button"><i class="fas fa-ellipsis-v"></i></button>
					</div>
					<div class="w-100 small text-secondary">
						Bonjour collègue comment vas...
					</div>
				</div>
			</div>
			<div class="mt-3 p-1 w-100 d-flex">
				<div class="mx-auto small text-secondary">Hier</div>
			</div>
			<div class="p-2 w-100 bg-white d-flex border-top border-bottom">
				<img id="userpic" class="mr-2 rounded-circle border border-light" src="https://static.thenounproject.com/png/2518416-200.png" alt="userpic">
				<div class="w-100">
					<div class="w-100 d-flex">
						<div class="font-weight-bold text-dark">Utilisateur 7</div>
						<button class="ml-auto btn btn-sm btn-light px-1 py-0" type="button"><i class="fas fa-ellipsis-v"></i></button>
					</div>
					<div class="w-100 small text-secondary">
						Rejoins-moi
					</div>
				</div>
			</div>
			<div class="p-2 w-100 bg-white d-flex border-top border-bottom">
				<img id="userpic" class="mr-2 rounded-circle border border-light" src="https://audit-controle-interne.com/wp-content/uploads/2019/03/avatar-user-teacher-312a499a08079a12-512x512.png" alt="userpic">
				<div class="w-100">
					<div class="w-100 d-flex">
						<div class="font-weight-bold text-dark">Utilisateur 2</div>
						<button class="ml-auto btn btn-sm btn-light px-1 py-0" type="button"><i class="fas fa-ellipsis-v"></i></button>
					</div>
					<div class="w-100 small text-secondary">
						Faisons comme cela
					</div>
				</div>
			</div>
			<div class="mt-3 p-1 w-100 d-flex">
				<div class="mx-auto small text-secondary">Plus anciens</div>
			</div>
			<div class="p-2 w-100 bg-white d-flex border-top border-bottom">
				<img id="userpic" class="mr-2 rounded-circle border border-light" src="https://cdn3.iconfinder.com/data/icons/avatars-round-flat/33/avat-01-512.png" alt="userpic">
				<div class="w-100">
					<div class="w-100 d-flex">
						<div class="font-weight-bold text-dark">Utilisateur 2</div>
						<button class="ml-auto btn btn-sm btn-light px-1 py-0" type="button"><i class="fas fa-ellipsis-v"></i></button>
					</div>
					<div class="w-100 small text-secondary">
						Ok
					</div>
				</div>
			</div>
		</div>
	</div>
</div>