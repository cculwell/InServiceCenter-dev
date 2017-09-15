<?php
    require "admin_functions.php";

    $table = $_GET['table'];
    $type = $_GET['type'];
    $dir = $_GET['dir'];

    $uploaded_file = $_FILES[$type]["name"];

    $target = "../../Uploads/" . $dir . "/" . $uploaded_file;
    $file_type = pathinfo($uploaded_file, PATHINFO_EXTENSION);

    // Check that the user selected a file to upload
    if (empty($_FILES[$type]['name'])) {
        echo "<script type='text/javascript'>alert('Please select a file to upload.')</script>";
    }

    // Check if the file already exists
    elseif (check_if_file_exists($table, $uploaded_file))
    {         
        echo "<script type='text/javascript'>alert('File $uploaded_file already exists. Please rename the file and try again.')</script>";
    }

    // Allow only PDF file formats
    elseif($file_type != "pdf") {
        echo "<script type='text/javascript'>alert('Only PDF files are able to be uploaded.')</script>";
    }

    // Try to upload the file
    elseif (move_uploaded_file($_FILES[$type]["tmp_name"], $target)) {

        if (add_file_to_database($table, $uploaded_file, $target)) {
            echo "<script type='text/javascript'>alert('$uploaded_file was successfully uploaded')</script>";
        }
        else
        {
            echo "<script type='text/javascript'>alert('$uploaded_file was NOT uploaded successfully')</script>";
        }
    }
    else {
        echo "<script type='text/javascript'>alert('$uploaded_file was NOT uploaded successfully')</script>";
    }
    
    header('refresh: 0; URL=../Admin.php');
?>