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
	}