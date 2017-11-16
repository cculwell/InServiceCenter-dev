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
        <title>Initiative Report</title>
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

        <script src="js/reports/initiative_report.js"></script>
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
            <h3>Initiative Report</h3>
            <br><br>
            <table id="initiative_report_table" class="display table-responsive" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th class="initiative">Initiative</th>
                        <th class="curriculum">Biology</th>
                        <th class="curriculum">Chemistry</th>
                        <th class="curriculum">English/Language Arts</th>
                        <th class="curriculum">Technology</th>
                        <th class="curriculum">Career Tech</th>
                        <th class="curriculum">Counseling</th>
                        <th class="curriculum">Climate and Culture</th>
                        <th class="curriculum">Effective Instruction</th>
                        <th class="curriculum">Fine Arts</th>
                        <th class="curriculum">Foreign Language</th>
                        <th class="curriculum">Gifted</th>
                        <th class="curriculum">Interdisciplinary</th>
                        <th class="curriculum">Leadership</th>
                        <th class="curriculum">Library Media Services</th>
                        <th class="curriculum">Mathematics</th>
                        <th class="curriculum">NBCT</th>
                        <th class="curriculum">Physics</th>
                        <th class="curriculum">Physical Education</th>
                        <th class="curriculum">Science</th>
                        <th class="curriculum">Social Studies</th>
                        <th class="curriculum">Special Education</th>
                        <th class="curriculum">Other</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                        $sql = "SELECT * 
                                FROM initiative_report_data 
                                WHERE report_date BETWEEN '$from_date' AND '$to_date'";
                        
                        if ($result = mysqli_query($mysqli, $sql))
                        {
                            while ($row = mysqli_fetch_row($result))
                            {
                                echo
                                    "<tr>"
                                    ."<td>". $row[2] ."</td>"    // Initiative
                                    ."<td>". $row[3] ."</td>"    // Biology
                                    ."<td>". $row[4] ."</td>"    // Chemistry
                                    ."<td>". $row[5] ."</td>"    // English/Language Arts
                                    ."<td>". $row[6] ."</td>"    // Technology
                                    ."<td>". $row[7] ."</td>"    // Career Tech
                                    ."<td>". $row[8] ."</td>"    // Counseling
                                    ."<td>". $row[9] ."</td>"    // Climate and Culture
                                    ."<td>". $row[10] ."</td>"    // Effective Instruction
                                    ."<td>". $row[11] ."</td>"   // Fine Arts
                                    ."<td>". $row[12] ."</td>"   // Foreign Language
                                    ."<td>". $row[13] ."</td>"   // Gifted
                                    ."<td>". $row[14] ."</td>"   // Interdisciplinary
                                    ."<td>". $row[15] ."</td>"   // Leadership
                                    ."<td>". $row[16] ."</td>"   // Library Media Services
                                    ."<td>". $row[17] ."</td>"   // Mathematics
                                    ."<td>". $row[18] ."</td>"   // NBCT
                                    ."<td>". $row[19] ."</td>"   // Physics
                                    ."<td>". $row[20] ."</td>"   // Physical Education
                                    ."<td>". $row[21] ."</td>"   // Science
                                    ."<td>". $row[22] ."</td>"   // Social Studies
                                    ."<td>". $row[23] ."</td>"   // Special Education
                                    ."<td>". $row[24] ."</td>"   // Other
                                    ."</tr>";
                            }
                        }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th class="initiative">Initiative</th>
                        <th class="curriculum">Biology</th>
                        <th class="curriculum">Chemistry</th>
                        <th class="curriculum">English/Language Arts</th>
                        <th class="curriculum">Technology</th>
                        <th class="curriculum">Career Tech</th>
                        <th class="curriculum">Counseling</th>
                        <th class="curriculum">Climate and Culture</th>
                        <th class="curriculum">Effective Instruction</th>
                        <th class="curriculum">Fine Arts</th>
                        <th class="curriculum">Foreign Language</th>
                        <th class="curriculum">Gifted</th>
                        <th class="curriculum">Interdisciplinary</th>
                        <th class="curriculum">Leadership</th>
                        <th class="curriculum">Library Media Services</th>
                        <th class="curriculum">Mathematics</th>
                        <th class="curriculum">NBCT</th>
                        <th class="curriculum">Physics</th>
                        <th class="curriculum">Physical Education</th>
                        <th class="curriculum">Science</th>
                        <th class="curriculum">Social Studies</th>
                        <th class="curriculum">Special Education</th>
                        <th class="curriculum">Other</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </body>
</html>

<?php
    mysqli_close($mysqli);
?>