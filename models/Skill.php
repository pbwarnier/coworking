<?php
	require_once dirname(__FILE__).'/../utils/Database.php';

	/**
	 * class for manage skills
	 */
	class Skill
	{

		private $id;
		private $skill_name;
		private $users_id;
		private $database;
		
		function __construct($skillArray = [])
		{
			$this->hydrate($skillArray);
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

		private function hydrate($skillArray)
		{
			foreach ($skillArray as $key => $value) {
				if (property_exists($this, $key)) {
					$this->$key = $value;
				}
			}
		}

		public function selectAll()
		{
			$select_SQL = 'SELECT `skills_id`, `skill_name` FROM `skills` WHERE `users_id` = :users_id';
			$selectStatement = $this->database->prepare($select_SQL);

			$selectStatement->bindValue(':users_id', $this->users_id, PDO::PARAM_INT);

			$list_skills = [];

			if ($selectStatement->execute()) {
				$list_skills = $selectStatement->fetchAll(PDO::FETCH_OBJ);
			}

			return $list_skills;
		}

		public function insert()
		{
			$insert_SQL = 'INSERT INTO `skills`(`skill_name`, `users_id`) VALUES (:skill_name, :users_id)';
			$insertStatement = $this->database->prepare($insert_SQL);

			$insertStatement->bindValue(':skill_name', $this->skill_name, PDO::PARAM_STR);
			$insertStatement->bindValue(':users_id', $this->users_id, PDO::PARAM_INT);

			$insertSuccess = false;

			if ($insertStatement->execute()) {
				$insertSuccess = true;
				$this->id = $this->database->lastInsertId();
			}

			return $insertSuccess;
		}

		public function delete()
		{
			$delete_SQL = 'DELETE FROM `skills` WHERE `skills_id` = :skills_id AND `users_id` = :users_id';
			$deleteStatement = $this->database->prepare($delete_SQL);

			$deleteStatement->bindValue(':skills_id', $this->id, PDO::PARAM_INT);
			$deleteStatement->bindValue(':users_id', $this->users_id, PDO::PARAM_INT);

			return $deleteStatement->execute();
		}
	}