<?php
    // Delete a file from the database
    require "../../../resources/config.php";

    $email = $_POST['email'];

    $db = $config['db']['admin_files'];
    $link = new mysqli($db['host'], $db['username'], $db['password'], $db['dbname']) or die('There was a problem connecting to the database.');

    // Delete subscriber's e-mail when requesting to unsubscribe
    $query = "DELETE FROM subscribers WHERE email='$email' LIMIT 1"; 
    if ($link->query($query) or die($link->error)) {
        echo "<script type='text/javascript'>alert('You have been unsubscribed.')</script>";
    }
    else {
        echo "<script type='text/javascript'>alert('ERROR: There was a problem unsubscribing from the newsletter. Try again or contact the administrator.')</script>";
    }

    $link->close();
    header('refresh: 0; URL=../../ProDevel.html');
?>