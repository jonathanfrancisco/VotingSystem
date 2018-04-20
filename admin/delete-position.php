

<?php
	
	require '../include/functions.php';
	session_start();

	if(empty($_GET['id'])) {
		header("location:positions.php");
	}

	else if(!empty($_GET['id'])) {

		deletePosition($_GET['id']);
		header("location:positions.php");

	}


?>