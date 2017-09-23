<!DOCTYPE html>
<html class="no-js" lang="en" dir="ltr">
<?php
require "../resources/config.php";
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
<head>
    <title>mForm</title>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../resources/library/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../resources/library/bootstrap/css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="../resources/library/DataTables/datatables.css">

    <script src="../resources/library/jquery-3.2.1.min.js"></script>
    <script src="../resources/library/bootstrap/js/bootstrap.min.js"></script>

    <script src="../resources/library/DataTables/datatables.js"></script>
    <script src="js/mForm.js"></script>


</head>

<body>

<div class="bs-example">
    <table id="example" class="display" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Request ID</th>
            <th>School</th>
            <th>System</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th>Request ID</th>
            <th>School</th>
            <th>System</th>
        </tr>
        </tfoot>
        <tbody>
            <?PHP

            $sql="select request_id, school, system from requests";

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
                        ."</tr>";

                    //print_r($row);
                    //printf ("%s (%s)\n",$row[0],$row[1]);
                }
                // Free result set
                mysqli_free_result($result);
            }

            mysqli_close($mysqli);

            ?>
        </tbody>
    </table>

</div>

</body>