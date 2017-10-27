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
?>

<!DOCTYPE html>
<html class="no-js" lang="en" dir="ltr">

    <head>
        <title>Financial Report</title>
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

        <!-- Tables -- >
        <script src="../resources/library/DataTables/datatables.js"></script>

        <!-- Buttons -->
        <script src="../resources/library/DataTables/js/jquery.dataTables.min.js"></script>
        <script src="../resources/library/DataTables/Buttons/js/dataTables.buttons.min.js"></script>

        <!-- Print button --> 
        <script src="../resources/library/DataTables/Buttons/js/buttons.print.min.js"></script>

        <!-- PDF Button -->
        <script src="../resources/library/DataTables/Buttons/js/buttons.html5.min.js"></script>
        <script src="../resources/library/DataTables/Buttons/js/pdfmake.min.js"></script>
        <script src="../resources/library/DataTables/Buttons/js/vfs_fonts.js"></script>

        <!-- Column Visibility Button -->
        <script src="../resources/library/DataTables/Buttons/js/buttons.colVis.min.js"></script>

    </head>
    <body>
        <div class="page_container">
            <h2 style="text-align: center;">Athens State University<br>Regional In-Service Center</h2>
            <h3 style="text-align: center;">Financial Report</h3>
            <h4 id="term-and-year" style="text-align: center; font-style: italic;"></h4><br><br>
            <table id="financial_report_table" class="display compact table-responsive" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Program ID</th>
                        <th>Program Title</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Number of Sessions</th>
                        <th>Location</th>
                        <th>Support Provided By</th>
                        <th>Target Audience</th>
                        <th>Current Enrollment</th>
                        <th>Maximum Enrollment</th>
                        <th>Consultant Fee</th>
                        <th>Misc Fees</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                        $sql = "SELECT * FROM financial_report_data";

                        if ($result = mysqli_query($mysqli, $sql))
                        {
                            while ($row = mysqli_fetch_row($result))
                            {
                                echo
                                    "<tr>"
                                    ."<td>". $row[1] ."</td>"   // Program ID
                                    ."<td>". $row[2] ."</td>"   // Program Title
                                    ."<td>". $row[3] ."</td>"   // Start Date
                                    ."<td>". $row[5] ."</td>"   // End Date
                                    ."<td>". $row[4] ."</td>"   // Start Time
                                    ."<td>". $row[6] ."</td>"   // End Time
                                    ."<td>". $row[12] ."</td>"  // Number of Sessions
                                    ."<td>". $row[7] ."</td>"   // Location
                                    ."<td>". $row[11] ."</td>"  // Support Provided By
                                    ."<td>". $row[13] ."</td>"  // Target Audience
                                    ."<td>". $row[9] ."</td>"   // Current Enrollment
                                    ."<td>". $row[8] ."</td>"   // Max Enrollment
                                    ."<td>". $row[14] ."</td>"  // Consultant Fee                                    
                                    ."<td>". $row[15] ."</td>"  // Misc Expenses
                                    ."</tr>";
                            }
                        }
                    ?>
                </tbody>
                <tfoot align="right">
                    <tr>
                        <th style="border-top: none;"></th>
                        <th style="border-top: none;"></th>
                        <th style="border-top: none;"></th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <script type="text/javascript" src="js/reports/financial_report.js"></script>
    </body>
</html>

<?php
    mysqli_close($mysqli);
?>