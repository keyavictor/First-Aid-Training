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

<?php
// Check if the form for adding a module is submitted
if(isset($_POST['add-module-submit'])) {
  // Retrieve and sanitize input data
  $module_name = mysqli_real_escape_string($db, $_POST['module_name']);
  $description = mysqli_real_escape_string($db, $_POST['description']);
  
  // File upload handling
  $uploadDirectory = 'uploads/'; // Directory where files will be uploaded
  $uploadedFile = $uploadDirectory . basename($_FILES['module_file']['name']);
  $fileType = pathinfo($uploadedFile, PATHINFO_EXTENSION);
  
  // Check if file is a valid type
  if(in_array($fileType, array('pdf', 'doc', 'docx', 'txt'))) {
      // Move uploaded file to the upload directory
      if(move_uploaded_file($_FILES['module_file']['tmp_name'], $uploadedFile)) {
          // Process the query to insert the new module with file name
          $sql = "INSERT INTO Modules (module_name, description, module_file) VALUES ('$module_name', '$description', '$uploadedFile')";
          if(mysqli_query($db, $sql)) {
              // Module added successfully
              header("Location: {$_SERVER['PHP_SELF']}");
              exit();
          } else {
              echo "Error: " . $sql . "<br>" . mysqli_error($db);
          }
      } else {
          echo "Error uploading file.";
      }
  } else {
      echo "Invalid file type. Please upload a PDF, DOC, DOCX, or TXT file.";
  }
}


// Check if the delete module button is clicked
if(isset($_POST['delete-module-btn'])) {
    // Retrieve and sanitize input data
    $module_id = mysqli_real_escape_string($db, $_POST['module_id']);
    // Process the query to delete the module
    $sql = "DELETE FROM Modules WHERE module_id='$module_id'";
    if(mysqli_query($db, $sql)) {
        // Module deleted successfully
        header("Location: {$_SERVER['PHP_SELF']}");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($db);
    }
}
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">
  <head>
    <title>Modules</title>
    <?php include "_head.php"?>
  </head>

  <body>
    <?php include "_topbar.php"?>
    <?php include "_sidebar.php"?>
      <!-- Page wrapper  -->
      <!-- ============================================================== -->
      <div class="page-wrapper">
        <div class="page-breadcrumb">
          <div class="row">
            <div class="col-5 align-self-center">
              <h4 class="page-title">Modules</h4>
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
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
          <div class="row"></div>
          <div class="row p-3">

          <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">List of Modules</h5>
                            <!-- Add Module Button -->
                            <input type='button' value='Add Module' name='open-module-btn'
                                class='btn btn-primary float-end open-module-modal-btn m-2' data-bs-toggle="modal" data-bs-target="#addModuleModal" />
                            <div class="table-responsive">
                                <table id="dtBasicExample" class="table table-hover table-bordered table-sm"
                                    cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Module ID</th>
                                            <th>Module Name</th>
                                            <th>Description</th>
                                            <th>Module File</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <?php
                                      // Check if the user is an admin
                                      if (isset($_SESSION['role_name']) && $_SESSION['role_name'] == 'Admin') {
                                          // Enable error reporting
                                          error_reporting(E_ALL);
                                          ini_set('display_errors', 1);
                                          // SQL query to fetch data from Modules table
                                          $sql = "SELECT * FROM Modules";
                                          $result = mysqli_query($db, $sql);

                                          // Check if there are any rows returned
                                          if ($result) {
                                              if (mysqli_num_rows($result) > 0) {
                                                  while ($row = mysqli_fetch_assoc($result)) {
                                                      echo "<tr>
                                                      <td>" . $row["module_id"] . "</td>
                                                      <td>" . $row["module_name"] . "</td>
                                                      <td>" . $row["description"] . "</td>
                                                      <td>" . $row["module_file"] . "</td>
                                                      <td>
                                                      <form method='POST' action=''>
                                                      <input type='hidden' name='module_id' value='" . $row["module_id"] . "'>
                                                      <input type='submit' value='Delete Module' name='delete-module-btn' class='btn btn-danger deleteModuleBtn' onclick='return confirm(\"Are you sure you want to delete this module?\");'>
                                                      </form>              
                                                      </td>

                                                      </tr>";
                                                  }
                                                  echo "</table>";
                                              } else {
                                                  echo "0 results";
                                              }
                                          } else {
                                              echo "Error executing the query: " . mysqli_error($db);
                                          }
                                      } else {
                                          echo "You do not have permission to view this data.";
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
      <?php include "_footer.php"?>
      </div>
      <!-- ============================================================== -->
      <!-- End Page wrapper  -->
      <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- Modal for adding a module -->
<!-- Modal for adding a module -->
<div class="modal fade" id="addModuleModal" tabindex="-1" aria-labelledby="addModuleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModuleModalLabel">Add Module</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="module_name" class="form-label">Module Name</label>
                        <input type="text" class="form-control" id="module_name" name="module_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="module_file" class="form-label">Module File</label>
                        <input type="file" class="form-control" id="module_file" name="module_file" accept=".pdf,.doc,.docx,.txt" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="add-module-submit">Add Module</button>
                </form>
            </div>
        </div>
    </div>
</div>


<?php include "_scripts.php"?>
<script>
// JavaScript function to handle form submission for deleting a module
function confirmDelete() {
    return confirm("Are you sure you want to delete this module?");
}
</script>











</body>
</html>
