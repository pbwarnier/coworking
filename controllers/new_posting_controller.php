<?php
	require_once dirname(__FILE__).'/../models/Post.php'; // insert class Post
	require_once dirname(__FILE__).'/../utils/convert_date.php';

	session_start();

	$insertSuccess = null;

	if (!empty($_POST['text'])) {
		$text = trim(filter_var($_POST['text'], FILTER_SANITIZE_STRING)); // sinitize textarea value
		$postArray = array(
			'text' => $text,
			'attachment' => null,
			'ban' => 0,
			'company_id' => $_SESSION['user']['company_id'],
			'users_id' => $_SESSION['user']['id']
		);

		$post = new Post($postArray);

		$insertSuccess = $post->insert();
	}

	if ($insertSuccess == true) {
		$postInfo = $post->readSingle();

		ob_start(); // start buffer
		require_once dirname(__FILE__).'/../views/new_posting_view.php';
		$html = ob_get_clean(); // send buffer in response table
		$response = array(
			'id' => $postInfo->posts_id,
			'html' => $html
		);

		echo json_encode($response);
	}