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
        <title>Curriculum Report</title>
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

        <script src="js/reports/curriculum_report.js"></script>
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
            <h3>Curriculum Report</h3>
            <br><br>
            <table id="curriculum_report_table" class="display cell-border table-responsive" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Curriculum</th>
                        <th>AMSTI</th>
                        <th>ASIM</th>
                        <th>TIM</th>
                        <th>RIC</th>
                        <th>ALSDE</th>
                        <th>LEA</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                        $sql = "SELECT DISTINCT(c.curriculum),
                                       SUM(c.amsti), 
                                       SUM(c.asim), 
                                       SUM(c.tim), 
                                       SUM(c.ric), 
                                       SUM(c.alsde), 
                                       SUM(c.lea) 
                                FROM curriculum_report_data c 
                                WHERE c.report_date BETWEEN '$from_date' AND '$to_date'
                                GROUP BY c.curriculum";

                        if ($result = mysqli_query($mysqli, $sql))
                        {
                            while ($row = mysqli_fetch_row($result))
                            {
                                echo
                                    "<tr>"
                                    ."<td>". $row[0]  ."</td>"       // Curriculum
                                    ."<td>". $row[1]  ."</td>"       // AMSTI
                                    ."<td>". $row[2]  ."</td>"       // ASIM
                                    ."<td>". $row[3]  ."</td>"       // TIM
                                    ."<td>". $row[4]  ."</td>"       // RIC
                                    ."<td>". $row[5]  ."</td>"       // ALSDE
                                    ."<td>". $row[6]  ."</td>"       // LEA
                                    ."</tr>";
                            }
                        }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Curriculum</th>
                        <th>AMSTI</th>
                        <th>ASIM</th>
                        <th>TIM</th>
                        <th>RIC</th>
                        <th>ALSDE</th>
                        <th>LEA</th>
                    </tr>
                    </tr>
                </tfoot>
            </table>
        </div>
    </body>
</html>

<?php
    mysqli_close($mysqli);
?>