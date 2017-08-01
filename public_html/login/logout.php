<?php
/* Log out process, unsets and destroys session variables */
session_start();
ob_start();
session_unset();
session_destroy(); 
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Error</title>
  <?php include 'css/css.html'; ?>
</head>

<body id="login-page">
    <div class="form">
          <h1 id="h1loginindex">GoodBye</h1>
              
          <p id=p-login-page><?= 'You have been logged out!'; ?></p>
          
          <a id="aloginindex" href="http://myathensric.org/Home.html"><button class="button button-block">Home</button></a>

    </div>
</body>
</html>
