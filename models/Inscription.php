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

			$interval = null;

			if ($selectStatement->execute()) {
				$time = $selectStatement->fetch(PDO::FETCH_OBJ);
				if (isset($time)) {
					$interval = $time->interval;
				}
			}

			return $interval;
		}

		public function checkAccess()
		{
			$select_SQL = 'SELECT `access` FROM `inscription` WHERE `users_id` = :user_id';
			$selectStatement = $this->database->prepare($select_SQL);

			$selectStatement->bindValue(':user_id', $this->user_id, PDO::PARAM_INT);
			$selectStatement->setFetchMode(PDO::FETCH_INTO, $this);

			if ($selectStatement->execute()) {
				$selectStatement->fetch(PDO::FETCH_INTO);
			}
		}

		public function activateAccount()
		{
			$update_SQL = 'UPDATE `inscription` SET `access` = 1 WHERE `users_id` = :user_id';
			$updateStatement = $this->database->prepare($update_SQL);

			$updateStatement->bindValue(':user_id', $this->user_id, PDO::PARAM_INT);

			return $updateStatement->execute();
		}

		public function countNewers()
		{
			$count_SQL = 'SELECT COUNT(`inscription_id`) FROM `inscription` WHERE `DATE` = CURRENT_DATE AND `company_id` = :company_id';
			$countStatement = $this->database->prepare($count_SQL);

			$countStatement->bindValue(':company_id', $this->company_id, PDO::PARAM_INT);

			if ($countStatement->execute()) {
				$nb_newers = $countStatement->fetchColumn();
				return $nb_newers;
			}
		}
	}