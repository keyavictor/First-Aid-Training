<?php
// Assuming there's a database connection established already as $db
include '../server.php';

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $userId = $_POST['editUserId'];
    $firstName = $_POST['editFirstName'];
    $lastName = $_POST['editLastName'];
    $email = $_POST['editEmail'];

    // Update user details in the database
    $sql = "UPDATE Users 
            SET first_name = '$firstName', last_name = '$lastName', email = '$email' 
            WHERE user_id = $userId";

    if (mysqli_query($db, $sql)) {
        // If the query was successful, return success message
        echo json_encode(array("status" => "success", "message" => "User details updated successfully."));
    } else {
        // If there was an error with the query, return error message
        echo json_encode(array("status" => "error", "message" => "Error updating user details: " . mysqli_error($db)));
    }
} else {
    // If the request method is not POST, return error message
    echo json_encode(array("status" => "error", "message" => "Invalid request method."));
}
?>
