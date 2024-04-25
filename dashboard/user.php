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
    <title>Users</title>
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
              <h4 class="page-title">Users</h4>
            </div>
            <div class="col-7 align-self-center">
              <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                      <a href="#">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                      Users
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

                            <h5 class="card-title">List of Users</h5>
                            <input type='button' value='Add User' name='open-lecturer-btn'
                                class='btn btn-primary float-end open-lecturer-modal-btn m-2' />
                            <div class="table-responsive">
                                <table id="dtBasicExample" class="table table-hover table-bordered table-sm"
                                    cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>User ID</th>
                                            <th>Email</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Role</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <?php
// Assuming there's a database connection established already as $db

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// SQL query to fetch data from Users table and join with Roles table to get role name
$sql = "SELECT u.user_id, u.email, u.first_name, u.last_name, r.role_name
        FROM Users u
        INNER JOIN Roles r ON u.role_id = r.role_id";

// Execute the query
$result = mysqli_query($db, $sql);

// Check if there are any rows returned
if ($result) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $user_id = $row['user_id'];
            $fname = $row['first_name'];
            $lname = $row['last_name'];
            $user_email = $row['email'];
           // $role = $row['role_id'];
            $role_name = $row['role_name'];

            echo "<tr>
            <td>" . $row["user_id"] . "</td>
            <td>" . $row["email"] . "</td>
            <td>" . $row["first_name"] . "</td>
            <td>" . $row["last_name"] . "</td>
            <td>" . $row["role_name"] . "</td>
            <td> 
            <form method ='POST' action=''>
            <input  type='text' hidden name='user_id' value='$user_id'>
            <input type='submit' data-id='$user_id'  data-fname='$fname' data-lname='$lname' data-mail='$user_email' data-user_role='$role_name' value='Edit Details' name='edit-lecturer-btn' class='btn btn-success edit-lecturer-modal-btn m-2'>
            <input type='submit' data-id= '$user_id' value='Delete User'  class='btn btn-danger deleteUserBtn'>
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
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addUserForm" method="POST">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select class="form-select" id="role" name="role" required>
                        <option value="">Select Role..</option>
                                <?php $sql=mysqli_query($db,"select * from Roles");
                  while ($rw=mysqli_fetch_array($sql)) {
                    ?>
                                <option value="<?php echo htmlentities($rw['role_id']);?>">
                                    <?php echo htmlentities($rw['role_name']);?></option>
                                <?php
                  }
                  ?>                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Add User</button>
                </form>
            </div>
        </div>
    </div>
</div>
    <!-- ============================================================== -->

    <div id="editUserModal" class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit User Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editUserForm">
                    <input type="hidden" id="editUserId" name="editUserId">
                    <div class="mb-3">
                        <label for="editFirstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="editFirstName" name="editFirstName">
                    </div>
                    <div class="mb-3">
                        <label for="editLastName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="editLastName" name="editLastName">
                    </div>
                    <div class="mb-3">
                        <label for="editEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="editEmail" name="editEmail">
                    </div>
                    <div class="mb-3">
                        <label for="editRole" class="form-label">Role</label>
                        <input type="text" class="form-control" id="editRole" name="editRole" disabled>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
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
    // JavaScript function to handle submitting the form data via AJAX
$(document).ready(function() {
    // Open the modal when the "Add User" button is clicked
    $(".open-lecturer-modal-btn").click(function() {
        $("#addUserModal").modal("show");
    });

    // Submit the form data via AJAX
    $("#addUserForm").submit(function(event) {
        event.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: "add_user.php",
            type: "POST",
            data: formData,
            success: function(response) {
                // Close the modal and reload the page after successful insertion
                $("#addUserModal").modal("hide");
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});

</script>
<script>
    $(document).ready(function() {
        $(".deleteUserBtn").click(function() {
            if (confirm("Are you sure you want to delete this user?")) {
                var userId = $(this).data('id');
                $.ajax({
                    type: "POST",
                    url: "delete_user.php",
                    data: { user_id: userId },
                    success: function(response) {
                        if (response == "success") {
                            alert("User deleted successfully!");
                            // Optionally, you can reload the page or remove the row from the table
                        } else {
                            alert("Failed to delete user.");
                        }
                    }
                });
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        // Handle click event for edit button
        $('.edit-lecturer-modal-btn').click(function(e) {
            e.preventDefault();
            var userId = $(this).data('id');
            var firstName = $(this).data('fname');
            var lastName = $(this).data('lname');
            var email = $(this).data('mail');
            var role = $(this).data('user_role');

            // Populate modal fields with user details
            $('#editUserId').val(userId);
            $('#editFirstName').val(firstName);
            $('#editLastName').val(lastName);
            $('#editEmail').val(email);
            $('#editRole').val(role);

            // Show the modal
            $('#editUserModal').modal('show');
        });

        // Handle form submission for editing user details
        $('#editUserForm').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            // Ajax request to update user details
            $.ajax({
                type: 'POST',
                url: 'update_user_details.php', // Change the URL to your PHP script for updating user details
                data: formData,
                success: function(response) {
                    // Handle success response
                    console.log(response);
                    // Close the modal
                    $('#editUserModal').modal('hide');
                    // Optionally, update the table with the new data
                    location.reload(); // Reload the page or update the table using JavaScript
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>



</body>
</html>
