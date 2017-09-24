<?php
require "../../resources/config.php";
# create connection to database
$mysqli = new mysqli($config['db']['amsti_01']['host']
    , $config['db']['amsti_01']['username']
    , $config['db']['amsti_01']['password']
    , $config['db']['amsti_01']['dbname']);

/* check connection */
if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}
?>
<!DOCTYPE html>
<html class="no-js" lang="en" dir="ltr">
<head>
    <title>Work Queue</title>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../../resources/library/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../resources/library/bootstrap/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="../../resources/library/bootstrap/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="../../resources/library/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" href="../../resources/library/DataTables/datatables.css">
    <link rel="stylesheet" href="../../resources/library/DataTables/Select/css/select.datatables.css">
    <!--link rel="stylesheet" href="../css/WorkQueue.css"-->

    <script src="../../resources/library/jquery-3.2.1.min.js"></script>
    <script src="../../resources/library/jquery-ui/jquery-ui.min.js"></script>
    <script src="../../resources/library/DataTables/datatables.js"></script>
    <script src="../../resources/library/DataTables/Select/js/dataTables.select.min.js"></script>


</head>
<div id="tabs">
    <ul>
        <li><a href="#tab_new_req">New Requests</a></li>
        <li><a href="#tab_in_prog">In Progress</a></li>
        <li><a href="#tab_completed">Completed</a></li>
        <li><a href="#tab_completed">All Requests</a></li>
    </ul>
    <div id="tab_new_req">
        <table id="tbl_new_req" class="display table-responsive" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>Request ID</th>
                <th>Type</th>
                <th>State</th>
                <th>School</th>
                <th>System</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>Request ID</th>
                <th>Type</th>
                <th>State</th>
                <th>School</th>
                <th>System</th>
            </tr>
            </tfoot>
            <tbody>
            <?PHP

            $sql  = "select ";
            $sql .= "request_id, request_type, workflow_state, school, system ";
            $sql .= "from requests where workflow_state = 'New'";

            if ($result=mysqli_query($mysqli,$sql))
            {
                // Fetch one and one row
                while ($row=mysqli_fetch_row($result))
                {
                    echo
                        "<tr>"
                        ."<td>".$row[0] ."</td>"
                        ."<td>".$row[1] ."</td>"
                        ."<td>".$row[2] ."</td>"
                        ."<td>".$row[3] ."</td>"
                        ."<td>".$row[4] ."</td>"
                        ."</tr>";
                }
                // Free result set
                mysqli_free_result($result);
            }

            //      mysqli_close($mysqli);

            ?>
            </tbody>
            </table>
<script>
    var queue = $('#tbl_new_req').DataTable({
        select: {
            style: 'single'
        }
    });
    //queue.rows( { selected: true } ).data();
    queue.on( 'select', function ( e, dt, type, indexes ) {
        if ( type === 'row' ) {
            //var data = queue.rows( indexes ).data().pluck( 'id' );
            var record = queue.rows( { selected: true } ).data();
            // do something with the ID of the selected items
//            console.log(record[0][0]);
            $.ajax({

                type: "POST",//post
                //url: $(this).attr('href'),
                url: "php/div_wq_form.php",
                data: "request_id="+record[0][0], // appears as $_POST['id'] @ ur backend side
                success: function(data) {
                    // data is ur summary
                    $('#div_wq_form').html(data);
                }

            });
        }
    } );


</script>
</div>
<div id="tab_in_prog">Completed List Content</div>
<div id="tab_completed">Completed List Content</div>
</div>
<script>
    $("#tabs").tabs();
</script>
</html>

<?php
mysqli_close($mysqli);
?>