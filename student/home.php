
<?php 
	require '../include/functions.php';
	session_start();

	if($_SERVER['REQUEST_METHOD'] == 'POST') {

		

		foreach($_POST as $candidate_id) {
			castVote((int)$candidate_id);
		}

		// set the user to already voted
		// destroy the session and redirect to index.php
		session_destroy();
		header("location:../index.php");


		// $queryValues = "INSERT INTO votes ";
		// foreach($_POST as $post) {
		// 	$queryValues.= " VALUES(null,".$post.")";
		// }

		// $queryValues .= ";";

		// header("location:home.php");

		// // do this fookin sht
		// // compile the votes in a string. Do it like this: (VALUES(),VALUES() and so on)
		// // insert the votes in database
	}

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


	// fetch on going election.
	$availableElection = checkOngoingElection();

	// check if there is onGoingElection
	// if there isn't, destroy session and redirect
	if(!$availableElection) {
		session_destroy();
		header("location:../index.php");
		exit;
	}





	// if(date('Y-m-d h:i:s') < $availableElection) {
	// 	session_destroy();
	// 	header("location:../index.php");
	// 	exit;
	// }

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

	<div class="row">
		<div class="col-md-8 col-md-offset-2">

		<form method="POST" action="home.php">

		<?php

			$positions = getPositions();

			foreach($positions as $position) {

				$candidates = getCandidatesForPosition($position['position_name'],$availableElection['election_id']);
			
				if(!empty($candidates)) {
					echo "<h2>".$position['position_name']."</h2>";
					echo "<select name='".$position['position_name']."'>";
					foreach($candidates as $candidate) {
						echo "<option value='".$candidate['candidate_id']."'>".$candidate['candidate_name']."</option>";
					}
					echo "</select>";
				}

				else if(empty($candidates)){
					// do nothing
				}

			}


		?>

			<input type="submit" class="btn btn-primary" value="Cast votes">

		</form>
		</div>
	</div>

</div>


<form method="POST" action="../logout.php">
	<input type='submit' value="Logout">
</form>

<?php  require '../include/templates/footer.php'; ?>