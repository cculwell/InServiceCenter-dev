<?php

include_once "../php/Common.php";
include_once "../../resources/config.php";

//$conn = new mysqli("myathensricorg.ipowermysql.com", "amsti_01", "Capstone@17", "amsti_01");

//Connect to the database
$conn = new mysqli($config['db']['amsti_01']['host']
    , $config['db']['amsti_01']['username']
    , $config['db']['amsti_01']['password']
    , $config['db']['amsti_01']['dbname']);
//Get Error
if ($conn -> connect_error) { die("Connection failed: " . $conn->connect_error); }


if(isset($_POST['program']) && isset($_POST['responsible']) && isset($_POST['sponsor'])&& isset($_POST['evntdesc'])
    && isset($_POST['room']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['attend'])
    && isset($_POST['accept']))
{
    $Program = $_POST['program'];
    $InCharge = $_POST['responsible'];
    $groupSponsor = $_POST['sponsor'];
    $Description = $_POST['evntdesc'];
    $RoomReservation = $_POST['room'];
    $Email = $_POST['email'];
    $PhoneNumber = $_POST['phone'];
    $BookedStatus = 'pending';
    $smartBoard = (isset($_POST['Smartboard']) ? 'Yes': 'No');
    $Projector = (isset($_POST['projector']) ? 'Yes': 'No');
    $ExtensionCord = (isset($_POST['extensioncords']) ? 'Yes': 'No');
    $DocumentCamera = (isset($_POST['documentcamera']) ? 'Yes' : 'No');
    $AV_Need = (isset($_POST['avsetup']) ? 'Yes': 'No');
    $NumberEvents = $_POST['attend'];

//Create Query to insert information for the event
    $sql_info = "INSERT INTO reservations (programName, programPerson,
                            programGroup, programDescription, room, email,
                            phone, bookedStatus, sm_board, ex_cord, projector,
                            document_camera, av_needs, num_events) " .
        "VALUES ('$Program', '$InCharge', '$groupSponsor', '$Description', '$RoomReservation', '$Email', '$PhoneNumber', 
'$BookedStatus', '$smartBoard', '$ExtensionCord', '$Projector',  '$DocumentCamera', '$AV_Need', '$NumberEvents')";

//Insert information to the table
    $result = $conn->query($sql_info);
    if($result == TRUE)
    {
        echo "New Record Created";
    }
    else{
        echo"Connection Error: " . $conn->error;
    }

//Get The primary key
    $ReservationID = $conn->insert_id;
//Using Rick's way of putting dynamic date and time in MySQL
    $index = 0;
    $reservationDatesAndTime = array();
    foreach ($_POST as $key)
    {
        if(preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $key))
        {
            $startDate = FormatDate4Db($_POST['requesteddatefrom' . $index]);
            $startTime = FormatTime4Db($_POST['starttime' . $index]);
            $endTime = FormatTime4Db($_POST['endtime' . $index]);
            $preTime = FormatTime4Db($_POST['preeventsetup' . $index]);
            $reservationDatesAndTime[$index] = "INSERT INTO reservationDate_Time (reservationID, StartDate, startTime,
                                    endTime, preTime)" .
                "VALUES('$ReservationID', '$startDate', '$startTime', '$endTime', '$preTime')";
            $result = $conn->query($reservationDatesAndTime[$index]);
            if($result == TRUE)
            {
                echo "<br> Day: $index successfuly inserted";
            }
            else
            {
                echo "<br> Day : $index hit a snag";
                exit;
            }
            $index++;
        }
    };

}


/*
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
   //$to = "Holly.Wood@athens.edu";
    $to = "jtwynn95@outlook.com";
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
*/
$conn->close();
?>