<?php
	require_once dirname(__FILE__).'/../utils/Database.php';
	/**
	 * class for manage users
	 */
	class User
	{
		private $id;
		private $gender;
		private $lastname;
		private $firstname;
		private $email;
		private $password;
		private $img;
		private $birthdate;
		private $phone_number;
		private $biography;
		private $city;
		private $permission;
		private $ban;
		private $temporary_code;
		private $multi_step;
		private $section_id;
		private $company_id;
		private $database;

		function __construct($userArray = [])
		{
			$this->hydrate($userArray);
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

		private function hydrate($userArray)
		{
			foreach ($userArray as $key => $value) {
				if (property_exists($this, $key)) {
					$this->$key = $value;
				}
			}
		}

		/**
    	 * create new user in database
     	 * @return boolean
     	 */
		public function create()
		{
			$insert_SQL = 'INSERT INTO `users` (`gender`, `lastname`, `firstname`, `email`, `password`, `img`, `birthdate`, `city`, `phone_number`, `biography`, `permission`, `ban`, `temporary_code`, `multi_step`, `section_id`, `company_id`) VALUES (:gender, :lastname, :firstname, :email, :password, :img, :birthdate, :city, :phone_number, :biography, :permission, :ban, :temporary_code, :multi_step, :section_id, :company_id)';
			$insertStatement = $this->database->prepare($insert_SQL);

			// binding values in request sql
			$insertStatement->bindValue(':gender', $this->gender, PDO::PARAM_STR);
			$insertStatement->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
			$insertStatement->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
			$insertStatement->bindValue(':email', $this->email, PDO::PARAM_STR);
			$insertStatement->bindValue(':password', $this->password, PDO::PARAM_STR);
			$insertStatement->bindValue(':img', $this->img, PDO::PARAM_STR);
			$insertStatement->bindValue(':birthdate', $this->birthdate, PDO::PARAM_STR);
			$insertStatement->bindValue(':city', $this->city, PDO::PARAM_INT);
			$insertStatement->bindValue(':phone_number', $this->phone_number, PDO::PARAM_INT);
			$insertStatement->bindValue(':biography', $this->biography, PDO::PARAM_STR);
			$insertStatement->bindValue(':permission', $this->permission, PDO::PARAM_STR);
			$insertStatement->bindValue(':ban', $this->ban, PDO::PARAM_BOOL);
			$insertStatement->bindValue(':temporary_code', $this->temporary_code, PDO::PARAM_STR);
			$insertStatement->bindValue(':multi_step', $this->multi_step, PDO::PARAM_BOOL);
			$insertStatement->bindValue(':section_id', $this->section_id, PDO::PARAM_NULL);
			$insertStatement->bindValue(':company_id', $this->company_id, PDO::PARAM_INT);

			if ($insertStatement->execute()) {
				$this->id = $this->database->lastInsertId();
			}
		}

		/**
    	 * check if an email already exists
     	 * @return int
     	 */
		public function checkMail()
		{
			$count_SQL = 'SELECT COUNT(`users_id`) FROM `users` WHERE `email` = :email';
			$countStatement = $this->database->prepare($count_SQL);

			// binding values in request sql
			$countStatement->bindValue(':email', $this->email, PDO::PARAM_STR);

			if ($countStatement->execute()) {
				$nb_users = $countStatement->fetchColumn();
				return $nb_users;
			}
			else{
				return false;
			}
		}

		/**
    	 * check permissions of user
     	 * @return strings
     	 */
		public function permission()
		{
			$select_SQL = 'SELECT `permission` FROM `users` WHERE `users_id` = :id';
			$selectStatement = $this->database->prepare($select_SQL);

			// binding values in request sql
			$selectStatement->bindValue(':id', $this->id, PDO::PARAM_INT);
			$selectStatement->setFetchMode(PDO::FETCH_INTO, $this); // fetch parametter

			if ($selectStatement->execute()) {
				$selectStatement->fetch(PDO::FETCH_INTO); // hydrate permission attribute
			}
		}

		/**
    	 * check token or security code of user
     	 * @return int
     	 */
		public function checkToken()
		{
			$count_SQL = 'SELECT COUNT(`users_id`) FROM `users` WHERE `users_id` = :id AND `temporary_code` = :temporary_code';
			$countStatement = $this->database->prepare($count_SQL);

			// binding values in request sql
			$countStatement->bindValue(':id', $this->id, PDO::PARAM_INT);
			$countStatement->bindValue(':temporary_code', $this->temporary_code, PDO::PARAM_STR);

			if ($countStatement->execute()) {
				$nb_users = $countStatement->fetchColumn();
				return $nb_users;
			}
		}

		public function updateToken()
		{
			$update_SQL = 'UPDATE `users` SET `temporary_code` = :temporary_code WHERE `users_id` = :user_id';
			$updateStatement = $this->database->prepare($update_SQL);

			$updateStatement->bindValue(':id', $this->id, PDO::PARAM_INT);
			$updateStatement->bindValue(':temporary_code', $this->temporary_code, PDO::PARAM_STR);

			return $updateStatement->execute();
		}

		public function resetToken()
		{
			$update_SQL = 'UPDATE `users` SET `temporary_code` = null WHERE `users_id` = :user_id';
			$updateStatement = $this->database->prepare($update_SQL);

			$updateStatement->bindValue(':user_id', $this->id, PDO::PARAM_INT);

			return $updateStatement->execute();
		}

		public function selectAuth()
		{
			$select_SQL = 'SELECT `users_id`, `email`, `password`, `permission`, `ban`, `multi_step` FROM `users` WHERE `email` = :email';
			$selectStatement = $this->database->prepare($select_SQL);

			$selectStatement->bindValue(':email', $this->email, PDO::PARAM_STR);

			if ($selectStatement->execute()) {
				return $selectStatement->fetch(PDO::FETCH_OBJ);
			}
		}
	}