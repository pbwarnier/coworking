<?php
	require_once dirname(__FILE__).'/../models/Post.php'; // insert class Post
	require_once dirname(__FILE__).'/../utils/convert_date.php';

	$insertSuccess = null;

	if (!empty($_POST['text'])) {
		$postArray = array(
			'text' => $_POST['text'],
			'attachment' => '',
			'ban' => 0,
			'company_id' => $_SESSION['user']['company_id'],
			'users_id' => $_SESSION['user']['id']
		);

		$post = new Post($postArray);

		$insertSuccess = $post->insert();
	}

	if ($insertSuccess == true) {
		$postInfo = $post->readSingle();
	}

	require_once dirname(__FILE__).'/../views/new_posting_view.php';