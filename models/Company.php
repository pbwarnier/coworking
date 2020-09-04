<?php
	require_once dirname(__FILE__).'/../utils/Database.php';

	/**
	 * class for manage companies
	 */
	class Company
	{
		
		private $id;
		private $company_code;
		private $company_name;
		private $siret;
		private $adress_number;
		private $number_complement;
		private $adress;
		private $adress_complement;
		private $postcode;
		private $city;
		private $phone_number;
		private $mobile_phone;
		private $users_id_manager;

		function __construct($companyArray = [])
		{
			$this->hydrate($companyArray);
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

		private function hydrate($companyArray)
		{
			foreach ($companyArray as $key => $value) {
				if (property_exists($this, $key)) {
					$this->$key = $value;
				}
			}
		}

		/**
    	 * check if company exists
     	 * @return int
     	 */
		public function checkCompany()
		{
			$count_SQL = 'SELECT COUNT(`company_id`) FROM `company` WHERE `company_code` = :company_code';
			$companyStatement = $this->database->prepare($count_SQL);

			// binding values in request sql
			$companyStatement->bindValue(':company_code', $this->company_code, PDO::PARAM_STR);

			if ($companyStatement->execute()) {
				$nb_company = $companyStatement->fetchColumn();
				return $nb_company;
			}
			else{
				return false;
			}
		}
	}
