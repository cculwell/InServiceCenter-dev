<?php
/* Displays user information and some useful messages */
session_start();
ob_start();
// Check if user is logged in using the session variable
if ( $_SESSION['logged_in'] != 1 ) {
  $_SESSION['message'] = "You must log in before viewing this page!";
  header("location: login/error.php");    
}
else {
    // Makes it easier to read
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];
    $email = $_SESSION['email'];
    $active = $_SESSION['active'];
}
?>
<?php
require "Common.php";

//Connect to database
$conn = new mysqli("myathensricorg.ipowermysql.com", "amsti_01", "Capstone@17", "amsti_01");   
if ($conn -> connect_error) { die("Connection failed: " . $conn->connect_error); } 

//Return every row in the table
$sql = "SELECT * FROM tblGeneralRequest";
$result = $conn->query($sql);

//Output the html
if ($result->num_rows > 0) {
   echo "<html>\r\n";
   echo "   <head>\r\n";
   echo "      <title>General Request Report</title>\r\n";
   echo "      <link rel='stylesheet' href='Report.css' />\r\n";
   echo "   </head>\r\n"; 
   echo "   <body>\r\n";
   echo "      <div id = 'toplogo'>\r\n";
   echo "         <img src='public_html/img/Logo.jpg' alt ='AthensLogo'>\r\n";
   echo "      </div>\r\n";  
   echo "      <table id='tblReport'>\r\n";
   echo "         <tr>\r\n";
   echo "               <th>School</th>\r\n";
   echo "               <th>System</th>\r\n";
   echo "               <th>Request</th>\r\n";
   echo "               <th>Need Area</th>\r\n";
   echo "               <th>Date 1</th>\r\n";
   echo "               <th>Date 2</th>\r\n";
   echo "               <th>Time 1</th>\r\n";
   echo "               <th>Time 2</th>\r\n";
   echo "               <th>Location</th>\r\n";
   echo "               <th>Hours</th>\r\n";
   echo "               <th>Target</th>\r\n";
   echo "               <th>Participants</th>\r\n";
   echo "               <th>Eval Method</th>\r\n";
   echo "               <th>Company</th>\r\n";
   echo "               <th>Contact Info</th>\r\n";
   echo "               <th>Amount</th>\r\n";
   echo "               <th>Contact</th>\r\n";
   echo "               <th>Phone</th>\r\n";
   echo "               <th>Email</th>\r\n";
   echo "         </tr>\r\n";
   echo "         <tbody>\r\n";

   while($row = $result->fetch_assoc()) {      
         echo "            <tr>\r\n";
         echo "               <td>" . $row["vcSchool"] . "</td>\r\n";
         echo "               <td>" . $row["vcSystem"] . "</td>\r\n";
         echo "               <td>" . $row["vcRequest"] . "</td>\r\n";
         echo "               <td>" . $row["vcJustification"] . "</td>\r\n";
         echo "               <td>" . FormatDate4Report($row["dtDate01"]) . "</td>\r\n";
         echo "               <td>" . FormatDate4Report($row["dtDate02"]) . "</td>\r\n";
         echo "               <td>" . FormatTime4Report($row["dtTime01"]) . "</td>\r\n";
         echo "               <td>" . FormatTime4Report($row["dtTime02"]) . "</td>\r\n";
         echo "               <td>" . $row["vcLocation"] . "</td>\r\n";
         echo "               <td>" . $row["iTotalHours"] . "</td>\r\n";
         echo "               <td>" . $row["vcTargetPartic"] . "</td>\r\n";
         echo "               <td>" . $row["iNumPartic"] . "</td>\r\n";
         echo "               <td>" . $row["vcEvalMethod"] . "</td>\r\n";
         echo "               <td>" . $row["vcCompany"] . "</td>\r\n";
         echo "               <td>" . $row["vcContactInfo"] . "</td>\r\n";
         echo "               <td>" . $row["fAmount"] . "</td>\r\n";
         echo "               <td>" . $row["vcContact"] . "</td>\r\n";
         echo "               <td>" . $row["vcPhone"] . "</td>\r\n";
         echo "               <td>" . $row["vcEmail"] . "</td>\r\n";
         echo "            </tr>\r\n";
    }

   echo "         </tbody>\r\n";
   echo "      </table>\r\n";
   echo "   </body>\r\n";
   echo "</html>";
}
else
{
   echo "No records found.";
}

$conn->close();
?> 