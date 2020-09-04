<?php
	class Calendar
	{
		private $months = [1 => 'Janvier', 2 => 'Février', 3 => 'Mars', 4 => 'Avril', 5 => 'Mai', 6 => 'Juin', 7 => 'Juillet', 8 => 'Août', 9 => 'Septembre', 10 => 'Octobre', 11 => 'Novembre', 12 => 'Décembre'];
		
		public $days = [1 => 'Lundi', 2 => 'Mardi', 3 => 'Mercredi', 4 => 'Jeudi', 5 => 'Vendredi', 6 => 'Samedi', 7 => 'Dimanche'];
		public $month;
		public $year;

		/**
		 * Calendar constructor
		 * @param month Le mois compris entre 1 et 12
		 * @param year L'année
		*/
		public function __construct($month = null, $year = null)
		{
			if ($month === null) {
				$month = date('n');
			}

			if ($year === null) {
				$year = date('Y');
			}

			if ($month < 1 || $month > 12) {
				throw new Exception("Le mois $month n'est pas valide");	
			}

			if ($year < 1970) {
				throw new Exception("Votre année est trop antérieure");	
			}

			$this->month = $month;
			$this->year = $year;
		}

		/**
		 * retourne le premier jour du mois
		 *	@return DateTime
		*/
		public function getStartingDay() {
			return new DateTime("{$this->year}-{$this->month}-01");
		}

		/**
		 * retourne le mois en toutes lettres
		 * @return string
		*/
		public function toString() {
			return $this->months[$this->month].' '.$this->year;
		}

		/**
		 * renvoi le nombre de semaines dans le mois
		 * @return int
		*/
		public function getWeeks() {
			$start = $this->getStartingDay();
			$end = (clone $start)->modify('+1 month');
			$weeks = intval($end->format('W')) - intval($start->format('W')) + 1;
			if ($weeks < 0) {
				$weeks = intval($end->format('W'));
			}
			return $weeks;
		}

		/**
		 * Vérifie si le jour est dans le mois en cours
		 * @param DateTime $date
		 * @return bool
		*/
		public function inMonth(DateTime $date) {
			return $this->getStartingDay()->format('Y-m') === $date->format('Y-m');
		}

		/**
		 * renvoie le mois suivant
		 * @return Calendar
		*/
		public function nextMonth() {
			$month = $this->month + 1;
			$year = $this->year;
			if ($month > 12) {
				$month = 1;
				$year += 1;
			}

			return new Calendar($month, $year);
		}

		/**
		 * renvoie le mois précédent
		 * @return Calendar
		*/
		public function prevMonth() {
			$month = $this->month - 1;
			$year = $this->year;
			if ($month < 1) {
				$month = 12;
				$year -= 1;
			}

			return new Calendar($month, $year);
		}
	}
?>