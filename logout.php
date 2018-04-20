


<?php

	session_start();

	
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['auth_id'])) {

		session_destroy();
		header("location:index.php");
		exit;
	}

	else if($_SERVER['REQUEST_METHOD'] == 'GET') {
		echo "page does not exist";
		exit;
	}


?>