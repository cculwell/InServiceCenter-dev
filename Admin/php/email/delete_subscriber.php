<?php
    // Delete a subscriber from the database
    require "../../../resources/config.php";

    $id = (int) $_GET['id'];

    $db = $config['db']['admin_files'];
    $link = new mysqli($db['host'], $db['username'], $db['password'], $db['dbname']) or die('There was a problem connecting to the database.');

    $query = "DELETE FROM subscribers WHERE id=$id LIMIT 1"; 
    if ($link->query($query) or die($link->error)) {
        echo "<script type='text/javascript'>alert('Subscriber deleted.')</script>";
    }
    else {
        echo "<script type='text/javascript'>alert('ERROR: There was an error removing the subscriber from the database.')</script>";
    }

    $link->close();
    header('refresh: 0; URL=../../Email.php');
?>