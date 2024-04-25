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
                            <?php
               if ($_SESSION['role_name'] == 'User'){
              ?>
                            <input type='button' id='addComplaintBtn' value='Add Complaint' name='open-complain-btn' 
                            class='btn btn-primary float-end open-complain-modal-btn m-2' />

                                <?php
                   }
              ?>
                                         
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

    <!-- Add Complaint Modal -->
<div class="modal fade" id="addComplaintModal" tabindex="-1" role="dialog" aria-labelledby="addComplaintModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addComplaintModalLabel">Add Complaint</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="addComplaintForm">
          <div class="form-group">
            <label for="complaintSubject">Subject</label>
            <input type="text" class="form-control" id="complaintSubject" name="subject" required>
          </div>
          <div class="form-group">
            <label for="complaintDescription">Description</label>
            <textarea class="form-control" id="complaintDescription" name="description" rows="3" required></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>

    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
<?php include "_scripts.php"?>
<script>
$(document).ready(function() {
  // When the "Add Complaint" button is clicked
  $('#addComplaintBtn').click(function() {
    // Show the modal
    $('#addComplaintModal').modal('show');
  });
});
</script>

<script>
$(document).ready(function() {
  $('#addComplaintForm').submit(function(event) {
    event.preventDefault(); // Prevent default form submission

    // Serialize form data
    var formData = $(this).serialize();

    // Ajax request to submit form data
    $.ajax({
      type: 'POST',
      url: 'add_complaint.php', // PHP script to handle form submission
      data: formData,
      success: function(response) {
        // Handle success response
        alert(response); // You can customize this based on your requirement
        $('#addComplaintModal').modal('hide'); // Hide modal after successful submission
        // You can also refresh the complaints table here if needed
        location.reload();

      },
      error: function(xhr, status, error) {
        // Handle error
        console.error(xhr.responseText);
        alert('An error occurred while submitting the complaint.');
      }
    });
  });
});
</script>

  </body>
</html>
