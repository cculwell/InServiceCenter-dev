<?php
/**
 * Created by PhpStorm.
 * User: jtwyn
 * Date: 10/29/2017
 * Time: 11:58 AM
 */

include_once "Common.php";
require "../../resources/library/PHPMailer/src/PHPMailer.php";
require "../../resources/library/PHPMailer/src/Exception.php";


$conn = new mysqli($config['db']['amsti_01']['host']
    , $config['db']['amsti_01']['username']
    , $config['db']['amsti_01']['password']
    , $config['db']['amsti_01']['dbname']);
//If reservation was canceled from admin page
if(isset($_POST['DeleteEvent']) && isset($_POST['ReservationID']))
{
    $ReservationID = mysql_fixstring($conn, $_POST['ReservationID']);
    //This query will delete the dates and time before deleting the information
    $cancel_Query = "UPDATE reservations SET bookedStatus= 'canceled' WHERE reservationID = '" . $ReservationID . "'";
    $result = $conn->query($cancel_Query);
/*
    $GetData_Query = "Select programName, email, room from reservations where reservationID = '$ReservationID'";
    $result = $conn->query($GetData_Query);
    $row=mysqli_fetch_row($result);
    $Program = $row[0];
    $Email = $row[1];
    $Room = $row[2];

    mysqli_free_result($result);

    //The Automated Acceptance Letter For User
     $mail = new PHPMailer();
     $Mail_Body = "<p>Your request to reserve space through the Athens State In-</p>
                   <p>Service Center cannot be accommodated at this time We are</p>
                   <p>sorry that we do not have the resources available to serve your</p>
                   <p>needs. We hope to be able to do so in the future</p><br><hr>
                   <p>If you have any questions, please email holly.wood@athens.edu</p>";

    $mail->addAddress($Email);
    $mail->isHTML(true);

    $mail->Subject = $Program . ': Reservation' ;
    $mail->Body = $Mail_Body;

 //From email address and name
     $mail->From = "inserviceathens@gmail.com";
     $mail->FromName = "Inservice Athens Reservation";

    if(!$mail->send())
    {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
    else
    {
        echo "Message has been sent successfully";
    }
*/
 }

//Book Request
 elseif(isset($_POST['program']) && isset($_POST['responsible']) && isset($_POST['sponsor']) && isset($_POST['evntdesc']) &&
        isset($_POST['room'])&& isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['attend'])) {
     //If not delete then update the event to booked
     $ReservationID = mysql_fixstring($conn, $_POST['ReservationID']);
     $Program = mysql_fixstring($conn, $_POST['program']);
     $InCharge = mysql_fixstring($conn, $_POST['responsible']);
     $groupSponsor = mysql_fixstring($conn, $_POST['sponsor']);
     $Description = mysql_fixstring($conn, $_POST['evntdesc']);
     $RoomReservation = mysql_fixstring($conn, $_POST['room']);
     $Email = mysql_fixstring($conn, $_POST['email']);
     $PhoneNumber = mysql_fixstring($conn, $_POST['phone']);
     $BookedStatus = 'booked';
     $smartBoard = (isset($_POST['Smartboard']) ? 'Yes' : 'No');
     $Projector = (isset($_POST['projector']) ? 'Yes' : 'No');
     $ExtensionCord = (isset($_POST['extensioncords']) ? 'Yes' : 'No');
     $DocumentCamera = (isset($_POST['documentcamera']) ? 'Yes' : 'No');
     $AV_Need = (isset($_POST['avsetup']) ? 'Yes' : 'No');
     $NumberEvents = mysql_fixstring($conn, $_POST['attend']);
     $Subject = $Program;


     // Update the information for the event
     $sql_info = "UPDATE reservations SET programName= '$Program', programPerson = '$InCharge',
                             programGroup='$groupSponsor', programDescription='$Description', room='$RoomReservation', email='$Email',
                             phone='$PhoneNumber', bookedStatus='$BookedStatus', sm_board='$smartBoard', ex_cord='$ExtensionCord', projector='$Projector',
                             document_camera='$DocumentCamera', av_needs='$AV_Need', num_events='$NumberEvents' " .
         "WHERE reservationID = '" . $ReservationID . "'";
     if ($conn->query($sql_info) === TRUE) {
         echo "It Works";
     }

    // Insert the New Date and Time
    $index = 0;
    foreach ($_POST as $key) {
        if (preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $key)) {
            $DateTimeID = mysql_fixstring($conn, $_POST['eventsId' . $index]);
            $startDate = FormatDate4Db(mysql_fixstring($conn, $_POST['date' . $index]));
            $startTime = FormatTime4Db(mysql_fixstring($conn, $_POST['stime' . $index]));
            $endTime = FormatTime4Db(mysql_fixstring($conn, $_POST['etime' . $index]));
            $preTime = FormatTime4Db(mysql_fixstring($conn, $_POST['ptime' . $index]));
            $status = 'reserved';
            $Subject .= '('.FormatDate4Report($startDate) . ') Start:' . FormatTime4Report($startTime). ', End:' . FormatTime4Report($endTime).
                        ', Pre:'.  FormatTime4Report($preTime) . '; ';

            $reservationDatesAndTime[$index] = "UPDATE reservationDate_Time SET StartDate = '$startDate', startTime = '$startTime' ,
                                    endTime = '$endTime', preTime = '$preTime', status='$status' WHERE reservationDateTime_ID = '$DateTimeID'";
            $result = $conn->query($reservationDatesAndTime[$index]);
            if ($result == TRUE) {
                echo "<br> Day: $index successfully updated";
            } else {
                echo "<br> Day : $index hit a snag";
                exit;
            }
            $index++;
        }
    };
     //Email the contact once the event is booked
