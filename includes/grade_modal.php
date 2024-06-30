<!-- Modal for adding new grade -->
<div class="modal fade" id="addGrade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="padding:20px 50px;">
                <button type="button" class="close" data-dismiss="modal" title="Close">&times;</button>
                <h3 align="center"><b>Add New Grade</b></h3>
            </div>
            <div class="modal-body" style="padding:40px 50px;">
                <form class="form-horizontal" action="add_grade.php" method="post" id="gradeForm">

                    <!-- Student Selection -->
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Student Name</label>
                        <div class="col-sm-8">
                            <select name="student_id" id="student_id" class="form-control" required>
                                <option value="" hidden>Select Student</option>
                                <?php
                                $connection = new mysqli($servername, $username, $password, $dbname);
                                if ($connection->connect_error) {
                                    die("Connection failed: " . $connection->connect_error);
                                }

                                $student_query = "SELECT id, fname, lname FROM students ORDER BY fname ASC";
                                $student_result = $connection->query($student_query);
                                if ($student_result->num_rows > 0) {
                                    while ($student_row = $student_result->fetch_assoc()) {
                                        echo '<option value="' . $student_row['id'] . '">' . $student_row['fname'] . ' ' . $student_row['lname'] . '</option>';
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
                            <select name="subject_id" id="subject_id" class="form-control" required onchange="updateTeacherName()">
                                <option value="" hidden>Select Subject</option>
                                <?php
                                $subject_query = "SELECT id, subject_name, teacher_name FROM subjects ORDER BY subject_name ASC";
                                $subject_result = $connection->query($subject_query);
                                if ($subject_result->num_rows > 0) {
                                    while ($subject_row = $subject_result->fetch_assoc()) {
                                        echo '<option value="' . $subject_row['id'] . '" data-teacher="' . $subject_row['teacher_name'] . '">' . $subject_row['subject_name'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <!-- Teacher Name Display -->
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Teacher Name</label>
                        <div class="col-sm-8">
                            <input type="text" name="teacher_name" id="teacher_name" class="form-control" readonly>
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
                                    echo "<option value='$year'>$year</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <!-- Subject Grade Input -->
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Subject Grade</label>
                        <div class="col-sm-8">
                            <input type="text" name="grade" class="form-control" required>
                        </div>
                    </div>

                    <!-- Form Buttons -->
                    <div class="form-group">
                        <label class="col-sm-4 control-label"></label>
                        <div class="col-sm-8">
                            <button type="submit" name="submit" class="btn btn-success" style="border-radius:60px;">
                                <i class="fa fa-check"></i> Insert
                            </button>
                            <button type="reset" class="btn btn-danger" style="border-radius:60px;">
                                <i class="fa fa-times"></i> Reset
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<script>
function updateTeacherName() {
    var subjectSelect = document.getElementById("subject_id");
    var selectedOption = subjectSelect.options[subjectSelect.selectedIndex];
    var teacherName = selectedOption.getAttribute("data-teacher");
    document.getElementById("teacher_name").value = teacherName;
}
</script>
