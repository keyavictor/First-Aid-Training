<?php

include '../server.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = md5($_POST['password']); // Hashing the password using MD5 (not recommended for security)
    $first_name = mysqli_real_escape_string($db, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($db, $_POST['last_name']);
    $role_id = (int)$_POST['role']; // Convert role to integer

    // Validate inputs
    if (empty($email) || empty($password) || empty($first_name) || empty($last_name) || empty($role_id)) {
        echo "All fields are required";
        exit;
    }

    // Prepare and execute SQL query
    $sql = "INSERT INTO Users (email, password, first_name, last_name, role_id) VALUES ('$email', '$password', '$first_name', '$last_name', $role_id)";
    if (mysqli_query($db, $sql)) {
        echo "User added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($db);
    }
}


?>


