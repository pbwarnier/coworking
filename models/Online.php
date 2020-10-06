<?php
	require_once dirname(__FILE__).'/../utils/Database.php';

	/**
	 * class for manage connexion marker
	 */
	class Online
	{
		
		private $id;
		private $marker;
		private $users_id;
		private $database;

		function __construct($onlineArray = [])
		{
			$this->hydrate($onlineArray);
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

		private function hydrate($onlineArray)
		{
			foreach ($onlineArray as $key => $value) {
				if (property_exists($this, $key)) {
					$this->$key = $value;
				}
			}
		}

		public function init()
		{
			$insert_SQL = 'INSERT INTO `online`(`marker`, `users_id`) VALUES (:marker, :users_id)';
			$insertStatement = $this->database->prepare($insert_SQL);

			$insertStatement->bindValue(':marker', $this->marker, PDO::PARAM_BOOL);
			$insertStatement->bindValue(':users_id', $this->users_id, PDO::PARAM_INT);

			return $insertStatement->execute();
		}

		public function update()
		{
			$update_SQL = 'UPDATE `online` SET `marker` = :marker WHERE `users_id` = :users_id';
			$updateStatement = $this->database->prepare($update_SQL);

			$updateStatement->bindValue(':marker', $this->marker, PDO::PARAM_BOOL);
			$updateStatement->bindValue(':users_id', $this->users_id, PDO::PARAM_INT);

			return $updateStatement->execute();
		}
	}