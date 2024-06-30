<?php
// Include database connection and authentication files
include("db.php");
include("auth.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_SESSION['id'];
    $fullname = mysqli_real_escape_string($connection, $_POST['fullname']);
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $new_password = mysqli_real_escape_string($connection, $_POST['new_password']);
    $confirm_password = mysqli_real_escape_string($connection, $_POST['confirm_password']);

    // Check if new password and confirm password match
    if (!empty($new_password) && $new_password !== $confirm_password) {
        ?>
        <script>
            alert('New password and confirm password do not match.');
            window.location.href='view_profile.php';
        </script>
        <?php 
        exit();
    }

    // Update query based on whether new password is provided or not
    if (!empty($new_password) && $new_password === $confirm_password) {
        $password = $new_password;
        $query = "UPDATE user SET fullname='$fullname', username='$username', email='$email', password='$password' WHERE id='$id'";
        $message = "Profile and password updated successfully.";
    } else {
        $query = "UPDATE user SET fullname='$fullname', username='$username', email='$email' WHERE id='$id'";
        $message = "Profile updated successfully.";
    }

    // Execute query
    if (mysqli_query($connection, $query)) {
        $_SESSION['fullname'] = $fullname;
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        ?>
        <script>
            alert('<?php echo $message; ?>');
            window.location.href='view_profile.php';
        </script>
        <?php
    } else {
        echo "Error updating record: " . mysqli_error($connection);
    }
}
?>
