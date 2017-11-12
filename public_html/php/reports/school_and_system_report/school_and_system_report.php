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
        <title>School and System Served Report</title>
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
        <script src="js/reports/school_and_system.js"></script>
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
            <h3>School and System Served Report</h3>
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
            <table id="school_and_system_report_table" class="display table-responsive" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th class="system_name">System Name</th>
                        <th class="offerings_per_system">Total PD Offerings Per System</th>
                        <th class="total_spent_per_system">Total Spent Per System</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                        $do_work = "r.system, COUNT(r.system), SUM(r.total_cost)";
                        $from = "requests r";
                        $join = "quick_report_data AS q";
                        $on = "r.request_id = q.request_id";
                        $groub_by = "r.system";

                        $sql = "SELECT $do_work FROM $from JOIN $join ON $on GROUP BY $groub_by";

                        if ($result = mysqli_query($mysqli, $sql))
                        {
                            while ($row = mysqli_fetch_row($result))
                            {
                                echo
                                    "<tr>"
                                    ."<td>". $row[0] ."</td>"         // System
                                    ."<td>". $row[1] ."</td>"         // Total Offerings
                                    ."<td>". "$" . $row[2] ."</td>"   // Total Spent
                                    ."</tr>";
                            }
                        }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th class="system_name">System Name</th>
                        <th class="offerings_per_system">Total PD Offerings Per System</th>
                        <th class="total_spent_per_system">Total Spent Per System</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </body>
</html>

<?php
    mysqli_close($mysqli);
?>