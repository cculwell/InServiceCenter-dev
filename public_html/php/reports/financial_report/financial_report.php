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

        <script src="js/reports/financial_report.js"></script>
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
            <h3>Financial Report</h3>
            <br><br>
            <table id="financial_report_table" class="display table-responsive" cellspacing="0" width="100%">
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
                        <th>Current Enrollment</th>
                        <th>Maximum Enrollment</th>
                        <th>Target Enrollment</th>
                        <th>Total Expenses</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                        $sql = "SELECT * 
                                FROM financial_report_data 
                                WHERE report_date BETWEEN '$from_date' AND '$to_date'";

                        if ($result = mysqli_query($mysqli, $sql))
                        {
                            while ($row = mysqli_fetch_row($result))
                            {
                                $total_expenses = number_format((float)$row[16], 2, '.', '');

                                echo
                                    "<tr>"
                                    ."<td>". $row[2]  ."</td>"                  // Program ID
                                    ."<td>". $row[3]  ."</td>"                  // STI ID
                                    ."<td>". $row[4]  ."</td>"                  // Program Title
                                    ."<td>". $row[5]  ."</td>"                  // Start Date
                                    ."<td>". $row[6]  ."</td>"                  // End Date
                                    ."<td>". $row[7]  ."</td>"                  // Start Time
                                    ."<td>". $row[8]  ."</td>"                  // End Time
                                    ."<td>". $row[9]  ."</td>"                  // Number of Sessions
                                    ."<td>". $row[10] ."</td>"                  // Location
                                    ."<td>". $row[11] ."</td>"                  // Initiative
                                    ."<td>". $row[12] ."</td>"                  // Target Audience
                                    ."<td>". $row[13] ."</td>"                  // School System
                                    ."<td>". $row[14] ."</td>"                  // Current Enrollment
                                    ."<td>". $row[15] ."</td>"                  // Maximum Enrollment
                                    ."<td>". $row[16] ."</td>";                 // Max Enrollment     

                                if ($row[16] == NULL)
                                {
                                    echo "<td>$0.00</td>"                       // Total Expenses  
                                         ."<td>". $row[17] ."</td>"             // Status
                                         ."</tr>";
                                } 
                                else 
                                {
                                   echo "<td>". "$" . $total_expenses ."</td>"  // Total Expenses
                                         ."<td>". $row[17] ."</td>"             // Status
                                         ."</tr>";
                                }                            
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
                        <th>Current Enrollment</th>
                        <th>Maximum Enrollment</th>
                        <th>Target Enrollment</th>
                        <th>Total Expenses</th>
                        <th>Status</th>
                    </tr>
                </tfoot>
            </table>
            <br><br><br>
            <h4>Total fees are a sum of all fees. To see a detailed breakdown print the PDF report.</h4>
        </div>
    </body>
</html>

<?php
    mysqli_close($mysqli);
?>