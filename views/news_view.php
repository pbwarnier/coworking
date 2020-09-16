<div class="p-customized w-100 h-100 d-flex">
			<div class="h-100 bg-white left-width d-sm-block d-none">
				<div class="p-3">
					<a href="my-account" class="nav-link rounded-lg d-flex"><img class="rounded-circle mr-3 border" src="assets/pictures/user.png" alt="userpic"><span class="my-auto text-dark">Mon profil</span></a>
					<a href="#" class="nav-link rounded-lg d-flex"><i class="my-auto mr-3 text-info fas fa-comment-alt-dots"></i><span class="my-auto text-dark">Discussions</span></a>
					<a href="#" class="nav-link rounded-lg d-flex"><i class="my-auto mr-3 text-warning fas fa-bell"></i><span class="my-auto text-dark">Notifications</span></a>
					<a href="members" class="nav-link rounded-lg d-flex"><i class="my-auto mr-3 text-success fas fa-users"></i><span class="my-auto text-dark">Membres</span></a>
					<a href="#" class="nav-link rounded-lg d-flex"><i class="my-auto mr-3 text-danger far fa-calendar-day"></i><span class="my-auto text-dark">Evènements</span></a>
					<a href="#" class="nav-link rounded-lg d-flex"><i class="my-auto mr-3 text-purple fas fa-industry-alt"></i><span class="my-auto text-dark">Mon entreprise</span></a>
				</div>
				<div class="p-3">
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
					<h3 class="mb-3 text-dark">Bienvenue chez La Manu</h3>
					<!-- Publication -->
					<div id="post-contain" class="post-normal">
						<span class="close_zoom d-none">&times;</span>
						<div id="form-contain" class="w-100 d-flex">
							<div class="mr-2">
								<img id="userpic" class="rounded-circle border border-light" src="assets/pictures/user.png" alt="userpic">
							</div>
							<div class="w-100">
								<form id="posting" action="news" method="POST" enctype="multipart/form-data">
									<textarea class="px-3 py-2 w-100 bg-light border border-light rounded" maxlength="999" name="edit-post" placeholder="Ecrivez quelque chose..."></textarea>
									<div class="mt-2 w-100 text-right">
										<label id="attachment" class="px-1 label-disabled rounded-pill" title="Joindre un fichier">
									  		<input class="d-none" name="fileToUpload" type="file" accept="all" disabled="disabled">
											<span id="file-name"><i class="fal fa-paperclip"></i></span>
										</label>
										<button class="ml-1 btn-customized-alternativ rounded-pill" type="button" name="posting" disabled="disabled">Publier</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<!-- Temporary content -->
					<div id="temporary-content" class="mt-3 mb-3 w-100 d-md-flex">
						<div class="mr-md-2 p-3 w-100 bg-light shadow-sm border rounded d-flex">
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
											Le bien être des salariés dans une entreprise est un sujet important pour assurer une bonne productivité. Grâce à ce questionnaire, nous pouvont transmettre les résultats de manière anonyme pour contribuer à l'amélioration de votre environnement de travail.
										</p>
									</div>
								</div>
							</div>
						</div>
						<div class="ml-md-2 mt-md-0 mt-3 p-3 w-100 bg-light shadow-sm border rounded d-flex">
							<div class="my-auto w-100">
								<div class="w-100 d-flex">
									<div class="p-3 w-100 text-center text-dark">
										<div class="h3 text-center">2</div>
										<div>anniversaires ce jour</div>
									</div>
									<div class="border-left border-secondary"></div>
									<div class="p-3 w-100 text-center text-dark">
										<div class="h3">1</div>
										<div>nouvel employé</div>
									</div>
								</div>
								<div class="p-3 text-center border-top border-secondary text-dark">
									<div class="h3">5</div>
									<div>évènements dans votre agenda à ce jour</div>
								</div>
							</div>
						</div>
					</div>
					<!-- Posts -->
					<div class="my-3 w-100 shadow-sm border rounded">
						<div class="p-3 w-100 d-flex">
							<a class="mr-3" href="profil-1"><img id="userpic" class="rounded-circle border border-light" src="assets/pictures/user.png" alt="userpic"></a>
							<div class="w-100">
								<div class="font-weight-bold">
									<a href="profil-1">Utilisateur 1</a>
								</div>
								<div class="text-secondary small">
									Publié le 15 Juin à 15:19
								</div>
							</div>
							<div class="dropdown position-static">
								<button class="btn btn-light text-secondary" id="options_1" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button>
								<div class="dropdown-menu" aria-labelledby="options_1">
    								<button class="dropdown-item d-flex" type="button">Partager<i class="ml-auto my-auto fas fa-share"></i></button>
    								<button class="dropdown-item d-flex" type="button">Signaler<i class="ml-auto my-auto fas fa-flag"></i></button>
  								</div>
							</div>
						</div>
						<div class="p-3 w-100">
							<p class="text-dark text-justify">
								Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. <a href="post-1">Voir plus</a>
							</p>
							<div class="text-secondary small text-right">2 j'aime et 5 commentaires</div>
						</div>
						<div class="w-100 d-flex">
							<button type="button" class="w-100 border-0 btn-interaction">J'aime<i class="ml-2 far fa-thumbs-up"></i></button>
							<button type="button" class="w-100 border-0 btn-interaction" onclick="commenter(1)">Commenter<i class="ml-2 far fa-comment"></i></button>
						</div>
						<!-- Comments -->
						<div id="commentsBloc_1" class="w-100 bg-light comments_contain">
							<div class="w-100 d-flex">
								<img id="userpic" class="mr-3 rounded-circle border" src="assets/pictures/user.png" alt="userpic">
								<textarea class="px-3 py-2 w-100 bg-white border rounded" maxlength="999" name="edit-comment" placeholder="Ecrivez quelque chose..."></textarea>
							</div>
							<div class="mt-2 mb-3 w-100 d-flex">
								<button class="ml-auto btn-customized-alternativ rounded-pill" type="button">Commenter</button>
							</div>
							<div id="commentsList_1" class="w-100">
								<div class="mt-2 w-100 d-flex">
									<a class="mr-3" href="#"><img id="userpic" class="rounded-circle border" src="https://i2.wp.com/www.winhelponline.com/blog/wp-content/uploads/2017/12/user.png?resize=256%2C256&quality=100&ssl=1" alt="userpic"></a>
									<div class="p-2 w-100 rounded-lg bg-white border">
										<div class="d-flex">
											<a class="font-weight-bold" href="#">Utilisateur 4</a>
											<button class="ml-auto px-1 py-0 btn btn-sm btn-light text-dark" type="button"><i class="fas fa-flag"></i></button>
										</div>
										<div class="text-dark">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</div>
									</div>
								</div>
								<div class="mt-2 w-100 d-flex">
									<a class="mr-3" href="#"><img id="userpic" class="rounded-circle border" src="https://static.thenounproject.com/png/2518416-200.png" alt="userpic"></a>
									<div class="p-2 w-100 rounded-lg bg-white border">
										<div class="d-flex">
											<a class="font-weight-bold" href="#">Utilisateur 7</a>
											<button class="ml-auto px-1 py-0 btn btn-sm btn-light text-dark" type="button"><i class="fas fa-flag"></i></button>
										</div>
										<div class="text-dark">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</div>
									</div>
								</div>
								<div class="mt-3 w-100 text-center small"><a href="post-1">Voir tous les commentaires</a></div>
							</div>
						</div>
					</div>
					<!-- Posts image-->
					<div class="my-3 w-100 shadow-sm border rounded">
						<div class="p-3 w-100 d-flex">
							<a class="mr-3" href="#"><img id="userpic" class="rounded-circle border border-light" src="assets/pictures/user.png" alt="userpic"></a>
							<div class="w-100">
								<div class="font-weight-bold">
									<a href="#">Utilisateur 1</a>
								</div>
								<div class="text-secondary small">
									Publié le 15 Juin à 15:19
								</div>
							</div>
							<div class="dropdown position-static">
								<button type="button" class="btn btn-light text-secondary" id="options_2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button>
								<div class="dropdown-menu" aria-labelledby="options_2">
    								<button class="dropdown-item d-flex" type="button">Partager<i class="ml-auto my-auto fas fa-share"></i></button>
    								<button class="dropdown-item d-flex" type="button">Signaler<i class="ml-auto my-auto fas fa-flag"></i></button>
  								</div>
							</div>
						</div>
						<div class="p-3 w-100">
							<p class="text-dark text-justify">
								Lorem Ipsum is simply dummy text of the printing and typesetting industry.
							</p>
							<img class="w-100" src="https://parismatch.be/app/uploads/2017/10/36605465764_728a162e79_o-1100x715.jpg" alt="photo">
							<div class="text-secondary small text-right">8 j'aime et 1 commentaire</div>
						</div>
						<div class="w-100 d-flex">
							<button type="button" class="w-100 border-0 btn-interaction">J'aime<i class="ml-2 far fa-thumbs-up"></i></button>
							<button type="button" class="w-100 border-0 btn-interaction">Commenter<i class="ml-2 far fa-comment"></i></button>
						</div>
					</div>
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