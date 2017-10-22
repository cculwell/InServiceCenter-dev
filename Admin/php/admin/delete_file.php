<?php
    // Delete a file from the database
    require "../../../resources/config.php";

    $id = (int) $_GET['id'];
    $table = $_GET['table'];

    $db = $config['db']['amsti_01'];
    $link = new mysqli($db['host'], $db['username'], $db['password'], $db['dbname']) or die('There was a problem connecting to the database.');

    $get_path_query = "SELECT * from $table WHERE id=$id";
    $get_path = $link->query($get_path_query) or die($link->error);

    // Delete file on the server
    $row = mysqli_fetch_array($get_path);
    $file_to_delete = $row['file_path'];

    if (file_exists($file_to_delete)) {
        if (unlink($file_to_delete)) {

            // Delete database reference after file deletion
            $query = "DELETE FROM $table WHERE id=$id LIMIT 1"; 
            if ($link->query($query) or die($link->error)) {
                echo "<script type='text/javascript'>alert('File deleted!')</script>";
            }
            else {
                echo "<script type='text/javascript'>alert('ERROR: The file reference was not deleted from the database.')</script>";
            }
        }
        else {
            echo "<script type='text/javascript'>alert('ERROR: The file was unable to be deleted.')</script>";
        }
    }
    else {
        // Delete database reference when file isn't stored locally anymore
        $query = "DELETE FROM $table WHERE id=$id LIMIT 1"; 
        if ($link->query($query) or die($link->error)) {
            echo "<script type='text/javascript'>alert('File was missing but the database reference has been removed.')</script>";
        }
    }

    $link->close();
    $url = "../../" . ucwords($table) . ".php";
    header('refresh: 0; URL=' . $url);
?>