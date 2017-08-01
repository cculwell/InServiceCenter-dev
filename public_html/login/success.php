<?php
/* Displays all successful messages */
session_start();
ob_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Success</title>
  <?php include 'css/css.html'; ?>
</head>
<body>
<div class="form">
    <h1><?= 'Success'; ?></h1>
    
    <p id="p-login-page">
    <?php 
    if( isset($_SESSION['message']) AND !empty($_SESSION['message']) ):
        echo $_SESSION['message'];    
    else:
        header( "location: index.php" );
    endif;
    ?>
    </p>
    <a id="aloginindex" href="http://myathensric.org/Home.html"><button class="button-block">Home</button></a>
</div>
</body>
</html>
