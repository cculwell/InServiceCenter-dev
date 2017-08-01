<?php
require "Common.php";

$date02 = "0000-00-00";

$parseDate = explode(",", $_GET['dates']);
$date01 = FormatDate4Db($parseDate[0]);

if (count($parseDate) > 1)
{
   $date02 =  FormatDate4Db($parseDate[1]);
}

$time02 = "00:00 AM";

$parseTime = explode(",", $_GET['times']);
$time01 = FormatTime4Db($parseTime[0]);

if (count($parseTime) > 1)
{
   $time02 =  FormatTime4Db($parseTime[1]);
}

$conn = new mysqli("myathensricorg.ipowermysql.com", "amsti_01", "Capstone@17", "amsti_01");   
if ($conn -> connect_error) { die("Connection failed: " . $conn->connect_error); } 

$sql = "INSERT INTO tblBookStudyRequest (vcSchool, vcSystem, vcTitle, vcPublisher, fCost, vcISBN, fTotalAmt, vcNeedArea, vcTargetPartic, iEnrolled, vcLocation, iTotalHours, dtDate01, dtDate02, dtTime01, dtTime02, vcFormat, vcFacilitator, vcContact, vcPhone, vcEmail, vcSTIPD)
VALUES ('" . 
$_GET['school'] . "', '" .
$_GET['system'] . "', '" .
$_GET['booktitle'] . "', '" .
$_GET['publisher'] . "', " .
$_GET['cost'] . ", '"  .
$_GET['isbn'] . "', " .
$_GET['amtrequested'] . ", '" .
$_GET['needarea'] . "', '".
$_GET['targetparticipant'] . "', " .
$_GET['numberenrolled'] . ", '" .
$_GET['location'] . "', " .
$_GET['totalhours'] . ", '" .
$date01 . "', '" .
$date02 . "', '" .
$time01 . "', '" .
$time02 . "', '" .
$_GET['formatstudy'] . "', '" .
$_GET['facilitator'] . "', '" .
$_GET['contactperson'] . "', '" .
$_GET['Phone'] . "', '" .
$_GET['email'] . "', '" .
$_GET['icentermanage'] . "')";

if ($conn->query($sql) === TRUE) {
   $to = "Holly.Wood@athens.edu";
   $subject = "Book Study Request";
   $txt = "School: " . $_GET['school'] . "\r\n" . 
      "System: " . $_GET['system'] . "\r\n" . 
      "Book Title: " . $_GET['booktitle'] . "\r\n" . 
      "Publisher: " . $_GET['publisher'] . "\r\n" . 
      "Cost Per Book: " . $_GET['cost'] . "\r\n" . 
      "ISBN: " . $_GET['isbn'] . "\r\n" .
      "Total Amount: " . $_GET['amtrequested'] . "\r\n" .
      "Need Area: " . $_GET['needarea'] . "\r\n" .
      "Target Participant: " . $_GET['targetparticipant'] . "\r\n" .
      "# Enrolled: " . $_GET['numberenrolled'] . "\r\n" .
      "Location: " . $_GET['location'] . "\r\n" .
      "Total Hours: " . $_GET['totalhours'] . "\r\n" .
      "Dates: " . $_GET['dates'] . "\r\n" .
      "Times: " . $_GET['times'] . "\r\n" .
      "Format: " . $_GET['formatstudy'] . "\r\n" .
      "Facilitator: " . $_GET['facilitator'] . "\r\n" .
      "Contact Person: " . $_GET['contactperson'] . "\r\n" .
      "Phone #: " . $_GET['Phone'] . "\r\n" .
      "Email: " . $_GET['email'] . "\r\n" .
      "In-Service Center Manage STI-PD: " . $_GET['icentermanage'];
   $headers = "From: webmaster@myathensric.org";

   mail($to,$subject,$txt,$headers);

    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>