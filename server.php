<?php
ob_start();
session_start();

if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {
    echo '<div style="border: 1px solid #ff0000; padding: 10px; background-color: #ffe6e6; margin-bottom: 10px;">';
    foreach ($_SESSION['errors'] as $error) {
        echo "<p style='color: #ff0000; margin: 0;'>Error: $error</p>";
    }
    echo '</div>';
    unset($_SESSION['errors']);
}


try {
  $db = mysqli_connect('localhost', 'root', '', 'aid');
  if (!$db) {
    die('Could not connect: ' . mysqli_connect_error());
}
} catch(Exception $e) {
  echo 'Database Connection Failed.';
}

$errors = array();


if (isset($_POST['login_btn'])) {
  $username = $_POST['email'];
  $password = $_POST['password'];

  if (empty($username)) {
    array_push($errors, "Username is required");
  }
  if (empty($password)) {
    array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
    $encrypted_password = md5($password);

    $login_query = 
    "SELECT Users.*, Roles.role_name
    FROM Users
    INNER JOIN Roles ON Users.role_id = Roles.role_id
    WHERE email='$username' AND password='$encrypted_password' ";

    $results = mysqli_query($db, $login_query);

    if (mysqli_num_rows($results) == 1) {
      $row = mysqli_fetch_assoc($results);
      $_SESSION['user_id'] = $row['user_id']; // Add user ID to session
      $_SESSION['fname'] = $row['first_name'];
      $_SESSION['lname'] = $row['last_name'];
      $_SESSION['email'] = $row['email'];
      $_SESSION['role_id']=$row['role_id'];
      $_SESSION['role_name']=$row['role_name'];
      $_SESSION['success'] = "You are now logged in";

   session_set_cookie_params(0, '/', '', true, true);

   ini_set('session.cookie_secure', 1);
   ini_set('session.cookie_httponly', 1);
   ini_set('session.use_only_cookies', 1);
   ini_set('session.cookie_lifetime', 0);
   session_regenerate_id();

      header('location: ./dashboard/');
    }else{
      array_push($errors, "Incorrect Username or Password");
      header('location: index.php');
    }
  }
}

ob_end_flush();
?>