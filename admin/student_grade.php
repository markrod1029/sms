<?php
include ("auth.php");
include ("db.php");

if (isset($_GET['id'])) {
    $student_id = $_GET['id'];

    // Query to get all unique batches for the student
    $batch_query = "SELECT DISTINCT batch FROM grades WHERE student_id = '$student_id' ORDER BY batch ASC";
    $batch_result = mysqli_query($connection, $batch_query);

    include("includes/header.php");
    echo '<body class="hold-transition login-page">';
    include("includes/menubar.php");

    if (mysqli_num_rows($batch_result) > 0) {
        while ($batch_row = mysqli_fetch_assoc($batch_result)) {
            $batch = $batch_row['batch'];
?>
            <div class="well bs-component">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Grades for Batch <?php echo $batch; ?></strong>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-condensed">
                            <thead>
                                <tr>
                                    <th>Subject Name</th>
                                    <th>Teacher Name</th>
                                    <th>Grade</th>
                                </tr>
                            </thead>
                            <tbody>
<?php
            // Query to fetch grades for the specific batch
            $sql = "SELECT subjects.subject_name, subjects.teacher_name, grades.grade
                    FROM grades
                    LEFT JOIN subjects ON subjects.id = grades.subject_id
                    WHERE grades.student_id = '$student_id' AND grades.batch = '$batch'";

            $result = mysqli_query($connection, $sql);
            if (mysqli_num_rows($result) > 0) {
                $totalGrades = 0;
                $countGrades = 0;

                while ($row = mysqli_fetch_assoc($result)) {
                    // Check if the grade is numeric
                    $grade = $row['grade'];
                    if (is_numeric($grade)) {
                        $totalGrades += $grade;
                        $countGrades++;
                    }
?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['subject_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['teacher_name']); ?></td>
                        <td><?php echo htmlspecialchars($grade); ?></td>
                    </tr>
<?php
                }

                // Compute overall average for the batch
                if ($countGrades > 0) {
                    $overallAverage = $totalGrades / $countGrades;
?>
                    <tr>
                        <td colspan="2" class="text-center"><strong>Overall Average</strong></td>
                        <td><strong><?php echo number_format($overallAverage, 2); ?></strong></td>
                    </tr>
<?php
                } else {
?>
                    <tr>
                        <td colspan="2" class="text-center"><strong>Overall Average</strong></td>
                        <td><strong>INC</strong></td>
                    </tr>
<?php
                }
            } else {
                echo "<tr><td colspan='3' class='text-center'>No grades found for this batch.</td></tr>";
            }
?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
<?php
        }
    } else {
?>
        <div class="well bs-component">
            <div class="card">
                <div class="card-header">
                    <strong class="card-title">Student Grades</strong>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-condensed">
                        <thead>
                            <tr>
                                <th>Subject Name</th>
                                <th>Teacher Name</th>
                                <th>Grade</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="3" class="text-center">No batches found for this student.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
<?php
    }

    include("includes/modal_user.php");
    include("includes/footer.php");
} else {
    echo '<div class="col-md-12"><p>Invalid request.</p></div>';
}

// Close connection
mysqli_close($connection);
?>
