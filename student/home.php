
<?php 
	
	session_start();

	// if session auth id is not set redirect to login page
	if( !(isset($_SESSION['auth_id']))) {
		header("location:../index.php");
		exit;
	}

	// if session auth id set and it is a admin redirect it to admin page
	// to prevent admin accessing student vote page
	else if(isset($_SESSION['auth_id']) && $_SESSION['auth_id'] == "1") {
		header("location:../admin/home.php");
	}



	$title = "Student vote";

	require '../include/templates/header.php';

?>




<div class="container">

	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-default text-center">
			  <div class="panel-heading">
			    <h3 class="panel-title">Welcome!</h3>
			  </div>
			  <div class="panel-body">
			   	Welcome, Student!. You may now vote.
			  </div>
			</div>
		</div>
	</div>

</div>


<form method="POST" action="../logout.php">
	<input type='submit' value="Logout">
</form>













<?php  require '../include/templates/footer.php';		?>