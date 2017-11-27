<!-- //Allows an admin to add or edit a user/admin from the database
<?php
	require "../../resources/config.php";
	# create connection to database
	$mysqli = new mysqli($config['db']['amsti_01']['host']
		, $config['db']['amsti_01']['username']
		, $config['db']['amsti_01']['password']
		, $config['db']['amsti_01']['dbname']);

	/* check connection */
	if ($mysqli->connect_errno) {
		printf("Connect failed: %s\n", $mysqli->connect_error);
		exit();
	}	
	
	if (isset($_GET['id']) && is_numeric($_GET['id']))
	{
		$id = $_GET['id'];
		
		if ($stmt = $mysqli->prepare("DELETE FROM users WHERE user_id = ? LIMIT 1"))
		{
			$stmt->bind_param("i", $id);
			$stmt->execute();
			$stmt->close();
		}
		else
		{
			echo "ERROR: could not prepare SQL statement";
		}
		$mysqli->close();
		header("Location: ../WorkQueue.php");
	}
	else
	{
		header("Location: ../WorkQueue.php");
	}
?>