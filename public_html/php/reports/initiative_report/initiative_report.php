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
            <table id="initiative_report_table" class="display cell-border table-responsive" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Initiative</th>
                        <th>Total Programs</th>
                        <th>Biology Programs</th>
                        <th>Biology Participants</th>
                        <th>Biology Sessions</th>
                        <th>Chemistry Programs</th>
                        <th>Chemistry Participants</th>
                        <th>Chemistry Sessions</th>
                        <th>English/Language Arts Programs</th>
                        <th>English/Language Participants</th>
                        <th>English/Language Sessions</th>
                        <th>Technology Programs</th>
                        <th>Technology Participants</th>
                        <th>Technology Sessions</th>
                        <th>Career Tech Programs</th>
                        <th>Career Tech Participants</th>
                        <th>Career Tech Sessions</th>
                        <th>Counseling Programs</th>
                        <th>Counseling Participants</th>
                        <th>Counseling Sessions</th>                        
                        <th>Climate and Culture Programs</th>
                        <th>Climate and Culture Participants</th>
                        <th>Climate and Culture Sessions</th>                          
                        <th>Effective Instruction Programs</th>
                        <th>Effective Instruction Participants</th>
                        <th>Effective Instruction Sessions</th> 
                        <th>Fine Arts Programs</th>
                        <th>Fine Arts Participants</th>
                        <th>Fine Arts Sessions</th>
                        <th>Foreign Language Programs</th>
                        <th>Foreign Language Participants</th>
                        <th>Foreign Language Sessions</th>
                        <th>Gifted Programs</th>
                        <th>Gifted Participants</th>
                        <th>Gifted Sessions</th>
                        <th>Interdisciplinary Programs</th>
                        <th>Interdisciplinary Participants</th>
                        <th>Interdisciplinary Sessions</th>
                        <th>Leadership Programs</th>
                        <th>Leadership Participants</th>
                        <th>Leadership Sessions</th>
                        <th>Library Media Services Programs</th>
                        <th>Library Media Services Participants</th>
                        <th>Library Media Services Sessions</th>
                        <th>Mathematics Programs</th>
                        <th>Mathematics Participants</th>
                        <th>Mathematics Sessions</th>
                        <th>NBCT Programs</th>
                        <th>NBCT Participants</th>
                        <th>NBCT Sessions</th>
                        <th>Physics Programs</th>
                        <th>Physics Participants</th>
                        <th>Physics Sessions</th>
                        <th>Physical Education Programs</th>
                        <th>Physical Education Participants</th>
                        <th>Physical Education Sessions</th>
                        <th>Science Programs</th>
                        <th>Science Participants</th>
                        <th>Science Sessions</th>
                        <th>Social Studies Programs</th>
                        <th>Social Studies Participants</th>
                        <th>Social Studies Sessions</th>
                        <th>Special Education Programs</th>
                        <th>Special Education Participants</th>
                        <th>Special Education Sessions</th>
                        <th>Other Programs</th>
                        <th>Other Participants</th>
                        <th>Other Sessions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                        // $sql = "SELECT * 
                        //         FROM initiative_report_data 
                        //         WHERE report_date BETWEEN '$from_date' AND '$to_date'";

                        $sql = "SELECT DISTINCT(i.support_initiative),
                                       SUM(i.total_programs),
                                       SUM(i.biology),
                                       SUM(i.biology_participants),
                                       SUM(i.biology_sessions),    
                                       SUM(i.chemistry),
                                       SUM(i.chemistry_participants),
                                       SUM(i.chemistry_sessions),      
                                       SUM(i.english_language_arts),
                                       SUM(i.english_language_arts_participants),
                                       SUM(i.english_language_arts_sessions),      
                                       SUM(i.technology),
                                       SUM(i.technology_participants),
                                       SUM(i.technology_sessions),         
                                       SUM(i.career_tech),
                                       SUM(i.career_tech_participants),
                                       SUM(i.career_tech_sessions),        
                                       SUM(i.counseling),
                                       SUM(i.counseling_participants),
                                       SUM(i.counseling_sessions),         
                                       SUM(i.climate_and_culture),
                                       SUM(i.climate_and_culture_participants),
                                       SUM(i.climate_and_culture_sessions),            
                                       SUM(i.effective_instruction),
                                       SUM(i.effective_instruction_participants),
                                       SUM(i.effective_instruction_sessions),      
                                       SUM(i.fine_arts),
                                       SUM(i.fine_arts_participants),
                                       SUM(i.fine_arts_sessions),      
                                       SUM(i.foreign_language),
                                       SUM(i.foreign_language_participants),
                                       SUM(i.foreign_language_sessions),           
                                       SUM(i.gifted),
                                       SUM(i.gifted_participants),
                                       SUM(i.gifted_sessions),         
                                       SUM(i.interdisciplinary),
                                       SUM(i.interdisciplinary_participants),
                                       SUM(i.interdisciplinary_sessions),              
                                       SUM(i.leadership),
                                       SUM(i.leadership_participants),
                                       SUM(i.leadership_sessions),         
                                       SUM(i.library_media_services),
                                       SUM(i.library_media_services_participants),
                                       SUM(i.library_media_services_sessions),         
                                       SUM(i.mathematics),
                                       SUM(i.mathematics_participants),
                                       SUM(i.mathematics_sessions),            
                                       SUM(i.nbct),
                                       SUM(i.nbct_participants),
                                       SUM(i.nbct_sessions),       
                                       SUM(i.physics),
                                       SUM(i.physics_participants),
                                       SUM(i.physics_sessions),        
                                       SUM(i.physical_education),
                                       SUM(i.physical_education_participants),
                                       SUM(i.physical_education_sessions),     
                                       SUM(i.science),
                                       SUM(i.science_participants),
                                       SUM(i.science_sessions),            
                                       SUM(i.social_studies),
                                       SUM(i.social_studies_participants),
                                       SUM(i.social_studies_sessions),     
                                       SUM(i.special_education),
                                       SUM(i.special_education_participants),
                                       SUM(i.special_education_sessions),      
                                       SUM(i.other),
                                       SUM(i.other_participants),
                                       SUM(i.other_sessions) 
                                FROM initiative_report_data i
                                WHERE i.report_date BETWEEN '$from_date' AND '$to_date'
                                GROUP BY i.support_initiative";
                        
                        if ($result = mysqli_query($mysqli, $sql))
                        {
                            while ($row = mysqli_fetch_row($result))
                            {
                                echo
                                    "<tr>"
                                    ."<td>". $row[0]."</td>"      // Initiative
                                    ."<td>". $row[1]."</td>"      // Total Programs
                                    ."<td>". $row[2] ."</td>"     // Biology
                                    ."<td>". $row[3] ."</td>"     // Biology Participants
                                    ."<td>". $row[4] ."</td>"     // Biology Sessions
                                    ."<td>". $row[5] ."</td>"     // Chemistry
                                    ."<td>". $row[6] ."</td>"     // Chemistry Participants
                                    ."<td>". $row[7] ."</td>"     // Chemistry Sessions
                                    ."<td>". $row[8] ."</td>"     // English/Language Arts
                                    ."<td>". $row[9] ."</td>"     // English/Language Participants
                                    ."<td>". $row[10] ."</td>"     // English/Language Sessions
                                    ."<td>". $row[11] ."</td>"    // Technology
                                    ."<td>". $row[12] ."</td>"    // Technology Participants
                                    ."<td>". $row[13] ."</td>"    // Technology Sessions
                                    ."<td>". $row[14] ."</td>"    // Career Tech
                                    ."<td>". $row[15] ."</td>"    // Career Tech Participants
                                    ."<td>". $row[16] ."</td>"    // Career Tech Sessions
                                    ."<td>". $row[17] ."</td>"    // Counseling
                                    ."<td>". $row[18] ."</td>"    // Counseling Participants
                                    ."<td>". $row[19] ."</td>"    // Counseling Sessions
                                    ."<td>". $row[20] ."</td>"    // Climate and Culture
                                    ."<td>". $row[21] ."</td>"    // Climate and Culture Participants
                                    ."<td>". $row[22] ."</td>"    // Climate and Culture Sessions
                                    ."<td>". $row[23] ."</td>"    // Effective Instruction
                                    ."<td>". $row[24] ."</td>"    // Effective Instruction Participants
                                    ."<td>". $row[25] ."</td>"    // Effective Instruction Sessions
                                    ."<td>". $row[26] ."</td>"    // Fine Arts
                                    ."<td>". $row[27] ."</td>"    // Fine Arts Participants
                                    ."<td>". $row[28] ."</td>"    // Fine Arts Sessions
                                    ."<td>". $row[29] ."</td>"    // Foreign Language
                                    ."<td>". $row[30] ."</td>"    // Foreign Language Participants
                                    ."<td>". $row[31] ."</td>"    // Foreign Language Sessions
                                    ."<td>". $row[32] ."</td>"    // Gifted
                                    ."<td>". $row[33] ."</td>"    // Gifted Participants
                                    ."<td>". $row[34] ."</td>"    // Gifted Sessions
                                    ."<td>". $row[35] ."</td>"    // Interdisciplinary
                                    ."<td>". $row[36] ."</td>"    // Interdisciplinary Participants
                                    ."<td>". $row[37] ."</td>"    // Interdisciplinary Sessions
                                    ."<td>". $row[38] ."</td>"    // Leadership
                                    ."<td>". $row[39] ."</td>"    // Leadership Participants
                                    ."<td>". $row[40] ."</td>"    // Leadership Sessions
                                    ."<td>". $row[41] ."</td>"    // Library Media Services
                                    ."<td>". $row[42] ."</td>"    // Library Media Services Participants
                                    ."<td>". $row[43] ."</td>"    // Library Media Services Sessions
                                    ."<td>". $row[44] ."</td>"    // Mathematics
                                    ."<td>". $row[45] ."</td>"    // Mathematics Participants
                                    ."<td>". $row[46] ."</td>"    // Mathematics Sessions
                                    ."<td>". $row[47] ."</td>"    // NBCT
                                    ."<td>". $row[48] ."</td>"    // NBCT Participants
                                    ."<td>". $row[49] ."</td>"    // NBCT Sessions
                                    ."<td>". $row[50] ."</td>"    // Physics
                                    ."<td>". $row[51] ."</td>"    // Physics Participants
                                    ."<td>". $row[52] ."</td>"    // Physics Sessions
                                    ."<td>". $row[53] ."</td>"    // Physical Education
                                    ."<td>". $row[54] ."</td>"    // Physical Education Participants
                                    ."<td>". $row[55] ."</td>"    // Physical Education Sessions
                                    ."<td>". $row[56] ."</td>"    // Science
                                    ."<td>". $row[57] ."</td>"    // Science Participants
                                    ."<td>". $row[58] ."</td>"    // Science Sessions
                                    ."<td>". $row[59] ."</td>"    // Social Studies
                                    ."<td>". $row[60] ."</td>"    // Social Studies Participants
                                    ."<td>". $row[61] ."</td>"    // Social Studies Sessions
                                    ."<td>". $row[62] ."</td>"    // Special Education
                                    ."<td>". $row[63] ."</td>"    // Special Education Participants
                                    ."<td>". $row[64] ."</td>"    // Special Education Sessions
                                    ."<td>". $row[65] ."</td>"    // Other
                                    ."<td>". $row[66] ."</td>"    // Other Participants
                                    ."<td>". $row[67] ."</td>"    // Other Sessions
                                    ."</tr>";
                            }
                        }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>Initiative</th>
                        <th>Total Programs</th>
                        <th>Biology Programs</th>
                        <th>Biology Participants</th>
                        <th>Biology Sessions</th>
                        <th>Chemistry Programs</th>
                        <th>Chemistry Participants</th>
                        <th>Chemistry Sessions</th>
                        <th>English/Language Arts Programs</th>
                        <th>English/Language Participants</th>
                        <th>English/Language Sessions</th>
                        <th>Technology Programs</th>
                        <th>Technology Participants</th>
                        <th>Technology Sessions</th>
                        <th>Career Tech Programs</th>
                        <th>Career Tech Participants</th>
                        <th>Career Tech Sessions</th>
                        <th>Counseling Programs</th>
                        <th>Counseling Participants</th>
                        <th>Counseling Sessions</th>                        
                        <th>Climate and Culture Programs</th>
                        <th>Climate and Culture Participants</th>
                        <th>Climate and Culture Sessions</th>                          
                        <th>Effective Instruction Programs</th>
                        <th>Effective Instruction Participants</th>
                        <th>Effective Instruction Sessions</th> 
                        <th>Fine Arts Programs</th>
                        <th>Fine Arts Participants</th>
                        <th>Fine Arts Sessions</th>
                        <th>Foreign Language Programs</th>
                        <th>Foreign Language Participants</th>
                        <th>Foreign Language Sessions</th>
                        <th>Gifted Programs</th>
                        <th>Gifted Participants</th>
                        <th>Gifted Sessions</th>
                        <th>Interdisciplinary Programs</th>
                        <th>Interdisciplinary Participants</th>
                        <th>Interdisciplinary Sessions</th>
                        <th>Leadership Programs</th>
                        <th>Leadership Participants</th>
                        <th>Leadership Sessions</th>
                        <th>Library Media Services Programs</th>
                        <th>Library Media Services Participants</th>
                        <th>Library Media Services Sessions</th>
                        <th>Mathematics Programs</th>
                        <th>Mathematics Participants</th>
                        <th>Mathematics Sessions</th>
                        <th>NBCT Programs</th>
                        <th>NBCT Participants</th>
                        <th>NBCT Sessions</th>
                        <th>Physics Programs</th>
                        <th>Physics Participants</th>
                        <th>Physics Sessions</th>
                        <th>Physical Education Programs</th>
                        <th>Physical Education Participants</th>
                        <th>Physical Education Sessions</th>
                        <th>Science Programs</th>
                        <th>Science Participants</th>
                        <th>Science Sessions</th>
                        <th>Social Studies Programs</th>
                        <th>Social Studies Participants</th>
                        <th>Social Studies Sessions</th>
                        <th>Special Education Programs</th>
                        <th>Special Education Participants</th>
                        <th>Special Education Sessions</th>
                        <th>Other Programs</th>
                        <th>Other Participants</th>
                        <th>Other Sessions</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </body>
</html>

<?php
    mysqli_close($mysqli);
?>