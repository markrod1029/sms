<?php
// Include database connection and authentication files
include ("db.php");
include ("auth.php");

// Fetch grade details based on id from URL parameter
$id = intval($_GET['id']); // Ensure the ID is an integer to prevent SQL injection

$query = "SELECT * FROM grades WHERE id = $id";
$result = mysqli_query($connection, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
} else {
    echo "Grade not found."; // Handle Subjects not found scenario
    exit();
}
?>

<?php include("includes/header.php"); ?>
<body class="hold-transition login-page">
    <?php include("includes/menubar.php"); ?>

    <!-- Jumbotron -->
    <div class="jumbotron">
        <h1>Update Grade</h1>
    </div>

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <form class="form-horizontal" action="update_grade.php" method="post">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($_GET['id']); ?>" />

                <!-- Student Selection -->
                <div class="form-group">
                    <label class="col-sm-4 control-label">Student Name</label>
                    <div class="col-sm-8">
                        <select name="student_id" id="student_id" class="form-control" readonly>
                            <option value="" hidden>Select Student</option>
                            <?php
                            $student_query = "SELECT id, fname, lname FROM students ORDER BY fname ASC";
                            $student_result = $connection->query($student_query);
                            if ($student_result->num_rows > 0) {
                                while ($student_row = $student_result->fetch_assoc()) {
                                    $selected = ($student_row['id'] == $row['student_id']) ? 'selected' : '';
                                    echo '<option value="' . $student_row['id'] . '" ' . $selected . '>' . $student_row['fname'] . ' ' . $student_row['lname'] . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <!-- Subject Selection -->
                <div class="form-group">
                    <label class="col-sm-4 control-label">Subject</label>
                    <div class="col-sm-8">
                        <select name="subject_id" id="subject_id" class="form-control" onchange="updateTeacherName()" readonly>
                            <option value="" hidden>Select Subject</option>
                            <?php
                            $subject_query = "SELECT id, subject_name, teacher_name FROM subjects ORDER BY subject_name ASC";
                            $subject_result = $connection->query($subject_query);
                            if ($subject_result->num_rows > 0) {
                                while ($subject_row = $subject_result->fetch_assoc()) {
                                    $selected = ($subject_row['id'] == $row['subject_id']) ? 'selected' : '';
                                    echo '<option value="' . $subject_row['id'] . '" data-teacher="' . $subject_row['teacher_name'] . '" ' . $selected . '>' . $subject_row['subject_name'] . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <!-- Batch Class Selection -->
                <div class="form-group">
                    <label class="col-sm-4 control-label">Batch Class</label>
                    <div class="col-sm-8">
                        <select name="batch" class="form-control" required>
                            <?php
                            $currentYear = date("Y");
                            for ($year = $currentYear; $year <= $currentYear + 10; $year++) {
                                $selected = ($year == $row['batch']) ? 'selected' : '';
                                echo "<option value='$year' $selected>$year</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <!-- Subject Grade Input -->
                <div class="form-group">
                    <label class="col-sm-4 control-label">Subject Grade</label>
                    <div class="col-sm-8">
                        <input type="text" name="grade" class="form-control" required value="<?php echo htmlspecialchars($row['grade']); ?>">
                    </div>
                </div>

                <!-- Form Buttons -->
                <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-8">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="home_grades.php" class="btn btn-default">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php include("includes/modal_user.php"); ?>
    <?php include("includes/footer.php"); ?>

    <script>
        function updateTeacherName() {
            var subjectSelect = document.getElementById("subject_id");
            var selectedOption = subjectSelect.options[subjectSelect.selectedIndex];
            var teacherName = selectedOption.getAttribute("data-teacher");
            document.getElementById("teacher_name").value = teacherName;
        }
    </script>
</body>
</html>
