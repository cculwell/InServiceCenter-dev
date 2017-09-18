<?php
	// Subscribe to the newsletter

    require "../../../resources/config.php";

    $email = $_POST['email'];

    $db = $config['db']['admin_files'];
    $link = new mysqli($db['host'], $db['username'], $db['password'], $db['dbname']) or die('There was a problem connecting to the database.');

    // Check if user is already subscribed
    $check_query = "SELECT email FROM subscribers WHERE email='$email'";
    $check_result = $link->query($check_query) or die("Error : ".mysqli_error($link)); 

    if (mysqli_num_rows($check_result) == 0) {
	    $query = "INSERT INTO subscribers (email) VALUES ('$email')";
	    $result = $link->query($query) or die("Error : ".mysqli_error($link)); 

	    if ($result) {
	    	echo "<script type='text/javascript'>alert('You have been ssubscribed!')</script>"; 
	    }
	    else {
	    	echo "<script type='text/javascript'>alert('ERROR: There was a probel subscribing. Please try again or contact the administrator.')</script>";
	    }
    }
    else {
    	echo "<script type='text/javascript'>alert('This E-mail is already subscribed to the newsletter.')</script>";
	}

    $link->close();
    header('refresh: 0; URL=../../ProDevel.html');
?>