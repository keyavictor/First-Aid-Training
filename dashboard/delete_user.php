<?php
// Assuming there's a database connection established already as $db
include '../server.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["user_id"])) {
    $userId = $_POST["user_id"];

    // SQL query to delete user
    $sql = "DELETE FROM Users WHERE user_id = $userId";

    if (mysqli_query($db, $sql)) {
        echo "success";
    } else {
        echo "error";
    }
} else {
    echo "Invalid request.";
}
?>