


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
		addPosition($_POST['positionname']);
		header("location:positions.php");
	}
	

	$title = "Body Positions";
	require '../include/templates/header.php';

?>

	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<form class="form-inline" action="/admin/positions.php" method="POST">
				  <div class="form-group">
				    <input type="text" class="form-control" id="position" name="positionname" placeholder="Position name">
				  </div>

				  <button type="submit" class="btn btn-default">Add position</button>
				</form>

			</div>
		</div>



		<div class="row">

			<div class="col-md-6 col-md-offset-3">

				<table class="table table-hover">
					<thead>
						<tr> 
							<th>Positions</th>
							<th>Actions</th>
						</tr>
					</thead>

					<tbody>


						<?php

						$positions = getPositions();

						foreach($positions as $position) {
							echo "<tr> <td>".$position['position_name']."</td> <td> <a class='btn btn-danger' href='delete-position.php?id='".$position['officer_position_id']."'>Delete</a></td> </tr>";
						}

						?>

					</tbody>
				</table>

			</div>
		</div>
	</div>



<?php require '../include/templates/footer.php'; ?>

