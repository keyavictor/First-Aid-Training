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
    <title>Logs</title>
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
              <h4 class="page-title">Access Logs</h4>
            </div>
            <div class="col-7 align-self-center">
              <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                      <a href="#">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                      Modules
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

                            <h5 class="card-title">User Logs</h5>
                            
                            <div class="table-responsive">
                                <table id="dtBasicExample" class="table table-hover table-bordered table-sm"
                                    cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                        <th>Log ID</th>
                                        <th>User</th>
                                        <th>Module ID</th>
                                        <th>Access Date</th>
                                        </tr>
                                    </thead>
                                    <?php
// Assuming there's a database connection established already as $db

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// SQL query to fetch data from Module_Access_Log table and join with Users table to get username
$sql = "SELECT l.*, CONCAT(u.first_name, ' ', u.last_name) AS username
        FROM Module_Access_Log l
        INNER JOIN Users u ON l.user_id = u.user_id";

// Execute the query
$result = mysqli_query($db, $sql);

// Check if there are any rows returned
if ($result) {
    if (mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
            <td>" . $row["log_id"] . "</td>
            <td>" . $row["username"] . "</td>
            <td>" . $row["module_id"] . "</td>
            <td>" . $row["access_date"] . "</td>
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
