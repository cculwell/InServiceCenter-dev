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
$sql = "SELECT * FROM tblWorkshopRequest";
$result = $conn->query($sql);

//Output the html
if ($result->num_rows > 0) {
?> 
<html>
   <head>
      <title>Workshop Request Report</title>
      <link rel='stylesheet' href='Report.css' />
   </head>
   <body>
      <div id = 'toplogo'>
         <img src='public_html/img/Logo.jpg' alt ='AthensLogo'>
      </div>
      <table id='tblReport'>
         <tr>
           <th>Program</th>
            <th>PD Title</th>
            <th>PD Desc</th>
            <th>Standards</th>
            <th>Location</th>
            <th>Date From</th>
            <th>Date To</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Total Hours</th>
            <th>Participants</th>
            <th>Target</th>
            <th>Systems</th>
            <th>Consultants</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Fee</th>
            <th>Contact</th>
            <th>Contact Email</th>
            <th>Other Info</th>
            <th>STIPD ?</th>
            <th>Travel ?</th>
            <th>Room Form</th>
            <th>STIPD #</th>
            <th>Folder</th>
         </tr>
<?php
   while($row = $result->fetch_assoc()) {
         echo "         <tr>\r\n";
         echo "            <td>" . $row["iProgram"] . "</td>\r\n";
         echo "            <td>" . $row["vcPDTitle"] . "</td>\r\n";
         echo "            <td>" . $row["vcPDDesc"] . "</td>\r\n";
         echo "            <td>" . $row["vcStandards"] . "</td>\r\n";
         echo "            <td>" . $row["vcLocation"] . "</td>\r\n";
         echo "            <td>" . FormatDate4Report($row["dtDateFrom"]) . "</td>\r\n";
         echo "            <td>" . FormatDate4Report($row["dtDateTo"]) . "</td>\r\n";
         echo "            <td>" . FormatTime4Report($row["dtStartTime"]) . "</td>\r\n";
         echo "            <td>" . FormatTime4Report($row["dtEndTime"]) . "</td>\r\n";
         echo "            <td>" . $row["intTotalHours"] . "</td>\r\n";
         echo "            <td>" . $row["intParticipants"] . "</td>\r\n";
         echo "            <td>" . $row["vcTarget"] . "</td>\r\n";
         echo "            <td>" . $row["vcSystems"] . "</td>\r\n";
         echo "            <td>" . $row["vcConsultants"] . "</td>\r\n";
         echo "            <td>" . $row["vcAddress"] . "</td>\r\n";
         echo "            <td>" . $row["vcPhone"] . "</td>\r\n";
         echo "            <td>" . $row["vcEmail"] . "</td>\r\n";
         echo "            <td>" . $row["fFee"] . "</td>\r\n";
         echo "            <td>" . $row["vcContact"] . "</td>\r\n";
         echo "            <td>" . $row["vcContactEmail"] . "</td>\r\n";
         echo "            <td>" . $row["vcOtherInfo"] . "</td>\r\n";
         echo "            <td>" . $row["bSTIPD"] . "</td>\r\n";
         echo "            <td>" . $row["bTravel"] . "</td>\r\n";
         echo "            <td>" . $row["vcRoomForm"] . "</td>\r\n";
         echo "            <td>" . $row["vcSTIPDNumber"] . "</td>\r\n";
         echo "            <td>" . $row["vcFolder"] . "</td>\r\n";
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