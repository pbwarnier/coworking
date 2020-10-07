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
			$insertStatement->bindValue(':city', $this->city, PDO::PARAM_NULL);
			$insertStatement->bindValue(':phone_number', $this->phone_number, PDO::PARAM_NULL);
			$insertStatement->bindValue(':biography', $this->biography, PDO::PARAM_NULL);
			$insertStatement->bindValue(':permission', $this->permission, PDO::PARAM_STR);
			$insertStatement->bindValue(':ban', $this->ban, PDO::PARAM_BOOL);
			$insertStatement->bindValue(':temporary_code', $this->temporary_code, PDO::PARAM_STR);
			$insertStatement->bindValue(':multi_step', $this->multi_step, PDO::PARAM_BOOL);
			$insertStatement->bindValue(':section_id', $this->section_id, PDO::PARAM_NULL);
			if (empty($this->company_id)) {
				$insertStatement->bindValue(':company_id', $this->company_id, PDO::PARAM_BOOL);
			}
			else {
				$insertStatement->bindValue(':company_id', $this->company_id, PDO::PARAM_INT);
			}

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
			$select_SQL = 'SELECT `permission` FROM `users` WHERE `users_id` = :users_id';
			$selectStatement = $this->database->prepare($select_SQL);

			// binding values in request sql
			$selectStatement->bindValue(':users_id', $this->id, PDO::PARAM_INT);
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
			$count_SQL = 'SELECT COUNT(`users_id`) FROM `users` WHERE `users_id` = :users_id AND `temporary_code` = :temporary_code';
			$countStatement = $this->database->prepare($count_SQL);

			// binding values in request sql
			$countStatement->bindValue(':users_id', $this->id, PDO::PARAM_INT);
			$countStatement->bindValue(':temporary_code', $this->temporary_code, PDO::PARAM_STR);

			if ($countStatement->execute()) {
				$nb_users = $countStatement->fetchColumn();
				return $nb_users;
			}
		}

		public function updateToken()
		{
			$update_SQL = 'UPDATE `users` SET `temporary_code` = :temporary_code WHERE `users_id` = :users_id';
			$updateStatement = $this->database->prepare($update_SQL);

			$updateStatement->bindValue(':users_id', $this->id, PDO::PARAM_INT);
			$updateStatement->bindValue(':temporary_code', $this->temporary_code, PDO::PARAM_STR);

			return $updateStatement->execute();
		}

		public function resetToken()
		{
			$update_SQL = 'UPDATE `users` SET `temporary_code` = null WHERE `users_id` = :users_id';
			$updateStatement = $this->database->prepare($update_SQL);

			$updateStatement->bindValue(':users_id', $this->id, PDO::PARAM_INT);

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

		/**
    	 * update user's informations
     	 * @return boolean
     	 */
		public function update($arrayColumns = [], $arrayUpdates = [])
		{
			if (!empty($arrayColumns)) {
				$query = implode(', ', $arrayColumns); // transform array in chain
				$update_SQL = 'UPDATE `users` SET '.$query.' WHERE `users_id` = :users_id'; // create request
				$updateStatement = $this->database->prepare($update_SQL);

				foreach ($arrayUpdates as $key => $value) {
					if (is_int($this->$key)) {
						$updateStatement->bindValue(':'.$key, $this->$key, PDO::PARAM_INT);
					}
					elseif (is_string($this->$key)) {
						$updateStatement->bindValue(':'.$key, $this->$key, PDO::PARAM_STR);
					}
					elseif (is_bool($this->$key)) {
						$updateStatement->bindValue(':'.$key, $this->$key, PDO::PARAM_BOOL);
					}
					elseif (is_null($this->$key)) {
						$updateStatement->bindValue(':'.$key, $this->$key, PDO::PARAM_NULL);
					}
				}

				$updateStatement->bindValue(':users_id', $this->id, PDO::PARAM_INT);

				return $updateStatement->execute();
			}
			else {
				return false;
			}
		}

		public function getNavInfo()
		{
			$select_SQL = 'SELECT `lastname`, `firstname`, `img` FROM `users` WHERE `users_id` = users_id';
			$selectStatement = $this->database->prepare($select_SQL);

			$selectStatement->bindValue(':users_id', $this->id, PDO::PARAM_INT);

			if ($selectStatement->execute()) {
				return $selectStatement->fetch(PDO::FETCH_OBJ);
			}
		}

		public function countBirthday(){
			$count_SQL = 'SELECT ((SELECT COUNT(`birthdate`) AS `birth1` FROM `users` WHERE DATE_FORMAT(`birthdate`, "%m-%d") = :birthdate AND `users`.`company_id` = :company_id) + (SELECT COUNT(`users`.`birthdate`) AS `birth2` FROM `users` INNER JOIN company ON `users`.`users_id` = `company`.`users_id_manager` WHERE DATE_FORMAT(`users`.`birthdate`, "%m-%d") = :birthdate AND `company`.`company_id` = :company_id)) AS total';

			$countStatement = $this->database->prepare($count_SQL);

			$countStatement->bindValue(':birthdate', $this->birthdate, PDO::PARAM_STR);
			$countStatement->bindValue(':company_id', $this->company_id, PDO::PARAM_INT);

			if ($countStatement->execute()) {
				$nb_birthday = $countStatement->fetchColumn();
				return $nb_birthday;
			}
		}

		public function selectProfil()
		{
			$select_SQL = 'SELECT `users`.`lastname`, `users`.`firstname`, `users`.`email`, `users`.`img`, `users`.`birthdate`, DATE_FORMAT(`users`.`birthdate`, "%d/%m/%Y") AS `birthSlash`, `users`.`city`, `users`.`phone_number`, `users`.`biography`, `villes_france_free`.`ville_nom_reel`, `villes_france_free`.`ville_departement`, `section`.`name` AS `section_name` FROM `users` LEFT JOIN `villes_france_free` ON `users`.`city` = `villes_france_free`.`ville_id` LEFT JOIN `section` ON `section`.`section_id` = `users`.`section_id` WHERE `users`.`users_id` = :users_id';
			$selectStatement = $this->database->prepare($select_SQL);

			$selectStatement->bindValue(':users_id', $this->id, PDO::PARAM_INT);

			if ($selectStatement->execute()) {
				return $selectStatement->fetch(PDO::FETCH_OBJ);
			}
		}
	}