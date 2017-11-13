<?php
    require '../../../../resources/library/Reports/fpdf181/fpdf.php';
    require "../../../../resources/config.php";

    $report_from = $_POST['report_from'];
    $report_to = $_POST['report_to'];

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

    class PDF extends FPDF
    {
        // Page header
        function Header()
        {
            // Create the title
            $this->SetFont('Times','B', 14);
            $this->Cell(80);
            $this->Cell(30, 10, 'Athens State University', 0, 0, 'C');
            $this->Ln(5);
            $this->Cell(80);
            $this->Cell(30, 10, 'Regional In-Service Center', 0, 0, 'C');
            $this->Ln(10);
            $this->Cell(80);
            $this->SetFont('Times', 'B', 12);
            $this->Cell(30, 10, 'Curriculum Report', 0, 0, 'C');
            $this->Ln(10);
        }

        // Page footer
        function Footer()
        {
            $this->SetY(-15);
            $this->SetFont('Arial','I',8);

            // Page number
            $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');

            // Printed on 
            $this->SetFont('Arial', '', 8);
            $this->Cell(0, 10, "Printed on " . date('n/j/Y'), 0, 0, 'R');
        }
    }

    // dictionary of curriculums and total offerings per initiative
    $curriculums = array();
    $curriculums['Biology'] = array('AMSTI' => 0, 'ASIM' => 0, 'TIM' => 0, 
                                    'Inservice' => 0, 'ALSDE' => 0, 'LEA' => 0, 'Total' = > 0);
    $curriculums['Chemistry'] = array('AMSTI' => 0, 'ASIM' => 0, 'TIM' => 0, 
                                      'Inservice' => 0, 'ALSDE' => 0, 'LEA' => 0, 'Total' = > 0);
    $curriculums['English/Language Arts'] = array('AMSTI' => 0, 'ASIM' => 0, 'TIM' => 0, 
                                                  'Inservice' => 0, 'ALSDE' => 0, 'LEA' => 0, 'Total' = > 0);
    $curriculums['Technology'] = array('AMSTI' => 0, 'ASIM' => 0, 'TIM' => 0, 
                                       'Inservice' => 0, 'ALSDE' => 0, 'LEA' => 0, 'Total' = > 0);
    $curriculums['Career Tech'] = array('AMSTI' => 0, 'ASIM' => 0, 'TIM' => 0, 
                                        'Inservice' => 0, 'ALSDE' => 0, 'LEA' => 0, 'Total' = > 0);
    $curriculums['Counseling'] = array('AMSTI' => 0, 'ASIM' => 0, 'TIM' => 0, 
                                       'Inservice' => 0, 'ALSDE' => 0, 'LEA' => 0, 'Total' = > 0);
    $curriculums['Climate and Culture'] = array('AMSTI' => 0, 'ASIM' => 0, 'TIM' => 0, 
                                                'Inservice' => 0, 'ALSDE' => 0, 'LEA' => 0 'Total' = > 0);
    $curriculums['Effective Instruction'] = array('AMSTI' => 0, 'ASIM' => 0, 'TIM' => 0, 
                                                  'Inservice' => 0, 'ALSDE' => 0, 'LEA' => 0, 'Total' = > 0);
    $curriculums['Fine Arts'] = array('AMSTI' => 0, 'ASIM' => 0, 'TIM' => 0, 
                                      'Inservice' => 0, 'ALSDE' => 0, 'LEA' => 0, 'Total' = > 0);
    $curriculums['Foreign Language'] = array('AMSTI' => 0, 'ASIM' => 0, 'TIM' => 0,
                                             'Inservice' => 0, 'ALSDE' => 0, 'LEA' => 0, 'Total' = > 0);
    $curriculums['Gifted'] = array('AMSTI' => 0, 'ASIM' => 0, 'TIM' => 0,
                                   'Inservice' => 0, 'ALSDE' => 0, 'LEA' => 0, 'Total' = > 0);
    $curriculums['Interdisciplinary'] = array('AMSTI' => 0, 'ASIM' => 0, 'TIM' => 0,
                                              'Inservice' => 0, 'ALSDE' => 0, 'LEA' => 0, 'Total' = > 0);
    $curriculums['Leadership'] = array('AMSTI' => 0, 'ASIM' => 0, 'TIM' => 0,
                                       'Inservice' => 0, 'ALSDE' => 0, 'LEA' => 0, 'Total' = > 0);
    $curriculums['Library Media Services'] = array('AMSTI' => 0, 'ASIM' => 0, 'TIM' => 0, 
                                                   'Inservice' => 0, 'ALSDE' => 0, 'LEA' => 0, 'Total' = > 0);
    $curriculums['Mathematics'] = array('AMSTI' => 0, 'ASIM' => 0, 'TIM' => 0, 
                                        'Inservice' => 0, 'ALSDE' => 0, 'LEA' => 0, 'Total' = > 0);
    $curriculums['NBCT'] = array('AMSTI' => 0, 'ASIM' => 0, 'TIM' => 0,
                                 'Inservice' => 0, 'ALSDE' => 0, 'LEA' => 0, 'Total' = > 0);
    $curriculums['Physics'] = array('AMSTI' => 0, 'ASIM' => 0, 'TIM' => 0,
                                    'Inservice' => 0, 'ALSDE' => 0, 'LEA' => 0, 'Total' = > 0);
    $curriculums['Physical Education'] = array('AMSTI' => 0, 'ASIM' => 0, 'TIM' => 0,
                                               'Inservice' => 0, 'ALSDE' => 0, 'LEA' => 0, 'Total' = > 0);
    $curriculums['Science'] = array('AMSTI' => 0, 'ASIM' => 0, 'TIM' => 0,
                                    'Inservice' => 0, 'ALSDE' => 0, 'LEA' => 0, 'Total' = > 0);
    $curriculums['Social Studies'] = array('AMSTI' => 0, 'ASIM' => 0, 'TIM' => 0,
                                           'Inservice' => 0, 'ALSDE' => 0, 'LEA' => 0, 'Total' = > 0);
    $curriculums['Special Education'] = array('AMSTI' => 0, 'ASIM' => 0, 'TIM' => 0,
                                              'Inservice' => 0, 'ALSDE' => 0, 'LEA' => 0, 'Total' = > 0);
    $curriculums['Other'] = array('AMSTI' => 0, 'ASIM' => 0, 'TIM' => 0,
                                  'Inservice' => 0, 'ALSDE' => 0, 'LEA' => 0, 'Total' = > 0);
    ksort($curriculums);

    $sql = "SELECT * 
            FROM curriculum_report_data 
            WHERE report_date BETWEEN '$report_from' AND '$report_to'";

    // Instanciation of inherited class
    $pdf = new PDF('P', 'mm', 'A4');

    $pdf->AliasNbPages();
    $pdf->AddPage();

    $pdf->SetFont('Times', 'I', 11);
    $pdf->Cell(80);
    $pdf->Cell(30, 10, $report_from . " - " . $report_to, 0, 0, 'C');
    $pdf->Ln(20);

    $pdf->SetFont('Times', 'B', 12);
    $pdf->Cell(60, 10, "Curriculum Area", 'B', 0);
    $pdf->Cell(0, 10, "Offerings Per Initiative", 'B', 0);
    $pdf->Ln(10);

    // Update dictionary of curriculums with the correct counts per initiative
    if ($result = mysqli_query($mysqli, $sql))
    {
        while ($row = mysqli_fetch_row($result))
        {
            $curriculum_area = $row[2];

            $curriculums[$curriculum_area]['AMSTI'] = $row[3];
            $curriculums[$curriculum_area]['ASIM'] = $row[4];
            $curriculums[$curriculum_area]['TIM'] = $row[5];
            $curriculums[$curriculum_area]['Inservice'] = $row[6];
            $curriculums[$curriculum_area]['ALSDE'] = $row[7];
            $curriculums[$curriculum_area]['LEA'] = $row[8];
            $curriculums[$curriculum_area]['Total'] = $row[9];
        }
    }

    $count = 0;

    //Create the report
    foreach ($curriculums as $curriculum => $initiatives)
    {
        // Create page break that doesn't cut off a group
        if($count == 5)
        {
            $pdf->AddPage();

            $pdf->SetFont('Times', 'I', 11);
            $pdf->Cell(80);
            $pdf->Cell(30, 10, $report_from . " - " . $report_to, 0, 0, 'C');
            $pdf->Ln(20);

            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(60, 10, "Curriculum Area", 'B', 0);
            $pdf->Cell(0, 10, "Offerings Per Initiative", 'B', 0);
            $pdf->Ln(10);

            $count = 0;
        }

        // Write curriculum area
        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(30, 10, $curriculum . ":", 0, 0, 'L');
        $pdf->Ln(7);

        // Write the AMSTI count
        $pdf->SetFont('Times', '', 11);
        $pdf->Cell(35, 10, "", 0, 0);
        $pdf->Cell(50, 10, "AMSTI:   ", 0, 0, 'L');
        $pdf->Cell(30, 10, $initiatives['AMSTI'], 0, 0, 'L');
        $pdf->Ln(5);

        // Write the ASIM count
        $pdf->SetFont('Times', '', 11);
        $pdf->Cell(35, 10, "", 0, 0);
        $pdf->Cell(50, 10, "ASIM:   ", 0, 0, 'L');
        $pdf->Cell(30, 10, $initiatives['ASIM'], 0, 0, 'L');
        $pdf->Ln(5);

        // Write the TIM count
        $pdf->SetFont('Times', '', 11);
        $pdf->Cell(35, 10, "", 0, 0);
        $pdf->Cell(50, 10, "TIM:   ", 0, 0, 'L');
        $pdf->Cell(30, 10, $initiatives['TIM'], 0, 0, 'L');
        $pdf->Ln(5);

        // Write the Inservice count
        $pdf->SetFont('Times', '', 11);
        $pdf->Cell(35, 10, "", 0, 0);
        $pdf->Cell(50, 10, "Inservice:   ", 0, 0, 'L');
        $pdf->Cell(30, 10, $initiatives['Inservice'], 0, 0, 'L');
        $pdf->Ln(5);

        // Write the ALSDE count
        $pdf->SetFont('Times', '', 11);
        $pdf->Cell(35, 10, "", 0, 0);
        $pdf->Cell(50, 10, "ALSDE:   ", 0, 0, 'L');
        $pdf->Cell(30, 10, $initiatives['ALSDE'], 0, 0, 'L');
        $pdf->Ln(5);

        // Write the LEA count
        $pdf->SetFont('Times', '', 11);
        $pdf->Cell(35, 10, "", 0, 0);
        $pdf->Cell(50, 10, "LEA:   ", 0, 0, 'L');
        $pdf->Cell(30, 10, $initiatives['LEA'], 0, 0, 'L');
        $pdf->Ln(8);

        // Write the LEA count
        $pdf->SetFont('Times', 'B', 11);
        $pdf->Cell(35, 10, "", 0, 0);
        $pdf->Cell(50, 10, "Total Offerings:   ", 0, 0, 'L');
        $pdf->SetFont('Times', '', 11);
        $pdf->Cell(30, 10,  $initiatives['Total'], 0, 0, 'L');

        $pdf->Ln(10);

        $count++;
    }

    $pdf->Output();
?>