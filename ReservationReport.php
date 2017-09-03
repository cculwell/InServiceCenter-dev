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
$sql = "SELECT * FROM tblReservationRequest";
$result = $conn->query($sql);

//Output the html
if ($result->num_rows > 0) {
   echo "<html>\r\n";
   echo "   <head>\r\n";
   echo "      <title>Reservation Request Report</title>\r\n";
   echo "      <link rel='stylesheet' href='Report.css' />\r\n";
   echo "   </head>\r\n"; 
   echo "   <body>\r\n";
   echo "      <div id = 'toplogo'>\r\n";
   echo "         <img src='public_html/img/Logo.jpg' alt ='AthensLogo'>\r\n";
   echo "      </div>\r\n";  
   echo "      <table id='tblReport'>\r\n";
   echo "            <tr>\r\n";
   echo "               <th>Program</th>\r\n";
   echo "               <th>Sponsors</th>\r\n";
   echo "               <th>Event Description</th>\r\n";
   echo "               <th>Primary</th>\r\n";
   echo "               <th>Phone</th>\r\n";
   echo "               <th>Email</th>\r\n";
   echo "               <th>From Date</th>\r\n";
   echo "               <th>To Date</th>\r\n";
   echo "               <th>Start Time</th>\r\n";
   echo "               <th>End Time</th>\r\n";
   echo "               <th>Setup Time</th>\r\n";
   echo "               <th>Attendees</th>\r\n";
   echo "               <th>Smartboard</th>\r\n";
   echo "               <th>Projector</th>\r\n";
   echo "               <th>Camera</th>\r\n";
   echo "               <th>Ext Cords</th>\r\n";
   echo "               <th>Tech</th>\r\n";
   echo "            </tr>\r\n";
   echo "         <tbody>\r\n";

   while($row = $result->fetch_assoc()) {     
         echo "            <tr>\r\n";
         echo "               <td>" . $row["vcProgram"] . "</td>\r\n";
         echo "               <td>" . $row["vcSponsors"] . "</td>\r\n";
         echo "               <td>" . $row["vcEventDesc"] . "</td>\r\n";
         echo "               <td>" . $row["vcPrimary"] . "</td>\r\n";
         echo "               <td>" . $row["vcPhone"] . "</td>\r\n";
         echo "               <td>" . $row["vcEmail"] . "</td>\r\n";
         echo "               <td>" . FormatDate4Report($row["dtFromDate"]) . "</td>\r\n";
         echo "               <td>" . FormatDate4Report($row["dtToDate"]) . "</td>\r\n";
         echo "               <td>" . FormatTime4Report($row["dtStartTime"]) . "</td>\r\n";
         echo "               <td>" . FormatTime4Report($row["dtEndTime"]) . "</td>\r\n";
         echo "               <td>" . FormatTime4Report($row["dSetupTime"]) . "</td>\r\n";
         echo "               <td>" . $row["iAttendees"] . "</td>\r\n";
         echo "               <td>" . $row["bSmartboard"] . "</td>\r\n";
         echo "               <td>" . $row["bProjector"] . "</td>\r\n";
         echo "               <td>" . $row["bCamera"] . "</td>\r\n";
         echo "               <td>" . $row["bExtCords"] . "</td>\r\n";
         echo "               <td>" . $row["bTech"] . "</td>\r\n";
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