/*
     $mail = new PHPMailer();
     $Mail_Body = "Your request to reserve space through the Athens State In-Service Center has been approved. Please\n
                   remember our building hours are Monday-Friday, 8:00-4:30. If you have questions or need to cancel\n
                   your session please email holly.wood@athens.edu.\n\n
                   Thanks,\n
                   In-Service & AMSTI Staff\n";

     $mail->addAddress($Email);

     $mail->Subject = $Subject;
     $mail->Body = $Mail_Body;

     //From email address and name
     $mail->From = "inserviceathens@gmail.com";
     $mail->FromName = "Inservice Athens Reservation";

     if(!$mail->send())
     {
         echo "Mailer Error: " . $mail->ErrorInfo;
     }
     else
     {
         echo "Message has been sent successfully";
     }
*/
}
//Add the Google Calendar ID's into the tables so can use for update, delete, and move
elseif(isset($_POST['PrivateID']) && isset($_POST['EventID']))
{
    $PrivateGoogleId = mysql_fixstring($conn, $_POST['PrivateID']);
    $EventID = mysql_fixstring($conn, $_POST['EventID']);

    $SQL_Query = "UPDATE reservationDate_Time SET privateGoogle = '$PrivateGoogleId'".
        "WHERE reservationDateTime_ID = '$EventID'";

    $conn->query($SQL_Query);
}
//Public ID Placement
elseif(isset($_POST['PublicID']) && isset($_POST['EventID']))
{
    $PublicGoogleId = mysql_fixstring($conn, $_POST['PublicID']);
    $EventID = mysql_fixstring($conn, $_POST['EventID']);

    $SQL_Query = "UPDATE reservationDate_Time SET publicGoogle = '$PublicGoogleId'".
        "WHERE reservationDateTime_ID = '$EventID'";

    $conn->query($SQL_Query);
}

//Handle new Events from the dialog box form
elseif (isset($_POST['ReservationID_newEvent']) && isset($_POST['newDate'])&& isset($_POST['newStime'])&& isset($_POST['newEtime'])&& isset($_POST['newPtime']) && isset($_POST['index']) && isset($_POST['Book_Status']))
{
    $index = mysql_fixstring($conn, $_POST['index']);
    $newEventReservationID = mysql_fixstring($conn, $_POST['ReservationID_newEvent']);
    $newDate = FormatDate4Db(mysql_fixstring($conn, $_POST['newDate']));
    $newStartTime = FormatTime4Db(mysql_fixstring($conn, $_POST['newStime']));
    $newEndTime = FormatTime4Db(mysql_fixstring($conn, $_POST['newEtime']));
    $newPreTime = FormatTime4Db(mysql_fixstring($conn, $_POST['newPtime']));
    $bookedStatus = mysql_fixstring($conn, $_POST['Book_Status']);

    $newEvent="INSERT INTO reservationDate_Time (reservationID, StartDate, startTime,
                endTime, preTime, status)" .
        "VALUES('$newEventReservationID', '$newDate', '$newStartTime', '$newEndTime', '$newPreTime', 'unreserved')";
    $result= $conn->query($newEvent);
    $newEventID = $conn->insert_id;

    if( $result=== TRUE)
    {
        echo"<tr id='add_row$index'>";
        if($bookedStatus === 'booked')
        {
            echo"<td><input type='text' name='status$index' id = 'status$index' class = 'status' disabled value='unreserved'/></td>";
            echo"<td class='hidden'><input type='text' name='status$index' id = 'status$index' class = 'status' value='unreserved'/></td>";
        }
        echo"<td><input type='text' name='date$index' id='date$index' class='datepicker' value='".FormatDate4Report($newDate)."' /></td>".
            "<td><input type='text' name='stime$index' id='stime$index' class='timepicker' value='".FormatTime4Report($newStartTime)."'/></td>".
            "<td><input type='text' name='etime$index' id='etime$index' class='timepicker' value='".FormatTime4Report($newEndTime)."'/></td>".
            "<td><input type='text' name='ptime$index' id='ptime$index' class='timepicker' value='".FormatTime4Report($newPreTime)."'/></td>".
            "<td class='hidden'><input type='hidden' name='eventsId$index' id='eventsId$index' class='eventID' value='$newEventID'/></td>";
        if($bookedStatus === 'booked')
        {
            echo "<td class='hidden'><input type='hidden' name='prgoogle$index' id='prgoogle$index' value='newDate'/></td>".
                "<td class='hidden'><input type='hidden' name='pugoogle$index' id='pugoogle$index' value='newDate'/></td>";
        }
        echo
            "<td><a id='deleteEvent' class='btn btn-danger deleteEvent'>Delete</a></td>".
            "</tr>";
    }
    else
    {
        echo"Error in Inserting Data";
    }
}
elseif(isset($_POST['EventID']) && isset($_POST['ChangeStatusTrigger']))
{
    $EventID = mysql_fixstring($conn, $_POST['EventID']);
    $updateEventStatus = "UPDATE reservationDate_Time SET status = 'reserved' WHERE reservationDateTime_ID  = ".$EventID;
    if($conn->query($updateEventStatus))
    {
        echo"The status changed to reserved";
    }
    else{echo "Error in Changing Status";}
}

