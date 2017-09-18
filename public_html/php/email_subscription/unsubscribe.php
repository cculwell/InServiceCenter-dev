<?php
    // Unsubscribe from the newsletter
    require "../../../resources/config.php";

    $email = $_POST['email'];

    $db = $config['db']['admin_files'];
    $link = new mysqli($db['host'], $db['username'], $db['password'], $db['dbname']) or die('There was a problem connecting to the database.');

    // Check if the email is in the database
    $check_query = "SELECT email FROM subscribers WHERE email='$email'";
    $check_result = $link->query($check_query) or die("Error : ".mysqli_error($link)); 

    if (mysqli_num_rows($check_result) != 0) {

        $query = "DELETE FROM subscribers WHERE email='$email' LIMIT 1"; 
        if ($link->query($query) or die($link->error)) {
            echo "<script type='text/javascript'>alert('You have been unsubscribed.')</script>";
        }
        else {
            echo "<script type='text/javascript'>alert('ERROR: There was a problem unsubscribing from the newsletter. Try again or contact the administrator.')</script>";
        }
    }
    else {
        echo "<script type='text/javascript'>alert('This E-mail is not subscribed to the newsletter. Check the spelling and try again.')</script>";
    }

    $link->close();
    header('refresh: 0; URL=../../ProDevel.html');
?>