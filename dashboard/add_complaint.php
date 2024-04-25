<?php
include '../server.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve data from POST request and sanitize
    $subject = mysqli_real_escape_string($db, $_POST['subject']);
    $description = mysqli_real_escape_string($db, $_POST['description']);
    // Get user ID from session and sanitize
    $userId = isset($_SESSION['user_id']) ? intval($_SESSION['user_id']) : null; // Convert to integer
    // Get current timestamp
    $dateCreated = date('Y-m-d H:i:s');

    if ($userId !== null) {
        // SQL query to insert complaint into database using prepared statement
        $sql = "INSERT INTO Complaints (user_id, subject, description, date_created) VALUES (?, ?, ?, ?)";

        // Prepare the statement
        $stmt = mysqli_prepare($db, $sql);

        // Bind parameters
        mysqli_stmt_bind_param($stmt, "isss", $userId, $subject, $description, $dateCreated);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            // Success response
            echo "Complaint added successfully!";
        } else {
            // Error response
            echo "Error: " . mysqli_stmt_error($stmt);
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        // Handle case when user ID is not available
        echo "Error: User ID is not available.";
    }
} else {
    // If not a POST request, redirect to index.php
    header("location: ../index.php"); 
    exit;
}

?>
