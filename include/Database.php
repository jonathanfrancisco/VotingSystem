
<?php

class Database {

	private static $connection = null;

	private function __construct() {

	}

	public function connect() {

		if(empty($connection)) {

			try {

				$connection = new PDO('mysql:host=localhost;dbname=votingsystem','root','');

			} catch(PDOException $e) {

				echo $e->getMessage();
			}
		}

		return $connection;
	}

	public function disconnect() {
		$connection = null;
	}

}