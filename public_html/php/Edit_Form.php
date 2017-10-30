<?php
/**
 * Created by PhpStorm.
 * User: jtwyn
 * Date: 10/26/2017
 * Time: 4:28 PM
 */

include_once "Common.php";

$conn = new mysqli($config['db']['amsti_01']['host']
    , $config['db']['amsti_01']['username']
    , $config['db']['amsti_01']['password']
    , $config['db']['amsti_01']['dbname']);

if ($conn->connect_errno) {
    printf("Connect failed: %s\n", $conn->connect_error);
    exit();
}
if(isset($_POST['reserveID'])) {

    $reservation_query = "SELECT * FROM reservations WHERE reservationID = '" . $_POST['reserveID'] . "'";
    if($result = mysqli_query($conn, $reservation_query))
    {
        $row = mysqli_fetch_row($result);
        //Free result row
        mysqli_free_result($result);

    }
    else
    {
        printf("ERROR Fetching row");
        exit();
    }
    $ReservationID = $row[0];
    $Program = $row[1];
    $InCharge = $row[2];
    $groupSponsor = $row[3];
    $Description = $row[4];
    $RoomReservation = $row[5];
    $Email = $row[6];
    $PhoneNumber = $row[7];
    $BookedStatus = $row[8];
    $smartBoard = $row[9];
    $Projector = $row[10];
    $ExtensionCord = $row[11];
    $DocumentCamera = $row[12];
    $AV_Need = $row[13];
    $NumberEvents = $row[14];

    //Date and Time query
    $date_time_Query = "Select * from reservationDate_Time where reservationID = '" . $_POST['reserveID'] . "'";
    $index = 0;
    if($result = $conn->query($date_time_Query))
    {
        while($date_row = $result->fetch_assoc())
        {
            $EventID[$index] = $date_row['reservationDateTime_ID'];
            $Date[$index] = FormatDate4Report($date_row['StartDate']);
            $StartTime[$index] = FormatTime4Report($date_row['startTime']);
            $EndTime[$index] = FormatTime4Report($date_row['endTime']);
            $PreTime[$index] = FormatTime4Report($date_row['preTime']);
            $index++;
        }
    }

}
else
{
    echo "Error in MYSQL Contact";
    exit();
}

?>

