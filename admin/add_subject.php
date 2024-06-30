<?php
include ("db.php");

if (isset($_POST['submit'])) {
    $subject_name = $_POST['subject'];
    $teacher_name = $_POST['teacher'];
    $time_start = $_POST['time_start'];
    $time_end = $_POST['time_end'];

    // Check if the subject and teacher combination already exists
    $check_query = "SELECT * FROM subjects WHERE subject_name = '$subject_name' AND teacher_name = '$teacher_name'";
    $check_result = $connection->query($check_query);

    if ($check_result->num_rows > 0) {
        // If the combination exists, do not insert and show an alert
        ?>
        <script>
            alert('This subject and teacher combination already exists!');
            window.location.href = 'home_subjects.php';
        </script>
        <?php
    } else {
        // If the combination does not exist, proceed with the insertion
        $insert_query = "INSERT INTO subjects (teacher_name, subject_name, time_start, time_end, created_at)
                         VALUES ('$teacher_name', '$subject_name', '$time_start', '$time_end', NOW())";

        if ($connection->query($insert_query) === TRUE) { ?>
            <script>
                alert('Subjects Added Successfully!');
                window.location.href = 'home_subjects.php';
            </script>
        <?php } else {
            echo "Error: " . $insert_query . "<br>" . $connection->error;
        }
    }


    $connection->close();
}
?>
