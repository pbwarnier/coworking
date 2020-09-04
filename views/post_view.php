<div class="container p-customized">
	<!-- Posts -->
	<div class="my-3 w-100">
		<a class="text-secondary" href="news"><i class="mr-2 fas fa-arrow-left"></i>Retour</a>
	</div>
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
				<button type="button" class="btn btn-light text-secondary" id="options_1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button>
				<div class="dropdown-menu" aria-labelledby="options_1">
    				<button class="dropdown-item d-flex" type="button">Partager<i class="ml-auto my-auto fas fa-share"></i></button>
    				<button class="dropdown-item d-flex" type="button">Signaler<i class="ml-auto my-auto fas fa-flag"></i></button>
  				</div>
			</div>
		</div>
		<div class="p-3 w-100">
			<p class="text-dark text-justify">
				Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
			</p>
			<div class="text-secondary small text-right">2 j'aime et 5 commentaires</div>
		</div>
		<div class="w-100 d-flex">
			<button type="button" class="w-100 border-0 btn-interaction">J'aime<i class="ml-2 far fa-thumbs-up"></i></button>
			<button id="commentate" type="button" class="w-100 border-0 btn-interaction">Commenter<i class="ml-2 far fa-comment"></i></button>
		</div>
		<!-- Comments -->
		<div id="commentsBloc_1" class="w-100 bg-light comments_contain_block">
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
						<div class="text-secondary small">Il y a 1 heure</div>
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
						<div class="text-secondary small">Il y a 1 jour</div>
						<div class="text-dark">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>