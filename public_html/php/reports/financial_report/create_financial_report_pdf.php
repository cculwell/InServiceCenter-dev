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
            $this->Cell(30, 10, 'Financial Report', 0, 0, 'C');
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

    //Instanciation of inherited class
    $pdf = new PDF('P', 'mm', 'A4');

    $pdf->AliasNbPages();
    $pdf->AddPage();

    $pdf->SetFont('Times', 'I', 11);
    $pdf->Cell(80);
    $pdf->Cell(30, 10, $report_from . " - " . $report_to, 0, 0, 'C');
    $pdf->Ln(20);

    $pdf->SetFont('Times', 'B', 12);
    $pdf->Cell(30, 10, "Program ID#", 'B', 0);
    $pdf->Cell(0, 10, "     Program Title", 'B', 0);
    $pdf->Ln(10);

    $sql = "SELECT * FROM financial_report_data WHERE report_date BETWEEN '$report_from' AND '$report_to'";

    if ($result = mysqli_query($mysqli, $sql))
    {
        while ($row = mysqli_fetch_row($result))
        {
            // Write program ID
            $id = $row[2];
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(30, 10, $id, 0, 0, 'C');

            // Write the program title
            $title = "     " . $row[4];
            $pdf->SetFont('Times', 'BI', 12);
            $pdf->Cell(30, 10, $title, 0, 0);

            if ($row[16] == 'Canceled')
            {
                // Write the canceled notification
                $canceled = "         " . "***** CANCELED *****";
                $pdf->SetFont('Times', 'B', 12);
                $pdf->Cell(30, 10, "", 0, 0);
                $pdf->Cell(30, 10, $canceled, 0, 0);
            }

            $pdf->Ln(5);

            // Write STI PD
            $pdf->SetFont('Times', '', 10);
            $sti_pd = "     " . $row[3];
            $pdf->Cell(30, 10, "", 0, 0);
            $pdf->Cell(30, 10, $sti_pd, 0, 0);
            $pdf->Ln(8);

            // Write dates of the program
            $pdf->SetFont('Times', '', 10);
            $dates = "     Date: " . $row[5] . " to " . $row[7];
            $pdf->Cell(30, 10, "", 0, 0);
            $pdf->Cell(30, 10, $dates, 0, 0);
            $pdf->Ln(5);

            // Write times of the program
            $times = "     Times: " . $row[6] . " to " . $row[8];
            $pdf->Cell(30, 10, "", 0, 0);
            $pdf->Cell(30, 10, $times, 0, 0);
            $pdf->Ln(5);

            // Write number of sessions for the program
            $sessions = "     Number of Sessions: " . $row[9];
            $pdf->Cell(30, 10, "", 0, 0);
            $pdf->Cell(30, 10, $sessions, 0, 0);
            $pdf->Ln(5);

            // Write location of the program
            $location = "     Location: " . $row[10];
            $pdf->Cell(30, 10, "", 0, 0);
            $pdf->Cell(30, 10, $location, 0, 0);
            $pdf->Ln(5);

            // Write who is providing support
            $initiative = "     Initiative: " . $row[12];
            $pdf->Cell(30, 10, "", 0, 0);
            $pdf->Cell(30, 10, $initiative, 0, 0);
            $pdf->Ln(5);

            // Write the target audience
            $target_audience = "     Target Audience: " . $row[13];
            $pdf->Cell(30, 10, "", 0, 0);
            $pdf->Cell(30, 10, $target_audience, 0, 0);
            $pdf->Ln(5);

            // Write enrollment numbers for the program
            $pdf->SetFont('Times', '', 10);
            $enrollment = "     Current Enrollment: " . $row[15] 
                          . "   " . "Maximum Enrollment: " . $row[14];
            $pdf->Cell(30, 10, "", 0, 0);
            $pdf->Cell(30, 10, $enrollment, 0, 0);
            $pdf->Ln(5);

            $system = "     School System: " . $row[11];
            $pdf->Cell(30, 10, "", 0, 0);
            $pdf->Cell(30, 10, $system, 0, 0);
            $pdf->Ln(7);

            // Begin writing the expenses for the program
            $pdf->SetFont('Times', 'B', 10);
            $pdf->Cell(34, 10, "", 0, 0);
            $pdf->Cell(30, 10, "Program Expenses:", 0, 0);
            $pdf->Ln(5);

            // Write consultant fee
            $pdf->SetFont('Times', '', 10);
            $consultant = "Consultant Fee: $" . $row[17];
            $pdf->Cell(45, 10, "", 0, 0);
            $pdf->Cell(30, 10, $consultant, 0, 0);
            $pdf->Ln(5);

            $total = (float)$row[17];

            $request_id = $row[0];
            $fields = "request_id, expense_type, expense_amount";
            $where = "request_id='$request_id'";
            $expense_sql = "SELECT $fields FROM expenses WHERE $where";

            if ($expense_result = mysqli_query($mysqli, $expense_sql))
            {
                while ($expense = mysqli_fetch_row($expense_result))
                {
                    // Write expense name and amount
                    $pdf->SetFont('Times', '', 10);
                    $expense_text = $expense[1] . ": $" . $expense[2];
                    $pdf->Cell(45, 10, "", 0, 0);
                    $pdf->Cell(30, 10, $expense_text, 0, 0);
                    $pdf->Ln(5);

                    $total = $total + (float)$expense[2];
                }
            }

            // Write total expenses for the program
            $pdf->Ln(2);
            $pdf->SetFont('Times', 'B', 10);
            $total_text = "Total Expenses: $" . number_format((float)$total, 2, '.', '');
            $pdf->Cell(45, 10, "", 0, 0);
            $pdf->Cell(30, 10, $total_text, 0, 0);
            $pdf->Ln(15);
        }
    }

    // Put totals on a seperate page
    $pdf->AddPage();

    $pdf->SetFont('Times', 'I', 11);
    $pdf->Cell(80);
    $pdf->Cell(30, 10, $report_from . " - " . $report_to, 0, 0, 'C');
    $pdf->Ln(20);

    $pdf->Ln(10);
    $pdf->SetFont('Times', 'B', 13);
    $pdf->Cell(50, 10, "", 0, 0);
    $pdf->Cell(90, 10, "Grand Totals", "LTR", 0, "C");
    $pdf->Ln(8);

    $sql = "SELECT SUM(consultant_fee) AS total_consultant_fees 
            FROM financial_report_data
            WHERE (report_date BETWEEN '$report_from' AND '$report_to')
            AND workflow_state <> 'Canceled'";

    $consultant_result = mysqli_query($mysqli, $sql); 
    $row = mysqli_fetch_assoc($consultant_result); 
    $total_consultant_fees = $row['total_consultant_fees'];

    $pdf->Cell(50, 10, "", "", 0);
    $pdf->Cell(10, 10, "", "L", 0);
    $pdf->Cell(50, 10, "Consultant: ", "", 0, "L");
    $pdf->Cell(30, 10, "$" . number_format((float)$total_consultant_fees, 2, '.', ''), "R", 0, "L");
    $pdf->Ln(5);

    $sql = "SELECT DISTINCT(e.expense_type), SUM(e.expense_amount) 
            FROM expenses e 
            JOIN (SELECT request_id 
                  FROM financial_report_data 
                  WHERE (report_date BETWEEN '$report_from' AND '$report_to')
                  AND workflow_state <> 'Canceled') rq 
            ON e.request_id = rq.request_id
            GROUP BY e.expense_type";

    if ($result = mysqli_query($mysqli, $sql))
    {
        while ($row = mysqli_fetch_row($result))
        {
            $pdf->Cell(50, 10, "", "", 0);
            $pdf->Cell(10, 10, "", "L", 0);
            $pdf->Cell(50, 10, $row[0] . ": ", "", 0, "L");
            $pdf->Cell(30, 10, "$" . number_format((float)$row[1], 2, '.', ''), "R", 0, "L");
            $pdf->Ln(5);
        }
    }

    $pdf->Ln(5);

    // Get total of misc fees the get grand total of misc and consultant fees
    $sql = "SELECT SUM(consultant_fee) + SUM(total_misc_expenses) AS total 
            FROM financial_report_data 
            WHERE (report_date BETWEEN '$report_from' AND '$report_to')
            AND workflow_state <> 'Canceled'";

    $total_fees_result = mysqli_query($mysqli, $sql); 
    $row = mysqli_fetch_assoc($total_fees_result); 
    $total_fees = $row['total'];

    $pdf->Cell(50, 10, "", "", 0);
    $pdf->Cell(10, 10, "", "BL", 0);
    $pdf->Cell(50, 10, "TOTAL SPENT: ", "B", 0, "L");
    $pdf->Cell(30, 10, "$" . number_format((float)$total_fees, 2, '.', ''), "BR", 0);

    $pdf->Output();
?>