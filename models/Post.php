<?php
	require_once dirname(__FILE__).'/../utils/Database.php';


	/**
	 * class for manage posts
	 */
	class Post
	{

		private $id;
		private $date;
		private $text;
		private $attachment;
		private $type_attachment;
		private $ban;
		private $company_id;
		private $users_id;
		private $database;
		
		function __construct($postArray = [])
		{
			$this->hydrate($postArray);
	        $this->database = Database::getPDO();
		}

		public function __get($attr)
	    {
	        return $this->$attr;
	    }

	    public function __set($attr, $value)
	    {
	        $this->$attr = $value;
	    }

		private function hydrate($postArray)
		{
			foreach ($postArray as $key => $value) {
				if (property_exists($this, $key)) {
					$this->$key = $value;
				}
			}
		}

		public function countContribution()
		{
			$select_SQL = 'SELECT COUNT(`posts_id`) FROM `posts` WHERE `users_id` = :users_id';
			$countStatement = $this->database->prepare($select_SQL);

			$countStatement->bindValue(':users_id', $this->users_id, PDO::PARAM_INT);

			$nb_post = null;

			if ($countStatement->execute()) {
				$nb_post = $countStatement->fetchColumn();
			}

			return $nb_post;
		}

		public function insert()
		{
			$insert_SQL = ' INSERT INTO `posts` (`date`, `text`, `attachment`, `type_attachment`, `ban`, `company_id`, `users_id`) VALUES (NOW(), :text, :attachment, :type_attachment, :ban, :company_id, :users_id)';
			$insertStatement = $this->database->prepare($insert_SQL);

			$insertStatement->bindValue(':text', $this->text, PDO::PARAM_STR);
			if (empty($this->attachment)) {
				$insertStatement->bindValue(':attachment', $this->attachment, PDO::PARAM_NULL);
				$insertStatement->bindValue(':type_attachment', $this->type_attachment, PDO::PARAM_NULL);
			}
			else{
				$insertStatement->bindValue(':attachment', $this->attachment, PDO::PARAM_STR);
				$insertStatement->bindValue(':type_attachment', $this->type_attachment, PDO::PARAM_STR);
			}
			$insertStatement->bindValue(':ban', $this->ban, PDO::PARAM_BOOL);
			$insertStatement->bindValue(':company_id', $this->company_id, PDO::PARAM_INT);
			$insertStatement->bindValue(':users_id', $this->users_id, PDO::PARAM_INT);

			$insertSuccess = false;
			
			if ($insertStatement->execute()) {
				$this->id = $this->database->lastInsertId();
				$insertSuccess = true;
			}
			
			return $insertSuccess;
		}

		public function readSingle()
		{
			$select_SQL = 'SELECT `users`.`users_id`, `users`.`lastname`, `users`.`firstname`, `users`.`img`, `posts`.`posts_id`, DATE_FORMAT(`posts`.`date`, "%Y-%m-%d") AS `post_date`, DATE_FORMAT(`posts`.`date`, "%H:%i") AS `post_time`, `posts`.`text`, `posts`.`attachment`, `posts`.`type_attachment` FROM `posts` INNER JOIN `users` ON `posts`.`users_id` = `users`.`users_id` WHERE `posts`.`posts_id` = :posts_id';
			$selectStatement = $this->database->prepare($select_SQL);

			$selectStatement->bindValue(':posts_id', $this->id, PDO::PARAM_INT);

			if ($selectStatement->execute()) {
				return $selectStatement->fetch(PDO::FETCH_OBJ);
			}
		}

		public function readAll()
		{
			$select_SQL = 'SELECT `users`.`users_id`, `users`.`lastname`, `users`.`firstname`, `users`.`img`, `posts`.`posts_id`, DATE_FORMAT(`posts`.`date`, "%Y-%m-%d") AS `post_date`, DATE_FORMAT(`posts`.`date`, "%H:%i") AS `post_time`, `posts`.`text`, `posts`.`attachment`, `posts`.`type_attachment`, `comments`.`comments_id`,  COUNT(`comments`.`comments_id`) AS `nb_comments`, COUNT(`likes`.`likes_id`) AS `nb_likes` FROM `posts` LEFT JOIN `users` ON `users`.`users_id` = `posts`.`users_id` LEFT JOIN `likes` ON `posts`.`posts_id` = `likes`.`posts_id` LEFT JOIN `comments` ON `posts`.`posts_id` = `comments`.`posts_id` WHERE `posts`.`company_id` = :company_id AND `posts`.`ban` = :ban GROUP BY `posts`.`posts_id` ORDER BY `posts`.`date` DESC';

			$selectStatement = $this->database->prepare($select_SQL);

			$selectStatement->bindValue(':company_id', $this->company_id, PDO::PARAM_INT);
			$selectStatement->bindValue(':ban', $this->ban, PDO::PARAM_BOOL);

			$list_post = [];

			if ($selectStatement->execute()) {
				$list_post = $selectStatement->fetchAll(PDO::FETCH_OBJ);
			}

			return $list_post;
		}

		public function delete()
		{
			$delete_SQL = 'DELETE `posts`, `comments`, `likes` FROM `posts` LEFT JOIN `comments` ON `posts`.`posts_id` = `comments`.`posts_id` LEFT JOIN `likes` ON `posts`.`posts_id` = `likes`.`posts_id` WHERE `posts`.`posts_id` = :posts_id AND `posts`.`users_id` = :users_id';
			$deleteStatement = $this->database->prepare($delete_SQL);

			$deleteStatement->bindValue(':posts_id', $this->id, PDO::PARAM_INT);
			$deleteStatement->bindValue(':users_id', $this->users_id, PDO::PARAM_INT);

			return $deleteStatement->execute();
		}
	}