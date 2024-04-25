if (isset($_POST['download-module-btn'])) {
    // Set the content type as a downloadable PDF file
    header('Content-Type: application/pdf');
    // Set the file name
    header('Content-Disposition: attachment; filename="module_details.pdf"');

    // Include the necessary files for creating a PDF
    require('fpdf/fpdf.php');

    require('fpdf/fpdf.php'); // Include FPDF library

    // Fetch data from Modules table
    $sql = "SELECT * FROM Modules";
    $result = $conn->query($sql);

    // Create PDF
    $pdf = new FPDF();
    $pdf->AddPage();

    // Add logo to the top of the PDF
    $pdf->Image('./images/logo.png', 10, 10, 50);

    // Set font for table headers
    $pdf->SetFont('Arial', 'B', 12);

    // Add table headers
    $pdf->Cell(40, 10, 'Module ID', 1);
    $pdf->Cell(60, 10, 'Module Name', 1);
    $pdf->Cell(80, 10, 'Description', 1);
    $pdf->Ln();

    // Set font for table data
    $pdf->SetFont('Arial', '', 10);

    // Add table data
    while ($row = $result->fetch_assoc()) {
        $pdf->Cell(40, 10, $row['module_id'], 1);
        $pdf->Cell(60, 10, $row['module_name'], 1);
        $pdf->Cell(80, 10, $row['description'], 1);
        $pdf->Ln();
    }


    // Close the database connection and output the PDF
    mysqli_close($db);
    $pdf->Output('D', 'module_details.pdf');

        // header('location: ./reports.php');
}
<?php
require('fpdf/fpdf.php'); // Include FPDF library

// Fetch data from Modules table
$sql = "SELECT * FROM Modules";
$result = $conn->query($sql);

// Create PDF
$pdf = new FPDF();
$pdf->AddPage();

// Add logo to the top of the PDF
$pdf->Image('./images/logo.png', 10, 10, 50);

// Set font for table headers
$pdf->SetFont('Arial', 'B', 12);

// Add table headers
$pdf->Cell(40, 10, 'Module ID', 1);
$pdf->Cell(60, 10, 'Module Name', 1);
$pdf->Cell(80, 10, 'Description', 1);
$pdf->Ln();

// Set font for table data
$pdf->SetFont('Arial', '', 10);

// Add table data
while ($row = $result->fetch_assoc()) {
    $pdf->Cell(40, 10, $row['module_id'], 1);
    $pdf->Cell(60, 10, $row['module_name'], 1);
    $pdf->Cell(80, 10, $row['description'], 1);
    $pdf->Ln();
}

// Output PDF
$pdf->Output();

// Close connection
$conn->close();
?>
