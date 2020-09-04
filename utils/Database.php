<?php
	require_once dirname(__FILE__).'/../config/config.php';
	/**
	 * object PDO
	 */
	class Database
	{
		private static $pdo = null;

		// static permet d'executer la fonction sans instance de la classe
		public static function getPDO()
		{
			$dsn = 'mysql:host='.HOST.';dbname='.DATABASE.';charset=utf8';
        	$option = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

        	if (is_null(self::$pdo)) {
	        	try {
	        		self::$pdo = new PDO($dsn, USER, PASSWORD, $option);
	        	}
	        	catch (PDOException $e) {
	        		die('Le lien vers la base de donnée à échoué '.$e->getMessage());
	        	}
	        }

	        return self::$pdo;
		}
	}