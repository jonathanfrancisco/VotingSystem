



<?php
	
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



	 $title = "About";
	 require '../include/templates/header.php'; 

?>



<div class="container">

	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-default text-center">
			  <div class="panel-heading">
			    <h3 class="panel-title">About</h3>
			  </div>
			  <div class="panel-body">
			   	This voting system is a project of mine to apply and improve my knowledge in making web application using vanilla PHP
			  </div>
			</div>
		</div>
	</div>

</div>


<form method="POST" action="../logout.php">
	<input type='submit' value="Logout">
</form>



<?php require '../include/templates/footer.php' ?>