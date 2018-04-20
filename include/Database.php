
<?php

class Database {

	private static $connection = null;

	private function __construct() {

	}

	public function connect() {

		if(empty($connection)) {

			try {

				$connection = new PDO('mysql:host=localhost;dbname=votingsystem','root','');
				$connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

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