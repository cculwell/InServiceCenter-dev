<?php
    require "../../../../resources/config.php";

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

    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];
?>

<!DOCTYPE html>
<html class="no-js" lang="en" dir="ltr">

    <head>
        <title>Quick Report</title>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
        <link rel="stylesheet" href="../resources/library/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="../resources/library/bootstrap/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="../resources/library/jquery-ui/jquery-ui.min.css">
        <link rel="stylesheet" href="../resources/library/DataTables/datatables.css">
        <link rel="stylesheet" href="../resources/library/DataTables/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="../resources/library/DataTables/Buttons/css/buttons.dataTables.min.css">
        <link rel="stylesheet" href="css/Reports.css">

        <script src="../resources/library/jquery-3.2.1.min.js"></script>
        <script src="js/reports/quick_report.js"></script>
        <script src="../resources/library/DataTables/datatables.js"></script>
        <script src="../resources/library/DataTables/js/jquery.dataTables.min.js"></script>
        <script src="../resources/library/DataTables/Buttons/js/dataTables.buttons.min.js"></script>
        <script src="../resources/library/DataTables/Buttons/js/buttons.print.min.js"></script>
        <script src="../resources/library/DataTables/Buttons/js/buttons.html5.min.js"></script>
        <script src="../resources/library/DataTables/Buttons/js/pdfmake.min.js"></script>
        <script src="../resources/library/DataTables/Buttons/js/vfs_fonts.js"></script>
        <script src="../resources/library/DataTables/Buttons/js/buttons.colVis.min.js"></script>
        <script src="../resources/library/DataTables/Buttons/js/jszip.min.js"></script>
        <script src="../resources/library/DataTables/Buttons/js/buttons.flash.min.js"></script>

    </head>
    <body>
        <div class="page_container">
            <h3>Quick Report</h3>
            <?php
                echo "<h5>" . "From: " . $from_date . "</h5>";
                echo "<h5>" . "To:   " . $to_date . "</h5>";
            ?>
            <br><br>
            <table id="quick_report_table" class="display table-responsive" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th class="program_id">Program ID</th>
                        <th class="program_title">Program Title</th>
                        <th class="start_date">Start Date</th>
                        <th class="end_date">End Date</th>
                        <th class="start_time">Start Time</th>
                        <th class="end_time">End Time</th>
                        <th class="location">Location</th>
                        <th class="initiative">Support Provided By</th>
                        <th class="current_enrollment">Current Enrollment</th>
                        <th class="max_enrollment">Maximum Enrollment</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                        $sql = "SELECT * FROM quick_report_data WHERE report_date BETWEEN '$from_date' AND '$to_date'";

                        if ($result = mysqli_query($mysqli, $sql))
                        {
                            while ($row = mysqli_fetch_row($result))
                            {
                                echo
                                    "<tr>"
                                    ."<td>". $row[2]  ."</td>"     // Program ID
                                    ."<td>". $row[4]  ."</td>"     // Program Title
                                    ."<td>". $row[5]  ."</td>"     // Start Date
                                    ."<td>". $row[7]  ."</td>"     // End Date
                                    ."<td>". $row[6]  ."</td>"     // Start Time
                                    ."<td>". $row[8]  ."</td>"     // End Time
                                    ."<td>". $row[9]  ."</td>"     // Location
                                    ."<td>". $row[14] ."</td>"     // Support Provided By
                                    ."<td>". $row[12]  ."</td>"    // Current Enrollment
                                    ."<td>". $row[11]  ."</td>"    // Max Enrollment
                                    ."</tr>";
                            }
                        }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th class="program_id">Program ID</th>
                        <th class="program_title">Program Title</th>
                        <th class="start_date">Start Date</th>
                        <th class="end_date">End Date</th>
                        <th class="start_time">Start Time</th>
                        <th class="end_time">End Time</th>
                        <th class="location">Location</th>
                        <th class="initiative">Support Provided By</th>
                        <th class="current_enrollment">Current Enrollment</th>
                        <th class="max_enrollment">Maximum Enrollment</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </body>
</html>

<?php
    mysqli_close($mysqli);
?>