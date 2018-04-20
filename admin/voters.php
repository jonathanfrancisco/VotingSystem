

<?php

	require '../include/functions.php';
	session_start();

	// if session auth id is not set redirect to login page
	if( !(isset($_SESSION['auth_id']))) {
		header("location:../index.php");
		exit;
	}
	// if session auth id set and it is a voter redirect it to student vote page
	// to prevent student accessing admin sites
	else if(isset($_SESSION['auth_id']) && $_SESSION['auth_id'] == "0") {
		header("location:../student/home.php");
	}



	if($_SERVER['REQUEST_METHOD'] == 'POST' && $_SESSION['auth_id'] == "1") {
		addVoter($_POST['id'],$_POST['firstname'],$_POST['lastname']);
		header("location:voters.php");
	}


	 $title = "Voters";
	 require '../include/templates/header.php'; 


?>

	<div class="container">

		<h1>Add Voter(s)</h1>

		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<form class="text-center" method="POST" action="/admin/voters.php">

				  <div class="form-group">
				    <label for="id">ID:</label>
				    <input required type="text" class="form-control" id="id" name="id" placeholder="ID...">
				  </div>


				  <div class="form-group">
				    <label for="firstname">First Name:</label>
				    <input required type="text" class="form-control" id="firstname" name="firstname" placeholder="First name">
				  </div>


				  <div class="form-group">
				    <label for="lastname">Last Name:</label>
				    <input required type="text" class="form-control" id="lastname" name="lastname" placeholder="Last name">
				  </div>

				
				 
				  <button type="submit" class="btn btn-primary">Add new voter</button>
				</form>
			</div>
		</div>
	</div>


<?php require '../include/templates/footer.php' ?>