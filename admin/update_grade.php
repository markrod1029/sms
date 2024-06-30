<?php
// Include database connection
include("db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $batch = $_POST['batch'];
    $grade = $_POST['grade'];

    // Check if the updated grade for the same subject, student, and batch already exists
    $check_query = "SELECT * FROM grades WHERE subject_id = (SELECT subject_id FROM grades WHERE id = $id) 
                    AND student_id = (SELECT student_id FROM grades WHERE id = $id) 
                    AND batch = '$batch' 
                    AND id != $id";
    $check_result = $connection->query($check_query);

    if ($check_result->num_rows > 0) {
        // If a matching record exists, show an alert and redirect
        echo "<script>
                alert('This grade already exists for the same subject, student, and batch!');
                window.location.href='home_grades.php';
              </script>";
    } else {
        // Update query
        $update_query = "UPDATE grades SET batch = '$batch', grade = '$grade' WHERE id = $id";

        if ($connection->query($update_query) === TRUE) {
            echo "<script>
                    alert('Grade updated successfully!');
                    window.location.href='home_grades.php';
                  </script>";
        } else {
            echo "Error updating grade: " . $connection->error;
        }
    }

    // Close connection
    $connection->close();
    exit();
} else {
    echo "Invalid request.";
}
?>
