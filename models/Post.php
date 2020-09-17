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
			$insert_SQL = ' INSERT INTO `posts` (`date`, `text`, `attachment`, `ban`, `company_id`, `users_id`) VALUES (NOW(), :text, :attachment, :ban, :company_id, :users_id)';
			$insertStatement = $this->database->prepare($insert_SQL);

			$insertStatement->bindValue(':text', $this->text, PDO::PARAM_STR);
			$insertStatement->bindValue(':attachment', $this->attachment, PDO::PARAM_STR);
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
			$select_SQL = 'SELECT `users`.`users_id`, `users`.`lastname`, `users`.`firstname`, `users`.`img`, `posts`.`posts_id`, DATE_FORMAT(`posts`.`date`, "Y-m-d") AS `post_date`, DATE_FORMAT(`posts`.`date`, "H:i") AS `post_time`, `posts`.`text`, `posts`.`attachment` FROM `posts` INNER JOIN `users` ON `posts`.`users_id` = `users`.`users_id` WHERE `posts_id` = :posts_id';
			$selectStatement = $this->database->prepare($select_SQL);

			$selectStatement->bindValue(':posts_id', $this->id, PDO::PARAM_INT);

			if ($selectStatement->execute()) {
				return $selectStatement->fetch(PDO::FETCH_OBJ);
			}
		}
	}