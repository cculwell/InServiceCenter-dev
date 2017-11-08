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
            <?php
                $month = date('m');
                $year = date('Y');
                $semester = "";

                // Determine semester based on current month
                if ($month >= 1 && $month <=4) {
                    $semester = "Spring" . " " . $year;
                }
                if ($month >= 5 && $month <=7) {
                    $semester = "Summer" . " " . $year;
                }
                if ($month >= 8 && $month <=12) {
                    $semester = "Fall" . " " . $year;
                }

                echo "<h4>" . $semester . "</h4>";
            ?>
            <br><br>
            <table id="financial_report_table" class="display table-responsive" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th class="program_id">Program ID</th>
                        <th class="program_title">Program Title</th>
                        <th class="start_date">Start Date</th>
                        <th class="end_date">End Date</th>
                        <th class="start_time">Start Time</th>
                        <th class="end_time">End Time</th>
                        <th class="num_sessions">Number of Sessions</th>
                        <th class="location">Location</th>
                        <th class="support_provided">Support Provided By</th>
                        <th class="target_audience">Target Audience</th>
                        <th class="current_enrollment">Current Enrollment</th>
                        <th class="max_enrollment">Maximum Enrollment</th>
                        <th class="consultant_fee">Consultant Fees</th>
                        <th class="misc_fees">Misc Fees</th>
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
                                    ."<td>". $row[1]  ."</td>"                    // Program ID
                                    ."<td>". $row[2]  ."</td>"                    // Program Title
                                    ."<td>". $row[3]  ."</td>"                    // Start Date
                                    ."<td>". $row[5]  ."</td>"                    // End Date
                                    ."<td>". $row[4]  ."</td>"                    // Start Time
                                    ."<td>". $row[6]  ."</td>"                    // End Time
                                    ."<td>". $row[12] ."</td>"                    // Number of Sessions
                                    ."<td class='location'>". $row[7]  ."</td>"   // Location
                                    ."<td>". $row[11] ."</td>"                    // Support Provided By
                                    ."<td>". $row[13] ."</td>"                    // Target Audience
                                    ."<td>". $row[9]  ."</td>"                    // Current Enrollment
                                    ."<td>". $row[8]  ."</td>"                    // Max Enrollment
                                    ."<td>". "$" . $row[14] ."</td>"              // Consultant Fee                                    
                                    ."<td>". "$" . $row[15] ."</td>"              // Misc Expenses
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
                        <th class="num_sessions">Number of Sessions</th>
                        <th class="location">Location</th>
                        <th class="support_provided">Support Provided By</th>
                        <th class="target_audience">Target Audience</th>
                        <th class="current_enrollment">Current Enrollment</th>
                        <th class="max_enrollment">Maximum Enrollment</th>
                        <th class="consultant_fee">Consultant Fees</th>
                        <th class="misc_fees">Misc Fees</th>
                    </tr>
                </tfoot>
            </table>
            <br><br>
            <table>
                <col width="200">
                <col width="80">
                <col width="80">
                <thead>
                    <tr>
                        <th style="font-weight: bold;
                                   font-size: 14;
                                   text-align: center;
                                   text-decoration: underline;"
                            colspan="2">Fee Totals</th>
                    </tr>
                </thead>
                <?php
                    // Get total consultant fees
                    $sql = "SELECT SUM(consultant_fee) AS total_consultant_fees FROM financial_report_data";
                    $consultant_fee_result = mysqli_query($mysqli, $sql); 
                    $row = mysqli_fetch_assoc($consultant_fee_result); 
                    $consultant_fees = $row['total_consultant_fees'];

                    // Get total misc fees
                    $sql = "SELECT SUM(misc_fee) AS total_misc_fees FROM financial_report_data";
                    $misc_fees_result = mysqli_query($mysqli, $sql); 
                    $row = mysqli_fetch_assoc($misc_fees_result); 
                    $misc_fees = $row['total_misc_fees'];

                    $total_fees = (float)$consultant_fees + (float)$misc_fees;

                    echo
                        "<tr>"
                        ."<td style='font-weight: bold; text-align: left;'>Total Consultant Fees:</td>"
                        ."<td>$". $consultant_fees  ."</td>"
                        ."</tr>"
                        ."<tr>"
                        ."<td style='font-weight: bold; text-align: left;'>Total Misc. Fees:</td>"
                        ."<td>$". $misc_fees  ."</td>"
                        ."</tr>"
                        ."<tr>"
                        ."<td style='font-weight: bold; text-align: left;'>Total Fees:</td>"
                        ."<td>$". $total_fees ."</td>"
                        ."</tr>"
                ?>
            </table>
        </div>
    </body>
</html>

<?php
    mysqli_close($mysqli);
?>