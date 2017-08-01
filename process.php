<?php
//require 'loginext.php';

$user = 'root';
$pass = '';
$db = 'accounts';
$mysqli = new mysqli('localhost',$user,$pass,$db) or die("cant connect to database");
?>

    <?php

    $email = $_POST['email'];
    $pass = $_POST['pass'];
    
    if  ($email && $pass){
        $result = $mysqli->query("SELECT * FROM users WHERE email='$email'");
        if($result->num_rows!=0){
            $row = $result->fetch_assoc();
            $db_user = $row['email'];
            $db_pass = $row['pass'];
            
            if($email == $db_user && $pass == $db_pass){
                echo '<p><b>Good</b></p>';
            }else{
                echo '<p>Username and password not match</p>';
            }
        }else{echo ' username not in the database';
            }
    }else{echo 'username is empty';
        }
    


?>

        <!--
//session_start();


//$email = $mysqli->escape_string($_POST['email']);


/*
$host = 'myathensricorg.ipowermysql.com';
$user = 'accounts';
$pass = 'password';
$db = 'accounts';
$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);
*/
 //$result = $mysqli->query("SELECT * FROM users WHERE email='$email'");





//mysql_select_db(accounts); 


//$result = $mysqli->query("SELECT * FROM users WHERE email='$username'");



//$row = $result->fetch_assoc();
/*
if ($row['email'] == $username && $row['password']==$password){
    echo"Login Success".$row['email'];
     $_SESSION['email'];
}
else{
    echo "Failed to login";
   
}
/*
 if ( password_verify($_POST['password'], $user['password']) ) {
        
        $_SESSION['email'] = $user['email'];
       
        echo "Login success Welcome" .$user['first_name'];
 }
else{
    echo "Failed to login";
}
*/

/*
$result = mysql_query("SELECT * FROM users WHERE email='$username'")
 or die ("failed" .mysql_error());

$row = mysql_fetch_array($result);

if ($row['email'] == $username && $row['pass']==$password){
    echo"Login Success".$row['username'];
}
else{
    echo "Failed to login";
}
*/
-->
