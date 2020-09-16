<?php
	require_once dirname(__FILE__).'/../utils/Database.php';

	/**
	 * class for manage devices
	 */
	class Device
	{
		private $login_id;
		private $database;

		function __construct($id = 0)
		{
			$this->login_id = $id;
	        $this->database = Database::getPDO();
		}

		public function saveDevice()
		{
			$insert_SQL = 'INSERT INTO `devices` (`list_login_id`) VALUES (:list_login_id)';
			$insertStatement = $this->database->prepare($insert_SQL);

			$insertStatement->bindValue(':list_login_id', $this->login_id, PDO::PARAM_INT);

			$insertStatement->execute();
		}
	}