<?php
/**
 * Created by PhpStorm.
 * User: jtwyn
 * Date: 10/29/2017
 * Time: 11:58 AM
 */

include_once "Common.php";
$conn = new mysqli($config['db']['amsti_01']['host']
    , $config['db']['amsti_01']['username']
    , $config['db']['amsti_01']['password']
    , $config['db']['amsti_01']['dbname']);
//If reservation was canceled from admin page
if(isset($_POST['DeleteEvent']) && isset($_POST['ReservationID']))
{
    $ReservationID = $_POST['ReservationID'];
    //This query will delete the dates and time before deleting the information
    $cancel_Query = "UPDATE reservations SET bookedStatus= 'canceled' WHERE reservationID = '" . $ReservationID . "'";
    $result = $conn->query($cancel_Query);

    /*
     if ($result === TRUE) {
   //$to = "Holly.Wood@athens.edu";
    $to = "jtwynn95@outlook.com";
   $subject = "Reservation Request Canceled";
   $txt = Your reservation for your program: (program) was canceled. If you have any questions with this
    cancellation please contact us through email or phone.
   $headers = "From: webmaster@myathensric.org";
   mail($to,$subject,$txt,$headers);

    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
     */
}


elseif(isset($_POST['program']) && isset($_POST['responsible']) && isset($_POST['sponsor']) && isset($_POST['evntdesc']) &&
       isset($_POST['room'])&& isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['attend'])) {
    //If not delete then update the event to booked
    $ReservationID = $_POST['ReservationID'];
    $Program = $_POST['program'];
    $InCharge = $_POST['responsible'];
    $groupSponsor = $_POST['sponsor'];
    $Description = $_POST['evntdesc'];
    $RoomReservation = $_POST['room'];
    $Email = $_POST['email'];
    $PhoneNumber = $_POST['phone'];
    $BookedStatus = 'booked';
    $smartBoard = (isset($_POST['Smartboard']) ? 'Yes' : 'No');
    $Projector = (isset($_POST['projector']) ? 'Yes' : 'No');
    $ExtensionCord = (isset($_POST['extensioncords']) ? 'Yes' : 'No');
    $DocumentCamera = (isset($_POST['documentcamera']) ? 'Yes' : 'No');
    $AV_Need = (isset($_POST['avsetup']) ? 'Yes' : 'No');
    $NumberEvents = $_POST['attend'];

    // Update the information for the event
    $sql_info = "UPDATE reservations SET programName= '$Program', programPerson = '$InCharge',
                            programGroup='$groupSponsor', programDescription='$Description', room='$RoomReservation', email='$Email',
                            phone='$PhoneNumber', bookedStatus='$BookedStatus', sm_board='$smartBoard', ex_cord='$ExtensionCord', projector='$Projector',
                            document_camera='$DocumentCamera', av_needs='$AV_Need', num_events='$NumberEvents' " .
        "WHERE reservationID = '" . $ReservationID . "'";
    if ($conn->query($sql_info) === TRUE) {
        echo "It Works";
    }
    //Email the contact once the event is booked
    /*
    if($conn->query($sql_info) === TRUE)
    {
     //$to = "Holly.Wood@athens.edu";
     $to = "jtwynn95@outlook.com";
     $subject = "Reservation Booked";
     $txt = Hello (person) your reservation for (program) has been reserved
        for room (room). If you have any questions concerning this email please contact
        us at email: email phone#: (phone)

     $headers = "From: webmaster@myathensric.org";
     mail($to,$subject,$txt,$headers);

      echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

     */

    // Insert the New Date and Time
    $index = 0;
    foreach ($_POST as $key) {
        if (preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $key)) {
            $DateTimeID = $_POST['eventsId' . $index];
            $startDate = FormatDate4Db($_POST['date' . $index]);
            $startTime = FormatTime4Db($_POST['stime' . $index]);
            $endTime = FormatTime4Db($_POST['etime' . $index]);
            $preTime = FormatTime4Db($_POST['ptime' . $index]);
            $status = 'reserved';

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
}
//Add the Google Calendar ID's into the tables so can use for update, delete, and move
elseif(isset($_POST['PrivateID']) && isset($_POST['EventID']))
{
    $PrivateGoogleId = $_POST['PrivateID'];
    $EventID = $_POST['EventID'];

    $SQL_Query = "UPDATE reservationDate_Time SET privateGoogle = '$PrivateGoogleId'".
        "WHERE reservationDateTime_ID = '$EventID'";

    $conn->query($SQL_Query);
}

elseif(isset($_POST['PublicID']) && isset($_POST['EventID']))
{
    $PublicGoogleId = $_POST['PublicID'];
    $EventID = $_POST['EventID'];

    $SQL_Query = "UPDATE reservationDate_Time SET publicGoogle = '$PublicGoogleId'".
        "WHERE reservationDateTime_ID = '$EventID'";

    $conn->query($SQL_Query);
}

//Handle new Events
elseif (isset($_POST['ReservationID_newEvent']) && isset($_POST['newDate'])&& isset($_POST['newStime'])&& isset($_POST['newEtime'])&& isset($_POST['newPtime']) && isset($_POST['index']) && isset($_POST['bookedStatus']))
{
    $index = $_POST['index'];
    $newEventReservationID = $_POST['ReservationID_newEvent'];
    $newDate = FormatDate4Db($_POST['newDate']);
    $newStartTime = FormatTime4Db($_POST['newStime']);
    $newEndTime = FormatTime4Db($_POST['newEtime']);
    $newPreTime = FormatTime4Db($_POST['newPtime']);
    $bookedStatus = $_POST['bookedStatus'];

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
else if(isset($_POST['EventID']) && isset($_POST['ChangeStatusTrigger']))
{
    $EventID = $_POST['EventID'];
    $updateEventStatus = "UPDATE reservationDate_Time SET status = 'reserved' WHERE reservationDateTime_ID  = ".$EventID;
    if($conn->query($updateEventStatus))
    {
        echo"The status changed to reserved";
    }
    else{echo "Error in Changing Status";}
}




