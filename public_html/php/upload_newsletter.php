<?php
session_start();
define ('SITE_ROOT', realpath(dirname(__FILE__) . "/../"));

$uploaded_file = $_FILES["newsletter_to_upload"]["name"];
$save_as_this = "current-newsletter.pdf";
$target = SITE_ROOT . "/Uploads/Newsletter/" . $save_as_this;
$file_type = pathinfo($uploaded_file, PATHINFO_EXTENSION);
$error = 0;


// Check that the user selected a file to upload
if (empty($_FILES['newsletter_to_upload']['name'])) {
    $_SESSION['uploaded_success'] = 'empty';
    header("Location: ../ProDevel.html");  
}


// Allow only PDF file formats
if($file_type != "pdf") {
    $error = 1;
}

if (!$error) {
    // Try to upload
    if (move_uploaded_file($_FILES["newsletter_to_upload"]["tmp_name"], $target)) {
        $_SESSION['upload_success'] = $uploaded_file . "was uploaded successfully!";
        header("Location: ../ProDevel.html");
        exit;
    }
    else {
        $error = 1;
    }
}

// Fail if not successful
if ($error) {
    $_SESSION['upload_success'] = "ERROR: " . $uploaded_file . "failed to load.";
    header("Location: ../ProDevel.html");
    exit;
}

?>