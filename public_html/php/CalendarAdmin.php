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
<div id="reservationTable">
    <table class="text-center" id="datatable">
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
                        data: "reserveID=" +  record[0],
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

