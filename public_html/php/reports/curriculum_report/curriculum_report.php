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

        <script src="../resources/library/jquery-3.2.1.min.js"></script>
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
            <?php
                echo "<h5>" . "From: " . $from_date . "</h5>";
                echo "<h5>" . "To:   " . $to_date . "</h5>";
            ?>
            <br><br>
            <table id="curriculum_report_table" class="display table-responsive" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th class="curriculum">Curriculum</th>
                        <th class="initiative">AMSTI</th>
                        <th class="initiative">ASIM</th>
                        <th class="initiative">TIM</th>
                        <th class="initiative">Inservice</th>
                        <th class="initiative">ALSDE</th>
                        <th class="initiative">LEA</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                        $curriculums = array('Biology', 'Chemistry', 'English/Language Arts', 'Technology', 
                                             'Career Tech', 'Counseling', 'Climate and Culture', 'Effective Instruction', 
                                             'Fine Arts', 'Foreign Language', 'Gifted', 'Interdisciplinary', 'Leadership', 
                                             'Library Media Services', 'Mathematics', 'NBCT', 'Physics', 
                                             'Physical Education', 'Science', 'Social Studies', 'Special Education', 
                                             'Other');


                        $sql = "SELECT * 
                                FROM curriculum_report_data 
                                WHERE report_date BETWEEN '$from_date' AND '$to_date'";

                        if ($result = mysqli_query($mysqli, $sql))
                        {
                            while ($row = mysqli_fetch_row($result))
                            {
                                echo
                                    "<tr>"
                                    ."<td>". $row[2]  ."</td>"       // Curriculum
                                    ."<td>". $row[3]  ."</td>"       // AMSTI
                                    ."<td>". $row[4]  ."</td>"       // ASIM
                                    ."<td>". $row[5]  ."</td>"       // TIM
                                    ."<td>". $row[6]  ."</td>"       // Inservice
                                    ."<td>". $row[7]  ."</td>"       // ALSDE
                                    ."<td>". $row[8]  ."</td>"       // LEA
                                    ."</tr>";

                                // Remove the curriculum from the array to indicate we 
                                // already have it
                                $pos = array_search($row[2], $curriculums);
                                array_splice($curriculums, $pos, 1);
                            }
                        }

                        // Add missing curriculums to the table
                        $max = sizeof($curriculums);
                        for($i = 0; $i < $max; $i++)
                        {
                            echo
                                "<tr>"
                                ."<td>". $curriculums[$i]  ."</td>"   // Curriculum
                                ."<td>0</td>"                         // AMSTI
                                ."<td>0</td>"                         // ASIM
                                ."<td>0</td>"                         // TIM
                                ."<td>0</td>"                         // Inservice
                                ."<td>0</td>"                         // ALSDE
                                ."<td>0</td>"                         // LEA
                                ."</tr>";
                        }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th class="curriculum">Curriculum</th>
                        <th class="initiative">AMSTI</th>
                        <th class="initiative">ASIM</th>
                        <th class="initiative">TIM</th>
                        <th class="initiative">Inservice</th>
                        <th class="initiative">ALSDE</th>
                        <th class="initiative">LEA</th>
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