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
		private $address_number;
		private $number_complement;
		private $address;
		private $address_complement;
		private $city;
		private $phone_number;
		private $mobile_number;
		private $users_id_manager;
		private $database;

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
			$countStatement = $this->database->prepare($count_SQL);

			// binding values in request sql
			$countStatement->bindValue(':company_code', $this->company_code, PDO::PARAM_STR);

			if ($countStatement->execute()) {
				$nb_company = $countStatement->fetchColumn();
				return $nb_company;
			}
			else{
				return false;
			}
		}

		/**
    	 * create new company
     	 * @return boolean
     	 */
		public function create()
		{
			$insert_SQL = 'INSERT INTO `company` (`company_code`, `company_name`, `siret`, `address_number`, `number_complement`, `address`, `address_complement`, `city`, `phone_number`, `mobile_phone`, `users_id_manager`) VALUES (:company_code, :company_name, :siret, :address_number, :number_complement, :address, :address_complement, :city, :phone_number, :mobile_phone, :users_id_manager)';
			$insertStatement = $this->database->prepare($insert_SQL);

			// binding values in request sql
			$insertStatement->bindValue(':company_code', $this->company_code, PDO::PARAM_INT);
			$insertStatement->bindValue(':company_name', $this->company_name, PDO::PARAM_STR);
			$insertStatement->bindValue(':siret', $this->siret, PDO::PARAM_STR);
			$insertStatement->bindValue(':address_number', $this->address_number, PDO::PARAM_INT);
			$insertStatement->bindValue(':number_complement', $this->number_complement, PDO::PARAM_STR);
			$insertStatement->bindValue(':address', $this->address, PDO::PARAM_STR);
			$insertStatement->bindValue(':address_complement', $this->address_complement, PDO::PARAM_STR);
			$insertStatement->bindValue(':city', $this->city, PDO::PARAM_INT);
			$insertStatement->bindValue(':phone_number', $this->phone_number, PDO::PARAM_STR);
			$insertStatement->bindValue(':mobile_phone', $this->mobile_number, PDO::PARAM_STR);
			$insertStatement->bindValue(':users_id_manager', $this->users_id_manager, PDO::PARAM_STR);

			if ($insertStatement->execute()) {
				$this->id = $this->database->lastInsertId();
			}
		}
		/**
    	 * select company code
     	 * @return int
     	 */
		public function getCodeWithManager(){
			$select_SQL = 'SELECT `company_code` FROM `company` WHERE `users_id_manager` = :users_id_manager';
			$selectStatement = $this->database->prepare($select_SQL);

			$selectStatement->bindValue(':users_id_manager', $this->users_id_manager, PDO::PARAM_INT);
			$selectStatement->setFetchMode(PDO::FETCH_INTO, $this);

			if ($selectStatement->execute()) {
				$selectStatement->fetch(PDO::FETCH_INTO);
			}
		}
		/**
    	 * select company code
     	 * @return int
     	 */
		public function getCodeWithEmployee($users_id){
			$select_SQL = 'SELECT `company`.`company_code` FROM `company` INNER JOIN `users` ON `company`.`company_id` = `users`.`company_id` WHERE `users`.`users_id` = :users_id';
			$selectStatement = $this->database->prepare($select_SQL);

			$selectStatement->bindValue(':users_id', $users, PDO::PARAM_INT);
			$selectStatement->setFetchMode(PDO::FETCH_INTO, $this);

			if ($selectStatement->execute()) {
				$selectStatement->fetch(PDO::FETCH_INTO);
			}
		}
	}
