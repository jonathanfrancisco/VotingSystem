
<?php 
	
	session_start();

	if(!(isset($_SESSION['auth_id']) && $_SESSION['auth_id'] == "0")) {
		header("location:../index.php");
		exit;
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