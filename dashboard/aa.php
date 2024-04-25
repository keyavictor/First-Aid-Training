
<?php
if (isset($_POST['download-user-btn'])) {
    // Set the content type as a downloadable PDF file
    header('Content-Type: application/pdf');
    // Set the file name
    header('Content-Disposition: attachment; filename="user_details.pdf"');

    // Include the necessary files for creating a PDF
    require('fpdf/fpdf.php');

    // Fetch data from Modules table
    $sql = "SELECT user_id, email, first_name, last_name FROM Users";
    $result = $db->query($sql);

    // Create PDF
    $pdf = new FPDF();
    $pdf->AddPage();


    // Set font for table headers
    $pdf->SetFont('Arial', 'B', 12);

    //logo
    $pdf->Image('images/logo.png', $pdf->GetPageWidth()/2 - 25, 10, 50, 0, 'PNG');
    
    // Write the title of the document
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 50, '', 0, 1, 'C');
    $pdf->Cell(0, 10, 'Maseno University First Aid App', 0, 1, 'C');
    $pdf->Cell(0, 10, 'User Details', 0, 1, 'C');


    /*/ Add table headers
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
    }*/
// Write user data
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $pdf->Cell(40,10,'User ID: ' . $row['user_id'], 0, 1);
        $pdf->Cell(40,10,'Email: ' . $row['email'], 0, 1);
        $pdf->Cell(40,10,'First Name: ' . $row['first_name'], 0, 1);
        $pdf->Cell(40,10,'Last Name: ' . $row['last_name'], 0, 1);
        $pdf->Cell(40,10,'-----------------', 0, 1); // Separator
    }
} else {
    $pdf->Cell(40,10,'No users found.', 0, 1);
}

    // Close the database connection and output the PDF
    mysqli_close($db);
    $pdf->Output('D', 'user_details.pdf');

        // header('location: ./reports.php');
}

?>
