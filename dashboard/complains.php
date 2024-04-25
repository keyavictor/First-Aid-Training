<?php
include '../server.php';

if (!isset($_SESSION['role_id']) || empty($_SESSION['role_id'])) {
  session_destroy();
  header("location: ../index.php"); 
  exit;
}
//Get Session data
$fname = $_SESSION['fname'];
$lname = $_SESSION['lname'];
$name = $_SESSION['fname'] . " ".$_SESSION['lname'];
$mail = $_SESSION['email'];
$role_name = $_SESSION['role_name'];





?>

<!DOCTYPE html>
<html dir="ltr" lang="en">
  <head>
    <title>Complains</title>
    <?php include "_head.php"?>
  </head>

  <body>
    <?php include "_topbar.php"?>
    <?php include "_sidebar.php"?>

      <!-- ============================================================== -->
      <!-- Page wrapper  -->
      <!-- ============================================================== -->
      <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
          <div class="row">
            <div class="col-5 align-self-center">
              <h4 class="page-title">Complains</h4>
            </div>
            <div class="col-7 align-self-center">
              <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                      <a href="#">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                      Complains
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
          <div class="row"></div>
          <div class="row p-3">

          <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h5 class="card-title">List of Complains</h5>
                            
                            <div class="table-responsive">
                                <table id="dtBasicExample" class="table table-hover table-bordered table-sm"
                                    cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                        <th>Complaint ID</th>
                                        <th>User</th>
                                        <th>Subject</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Admin Response</th>
                                        <th>Date Created</th>
                                        <th>Date Responded</th>
                                        <?php
               if ($_SESSION['role_name'] == 'Admin'){
              ?>
                                        <th>Action</th>
                                        <?php
                   }
              ?>
              
                                        </tr>
                                    </thead>
                                    <?php
// Assuming there's a database connection established already as $db

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// SQL query to fetch data from Complaints table and concatenate first and last names from Users table as username
$sql = "SELECT c.*, CONCAT(u.first_name, ' ', u.last_name) AS username
        FROM Complaints c
        INNER JOIN Users u ON c.user_id = u.user_id";

// Execute the query
$result = mysqli_query($db, $sql);

// Check if there are any rows returned
if ($result) {
    if (mysqli_num_rows($result) > 0) {
        // Output data as a table
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
            <td>" . $row["complaint_id"] . "</td>
            <td>" . $row["username"] . "</td>
            <td>" . $row["subject"] . "</td>
            <td>" . $row["description"] . "</td>
            <td>" . $row["status"] . "</td>
            <td>" . $row["admin_response"] . "</td>
            <td>" . $row["date_created"] . "</td>
            <td>" . $row["date_responded"] . "</td>
            </tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }
} else {
    echo "Error executing the query: " . mysqli_error($db);
}
?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
               
        </div>
          <!-- ============================================================== -->
          <!-- Email campaign chart -->
          <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
      <?php include "_footer.php"?>
      </div>
      <!-- ============================================================== -->
      <!-- End Page wrapper  -->
      <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
<?php include "_scripts.php"?>
  </body>
</html>
