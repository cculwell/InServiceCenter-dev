<?php
    require '../../../../resources/library/Reports/fpdf181/fpdf.php';
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

    class PDF extends FPDF
    {
        // Page header
        function Header()
        {

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

            // Create the title
            $this->SetFont('Times','B', 14);
            $this->Cell(80);
            $this->Cell(30, 10, 'Athens State University', 0, 0, 'C');
            $this->Ln(5);
            $this->Cell(80);
            $this->Cell(30, 10, 'Regional In-Service Center', 0, 0, 'C');
            $this->Ln(10);
            $this->Cell(80);
            $this->SetFont('Times', 'IB', 12);
            $this->Cell(30, 10, $semester, 0, 0, 'C');
            $this->Ln(20);
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

    $sql = "SELECT * FROM school_and_system_report_data";

    // Instanciation of inherited class
    $pdf = new PDF('P', 'mm', 'A4');

    $pdf->AliasNbPages();
    $pdf->AddPage();

    if ($result = mysqli_query($mysqli, $sql))
    {
        while ($row = mysqli_fetch_row($result))
        {
            // Write the system name
            $system = $row[0] . ":";
            $pdf->SetFont('Times', 'BI', 14);
            $pdf->Cell(10, 10, "", 0, 0);
            $pdf->Cell(30, 10, $system, 0, 0, 'L');
            $pdf->Ln(6);

            // Write the total PD's for the system
            $total_pd = "Total Programs Offered:   " . $row[1];
            $pdf->SetFont('Times', '', 12);
            $pdf->Cell(20, 10, "", 0, 0);
            $pdf->Cell(30, 10, $total_pd, 0, 0);
            $pdf->Ln(5);

            // Write the total spent on this PD
            $pdf->SetFont('Times', '', 12);
            $get_total = (string)(number_format((float)$row[2], 2, '.', ''));
            $total_spent = "Total Spent:   $" . $get_total;
            $pdf->Cell(20, 10, "", 0, 0);
            $pdf->Cell(30, 10, $total_spent, 0, 0);
            $pdf->Ln(10);
        }
    }

    $pdf->Output();
?>