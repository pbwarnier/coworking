<?php
	require_once dirname(__FILE__).'/../utils/Database.php';

	/**
	 * class for manage list login and logout
	 */
	class History
	{

		private $id;
		private $date;
		private $os;
		private $browser;
		private $ip;
		private $mac;
		private $users_id;
		
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
	}