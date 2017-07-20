
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
		exit;
	}

	if( $_SERVER['REQUEST_METHOD'] == "POST" && $_SESSION['auth_id'] == "1") {

		addElection($_POST['electiontitle'],$_POST['startdate'],$_POST['enddate']);
		header("location:elections.php");
		exit;
	}



	
	$title = "Elections";
	require '../include/templates/header.php';

?>

	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<form class="text-center" method="POST" action="/admin/elections.php">

				  <div class="form-group">
				    <label for="title">Election Title:</label>
				    <input required type="text" class="form-control" id="title" name="electiontitle" placeholder="Election title...">
				  </div>


				  <div class="form-group">
				    <label for="startdate">Start Date:</label>
				    <input required type="date" class="form-control" id="startdate" name="startdate">
				  </div>


				  <div class="form-group">
				    <label for="enddate">End Date:</label>
				    <input required type="date" class="form-control" id="enddate" name="enddate">
				  </div>

				
				 
				  <button type="submit" class="btn btn-default">Add new election</button>
				</form>
			</div>
		</div>
	</div>




<?php require '../include/templates/footer.php'; ?>