<?php
	require_once dirname(__FILE__).'/../utils/Database.php';

	/**
	 * class for manage like
	 */
	class Like
	{
		
		private $id;
		private $date;
		private $users_id;
		private $posts_id;
		private $database;

		function __construct($likeArray = [])
		{
			$this->hydrate($likeArray);
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

		private function hydrate($likeArray)
		{
			foreach ($likeArray as $key => $value) {
				if (property_exists($this, $key)) {
					$this->$key = $value;
				}
			}
		}

		/**
    	 * add new like from post
     	 * @return boolean
     	 */
		public function insert()
		{
			$insert_SQL = 'INSERT INTO `likes` (`date`, `users_id`, `posts_id`) VALUES (NOW(), :users_id, :posts_id)';
			$insertStatement = $this->database->prepare($insert_SQL);

			$insertStatement->bindValue(':users_id', $this->users_id, PDO::PARAM_INT);
			$insertStatement->bindValue(':posts_id', $this->posts_id, PDO::PARAM_INT);

			return $insertStatement->execute();
		}

		public function count()
		{
			$count_SQL = 'SELECT COUNT(`likes_id`) AS `nb_likes` FROM `likes` WHERE `posts_id` = :posts_id';
			$countStatement = $this->database->prepare($count_SQL);

			$countStatement->bindValue(':posts_id', $this->posts_id, PDO::PARAM_INT);

			if ($countStatement->execute()) {
				$nb_likes = $countStatement->fetchColumn();
				return $nb_likes;
			}
		}

		public function checkLiked($postId = 0)
		{
			$count_SQL = 'SELECT COUNT(`likes_id`) AS `nb_likes` FROM `likes` WHERE `posts_id` = :posts_id AND `users_id` = :users_id';
			$countStatement = $this->database->prepare($count_SQL);

			$countStatement->bindValue(':posts_id', $postId, PDO::PARAM_INT);
			$countStatement->bindValue(':users_id', $this->users_id, PDO::PARAM_INT);

			if ($countStatement->execute()) {
				$like_exist = $countStatement->fetchColumn();
				return boolval($like_exist);
			}
		}

		public function delete()
		{
			$delete_SQL = '	DELETE FROM `likes` WHERE `posts_id` = :posts_id AND `users_id` = :users_id';
			$deleteStatement = $this->database->prepare($delete_SQL);

			$deleteStatement->bindValue(':users_id', $this->users_id, PDO::PARAM_INT);
			$deleteStatement->bindValue(':posts_id', $this->posts_id, PDO::PARAM_INT);

			return $deleteStatement->execute();
		}
	}