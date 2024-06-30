<?php
// Include database connection
include("db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $subject_id = intval($_POST['subject_id']);
    $student_id = intval($_POST['student_id']);
    $batch = $_POST['batch'];
    $grade = $_POST['grade'];
    $created_at = date("Y-m-d H:i:s");

    // Check if the grade for the same subject, student, and batch already exists
    $check_query = "SELECT * FROM grades WHERE subject_id = ? AND student_id = ? AND batch = ?";
    $check_stmt = $connection->prepare($check_query);
    $check_stmt->bind_param("iis", $subject_id, $student_id, $batch);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        // If a matching record exists, do not insert and show an alert
        echo "<script>
                alert('This grade already exists for the same subject, student, and batch!');
                window.location.href='home_Manage_grades.php';
              </script>";
    } else {
        // Prepare an insert statement
        $query = "INSERT INTO grades (subject_id, student_id, batch, grade, created_at) VALUES (?, ?, ?, ?, ?)";

        // Prepare and bind
        $stmt = $connection->prepare($query);
        $stmt->bind_param("iisss", $subject_id, $student_id, $batch, $grade, $created_at);

        if ($stmt->execute()) {
            echo "<script>
                    alert('Grade has been added successfully!');
                    window.location.href='home_Manage_grades.php';
                  </script>";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close statement
        $stmt->close();
    }

    // Close check statement and connection
    $check_stmt->close();
    $connection->close();

    exit();
} else {
    echo "Invalid request.";
}
?>
