<?php

	require 'Database.php';
	date_default_timezone_set("Asia/Hong_Kong");
	
	// authenticate and authorize a user
	// if result == 1 redirect to admin
	// otherwise, redirect to voting page
	function authenticateAndAuthorize($id) {

		try {

			$connection = Database::connect();
			$query = $connection->prepare("SELECT authorization FROM Users WHERE user_id = :id");
			$query->bindParam(":id",$id,PDO::PARAM_INT);
			$query->execute();
			$result = $query->fetch();
			Database::disconnect();

		} catch(PDOException $e) {
			echo $e->getMessage();
		}

		return $result['authorization'];

	}

	////// POSITION CRUD Functionalities /////////////
	function addPosition($positionName) {

		try {

			$connection = Database::connect();
			$query = $connection->prepare("INSERT INTO officerpositions VALUES(NULL,:positionName) ");
			$query->bindParam(":positionName",$positionName,PDO::PARAM_STR);
			$query->execute();
			Database::disconnect();

		} catch(PDOException $e) {
			echo $e->getMessage();
		}


	}

	function getPositions() {

		try {

			$connection = Database::connect();
			$query = $connection->prepare("SELECT * FROM officerpositions");
			$query->execute();
			$results = $query->fetchAll(PDO::FETCH_ASSOC);
			Database::disconnect();

		} catch(PDOException $e) {
			echo $e->getMessage();
		}



		return $results;

	}
	

	function deletePosition($id) {

		try {

			$connection = Database::connect();
			$query = $connection->prepare("DELETE FROM officerpositions WHERE officer_position_id = :id");
			$query->bindParam(":id",$id,PDO::PARAM_INT);
			$query->execute();

			// deletes candidates associated with the deleted position
			$query = $connection->prepare("DELETE FROM officerpositions INNER JOIN candidates ON officerpositions.officer_position_id = candidates.officer_position_id WHERE officerpositions.officer_position_id = :id");
			$query->bindParam(":id",$id,PDO::PARAM_INT);
			$query->execute();
			Database::disconnect();

		} catch(PDOException $e) {
			echo $e->getMessage();
		}

	}

	////////////////


	// add a voter/student
	function addVoter($id, $firstName, $lastName) {

		try {

			$connection = Database::connect();
			$query = $connection->prepare("INSERT INTO users VALUES(:id,:firstName,:lastName,1,0)");
			$query->bindParam(":id",$id,PDO::PARAM_INT);
			$query->bindParam(":firstName",$firstName,PDO::PARAM_STR);
			$query->bindParam(":lastName",$lastName,PDO::PARAM_STR);
			$query->execute();
			Database::disconnect();

		} catch(PDOException $e) {
			echo $e->getMessage();
			exit;
		}

	}

	// add an election
	function addElection($electionTitle, $startDate, $endDate) {

		try {

			$connection = Database::connect();
			$query = $connection->prepare("INSERT INTO elections VALUES(NULL,:electionTitle,:startDate,:endDate)");
			$query->bindParam(":electionTitle",$electionTitle,PDO::PARAM_STR);
			$query->bindParam(":startDate",$startDate,PDO::PARAM_STR);
			$query->bindParam(":endDate",$endDate,PDO::PARAM_STR);
			$query->execute();
			Database::disconnect();

		} catch(PDOException $e) {
			echo $e->getMessage();
		}

	}

	// fetch all elections
	function getElections() {

		try {

			$connection = Database::connect();
			$query = $connection->prepare("SELECT * FROM elections ORDER BY start_date DESC");
			$query->execute();
			$results = $query->fetchAll(PDO::FETCH_ASSOC);
			Database::disconnect();

		} catch(PDOException $e) {
			echo $e->getMessage();
		}

		return $results;

	}

	/////////////////////////////////// ELECTION DETAILS ///////////////////////////////////////////

	// return a specific election
	function getElection($id) {

		try {

			$connection = Database::connect();
			$query = $connection->prepare("SELECT * FROM elections WHERE election_id = :id");
			$query->bindParam(":id",$id,PDO::PARAM_INT);
			$query->execute();
			$result = $query->fetch();
			Database::disconnect();


		} catch(PDOException $e) {
			echo $e->getMessage();
		}

		return $result;

	}


	function deleteElection($id) {


		try {

			$connection = Database::connect();
			$query = $connection->prepare("DELETE FROM elections WHERE election_id = :id");
			$query->bindParam(":id",$id,PDO::PARAM_INT);
			$query->execute();
			Database::disconnect();

		} catch(PDOexception $e) {
			echo $e->getMessage();
		}

	}



	// add candidate to this specific election

	function addCandidate($candidateName, $electionId, $positionName) {

		try {

			$connection = Database::connect();
			$query = $connection->prepare("INSERT INTO candidates VALUES(NULL,:candidate_name, :election_id, :position_id) ");
			$query->bindParam(":candidate_name",$candidateName,PDO::PARAM_STR);
			$query->bindParam(":election_id",$electionId,PDO::PARAM_INT);
			$query->bindParam(":position_id",$positionName,PDO::PARAM_INT);
			$query->execute();
			Database::disconnect();

		} catch(PDoexception $e) {

			echo $e->getMessage();

		}


	}


	// remove all candidates from an election

	function deleteCandidates($id) {

		try {

			$connection = Database::connect();
			$query = $connection->prepare("DELETE FROM candidates WHERE election_id = :id");
			$query->bindParam(":id",$id,PDO::PARAM_INT);
			$query->execute();
			Database::disconnect();

		} catch(PDOException $e) {
			echo $e->getMessage();
		}


	}

	// return candidates of a specific election
	function getCandidates($id) {

		try { 
			$connection = Database::connect();
			$query = $connection->prepare("SELECT candidate_name, position_name FROM candidates INNER JOIN elections ON candidates.election_id = elections.election_id INNER JOIN officerpositions ON candidates.officer_position_id = officerpositions.officer_position_id WHERE candidates.election_id = :id");
			$query->bindParam(":id",$id,PDO::PARAM_INT);
			$query->execute();
			$results = $query->fetchAll(PDO::FETCH_ASSOC);
			Database::disconnect();

		} catch(PDOException $e) {
			echo $e->getMessage();
		}

		return $results;

	}

	function getCandidatesForPosition($positionName,$electionId) {
		try {

			$connection = Database::connect();
			$query = $connection->prepare("SELECT candidate_id, candidate_name FROM candidates INNER JOIN elections ON candidates.election_id = elections.election_id INNER JOIN officerpositions ON candidates.officer_position_id = officerpositions.officer_position_id WHERE elections.election_id = :electionId AND officerpositions.position_name = :positionName");
			$query->bindParam(":electionId",$electionId,PDO::PARAM_INT);
			$query->bindParam(":positionName",$positionName,PDO::PARAM_STR);
			$query->execute();
			$results = $query->fetchAll(PDO::FETCH_ASSOC);
			Database::disconnect();


		} catch(PDOException $e) {
			echo $e->getMessage();
		}

		return $results;
	}


	// check for on going election


	function checkOngoingElection() {

		$dateToday = date('Y-m-d h:i:s');

		try {

			$connection = Database::connect();
			$query = $connection->prepare("SELECT * FROM elections WHERE :dateToday > start_date AND :dateToday < end_date");
			$query->bindParam(":dateToday",$dateToday,PDO::PARAM_STR);
			$query->execute();
			$result = $query->fetch();
			Database::disconnect();

		} catch(PDOException $e) {
			echo $e->getMessage();
		}

		return $result;
	}

	function castVote($candidate_id) {

		try {
			$connection = Database::connect();
			$query = $connection->prepare("INSERT INTO votes VALUES(null,:candidate_id)");
			$query->bindParam(":candidate_id",$candidate_id,PDO::PARAM_INT);
			$query->execute();
			Database::disconnect();

		} catch(PDOException $e) {
			echo $e->getMessage();
		}

	}


	function getCandidateVotes($positionName,$electionId) {

		try {

			$connection = Database::connect();
			$query = $connection->prepare("SELECT candidate_name, COUNT(*) as totalVotes FROM candidates INNER JOIN elections ON candidates.election_id = elections.election_id INNER JOIN officerpositions ON candidates.officer_position_id = officerpositions.officer_position_id INNER JOIN votes ON votes.candidate_id = candidates.candidate_id WHERE elections.election_id = :electionId AND officerpositions.position_name = :positionName GROUP BY candidate_name");
			$query->bindParam(":electionId",$electionId,PDO::PARAM_INT);
			$query->bindParam(":positionName",$positionName,PDO::PARAM_STR);
			$query->execute();
			$results = $query->fetchAll(PDO::FETCH_ASSOC);
			Database::disconnect();


		} catch(PDOException $e) {
			echo $e->getMessage();
		}

		return $results;
	}







?>