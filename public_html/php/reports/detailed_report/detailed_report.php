<?php
    session_start();
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
        <link rel="stylesheet" href="../resources/library/DataTables/Buttons/css/buttons.dataTables.min.css">
        <link rel="stylesheet" href="css/Reports.css">

        <script src="js/reports/detailed_report.js"></script>
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
        <h3>Detailed Report</h3>
        <br><br>
    <?php
    if (isset ($_SESSION['valid_email']) && ($_SESSION['valid_status']=='Admin'))
    {?>
        <table id="detailed_report_table" class="display cell-border table-responsive" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Program ID</th>
                    <th>STI PD</th>
                    <th>Program Title</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Sessions</th>
                    <th>Location</th>
                    <th>Initiative</th>
                    <th>Target Audience</th>
                    <th>School System</th>
                    <th>School</th>
                    <th>Curriculum Area</th>
                    <th>Consultant</th>
                    <th>Current Enrollment</th>
                    <th>Target Enrollment</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php

                    $sql = "SELECT * 
                            FROM detailed_report_data 
                            WHERE report_date BETWEEN '$from_date' AND '$to_date'";

                    if ($result = mysqli_query($mysqli, $sql))
                    {
                        while ($row = mysqli_fetch_row($result))
                        {
                            echo
                                "<tr>"
                                ."<td>". $row[2]  ."</td>"       // Program ID
                                ."<td>". $row[3]  ."</td>"       // STI PD
                                ."<td>". $row[4]  ."</td>"       // Program Title
                                ."<td>". $row[5]  ."</td>"       // Start Date
                                ."<td>". $row[6]  ."</td>"       // End Date
                                ."<td>". $row[7]  ."</td>"       // Start Time
                                ."<td>". $row[8]  ."</td>"       // End Time
                                ."<td>". $row[9]  ."</td>"       // Sessions
                                ."<td>". $row[10] ."</td>"       // Location
                                ."<td>". $row[11] ."</td>"       // Initiative
                                ."<td>". $row[12] ."</td>"       // Target Audience
                                ."<td>". $row[13] ."</td>"       // School System
                                ."<td>". $row[14] ."</td>"       // School
                                ."<td>". $row[15] ."</td>"       // Curriculum Area
                                ."<td>". $row[16] ."</td>"       // Consultant
                                ."<td>". $row[17] ."</td>"       // Current Enrollment
                                ."<td>". $row[18] ."</td>"       // Target Enrollment
                                ."<td>". $row[19] ."</td>"       // Status
                                ."</tr>";
                        }
                    }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>Program ID</th>
                    <th>STI PD</th>
                    <th>Program Title</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Sessions</th>
                    <th>Location</th>
                    <th>Initiative</th>
                    <th>Target Audience</th>
                    <th>School System</th>
                    <th>School</th>
                    <th>Curriculum Area</th>
                    <th>Consultant</th>
                    <th>Current Enrollment</th>
                    <th>Target Enrollment</th>
                    <th>Status</th>
                </tr>
            </tfoot>
        </table>
<?php
    }
    else
    {
        echo "<p><h3>You are not authorized to view this report.</h3></p>";
        echo "<p><a href='../../UserLogin.php'>User Login</a></p>";
        echo "<p><a href='../../UserLogout.php'>User Logout</a></p>";
        echo "<p><a href='../../../Home.html'>Home Page</a></p>";
    }
?>
    </body>
</html>

<?php
    mysqli_close($mysqli);
?>