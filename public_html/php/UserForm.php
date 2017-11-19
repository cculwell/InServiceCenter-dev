<!DOCTYPE html>
<html class="no-js" lang="en" dir="ltr">

<head>
    <title>Users</title>   
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
	?>
</head>
<body>		
		<a href='AddEditUser.php'><h3>Add a new user</h1></a>
		
		<?php	
		//$sql = "INSERT INTO users (first_name, last_name, user_email, user_password, user_status) VALUES ('Superlongname', 'Anevenlongerlastname', 'reallyreallyreallylongemailaddress@fake.com', 'shortpassword', 'User')";
		$sql = "SELECT * FROM users ORDER BY last_name";
		if ($result = mysqli_query($mysqli, $sql))
		{
			if ($result->num_rows > 0)
			{
				echo "<table border='1' cellpadding='15'>";
				echo "<tr><th>Last Name</th><th>First Name</th><th>Email</th><th>Password</th><th>Status</th><th>Edit user</th><th>Delete user</th></tr>";
				while ($row=mysqli_fetch_row($result))
				{
					echo
						"<tr>"
							."<td>".$row[2]."</td>"
							."<td>".$row[1]."</td>"
							."<td>".$row[3]."</td>"
							."<td>".$row[4]."</td>"
							."<td>".$row[5]."</td>"
							."<td><a href='AddEditUser.php?id=" . $row[0] . "'>Edit</a></td>"
							."<td><a href='DeleteUser.php?id=" . $row[0] . "'>Delete</a></td>"
						."</tr>";
				}
				// Free result set
				mysqli_free_result($result);
			}
			else
			{
				echo "No users to display.";
			}
		}
		else
		{
			echo "Error: " . $mysqli_error;
		}
		$mysqli->close();
		?>
</body>
</html>