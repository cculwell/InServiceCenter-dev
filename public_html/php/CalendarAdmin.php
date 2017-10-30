<?php
/**
 * Created by PhpStorm.
 * User: jtwyn
 * Date: 10/19/2017
 * Time: 2:40 PM
 */
include_once "Common.php";

$conn = new mysqli($config['db']['amsti_01']['host']
    , $config['db']['amsti_01']['username']
    , $config['db']['amsti_01']['password']
    , $config['db']['amsti_01']['dbname']);

?>

<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#reservation_queue">Pending Reservations</a></li>
    <li><a data-toggle="tab" href="#booked_reservation">Booked Reservations</a></li>
    <li><a data-toggle="tab" href="#canceled_Reservations">Canceled Reservations</a></li>
    <li><a data-toggle="tab" href="#create_Reservation">Create Reservation</a></li>
</ul>
<div class="tab-content">
    <div id="reservation_queue" class="tab-pane fade in active">
        <h4 class="text-center">Pending Reservations</h4>
        <table class="text-center table table-striped table-bordered" id="datatable">
            <thead>
            <tr>
                <th>Reservation ID</th>
                <th>Program Name</th>
                <th>Program Sponsor</th>
                <th>Room Reserving</th>
                <th>Person In Charge</th>
            </tr>

            </thead>
            <tbody>
            <?php

            $query = "SELECT * FROM reservations WHERE bookedStatus = 'pending'";
            $result = mysqli_query($conn, $query);

            while($row = mysqli_fetch_row($result))
            {
                echo <<<End
            <tr>
            <td>$row[0]</td>
            <td>$row[1]</td>
            <td>$row[3]</td>
            <td>$row[5]</td>
            <td>$row[2]</td>
            
            </tr>
            

End;
            }
            mysqli_free_result($result);
            ?>
            </tbody>
            <tfoot>
            <tr>
                <th>Reservation ID</th>
                <th>Program Name</th>
                <th>Program Sponsor</th>
                <th>Room Reserving</th>
                <th>Person In Charge</th>
            </tr>
            </tfoot>
        </table>
        <script>
            $(document).ready(function () {
                var table = $('#datatable').DataTable({
                    select:{
                        style: 'single'
                    }
                });

                $('#datatable tbody').on('click', 'tr',  function(){
                    var tr = $(this).closest('tr');
                    var row = table.row(tr);
                    if(row.child.isShown())
                    {
                        row.child.hide();
                        tr.removeClass('shown');
                    }
                    else
                    {
                        var record = row.data();
                        $.ajax({
                            type:"POST",
                            url:"php/Edit_Form.php",
                            data: {reserveID:  record[0]},
                            success:function(response)
                            {
                                row.child(response).show();
                            },
                            error:function(thrownError)
                            {
                                row.child("Error loading content " + thrownError).show();
                            }
                        });
                        tr.addClass('shown');
                    }
                });
            });
        </script>
    </div>
    <div id="booked_reservation" class="tab-pane fade">
        <h4 class="text-center">Booked Reservations</h4>
        <table class="text-center table table-striped table-bordered" id="datatable_booked">
            <thead>
            <tr>
                <th>Reservation ID</th>
                <th>Program Name</th>
                <th>Program Sponsor</th>
                <th>Room Reserving</th>
                <th>Person In Charge</th>
            </tr>

            </thead>
            <tbody>
            <?php

            $query = "SELECT * FROM reservations WHERE bookedStatus = 'booked'";
            $result = mysqli_query($conn, $query);

            while($row = mysqli_fetch_row($result))
            {
                echo <<<End
            <tr>
            <td>$row[0]</td>
            <td>$row[1]</td>
            <td>$row[3]</td>
            <td>$row[5]</td>
            <td>$row[2]</td>
            
            </tr>
            

End;
            }
            mysqli_free_result($result);
            ?>
            </tbody>
            <tfoot>
            <tr>
                <th>Reservation ID</th>
                <th>Program Name</th>
                <th>Program Sponsor</th>
                <th>Room Reserving</th>
                <th>Person In Charge</th>
            </tr>
            </tfoot>
        </table>
        <script>
            $(document).ready(function () {
                var table = $('#datatable_booked').DataTable({
                    select:{
                        style: 'single'
                    }
                });

                $('#datatable_booked tbody').on('click', 'tr',  function(){
                    var tr = $(this).closest('tr');
                    var row = table.row(tr);
                    if(row.child.isShown())
                    {
                        row.child.hide();
                        tr.removeClass('shown');
                    }
                    else
                    {
                        var record = row.data();
                        $.ajax({
                            type:"POST",
                            url:"php/Edit_Form.php",
                            data: {reserveID:  record[0]},
                            success:function(response)
                            {
                                row.child(response).show();
                            },
                            error:function(thrownError)
                            {
                                row.child("Error loading content " + thrownError).show();
                            }
                        });
                        tr.addClass('shown');
                    }
                });
            });
        </script>
    </div>
    <div id="canceled_Reservations" class="tab-pane fade">
        <h4 class="text-center">Canceled Reservations</h4>
        <table class="text-center table table-striped table-bordered" id="datatable_canceled">
            <thead>
            <tr>
                <th>Reservation ID</th>
                <th>Program Name</th>
                <th>Program Sponsor</th>
                <th>Room Reserving</th>
                <th>Person In Charge</th>
            </tr>

            </thead>
            <tbody>
            <?php

            $query = "SELECT * FROM reservations WHERE bookedStatus = 'canceled'";
            $result = mysqli_query($conn, $query);

            while($row = mysqli_fetch_row($result))
            {
                echo <<<End
            <tr>
            <td>$row[0]</td>
            <td>$row[1]</td>
            <td>$row[3]</td>
            <td>$row[5]</td>
            <td>$row[2]</td>
            
            </tr>
            

End;
            }
            mysqli_free_result($result);
            ?>
            </tbody>
            <tfoot>
            <tr>
                <th>Reservation ID</th>
                <th>Program Name</th>
                <th>Program Sponsor</th>
                <th>Room Reserving</th>
                <th>Person In Charge</th>
            </tr>
            </tfoot>
        </table>
        <script>
            $(document).ready(function () {
                var table = $('#datatable_canceled').DataTable({
                    select:{
                        style: 'single'
                    }
                });

                $('#datatable_canceled tbody').on('click', 'tr',  function(){
                    var tr = $(this).closest('tr');
                    var row = table.row(tr);
                    if(row.child.isShown())
                    {
                        row.child.hide();
                        tr.removeClass('shown');
                    }
                    else
                    {
                        var record = row.data();
                        $.ajax({
                            type:"POST",
                            url:"php/Edit_Form.php",
                            data: {reserveID:  record[0]},
                            success:function(response)
                            {
                                row.child(response).show();
                            },
                            error:function(thrownError)
                            {
                                row.child("Error loading content " + thrownError).show();
                            }
                        });
                        tr.addClass('shown');
                    }
                });
            });
        </script>
    </div>
    <div id="create_Reservation" class="tab-pane fade">
        <h1>Coming Soon</h1>
    </div>

</div>

<?php mysqli_close($conn);