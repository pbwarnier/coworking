<?php if ($insertSuccess == true) : ?>
<div class="my-3 w-100 shadow-sm border rounded-lg">
	<div class="p-3 w-100 d-flex">
		<a class="mr-3" href="profil-<?= $postInfo->users_id; ?>"><img id="userpic" class="rounded-circle border border-light" src="<?= $postInfo->img; ?>" alt="userpic"></a>
		<div class="w-100">
			<div class="font-weight-bold">
				<a href="profil-1"><?= $postInfo->firstname ?></a>
			</div>
			<div class="text-secondary small">
				Publié à l'instant
			</div>
		</div>
		<div class="dropdown position-static">
			<button class="btn btn-light text-secondary" id="options_<?= $postInfo->post_id; ?>" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button>
			<div class="dropdown-menu" aria-labelledby="options_<?= $postInfo->post_id; ?>">
    			<button class="dropdown-item d-flex" type="button">Partager<i class="ml-auto my-auto fas fa-share"></i></button>
    			<button id="delete-post" class="dropdown-item d-flex" type="button">Supprimer<i class="ml-auto fas fa-trash-alt"></i></button>
  			</div>
		</div>
	</div>
	<!-- <div class="p-3 w-100">
		<p class="text-dark text-justify">
		</p>
		<div class="text-secondary small text-right">2 j'aime et 5 commentaires</div>
	</div> -->
	<div class="w-100 d-flex">
		<button type="button" class="w-100 border-0 btn-interaction">J'aime<i class="ml-2 far fa-thumbs-up"></i></button>
		<button type="button" class="w-100 border-0 btn-interaction" onclick="commenter(1)">Commenter<i class="ml-2 far fa-comment"></i></button>
	</div>
	<!-- commentaires -->
</div>
<?php else : ?>
<div class="my-3 w-100">
	<div class="alert alert-danger" role="alert">
		<i class="mr-2 far fa-exclamation-circle"></i>Suite à une erreur technique, la publication de votre message à échouée. Veuillez contacter l'administrateur.
	</div>
</div>
<?php endif; ?>
