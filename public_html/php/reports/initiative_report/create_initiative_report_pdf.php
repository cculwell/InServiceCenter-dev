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
            $this->Cell(30, 10, 'Initiative Report', 0, 0, 'C');
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

    // First 3 indexes are blank to cover the other 3 row fields from the query
    $initiatives = array('', '' , '', 'Biology', 'Chemistry', 'English/Language Arts', 'Technology', 'Career Tech',
                        'Counseling', 'Climate and Culture', 'Effective Instruction', 'Fine Arts',
                        'Foreign Language', 'Gifted', 'Interdisciplinary', 'Leadership', 
                        'Library Media Services', 'Mathematics', 'NBCT', 'Physics', 'Physical Education',
                        'Science', 'Social Studies', 'Special Education', 'Other');

    $sql = "SELECT * 
            FROM initiative_report_data 
            WHERE report_date BETWEEN '$report_from' AND '$report_to'";

    // Instanciation of inherited class
    $pdf = new PDF('P', 'mm', 'A4');

    $pdf->AliasNbPages();

    if ($result = mysqli_query($mysqli, $sql))
    {
        while ($row = mysqli_fetch_row($result))
        {
            $pdf->AddPage();
            
            $pdf->SetFont('Times', 'I', 11);
            $pdf->Cell(80);
            $pdf->Cell(30, 10, $report_from . " - " . $report_to, 0, 0, 'C');
            $pdf->Ln(20);

            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(30, 10, "Initiative", 'B', 0);
            $pdf->Cell(0, 10, "     Programs Per Curriculum Area", 'B', 0);
            $pdf->Ln(20);
            
            // Write the initiative
            $initiative = $row[2] . ":";
            $pdf->SetFont('Times', 'BI', 13);
            $pdf->Cell(30, 10, $initiative, 0, 0, 'L');
            $pdf->Ln(6);

            $max = sizeof($row) - 1;
            for($i = 3; $i < $max; $i++)
            {
                // Write the curriculum area and total programs for that area
                $area = $initiatives[$i] . ":   ";
                $pdf->SetFont('Times', '', 11);
                $pdf->Cell(35, 10, "", 0, 0);
                $pdf->Cell(50, 10, $area, 0, 0, 'L');
                $pdf->Cell(30, 10, $row[$i], 0, 0, 'L');
                $pdf->Ln(5);
            }
        }
    }

    $pdf->Output();
?>