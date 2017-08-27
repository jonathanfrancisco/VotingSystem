<?php
	
	session_start();

	require '../include/functions.php';


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




<div class="container-fluid">

	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="panel panel-primary">
			  <!-- Default panel contents -->
			  <div class="panel-heading text-center"><strong>RESULT</strong></div>

			  <!-- Table -->
			  <table class="table">
			   
			    
			   		<?php


						$positions = getPositions();

						foreach($positions as $position){

							$candidates = getCandidateVotes($position['position_name'],$_GET['result']);

							if(!empty($candidates)) {

								echo '<tr> 
								      <th>'.$position['position_name'].'</th>
								      <th>Vote(s)</th> 
								      </tr>';

								foreach($candidates as $candidate){
									echo '<tr> 
									      <td>'.$candidate['candidate_name'].'</td>
									      <td>'.$candidate['totalVotes'].'</td> 
									      </tr>';
								}

							}

							else if(empty($candidates)) {
								// do nothing
							}

							


						}


					?>
			    

			  </table>
			</div>
		</div>

	</div>

</div>


<?php 
	require '../include/templates/footer.php';
?>