<?php if ($insertSuccess == true) : ?>
<div id="post_<?= $postInfo->posts_id; ?>" class="my-3 w-100 shadow-sm border rounded-lg" style="display: none;">
	<div class="p-3 w-100 d-flex">
		<a class="mr-3" href="profil-<?= $postInfo->users_id; ?>"><img id="userpic" class="rounded-circle border border-light" src="<?= $postInfo->img; ?>" alt="userpic"></a>
		<div class="w-100">
			<div class="font-weight-bold">
				<a href="profil-1"><?= $postInfo->firstname ?> <?= $postInfo->lastname; ?></a>
			</div>
			<div class="text-secondary small">
				Publié à l'instant
			</div>
		</div>
		<div class="dropdown position-static">
			<button class="btn btn-light text-secondary" id="options_<?= $postInfo->posts_id; ?>" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button>
			<div class="dropdown-menu" aria-labelledby="options_<?= $postInfo->posts_id; ?>">
    			<button class="dropdown-item d-flex" type="button">Partager<i class="ml-auto my-auto fas fa-share"></i></button>
    			<button class="dropdown-item d-flex update-post" type="button">Modifier<i class="ml-auto my-auto fas fa-pencil"></i></button>
    			<button class="dropdown-item d-flex delete-post" type="button">Supprimer<i class="ml-auto my-auto fas fa-trash-alt"></i></button>
  			</div>
		</div>
	</div>
	<div class="px-3 w-100">
		<p class="text-dark text-justify">
		<?php if (strlen($postInfo->text) > 499) : ?>
			<?= nl2br(substr($postInfo->text, 0, 499)).'...'; ?> <a href="post-<?= $postInfo->posts_id; ?>">Voir plus</a>
		<?php else : ?>
			<?= nl2br($postInfo->text); ?>
		<?php endif; ?>
		</p>
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
<?php else : ?>
<div class="my-3 w-100">
	<div class="alert alert-danger" role="alert">
		<i class="mr-2 far fa-exclamation-circle"></i>Suite à une erreur technique, la publication de votre message à échouée. Veuillez contacter l'administrateur.
	</div>
</div>
<?php endif; ?>
