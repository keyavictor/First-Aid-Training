<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

include '../server.php';
if (!isset($_SESSION['role_id']) || empty($_SESSION['role_id'])) {
  // if the session variable 'role_id' is not set or is empty, destroy the session and redirect to the login page
  session_destroy();
  header("location: ../index.php"); 
  exit;
}

//deny access to courses.php if user is not an admin
if ($_SESSION['role_name'] !== 'Admin') {
  // if the session variable 'role_name' is not set or does not equal 'Admin', deny access and redirect to a non-privileged page
  header("Location: index.php"); 
  exit;
}

if (isset($_POST['download-module-btn'])) {
    // Set the content type as a downloadable PDF file
    header('Content-Type: application/pdf');
    // Set the file name
    header('Content-Disposition: attachment; filename="module_details.pdf"');

    // Include the necessary files for creating a PDF
    require('fpdf/fpdf.php');

    // Fetch data from Modules table
    $sql = "SELECT * FROM Modules";
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
    $pdf->Cell(0, 10, 'Module Details', 0, 1, 'C');


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

$fname = $_SESSION['fname'];
$lname = $_SESSION['lname'];
$name = $_SESSION['fname'] . " ".$_SESSION['lname'];
$mail = $_SESSION['email'];


?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <title>Reports | TimeCraft</title>
    <?php
include '_head.php';
?>
</head>

<body>
    <!-- ============================================================== -->
    <!-- Topbar header - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <?php
     include '_topbar.php';
     ?>
    <!-- ============================================================== -->
    <!-- End Topbar header -->
    <!-- ============================================================== -->

    <!-- ============================================================== -->
    <!-- Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <?php
     include '_sidebar.php';
     ?>
    <!-- ============================================================== -->
    <!-- End Left Sidebar - style you can find in sidebar.scss  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb pt-5">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">Reports</h4>
                    <div class="ms-auto text-end">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Reports
                                </li>

                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-md-3">
                    
                <a href="#" name="module-form">
                        <form method="POST" action="">
                            <div class="card card-hover">
                                <div class="box bg-success text-center">
                                    <h1 class="font-light text-white">
                                        <i class="fa fa-file-pdf"></i>
                                    </h1>
                                    <h6 class="text-light">Module Details</h6>
                                    <input type="submit" name="download-module-btn" class="btn btn-info"
                                        value="Download" />
                                </div>
                            </div>

                        </form>
                    </a>
                </div>

                <div class="col-md-3">
                    <a href="#" name="complaints-form">
                        <form method="POST" action="">
                            <div class="card card-hover">
                                <div class="box bg-info text-center">
                                    <h1 class="font-light text-white">
                                        <i class="fa fa-file-pdf "></i>
                                    </h1>
                                    <h6 class="text-light">Complaints Details</h6>
                                    <input type="submit" name="download-complaints-btn" class="btn btn-success"
                                        value="Download" />
                                </div>
                            </div>

                        </form>
                    </a>
                </div>

                <div class="col-md-3">
                    <a href="#" name="user-form">
                        <form method="POST" action="">
                            <div class="card card-hover">
                                <div class="box bg-primary text-center">
                                    <h1 class="font-light text-white">
                                        <i class="fa fa-file-pdf"></i>
                                    </h1>
                                    <h6 class="text-light">User Details</h6>
                                    <input type="submit" name="download-user-btn" class="btn btn-cyan"
                                        value="Download" />
                                </div>
                            </div>

                        </form>
                    </a>
                </div>

            </div>
            <!--close row-->

        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->


        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <?php
    include '_footer.php';
    ?>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->



<?php include "_scripts.php";?>
    <script>
    $(document).ready(function() {
        $('#dtBasicExample').DataTable();
        $('.dataTables_length').addClass('bs-select');
    });
    </script>

</body>

</html>