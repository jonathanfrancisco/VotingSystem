<!DOCTYPE html>
<html>
<head>
  <title> <?php echo $title; ?> </title>
  <link rel="stylesheet" href="../include/css-js/bootstrap.min.css">
</head>
<body>




<!--  If admin show nav bar -->
<?php

	if(!empty($_SESSION['auth_id']) && $_SESSION['auth_id'] == "1") {

			echo ' <nav class="navbar navbar-default">
				  <div class="container-fluid">
				    <div class="navbar-header">
				      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				        <span class="sr-only">Toggle navigation</span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				      </button>
				      <a class="navbar-brand" href="../../admin/home.php">Voting System</a>
				    </div>
				    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				      <ul class="nav navbar-nav">
				        <li><a href="../../admin/elections.php">Elections</a></li>
				        <li><a href="../../admin/positions.php">Positions</a></li>
				        <li><a href="../../admin/voters.php">Voters</a></li>
				        <li><a href="../../admin/results.php">Results</a></li>
				      </ul>
				    </div><!-- /.navbar-collapse -->

				  </div><!-- /.container-fluid -->
				</nav>  ';

	}





?>




<!-- else, do not -->


