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
		private $birthdate;
		private $phone_number;
		private $biography;
		private $image;
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
			$userStatement = $this->database->prepare($insert_SQL);

			// binding values in request sql
			$userStatement->bindValue(':gender', $this->gender, PDO::PARAM_INT);
			$userStatement->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
			$userStatement->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
			$userStatement->bindValue(':email', $this->email, PDO::PARAM_STR);
			$userStatement->bindValue(':password', $this->password, PDO::PARAM_STR);
			$userStatement->bindValue(':img', $this->img, PDO::PARAM_STR);
			$userStatement->bindValue(':birthdate', $this->birthdate, PDO::PARAM_STR);
			$userStatement->bindValue(':city', $this->city, PDO::PARAM_INT);
			$userStatement->bindValue(':phone_number', $this->phone_number, PDO::PARAM_INT);
			$userStatement->bindValue(':biography', $this->biography, PDO::PARAM_STR);
			$userStatement->bindValue(':permission', $this->permission, PDO::PARAM_STR);
			$userStatement->bindValue(':ban', $this->ban, PDO::PARAM_BOOL);
			$userStatement->bindValue(':temporary_code', $this->temporary_code, PDO::PARAM_INT);
			$userStatement->bindValue(':multi_step', $this->multi_step, PDO::PARAM_BOOL);
			$userStatement->bindValue(':section_id', $this->section_id, PDO::PARAM_NULL);
			$userStatement->bindValue(':company_id', $this->company_id, PDO::PARAM_INT);

			if ($userStatement->execute()) {
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
			$userStatement = $this->database->prepare($count_SQL);

			// binding values in request sql
			$userStatement->bindValue(':email', $this->email, PDO::PARAM_STR);

			if ($userStatement->execute()) {
				$nb_users = $userStatement->fetchColumn();
				return $nb_users;
			}
			else{
				return false;
			}
		}
	}