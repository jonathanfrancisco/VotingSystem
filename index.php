


<?php 
	
	session_start();	
	


	// if server request is POST do authentication
	if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['id'])) {

		require 'include/functions.php';		

		$authID = authenticateAndAuthorize($_POST['id']);

		// if admin, redirect to admin panel
		if($authID == "1") {
			$_SESSION['auth_id'] = $authID;
			header("location:admin/home.php");
			exit;
		}

		// else if voter, redirect to voting page
		else if($authID == "0") {
			$_SESSION['auth_id'] = $authID;
			header("location:student/home.php");
			exit;
		}

		// stay on page
		else if(empty($authID)) {
			echo "ID does not exist or Wrong ID!";
			var_dump($authID);
			exit;
		}

		else {
			throw new Excception("Error");	
		}

	}

	// if server request is GET and session ID is set then redirect in to voting page
	else if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_SESSION['auth_id'])) {

		if($_SESSION['auth_id'] == "1") {
			header("location:admin/home.php");
		}

		else if($_SESSION['auth_id'] == "0") {
			header("location:student/home.php");
		}



	}
	
	$title = "Login";
	require 'include/templates/header.php';

?>


	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<form class="text-center" method="POST" action="/">
				  <div class="form-group">
				    <label for="id">Student ID:</label>
				    <input type="text" class="form-control" id="id" name="id" placeholder="Enter your id...">
				  </div>
				 
				  <button type="submit" class="btn btn-default">Login</button>
				</form>
			</div>
		</div>
	</div>


<?php require 'include/templates/header.php'; ?>