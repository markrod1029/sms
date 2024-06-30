<?php
// Include database connection and authentication files
include("db.php");
include("auth.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_SESSION['id'];
    $fname = mysqli_real_escape_string($connection, $_POST['fname']);
    $lname = mysqli_real_escape_string($connection, $_POST['lname']);
    $gender = mysqli_real_escape_string($connection, $_POST['gender']);
    $contact = mysqli_real_escape_string($connection, $_POST['contact']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $address = mysqli_real_escape_string($connection, $_POST['address']);
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
        $query = "UPDATE students SET fname='$fname', lname='$lname', gender='$gender', contact='$contact', email='$email', password='$password', address='$address' WHERE id='$id'";
        $message = "Profile and password updated successfully.";
    } else {
        $query = "UPDATE students SET fname='$fname', lname='$lname', gender='$gender', contact='$contact', email='$email', address='$address' WHERE id='$id'";
        $message = "Profile updated successfully.";
    }

    // Execute query
    if (mysqli_query($connection, $query)) {
        $_SESSION['fullname'] = $fname . ' '. $lname;
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
