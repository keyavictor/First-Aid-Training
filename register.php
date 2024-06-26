<?php
// Include the database connection file
$servername = "localhost";
$username = "root";
$password = "";
$database = "aid";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST['email'];
    $password = md5($_POST['password']); // Hash the password using MD5
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $role_id = 2; // Set default role ID to 1 (User)

    // Prepare and execute SQL statement to insert data into Users table
    $sql = "INSERT INTO Users (email, password, first_name, last_name, role_id) 
            VALUES ('$email', '$password', '$first_name', '$last_name', $role_id)";

    if ($conn->query($sql) === TRUE) {
        // Redirect to login page after successful registration
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include './components/head.php'; ?>
    <title>Maseno | First Aid</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-JTUxE1qOq/+yLh9CcUztoKZyFHEdEHLgog8BiA/+BzSN0REXzLLpfvAqooFd7Sgp" crossorigin="anonymous">
    <script>
        // JavaScript function to validate form fields
        function validateForm() {
            var email = document.getElementById('email').value;
            var password = document.getElementById('password').value;
            var confirmPassword = document.getElementById('confirm_password').value;
            var firstName = document.getElementById('first_name').value;
            var lastName = document.getElementById('last_name').value;

            // Check if any field is empty
            if (email == '' || password == '' || confirmPassword == '' || firstName == '' || lastName == '') {
                alert('All fields are required');
                return false;
            }

            // Check if email is in the correct format
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                alert('Please enter a valid email address');
                return false;
            }

            // Check if passwords match
            if (password !== confirmPassword) {
                alert('Passwords do not match');
                return false;
            }

            return true; // Form is valid
        }
    </script>
</head>
<body style="background-color:#d2d6de">
    <div class="container">
        <div class="row mt-5 ml-1 mr-1 ">
            <div class="col-md-3"></div>
            <div class="col-md-6 col-md-6 mt-5 text-center text-light" style="background-color:#00a7d0">
                <img src="./static/images/logo.png" class="img-fluid" height="120" width="120" />
                <h2 class="text-center">Register</h2>
            </div>
            <div class="col-md-3"></div>
        </div>

        <!-- Registration form -->
        <div class="row ml-1 mr-1 mb-4">
            <div class="col-md-3"></div>
            <div class="col-md-6 p-3" style="background-color:#fff">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return validateForm()">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirm Password:</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                    </div>
                    <div class="mb-3">
                        <label for="first_name" class="form-label">First Name:</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name:</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <a href="./index.php" class="text-success m-2 btn-block">Have an account?</a>
                        </div>
                        <div class="col-md-5">
                            <button type="submit" class="btn btn-info btn-block">Register</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-U4s5JfuaxhOywOtwcRFTxu6TJiaF7y4F9EPtzCUtIf7wFy/3fIS6DkqXqNXrEKyB" crossorigin="anonymous"></script>
</body>
</html>

