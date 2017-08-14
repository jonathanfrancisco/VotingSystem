<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-with, initial-scale=1">
  <meta name="author" content="Jonathan Buted Francisco">
  <meta name="description" content="Jonathan Francisco' Voting System">
  <meta name="keywords" content="Programmer, Full-stack Web Developer, Web Developer, Front-End, Back-End, Portfolio, JavaScript, Android, Java, Java Developer, JavaScript Developer, Android Developer, PHP Developer, PHP">
  <title> <?php echo $title; ?> </title>
  <link rel="stylesheet" href="../include/css-js/bootstrap.min.css">
</head>
<body>

<?php
	
	// if admin show the navigation bar
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
				      </ul>

				      <form action="../../logout.php" method="POST">

				     	<button class="nav-right" type="submit">Logout</button>


				      </form>
				     
				    </div><!-- /.navbar-collapse -->

				  </div><!-- /.container-fluid -->
				</nav>';

	}

?>




