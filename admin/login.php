<?php
require('db.php');
session_start();
// If form submitted, check and authenticate user
if (isset($_POST['username'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Sanitize inputs (optional, but recommended)
    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);

    // Check user in database
    $query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) == 1) {
        // Retrieve user details
        $row = mysqli_fetch_assoc($result);
        $id = $row['id'];
        $fullname = $row['fullname'];
        $email = $row['email'];
        $role = 'admin';

        // Store user information in session variables
        $_SESSION['username'] = $username;
        $_SESSION['id'] = $id;
        $_SESSION['fullname'] = $fullname;
        $_SESSION['email'] = $email;
        $_SESSION['role'] = $role;

        // Redirect to home page
        header("Location: home.php");
        exit; // Ensure script stops execution after redirection
    } else {
        ?>
        <script>
            alert('Invalid login, please try again.');
            window.location.href='login.php';
        </script>
        <?php
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Employee Login - Payroll System</title>
  <link rel="stylesheet" href="assets/css/login.css">
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f0f0f0; /* Light gray background */
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh; /* Full viewport height */
      margin: 0;
    }
    .container {
      width: 400px; /* Adjust width as needed */
      background-color: #fff; /* White background for the login form */
      padding: 30px;
      border-radius: 5px; /* Rounded corners */
      box-shadow: 0 0 10px rgba(0,0,0,0.1); /* Box shadow for a slight lift */
    }
    .container h1 {
      text-align: center;
      padding-bottom: 20px;
    }
    .container form {
      margin-top: 20px;
    }
    .container input[type="text"],
    .container input[type="password"],
    .container input[type="submit"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }
    .container input[type="submit"] {
      background-color: #4CAF50; /* Green background color */
      color: white;
      border: none;
      cursor: pointer;
    }
    .container input[type="submit"]:hover {
      background-color: #45a049; /* Darker green hover color */
    }
  </style>
</head>
<body>
<div class="container">
  <section>
    <form action="" method="post">
      <h1>Login Panel</h1>
      <div>
        <input name="username" type="text" placeholder="Username" required>
      </div>
      <div>
        <input name="password" type="password" placeholder="Password" required>
      </div>
      <div>
        <input type="submit" value="Login" />
      </div>
    </form>
  </section>
</div>
</body>
</html>
