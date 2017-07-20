



<?php
	
	session_start();


	if(!(isset($_SESSION['auth_id']) && $_SESSION['auth_id'] == "1")) {
		header("location:../index.php");
		exit;
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