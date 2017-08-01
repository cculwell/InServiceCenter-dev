<?php

require "Common.php";

$conn = new mysqli("myathensricorg.ipowermysql.com", "amsti_01", "Capstone@17", "amsti_01");   
if ($conn -> connect_error) { die("Connection failed: " . $conn->connect_error); } 

$sql = "INSERT INTO tblWorkshopRequest (iProgram, vcPDTitle, vcPDDesc, vcStandards, vcLocation, dtDateFrom, dtDateTo, dtStartTime, dtEndTime, intTotalHours, intParticipants, vcTarget, vcSystems, vcConsultants, vcAddress, vcPhone, vcEmail, fFee, vcContact, vcContactEmail, vcOtherInfo, bSTIPD, bTravel, vcRoomForm, vcSTIPDNumber, vcFolder)
VALUES (". 
$_GET['program'] . ", '" .
$_GET['title'] . "', '" .
$_GET['pddesc'] . "', '" .
$_GET['stdcvd'] . "', '" .
$_GET['location'] . "', '" .
date("Y-m-d", strtotime($_GET['requesteddatefrom'])) . "', '" .
date("Y-m-d", strtotime($_GET['requesteddateto'])) . "', '" .
FormatTime4Db($_GET['starttime']) . "', '" .
FormatTime4Db($_GET['endtime']) . "', " .
$_GET['totlhrs'] . ", " .
$_GET['attend'] . ", '" .
$_GET['targetgrp'] . "', '" .
$_GET['syssvd'] . "', '" .
$_GET['consultant'] . "', '" .
$_GET['address'] . "', '" .
$_GET['phone'] . "', '" .
$_GET['email'] . "', " .
$_GET['fee'] . ", '" .
$_GET['contact'] . "', '" .
$_GET['email2'] . "', '" .
$_GET['oifo'] . "', " .
(isset($_GET['placeyes']) ? 1: 0) . ", " .
(isset($_GET['travelyes']) ? 1: 0) . ", '" .
$_GET['roomreserve'] . "', " .
$_GET['stipdnum'] . ", '" .
$_GET['foldercomplete'] . "')";

if ($conn->query($sql) === TRUE) {
   $to = "Holly.Wood@athens.edu";
   $subject = "Workshop Request";
   $txt = "Program #: " . $_GET['program'] . "\r\n" . 
      "PD Title: " . $_GET['title'] . "\r\n" . 
      "PD Description: " . $_GET['pddesc'] . "\r\n" . 
      "Standards Covered: " . $_GET['stdcvd'] . "\r\n" . 
      "Location: " . $_GET['location'] . "\r\n" . 
      "Requested Date From: " . $_GET['requesteddatefrom'] . "\r\n" .
      "Requested Date To: " . $_GET['requesteddateto'] . "\r\n" .
      "Start Time: " . $_GET['starttime'] . "\r\n" .
      "End Time: " . $_GET['endtime'] . "\r\n" .
      "Total Hours: " . $_GET['totlhrs'] . "\r\n" .
      "Number of Participants: " . $_GET['attend'] . "\r\n" .
      "Target Group: " . $_GET['targetgrp'] . "\r\n" .
      "Systems/Schools Served: " . $_GET['syssvd'] . "\r\n" .
      "Consultants: " . $_GET['consultant'] . "\r\n" .
      "Address: " . $_GET['address'] . "\r\n" .
      "Phone #: " . $_GET['phone'] . "\r\n" .
      "Email: " . $_GET['email'] . "\r\n" .
      "Fee: " . $_GET['fee'] . "\r\n" .
      "Contact Person/Requestor: " . $_GET['contact'] . "\r\n" .
      "Contact Email: " . $_GET['email2'] . "\r\n" .
      "Other Information: " . $_GET['oifo'] . "\r\n" .
      "Place on STIPD?: " . (isset($_GET['placeyes']) ? 'Yes': 'No') . "\r\n" .
      "Travel required?: " . (isset($_GET['travelyes']) ? 'Yes': 'No') . "\r\n" .
      "Room Reservation Form Needed: " . $_GET['roomreserve'] . "\r\n" .
      "STIPD Title Number: " . $_GET['stipdnum'] . "\r\n" .
      "Folder Completed: " . $_GET['foldercomplete'] ;
   $headers = "From: webmaster@myathensric.org";

   mail($to,$subject,$txt,$headers);

    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
