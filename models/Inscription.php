<?php
	require_once dirname(__FILE__).'/../utils/Database.php';

	/**
	 * class to manage inscriptions
	 */
	class Inscription
	{
		private $id;
		private $date;
		private $access;
		private $standby;
		private $user_id;
		private $company_id;

		function __construct($inscriptionArray = [])
		{
			$this->hydrate($inscriptionArray);
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

		private function hydrate($inscriptionArray)
		{
			foreach ($inscriptionArray as $key => $value) {
				if (property_exists($this, $key)) {
					$this->$key = $value;
				}
			}
		}

		/**
    	 * create new inscription in database
     	 * @return boolean
     	 */
		public function create()
		{
			$insert_SQL = 'INSERT INTO `inscription` (`DATE`, `access`, `standby`, `users_id`, `company_id`) VALUES (NOW(), 0, 0, :users_id, :company_id)';
			$inscriptionStatement = $this->database->prepare($insert_SQL);

			// binding values in request sql
			$inscriptionStatement->bindValue(':users_id', $this->user_id, PDO::PARAM_INT);
			$inscriptionStatement->bindValue(':company_id', $this->company_id, PDO::PARAM_INT);

			$inscriptionStatement->execute();
		}

		public function checkTimeToRegister()
		{
			$select_SQL = 'SELECT TIMESTAMPDIFF(HOUR, `DATE`, NOW()) AS `interval` FROM `inscription` WHERE `users_id` = :user_id';
			$selectStatement = $this->database->prepare($select_SQL);

			// binding values in request sql
			$selectStatement->bindValue(':user_id', $this->user_id, PDO::PARAM_INT);

			if ($selectStatement->execute()) {
				return $selectStatement->fetch(PDO::FETCH_OBJ);
			}
		}

		public function activateAccount()
		{
			$update_SQL = 'UPDATE `inscription` SET `access` = 1 WHERE `users_id` = :user_id';
			$updateStatement = $this->database->prepare($update_SQL);

			$updateStatement->bindValue(':user_id', $this->user_id, PDO::PARAM_INT);

			return $updateStatement->execute();
		}
	}