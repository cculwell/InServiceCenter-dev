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
$sql = "SELECT * FROM tblBookStudyRequest";
$result = $conn->query($sql);

//Output the html
if ($result->num_rows > 0) {
?> 
<html>
   <head>
      <title>Book Study Request Report</title>
      <link rel='stylesheet' href='Report.css' />
   </head>
   <body>
      <div id = 'toplogo'>
         <img src='public_html/img/Logo.jpg' alt ='AthensLogo'>
      </div>
      <table id='tblReport'>
         <tr>
           <th>School</th>
            <th>System</th>
            <th>Title</th>
            <th>Publisher</th>
            <th>Cost</th>
            <th>ISBN</th>
            <th>Total Amount</th>
            <th>Need Area</th>
            <th>Target</th>
            <th>Participants</th>
            <th>Location</th>
            <th>Hours</th>
            <th>Date 1</th>
            <th>Date 2</th>
            <th>Time 1</th>
            <th>Time 2</th>
            <th>Format</th>
            <th>Facilitator</th>
            <th>Contact</th>
            <th>Phone</th>
            <th>Email</th>
            <th>STIPD</th>
         </tr>
<?php
   while($row = $result->fetch_assoc()) {
         echo "         <tr>\r\n";
         echo "            <td>" . $row["vcSchool"] . "</td>\r\n";
         echo "            <td>" . $row["vcSystem"] . "</td>\r\n";
         echo "            <td>" . $row["vcTitle"] . "</td>\r\n";
         echo "            <td>" . $row["vcPublisher"] . "</td>\r\n";
         echo "            <td>" . $row["fCost"] . "</td>\r\n";
         echo "            <td>" . $row["vcISBN"] . "</td>\r\n";
         echo "            <td>" . $row["fTotalAmt"] . "</td>\r\n";
         echo "            <td>" . $row["vcNeedArea"] . "</td>\r\n";
         echo "            <td>" . $row["vcTargetPartic"] . "</td>\r\n";
         echo "            <td>" . $row["iEnrolled"] . "</td>\r\n";
         echo "            <td>" . $row["vcLocation"] . "</td>\r\n";
         echo "            <td>" . $row["iTotalHours"] . "</td>\r\n";
         echo "            <td>" . FormatDate4Report($row["dtDate01"]) . "</td>\r\n";
         echo "            <td>" . FormatDate4Report($row["dtDate02"]) . "</td>\r\n";
         echo "            <td>" . FormatTime4Report($row["dtTime01"]) . "</td>\r\n";
         echo "            <td>" . FormatTime4Report($row["dtTime02"]) . "</td>\r\n";
         echo "            <td>" . $row["vcFormat"] . "</td>\r\n";
         echo "            <td>" . $row["vcFacilitator"] . "</td>\r\n";
         echo "            <td>" . $row["vcContact"] . "</td>\r\n";
         echo "            <td>" . $row["vcPhone"] . "</td>\r\n";
         echo "            <td>" . $row["vcEmail"] . "</td>\r\n";
         echo "            <td>" . $row["vcSTIPD"] . "</td>\r\n";
         echo "         </tr>\r\n";
    }
?>
      </tbody>
   </table>
</html>

<?php
}
else
{
   echo "No records found.";
}

$conn->close();
?> 