<?php
	// Subscribe to the newsletter

    require "../../../resources/config.php";
    
    $email = $_POST['email'];

    $db = $config['db']['admin_files'];
    $link = new mysqli($db['host'], $db['username'], $db['password'], $db['dbname']) or die('There was a problem connecting to the database.');

    if ($email != "") {

        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {

            // Check if user is already subscribed
            $check_query = "SELECT email FROM subscribers WHERE email='$email'";
            $check_result = $link->query($check_query) or die("Error : ".mysqli_error($link)); 

            if (mysqli_num_rows($check_result) == 0) {
        	    $query = "INSERT INTO subscribers (email) VALUES ('$email')";
        	    $result = $link->query($query) or die("Error : ".mysqli_error($link)); 

        	    if ($result) {
        	    	echo "Successfully Subscribed!"; // Successfully subscribed
        	    }
        	    else {
                    echo "There was a problem subscribing. Please try again or contact the administrator."; // Error entering email into database
        	    }
            }
            else {
                echo "The E-mail address provided is already being used."; // Already subscribed
        	}
        }
        else {
            echo "Please enter a valid E-mail adress."; //Check that the email address is formatted correctly
        }
    }
    else {
        echo "Please provide an E-mail address."; // Empty email address
    }

    $link->close();
?>