<div id="pending_reservations">


    <form id="form_id<?php echo $ReservationID?>">
        <div class="panel panel-primary">
            <div class="panel-heading">Program Information</div>
            <div class="panel-body">
                <div class="row form-group">
                    <input type="hidden" name="ReservationID" value="<?php echo $ReservationID?>"/>
                    <div class="pull-left col-md-4">
                        <label for="program">Program Name: </label><input id="program" name="program" type="text" class="col-md-6" value="<?php echo $Program?>"/>
                    </div>
                    <div class="pull-right col-md-4">
                        <label for="sponsor">Group Sponsor:</label><input id="sponsor" name="sponsor" type="text" class="col-md-6" value="<?php echo $groupSponsor?>"/>
                    </div>
                    <div class="col-md-11">
                        <label for="evntdesc">Program Description</label><textarea id="evntdesc" name="evntdesc" rows="3" cols="12"><?php echo $Description?></textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel panel-primary">
            <div class="panel-heading">Contact Information</div>
            <div class="panel-body">
                <div class="row form-group">
                    <div class="pull-left col-md-4">
                        <label for="responsible">Contact's Name:</label><input id="responsible" name='responsible' type="text" value="<?php echo $InCharge ?>"/>
                    </div>
                    <div class="pull-right col-md-4 pull-left">
                        <label for="phone">Contact's Phone#:</label><input id="phone" name="phone" type="text" value="<?php echo $PhoneNumber ?>"/>
                    </div>
                    <div class="col-md-3 pull-right">
                        <label for="email">Contact's Email:</label><input id="email" name="email" type="text" value="<?php echo $Email ?>"/>

                    </div>
                </div>
            </div>
        </div>



        <div class="panel panel-primary">
            <div class="panel-heading">Room Reservation Dates</div>
            <div class="form-group row panel-body">
                <div class="pull-left col-md-4">
                    <label for="location">Pick a room to reserve: </label>
                    <select id="location" name="room" style="height: 40px; width: 200px" >
                        <option <?php echo ($RoomReservation === 'Room A')?'Selected' : '' ?> value="Room A">Room A</option>
                        <option <?php echo ($RoomReservation === 'Room B')?'Selected' : '' ?> value="Room B">Room B</option>
                        <option <?php echo ($RoomReservation === 'Room C')?'Selected' : '' ?> value="Room C">Room C</option>
                        <option <?php echo ($RoomReservation === 'Conference')?'Selected' : '' ?> value="Conference">Conference</option>
                    </select>
                </div>
                <div class="pull-right col-md-4">
                    <label for="numattend">Number of Attendees</label>
                    <input type="number" id="numattend" name="attend" required value="<?php echo $NumberEvents ?>">
                </div>

            <table class="table table-bordered">
                <tbody>




            <?php
            // PHP to put all of the date and time from the database
            for($x = 0; $x < $index; $x++)
            {
                echo"<tr>".
                    "<input type='hidden' name=eventid$x id='eventid$x' value='$EventID[$x]'>" .
                    "<td><label for='date$x'>Start Date</label><input type='text' name='date$x' id='date$x' class='datepicker' value='$Date[$x]'/></td>".
                    "<td><label for='stime$x'>Start Time</label><input type='text' name='stime$x' id='stime$x' class='timepicker' value='$StartTime[$x]'/></td>".
                    "<td><label for='etime$x'>End Time</label><input type='text' name='etime$x' id='etime$x' class='timepicker' value='$EndTime[$x]'/></td>".
                    "<td><label for='ptime$x'>Pre-Time</label><input type='text' name='ptime$x' id='ptime$x' class='timepicker' value='$PreTime[$x]'/></td>".
                    "</tr>";
            }
            ?>
                </tbody>
            </table>



                <label class="checkbox-inline"><input type="checkbox" name="Smartboard" value="Smartboard" <?php echo($smartBoard === 'Yes')? 'checked':''?> >Smartboard</label></td>
                <label class="checkbox-inline"><input type="checkbox" name="projector" value="projector"<?php echo($Projector === 'Yes')? 'checked':''?>>Projector</label></td>
                <label class="checkbox-inline"><input type="checkbox" name="documentcamera" value="documentcamera"<?php echo($ExtensionCord === 'Yes')? 'checked':''?>>Document Camera</label></td>
                <label class="checkbox-inline"><input type="checkbox" name="extensioncords" value="extensioncords"<?php echo($DocumentCamera === 'Yes')? 'checked':''?>>Extension Cords</label></td>


                <label style="font-size: 20px; " for="avguy">*A/V tech needed to assist with setup?<input type="checkbox" id = "avguy" name="avsetup" style="width: 30px; height: 20px; cursor: pointer" value="avsetup" <?php echo($AV_Need === 'Yes')? 'checked':''?> ></label>
            </div>


        </div>
        <button type="button" class="btn btn-primary pull-left" id="bookEvent<?php echo $ReservationID?>">Book Reservation</button>
        <button type="button" class="btn btn-danger pull-right" id="deleteEvent<?php echo $ReservationID?>">Delete Reservation</button>
        <script>
            //Javascript to handle booking event and deleting events
            $('.datepicker').datepicker();
            $('#bookEvent<?php echo $ReservationID?>').on('click', function () {
                //alert('Booked event on <?php echo $ReservationID?>');
                var form = $('#form_id<?php echo $ReservationID?>').serialize();

                $.ajax({
                    type: 'POST',
                    url: 'php/BookEvent.php',
                    data: form,
                    success: function () {
                        console.log('Form Sent');
                        $('#reservationQueue').load('php/CalendarAdmin.php');
                    },
                    error: function (data) {
                        console.log('Error on sending form');
                    }
                });

                event.preventDefault();
            });
            $('#deleteEvent<?php echo $ReservationID?>').on('click', function () {

                $.ajax({
                    type: 'POST',
                    url: 'php/BookEvent.php',
                    data: {DeleteEvent: "DELETE", ReservationID: "<?php echo $ReservationID?>"},
                    success: function () {
                        alert('Delete Sent');
                        $('#reservationQueue').load('php/CalendarAdmin.php');
                    },
                    error: function (data) {
                        alert('Error on sending Delete Request');
                    }
                });

                //event.preventDefault();
            });
        </script>
    </form>
</div>

