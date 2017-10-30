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
if(isset($_POST['DeleteEvent']) && isset($_POST['ReservationID']))
{
    $ReservationID = $_POST['ReservationID'];
    //This query will delete the dates and time before deleting the information
    $cancel_Query = "UPDATE reservations SET bookedStatus= 'canceled' WHERE reservationID = '" . $ReservationID . "'";
    $result = $conn->query($cancel_Query);
}

elseif(isset($_POST['program']) && isset($_POST['responsible']) && isset($_POST['sponsor']) && isset($_POST['evntdesc']) &&
       isset($_POST['room'])&& isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['attend']))
{
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
    $smartBoard = (isset($_POST['Smartboard']) ? 'Yes': 'No');
    $Projector = (isset($_POST['projector']) ? 'Yes': 'No');
    $ExtensionCord = (isset($_POST['extensioncords']) ? 'Yes': 'No');
    $DocumentCamera = (isset($_POST['documentcamera']) ? 'Yes' : 'No');
    $AV_Need = (isset($_POST['avsetup']) ? 'Yes': 'No');
    $NumberEvents = $_POST['attend'];

    // Update the information for the event
    $sql_info = "UPDATE reservations SET programName= '$Program', programPerson = '$InCharge',
                            programGroup='$groupSponsor', programDescription='$Description', room='$RoomReservation', email='$Email',
                            phone='$PhoneNumber', bookedStatus='$BookedStatus', sm_board='$smartBoard', ex_cord='$ExtensionCord', projector='$Projector',
                            document_camera='$DocumentCamera', av_needs='$AV_Need', num_events='$NumberEvents' " .
        "WHERE reservationID = '" . $ReservationID . "'";
    $conn->query($sql_info);

    // Update the date and time
    $index=0;
    foreach ($_POST as $key)
    {
        if(preg_match('/^\d{1,2}\/\d{1,2}\/\d{4}$/', $key))
        {
            $startDate = FormatDate4Db($_POST['date' . $index]);
            $startTime = FormatTime4Db($_POST['stime' . $index]);
            $endTime = FormatTime4Db($_POST['etime' . $index]);
            $preTime = FormatTime4Db($_POST['ptime' . $index]);
            $eventID = $_POST['eventid' . $index];
            $reservationDatesAndTime[$index] = "UPDATE reservationDate_Time SET StartDate='$startDate', startTime='$startTime',
                                    endTime='$endTime', preTime='$preTime' " .
                "WHERE reservationDateTime_ID = '" . $eventID . "'";
            $result = $conn->query($reservationDatesAndTime[$index]);
            if($result == TRUE)
            {
                echo "<br> Day: $index successfully updated";
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