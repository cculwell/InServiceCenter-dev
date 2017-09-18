<?php
    // View the current newsletter
    require "../../resources/config.php";

    $table = $_GET['table'];
    $page = $_GET['page'];

    $db = $config['db']['admin_files'];
    $link = new mysqli($db['host'], $db['username'], $db['password'], $db['dbname']) or die('There was a problem connecting to the database.');

    // Get the viewable file
    $query = "SELECT file_path FROM $table WHERE current='yes'";
    $result = $link->query($query) or die("Error : ".mysqli_error($link));

    if ($result) {

        $row = mysqli_fetch_array($result);
        $path = $row['file_path'];
        $reg = '/'.preg_quote("../", '/').'/';
        $path = preg_replace($reg, "", $path, 1);

        // Get the file's mime type to send the correct content type header
        if (file_exists($path)) {

            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime_type = finfo_file($finfo, $path);

            // send the headers
            header("Content-Type: $mime_type");
            header('Content-Length: ' . filesize($path));

            // Stream the file
            $fp = fopen($path, 'rb');
            fpassthru($fp);  
        }
        else {
            echo "<script type='text/javascript'>alert('ERROR: There was a problem opening the current newsletter. The file might have been removed.')</script>";
        }
 
    }
    else {
        echo "<script type='text/javascript'>alert('ERROR: There was an issue querying the database for the $table')</script>";
    }

    $url = "../" . $page . ".html";
    header('refresh: 0; URL=' . $url);
?>