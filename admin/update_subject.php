<?php
include ("db.php");

if  ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $subject_name = $_POST['subject'];
    $teacher_name = $_POST['teacher'];
    $time_start = $_POST['time_start'];
    $time_end = $_POST['time_end'];

    // Check if the updated subject and teacher combination already exists (excluding the current record)
    $check_query = "SELECT * FROM subjects WHERE subject_name = '$subject_name' AND teacher_name = '$teacher_name' AND id != $id";
    $check_result = $connection->query($check_query);

    if ($check_result->num_rows > 0) {
        // If the combination exists, do not update and show an alert
        ?>
        <script>
            alert('This subject and teacher combination already exists!');
            window.location.href = 'update_subject.php?id=<?php echo $id; ?>';
        </script>
        <?php
    } else {
        // If the combination does not exist, proceed with the update
        $update_query = "UPDATE subjects 
                         SET  teacher_name = '$teacher_name', subject_name = '$subject_name', time_start = '$time_start', time_end = '$time_end' 
                         WHERE id = $id";

        if ($connection->query($update_query) === TRUE) { ?>
            <script>
                alert('Subject Updated Successfully!');
                window.location.href = 'home_subjects.php';
            </script>
        <?php } else {
            echo "Error: " . $update_query . "<br>" . $connection->error;
        }
    }

    $connection->close();
}
?>
