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
            <br><br>
            <table id="school_and_system_report_table" class="display table-responsive" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th class="system_name">System Name</th>
                        <th class="curriculum">Category</th>
                        <th class="program_title">Program Title</th>
                        <th class="school">School</th>
                        <th class="initiative">Initiative</th>
                        <th class="consultatnt_fee">Total Consultant Fees</th>
                        <th class="misc_fees">Total Misc Expenses</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    
                        $sql = "SELECT * 
                                FROM school_and_system_report_data 
                                WHERE report_date BETWEEN '$from_date' AND '$to_date'";

                        if ($result = mysqli_query($mysqli, $sql))
                        {
                            while ($row = mysqli_fetch_row($result))
                            {
                                $consultatnt_fees = number_format((float)$row[7], 2, '.', '');
                                $misc_expenses = number_format((float)$row[8], 2, '.', '');
                                
                                echo
                                    "<tr>"
                                    ."<td>". $row[2] ."</td>"                 // System
                                    ."<td>". $row[3] ."</td>"                 // Category
                                    ."<td>". $row[4] ."</td>"                 // Program Title
                                    ."<td>". $row[5] ."</td>"                 // School
                                    ."<td>". $row[6] ."</td>"                 // Initiative
                                    ."<td>$". $consultatnt_fees  ."</td>";    // Consultant Fees

                                if ($row[8] == NULL)
                                {
                                    echo "<td>$0.00</td>"                     // Misc Expenses   
                                         ."</tr>";
                                } 
                                else 
                                {
                                   echo "<td>$" . $misc_expenses ."</td>"     // Misc Expenses
                                        ."</tr>";
                                } 
                            }
                        }
                    ?>
                </tbody>
                <tfoot>
                        <th class="system_name">System Name</th>
                        <th class="curriculum">Category</th>
                        <th class="program_title">Program Title</th>
                        <th class="school">School</th>
                        <th class="initiative">Initiative</th>
                        <th class="consultatnt_fee">Total Consultant Fees</th>
                        <th class="misc_fees">Total Misc Expenses</th>
                    </tr>
                </tfoot>
            </table>
            <br><br><br>
            <h4>Consultant Fees and Misc Fees are totals. To see the detailed breakdown print the PDF report.</h4>
        </div>
    </body>
</html>

<?php
    mysqli_close($mysqli);
?>