<?php
	require_once dirname(__FILE__).'/../utils/Database.php';

	/**
	 * class for manage list login and logout
	 */
	class History
	{

		protected $id;
		private $date;
		private $os;
		private $browser;
		private $ip;
		private $mac;
		private $users_id;
		protected $database;
		
		function __construct($historyArray = [])
		{
			$this->hydrate($historyArray);
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

		private function hydrate($historyArray)
		{
			foreach ($historyArray as $key => $value) {
				if (property_exists($this, $key)) {
					$this->$key = $value;
				}
			}
		}

		public function saveLogin()
		{
			$insert_SQL = 'INSERT INTO `list_login` (`date`, `os`, `browser`, `ipv4`, `addr_mac`, `users_id`) VALUES (NOW(), :os, :browser, :ipv4, :addr_mac, :users_id)';
			$insertStatement = $this->database->prepare($insert_SQL);

			// binding values in request sql
			$insertStatement->bindValue(':os', $this->os, PDO::PARAM_STR);
			$insertStatement->bindValue(':browser', $this->browser, PDO::PARAM_STR);
			$insertStatement->bindValue(':ipv4', $this->ip, PDO::PARAM_STR);
			$insertStatement->bindValue(':addr_mac', $this->mac, PDO::PARAM_STR);
			$insertStatement->bindValue(':users_id', $this->users_id, PDO::PARAM_INT);

			if ($insertStatement->execute()) {
				$this->id = $this->database->lastInsertId();
			}
		}

		public function countLogin()
		{
			$count_SQL = 'SELECT COUNT(`list_login_id`) FROM `list_login` WHERE `users_id` = :users_id';
			$countStatement = $this->database->prepare($count_SQL);

			$countStatement->bindValue(':users_id', $this->users_id, PDO::PARAM_INT);

			if ($countStatement->execute()) {
				$nb_connexion = $countStatement->fetchColumn();
				return $nb_connexion;
			}
			else{
				return false;
			}
		}
	}