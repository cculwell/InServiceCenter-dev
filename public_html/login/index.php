<?php 
/* Main page with two forms: sign up and log in */
require 'db.php';
session_start();
ob_start();
?>

<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    if (isset($_POST['login'])) { //user logging in

        require 'login.php';
    }
    
    elseif (isset($_POST['register'])) { //user registering
        
        require 'register.php';
    }
}
?>
<!DOCTYPE html>
<html class="no-js" lang="en" dir="ltr">
    <head>
        <?php include 'css/css.html';
      //  include 'top-bar-nav.html';
        ?>
       <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign-Up/Login Form</title>

    <link href="https://fonts.googleapis.com/css?family=Allura" rel="stylesheet">
    <link rel="stylesheet" href="http://myathensric.org/Home_Data/foundation.css"> 
      
   
</head>

<body id="login-page">

  <div class="form">
      
      <ul class="tab-group">
       <li class="tab"><a id="aloginindex" href="#signup">New Account</a></li>
        <li class="tab active"><a id="aloginindex" href="#login">Log In</a></li>
      </ul>
      
      <div class="tab-content">

         <div id="login">   
          <h1 id="h1loginindex">Welcome Back!</h1>
          
          <form action="index.php" method="post" autocomplete="off">
          
            <div class="field-wrap">
            <label class="label-login">
              Email Address<span class="req">*</span>
            </label>
            <input type="email" required autocomplete="off" name="email"/>
          </div>
          
          <div class="field-wrap">
            <label class="label-login">
              Password<span class="req">*</span>
            </label>
            <input type="password" required autocomplete="off" name="password"/>
          </div>
          
          <p class="forgot"><a id="aloginindex" href="forgot.php">Forgot Password?</a></p>
          
          <button class="button-block" name="login">Log In</button>
          
          </form>

        </div>
          
        <div id="signup">   
          <h1 id="h1loginindex">New Account</h1>
          
          <form action="index.php" method="post" autocomplete="off">
          
          <div class="top-row">
            <div class="field-wrap">
              <label class="label-login">
                First Name<span class="req">*</span>
              </label>
              <input type="text" required autocomplete="off" name='firstname' />
            </div>
        
            <div class="field-wrap">
              <label class="label-login">
                Last Name<span class="req">*</span>
              </label>
              <input type="text"required autocomplete="off" name='lastname' />
            </div>
          </div>

          <div class="field-wrap">
            <label class="label-login">
              Email Address<span class="req">*</span>
            </label>
            <input type="email"required autocomplete="off" name='email' />
          </div>
          
          <div class="field-wrap">
            <label class="label-login">
              Password<span class="req">*</span>
            </label>
            <input type="password"required autocomplete="off" name='password'/>
          </div>
          
          <button type="submit" class="button-block" name="register">Register</button>
          
          </form>

        </div>  
    
     <!-- tab-content -->
  
 <!-- /form -->
    </div>
    </div>
        
   
         <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
        <script src="http://dhbhdrzi4tiry.cloudfront.net/cdn/sites/foundation.js"></script>
           <script>
            $(document).foundation();
          

        </script>
     <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="http://myathensric.org/login/js/index.js"></script>
</body>
</html>
