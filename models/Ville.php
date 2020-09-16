<?php
	require_once dirname(__FILE__).'/../utils/Database.php';

	/**
	 * class for manage ville
	 */
	class Ville
	{
		private $id;
		private $ville_name;
		private $ville_code;
		private $database;
		
		function __construct($villeArray = [])
		{
			$this->hydrate($villeArray);
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

	    private function hydrate($villeArray)
		{
			foreach ($villeArray as $key => $value) {
				if (property_exists($this, $key)) {
					$this->$key = $value;
				}
			}
		}

	    public function searchCity()
	    {
	    	$select_SQL = 'SELECT `ville_id`, `ville_nom_reel`, `ville_code_postal` FROM `villes_france_free` WHERE `ville_code_postal` LIKE :ville_code ORDER BY `ville_nom_reel` ASC';
	    	$searchStatement = $this->database->prepare($select_SQL);

	    	$searchStatement->bindValue(':ville_code', $this->ville_code, PDO::PARAM_STR);

	    	$search_list = [];

	    	if ($searchStatement->execute()) {
				$search_list = $searchStatement->fetchAll(PDO::FETCH_OBJ);
			}

			return $search_list;
	    }

	    public function searchCityandZipcode()
	    {
	    	$select_SQL = 'SELECT `ville_id`, `ville_nom_reel`, `ville_departement` FROM `villes_france_free` WHERE `ville_nom_reel` LIKE :ville_name OR `ville_code_postal` LIKE :ville_code ORDER BY `ville_nom_reel` ASC LIMIT 5';
	    	$searchStatement = $this->database->prepare($select_SQL);

	    	$searchStatement->bindValue(':ville_name', $this->ville_name, PDO::PARAM_STR);
	    	$searchStatement->bindValue(':ville_code', $this->ville_name, PDO::PARAM_STR);

	    	$search_list = [];

	    	if ($searchStatement->execute()) {
				$search_list = $searchStatement->fetchAll(PDO::FETCH_OBJ);
			}

			return $search_list;
	    }
	}