

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


	if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['view'])) {

		// fetch the details of this election by id
		$electionDetails = getElection($_GET['view']);

		// fetch candidates of this election by id_election assign to candidatees
		$candidates = getCandidates($_GET['view']);

		// fetch all available position for a candidate
		$positions = getPositions();		
	}

	else if($_SERVER['REQUEST_METHOD'] == "GET" && !isset($_GET['view'])) {
		header("location:elections.php");
		exit;
	}

	else if($_SERVER['REQUEST_METHOD'] == 'POST' && $_SESSION['auth_id'] == "1") {


		// add candidates to this election
		addCandidate($_POST['candidateName'], $_POST['electionId'],$_POST['position']);
		header("location:election.php?view=".$_POST['electionId']);
	

	}	




	$title = "Election";
	require '../include/templates/header.php';



?>

	<div class="container">

		<div class="row">


			<div class="col-md-10 col-md-offset-1">

				<h1> Election details </h1>

				<table class="table table-hover">
					<thead>
						<tr> 
							<th>Election Title</th>
							<th>Start Date</th>
							<th>End Date</th>

						</tr>
					</thead>

					<tbody>
				
						<tr>
							<td> <?php echo $electionDetails['election_title'];   ?> </td>
							<td> <?php echo $electionDetails['start_date']; ?> </td>
							<td> <?php echo $electionDetails['end_date']; ?> </td>

						</tr>
						
					</tbody>

				</table>

			</div>

		</div>



		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<form class="form-inline" action="/admin/election.php" method="POST">

				  <div class="form-group">
				    <input type="text" class="form-control" id="candidate" name="candidateName" placeholder="Candidate name">
				    <input type="hidden" class="form-control" id="electionId" name="electionId" value="<?php echo $electionDetails['election_id'];?> ">
				  </div>

				  <select name="position">
				  	<?php 
					  	foreach($positions as $position) {

					  		echo "<option value='".$position['officer_position_id']."'>".$position['position_name']."</option>";

					  	}
				  	?>
				  </select>

				  <button type="submit" class="btn btn-default">Add Candidate</button>
				</form>
			</div>
		</div>


		<div class="row">

			<div class="col-md-8 col-md-offset-2">

				<table class="table table-hover">

					<thead>
						<tr>
							<th>CANDIDATES</th>
						</tr>

					</thead>

					<tbody>

						<?php

							foreach($candidates as $candidate) {
								echo "<tr> <td>".$candidate['candidate_name']." for ".$candidate['position_name']." </td> </tr>";
							}
						?>

					</tbody>
				</table>

			</div>

		</div>

	</div>


<?php require '../include/templates/footer.php'; ?>