//Create a pending request within the Admin Page
elseif (isset($_POST['createProgram']) && isset($_POST['createSponsor']) && isset($_POST['createEvntdesc']) && isset($_POST['createResponsible']) && isset($_POST['createPhone']) &&
    isset($_POST['createEmail']) && isset($_POST['createRoom']) && isset($_POST['createAttend']))
{
    $Program = mysql_fixstring($conn, $_POST['createProgram']);
    $Sponsor = mysql_fixstring($conn, $_POST['createSponsor']);
    $EventDesc = mysql_fixstring($conn, $_POST['createEvntdesc']);
    $Responsible = mysql_fixstring($conn, $_POST['createResponsible']);
    $Phone = mysql_fixstring($conn, $_POST['createPhone']);
    $Email = mysql_fixstring($conn, $_POST['createEmail']);
    $Room = mysql_fixstring($conn, $_POST['createRoom']);
    $AttendNumber = mysql_fixstring($conn, $_POST['createAttend']);
    $BookedStatus = 'pending';
    $smartBoard = (isset($_POST['createSmartboard']) ? 'Yes': 'No');
    $Projector = (isset($_POST['createProjector']) ? 'Yes': 'No');
    $ExtensionCord = (isset($_POST['createExtensioncords']) ? 'Yes': 'No');
    $DocumentCamera = (isset($_POST['createDocumentcamera']) ? 'Yes' : 'No');
    $AV_Need = (isset($_POST['createAvsetup']) ? 'Yes': 'No');

    $SQL_Insert = "INSERT INTO reservations (programName, programPerson,
                            programGroup, programDescription, room, email,
                            phone, bookedStatus, sm_board, ex_cord, projector,
                            document_camera, av_needs, num_events) " .
        "VALUES ('$Program', '$Responsible', '$Sponsor', '$EventDesc', '$Room', '$Email', '$Phone', 
                '$BookedStatus', '$smartBoard', '$ExtensionCord', '$Projector',  '$DocumentCamera', '$AV_Need', '$AttendNumber')";

    if($conn->query($SQL_Insert) === false)
    {
        echo "Problem with SQL Insert";
    }
    $ReservationID = $conn->insert_id;
    //Get dates for the sql
    $index = 0;
    $reservationDatesAndTime = array();
    foreach ($_POST as $key) {
        if (preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $key)) {
            $startDate = FormatDate4Db(mysql_fixstring($conn, $_POST['createRequesteddatefrom' . $index]));
            $startTime = FormatTime4Db(mysql_fixstring($conn, $_POST['createStarttime' . $index]));
            $endTime = FormatTime4Db(mysql_fixstring($conn, $_POST['createEndtime' . $index]));
            $preTime = FormatTime4Db(mysql_fixstring($conn, $_POST['createPreeventsetup' . $index]));
            $reservationDatesAndTime[$index] = "INSERT INTO reservationDate_Time (reservationID, StartDate, startTime,
                                    endTime, preTime)" .
                "VALUES('$ReservationID', '$startDate', '$startTime', '$endTime', '$preTime')";
            $result = $conn->query($reservationDatesAndTime[$index]);

            if ($result == TRUE) {
                echo "<br> Day: $index successfuly inserted";
            } else {
                echo "<br> Day : $index hit a snag";
                exit;
            }
            $index++;
        }
    }
}
//Permanently Delete Reservation from Canceled Reservation
elseif(isset($_POST['permanentDelete']))
{
    $PermanentDeleteID = mysql_fixstring($conn, $_POST['permanentDelete']);

    $PermanentDelete_SQL = "delete from reservationDate_Time where reservationID  = '" . $PermanentDeleteID."'";
    $conn->query($PermanentDelete_SQL);
    $PermanentDelete_SQL = "delete from reservations where reservationID = '" . $PermanentDeleteID . "'";
    $conn->query($PermanentDelete_SQL);
}
else
{
    echo "Please fill out all of the inputs before submitting";
}

function mysql_fixstring($conn, $string)
{
    if(get_magic_quotes_gpc()) $string=stripslashes($string);
    return $conn->real_escape_string($string);
}
function SanitizePostString($conn, $string)
{
    return htmlentities(mysql_fixstring($conn, $string));
}


