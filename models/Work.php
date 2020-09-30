<?php
	require_once dirname(__FILE__).'/../utils/Database.php';

	/**
	 * class for manage works experiences
	 */
	class Work
	{
		
		private $id;
		private $occupation;
		private $start;
		private $end;
		private $description;
		private $company_id;
		private $company_name;
		private $users_id;
		private $database;
		
		function __construct($workArray = [])
		{
			$this->hydrate($workArray);
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

	    private function hydrate($workArray)
		{
			foreach ($workArray as $key => $value) {
				if (property_exists($this, $key)) {
					$this->$key = $value;
				}
			}
		}

		/**
    	 * insert new work experience
     	 * @return boolean
     	 */
		public function insert()
		{
			$insert_SQL = 'INSERT INTO `works` (`occupation`, `start` , `end`, `description`, `company_id`, `company_name`, `users_id`) VALUES (:occupation, :start, :end, :description, :company_id, :company_name, :users_id)';
			$insertStatement = $this->database->prepare($insert_SQL);

			// binding values in request sql
			$insertStatement->bindValue(':occupation', $this->occupation, PDO::PARAM_STR);
			$insertStatement->bindValue(':start', $this->start, PDO::PARAM_STR);
			$insertStatement->bindValue(':end', $this->end, PDO::PARAM_STR);
			$insertStatement->bindValue(':description', $this->description, PDO::PARAM_STR);
			$insertStatement->bindValue(':company_id', $this->company_id, PDO::PARAM_INT);
			$insertStatement->bindValue(':company_name', $this->company_name, PDO::PARAM_STR);
			$insertStatement->bindValue(':users_id', $this->users_id, PDO::PARAM_INT);

			return $insertStatement->execute();
		}

		public function selectAll()
		{
			$select_SQL = 'SELECT `works`.`occupation`, `works`.`start`, `works`.`end`, `works`.`description`, `works`.`company_id`, `works`.`company_name` AS `company_name_edit`, `company`.`company_name`, `company`.`img` FROM `works` LEFT JOIN `company` ON `works`.`company_id` = `company`.`company_id` WHERE `works`.`users_id` = :users_id ORDER BY `works`.`start` DESC';
			$selectStatement = $this->database->prepare($select_SQL);

			$selectStatement->bindValue(':users_id', $this->users_id, PDO::PARAM_INT);

			$list_experience = [];

			if ($selectStatement->execute()) {
				$list_experience = $selectStatement->fetchAll(PDO::FETCH_OBJ);
			}

			return $list_experience;
		}
	}