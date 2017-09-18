<?php
    // Unsubscribe from the newsletter
    require "../../../resources/config.php";

    $email = $_POST['email'];

    $db = $config['db']['admin_files'];
    $link = new mysqli($db['host'], $db['username'], $db['password'], $db['dbname']) or die('There was a problem connecting to the database.');

    if ($email != "") {

        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {

            // Check if the email is in the database
            $check_query = "SELECT email FROM subscribers WHERE email='$email'";
            $check_result = $link->query($check_query) or die("Error : ".mysqli_error($link)); 

            if (mysqli_num_rows($check_result) != 0) {

                $query = "DELETE FROM subscribers WHERE email='$email' LIMIT 1"; 
                if ($link->query($query) or die($link->error)) {
                    echo "Successfully Unsubscribed!";
                }
                else {
                    echo "There was a problem unsubscribing. Please try again or contact the administrator.";
                }
            }
            else {
                echo "This E-mail is not subscribed to the newsletter. Check the spelling and try again.";
            }
        }
        else {
            echo "Please enter a valid E-mail address.";
        }
    }
    else {
        echo "Please enter an E-mail address.";
    }

    $link->close();
?>