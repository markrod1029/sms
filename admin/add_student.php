<?php
include("db.php"); // Include db.php file for database connection

$lname = $fname = $gender = $type = $division = $contact = $address = $email = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $lname = sanitizeInput($_POST['lname']);
    $fname = sanitizeInput($_POST['fname']);
    $gender = sanitizeInput($_POST['gender']);
    $contact = sanitizeInput($_POST['contact']);
    $address = sanitizeInput($_POST['address']);
    $email = sanitizeInput($_POST['email']);
    $section = sanitizeInput($_POST['section']);
    $year = date("Y");
    $randomNum = mt_rand(1000, 9999);
    $student_id = $year . '-' . $randomNum;
    $password = $student_id;
    // Prepare SQL query using mysqli_real_escape_string for basic input sanitation
    $sql = "INSERT INTO students (student_id, fname, lname, gender, contact, email, password, address, section, created_at)
            VALUES ('$student_id', '$fname', '$lname', '$gender', '$contact', '$email', '$password', '$address', '$section', NOW())";

    if (mysqli_query($connection, $sql)) {
        echo '<script>alert("Student has been added!"); window.location.href="home_students.php";</script>';
    } else {
        echo '<script>alert("An error occurred: ' . mysqli_error($connection) . '"); window.location.href="index.php";</script>';
    }
}

// Close connection
mysqli_close($connection);

// Function to sanitize input data
function sanitizeInput($data) {
    global $connection;
    // Use htmlspecialchars to prevent XSS attacks (optional but recommended)
    $data = htmlspecialchars($data);
    // Use mysqli_real_escape_string to escape special characters
    return mysqli_real_escape_string($connection, $data);
}
?>
