
<?php 

	session_start();
	if(!(isset($_SESSION['auth_id']) && $_SESSION['auth_id'] == 1)) {
		header("location:../index.php");
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
				    <label for="id">End Date:</label>
				    <input required type="date" class="form-control" id="id" name="enddate">
				  </div>

				
				 
				  <button type="submit" class="btn btn-default">Add new election</button>
				</form>
			</div>
		</div>
	</div>



<?php require '../include/templates/footer.php'; ?>