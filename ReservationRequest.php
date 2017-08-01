<?php

require "Common.php";

$conn = new mysqli("myathensricorg.ipowermysql.com", "amsti_01", "Capstone@17", "amsti_01");   
if ($conn -> connect_error) { die("Connection failed: " . $conn->connect_error); } 

$sql = "INSERT INTO tblReservationRequest (vcProgram, vcSponsors, vcEventDesc, vcPrimary, vcPhone, vcEmail, dtFromDate, dtToDate, dtStartTime, dtEndTime, dtSetupTime, iAttendees, bSmartboard, bProjector, bCamera, bExtCords, bTech)
VALUES ('". 
$_GET['program'] . "', '" .
$_GET['sponsor'] . "', '" .
$_GET['evntdesc'] . "', '" .
$_GET['responsible'] . "', '" .
$_GET['phone'] . "', '" .
$_GET['email'] . "', '" .
date("Y-m-d", strtotime($_GET['requesteddatefrom'])) . "', '" .
date("Y-m-d", strtotime($_GET['requesteddateto'])) . "', '" .
FormatTime4Db($_GET['starttime']) . "', '" .
FormatTime4Db($_GET['endtime']) . "', '" .
FormatTime4Db($_GET['preeventsetup']) . "', " .
$_GET['attend'] . ", " .
(isset($_GET['Smartboard']) ? 1: 0) . ", " .
(isset($_GET['projector']) ? 1: 0) . ", " .
(isset($_GET['documentcamera']) ? 1: 0) . ", " .
(isset($_GET['extensioncords']) ? 1: 0) . ", " .
(isset($_GET['avsetup']) ? 1: 0) . ")";

if ($conn->query($sql) === TRUE) {
   $to = "Holly.Wood@athens.edu";
   $subject = "Reservation Request";
   $txt = "Program: " . $_GET['program'] . "\r\n" . 
      "Sponsoring Group(s): " . $_GET['sponsor'] . "\r\n" . 
      "Describe the Event: " . $_GET['evntdesc'] . "\r\n" . 
      "Primary Individual Responsible: " . $_GET['responsible'] . "\r\n" . 
      "Phone Number: " . $_GET['phone'] . "\r\n" . 
      "Email: " . $_GET['email'] . "\r\n" .
      "Requested Date From: " . $_GET['requesteddatefrom'] . "\r\n" .
      "Requested Date To: " . $_GET['requesteddateto'] . "\r\n" .
      "Start Time: " . $_GET['starttime'] . "\r\n" .
      "End Time: " . $_GET['endtime'] . "\r\n" .
      "Setup Time: " . $_GET['preeventsetup'] . "\r\n" .
      "Number of Attendees: " . $_GET['attend'] . "\r\n" .
      "Smartboard?: " . (isset($_GET['Smartboard']) ? 'Yes': 'No') . "\r\n" .
      "Projector?: " . (isset($_GET['projector']) ? 'Yes': 'No') . "\r\n" .
      "Camera?: " . (isset($_GET['documentcamera']) ? 'Yes': 'No') . "\r\n" .
      "Ext Cords?: " . (isset($_GET['extensioncords']) ? 'Yes': 'No') . "\r\n" .
      "Tech Needed?: " . (isset($_GET['avsetup']) ? 'Yes': 'No');
   $headers = "From: webmaster@myathensric.org";
   mail($to,$subject,$txt,$headers);

    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>