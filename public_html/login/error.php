<?php
/* Displays all error messages */
session_start();
ob_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Error</title>
  <?php include 'css/css.html'; ?>
</head>
<body id="login-page">
<div class="form">
    <h1>Error</h1>
    <p id="p-login-page">
    <?php 
    if( isset($_SESSION['message']) AND !empty($_SESSION['message']) ): 
        echo $_SESSION['message'];    
    else:
        header( "location: index.php" );
    endif;
    ?>
    </p>     
    <a id="aloginindex" href="index.php"><button class="button-block">Back to Login</button></a>
</div>
</body>
</html>
