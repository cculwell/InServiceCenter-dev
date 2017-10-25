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

    $sql = "SELECT * FROM quick_report_data";

    // Instanciation of inherited class
    $pdf = new PDF('P', 'mm', 'A4');

    $pdf->AliasNbPages();
    $pdf->AddPage();

    $pdf->SetFont('Times', 'B', 12);
    $pdf->Cell(30, 10, "Program ID#", 'B', 0);
    $pdf->Cell(0, 10, "     Program Title", 'B', 0);
    $pdf->Ln(10);

    if ($result = mysqli_query($mysqli, $sql))
    {
        while ($row = mysqli_fetch_row($result))
        {
            // Write program ID
            $id = $row[1];
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(30, 10, $id, 0, 0, 'C');

            // Write the program title
            $title = "     " . $row[2];
            $pdf->SetFont('Times', 'BI', 12);
            $pdf->Cell(30, 10, $title, 0, 0);

            if ($row[10] == 'Canceled')
            {
                // Write the canceled notification
                $canceled = "         " . "***** CANCELED *****";
                $pdf->SetFont('Times', 'B', 12);
                $pdf->Cell(30, 10, "", 0, 0);
                $pdf->Cell(30, 10, $canceled, 0, 0);
            }

            $pdf->Ln(8);

            // Write dates of the program
            $pdf->SetFont('Times', '', 10);
            $dates = "     Date: " . $row[3] . " to " . $row[5];
            $pdf->Cell(30, 10, "", 0, 0);
            $pdf->Cell(30, 10, $dates, 0, 0);
            $pdf->Ln(5);

            // Write times of the program
            $pdf->SetFont('Times', '', 10);
            $times = "     Times: " . $row[4] . " to " . $row[6];
            $pdf->Cell(30, 10, "", 0, 0);
            $pdf->Cell(30, 10, $times, 0, 0);
            $pdf->Ln(5);

            // Write location of the program
            $pdf->SetFont('Times', '', 10);
            $location = "     Location: " . $row[7];
            $pdf->Cell(30, 10, "", 0, 0);
            $pdf->Cell(30, 10, $location, 0, 0);
            $pdf->Ln(5);

            // Write who is providing support
            $pdf->SetFont('Times', '', 10);
            $location = "     Support Provided By: " . $row[11];
            $pdf->Cell(30, 10, "", 0, 0);
            $pdf->Cell(30, 10, $location, 0, 0);
            $pdf->Ln(5);

            // Write enrollment numbers for the program
            $enrollment = "     Current Enrollment: " . $row[9] 
                          . "   " . "Maximum Enrollment: " . $row[8];
            $pdf->Cell(30, 10, "", 0, 0);
            $pdf->Cell(30, 10, $enrollment, 0, 0);
            $pdf->Ln(10);
        }
    }

    // Get the total number of programs
    $total_programs = mysqli_num_rows($result);

    // Get total number of canceled programs
    $sql = "SELECT workflow_state FROM quick_report_data WHERE workflow_state='Canceled'";
    $total_canceled = mysqli_num_rows(mysqli_query($mysqli, $sql));

    // Get the total enrollment over al programs
    $sql = "SELECT SUM(enrolled_participants) AS total_enrollment FROM quick_report_data";
    $enrollment_result = mysqli_query($mysqli, $sql); 
    $row = mysqli_fetch_assoc($enrollment_result); 
    $total_enrollment = $row['total_enrollment'];

    // Write total programs, total canceled programs, and total enrollment
    $pdf->Ln(10);
    $pdf->SetFont('Times', 'B', 13);
    $pdf->Cell(50, 10, "", 0, 0);
    $pdf->Cell(90, 10, "Enrollment Grand Totals", "LTR", 0, "L");
    $pdf->Ln(8);
    $pdf->Cell(50, 10, "", 0, 0);
    $pdf->SetFont('Times', 'B', 11);
    $pdf->Cell(30, 10, "", "L", 0);
    $pdf->Cell(30, 10, "Total Programs: ", 0, 0, "R");
    $pdf->Cell(30, 10, $total_programs, "R", 0, "C");
    $pdf->Ln(5);
    $pdf->Cell(50, 10, "", 0, 0);
    $pdf->Cell(30, 10, "", "L", 0);
    $pdf->Cell(30, 10, "Canceled Programs: ", 0, 0, "R");
    $pdf->Cell(30, 10, $total_canceled, "R", 0, "C");
    $pdf->Ln(5);
    $pdf->Cell(50, 10, "", 0, 0);
    $pdf->Cell(30, 10, "", "BL", 0);
    $pdf->Cell(30, 10, "Enrollment: ", "B", 0, "R");
    $pdf->Cell(30, 10, $total_enrollment, "BR", 0, "C");

    $pdf->Output();
?>