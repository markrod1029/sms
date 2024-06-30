<?php
// Include database connection and authentication files
include("db.php");
include("auth.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $id = intval($_POST['id']);
    $lname = $_POST['lname'];
    $fname = $_POST['fname'];
    $gender = $_POST['gender'];
    $section = $_POST['section'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $net = intval($_POST['net']);
    $updated_at = date("Y-m-d H:i:s");

    // Prepare an update statement
    if (empty($password)) {
        // Password is empty, do not update the password
        $query = "UPDATE students SET fname = '$fname', lname = '$lname', gender = '$gender', contact = '$contact', email = '$email', address = '$address', updated_at = '$updated_at' WHERE id = '$id'";
    } else {
        // Password is not empty, update the password
        $query = "UPDATE students SET fname = '$fname', lname = '$lname', gender = '$gender', contact = '$contact', email = '$email', address = '$address', password = '$password', updated_at = '$updated_at' WHERE id = '$id'";
    }

    if (mysqli_query($connection, $query)) {
        echo "<script>
                alert('Student account has been updated!');
                window.location.href='home_students.php';
              </script>";
    } else {
        echo "Error updating record: " . mysqli_error($connection);
    }

    // Close the database connection
    mysqli_close($connection);

    exit();
} else {
    echo "Invalid request.";
}
?>
