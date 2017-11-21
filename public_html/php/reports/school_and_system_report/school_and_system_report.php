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
        <title>School and System Report</title>
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
            <h3>School and System Report</h3>
            <br><br>
            <table id="school_and_system_report_table" class="display cell-border table-responsive" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>System Name</th>
                        <th>Curriculum</th>
                        <th>Program Number</th>
                        <th>Program Title</th>
                        <th>School</th>
                        <th>Initiative</th>
                        <th>Attendance</th>
                        <th>Total Expenses</th>
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
                                echo
                                    "<tr>"
                                    ."<td>". $row[2] ."</td>"   // System
                                    ."<td>". $row[3] ."</td>"   // Curriculum
                                    ."<td>". $row[4] ."</td>"   // Program Number                                   
                                    ."<td>". $row[5] ."</td>"   // Program Title
                                    ."<td>". $row[6] ."</td>"   // School
                                    ."<td>". $row[7] ."</td>"   // Initiative
                                    ."<td>". $row[8] ."</td>";  // Actual Attendance


                                if ($row[9] == NULL)
                                {
                                    echo "<td>$0.00</td>"  //Total Expenses   
                                         ."</tr>";
                                } 
                                else 
                                {
                                    $total_expenses = number_format((float)$row[9], 2, '.', '');
                                    echo "<td>$" . $total_expenses . "</td>"  // Total Expenses
                                         ."</tr>";
                                } 
                            }
                        }
                    ?>
                </tbody>
                <tfoot>
                        <th>System Name</th>
                        <th>Curriculum</th>
                        <th>Program Number</th>
                        <th>Program Title</th>
                        <th>School</th>
                        <th>Initiative</th>
                        <th>Attendance</th>
                        <th>Total Expenses</th>
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