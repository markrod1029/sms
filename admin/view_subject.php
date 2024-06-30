<?php
// Include database connection and authentication files
include ("db.php");
include ("auth.php");

// Fetch Subjects details based on id from URL parameter
$id = intval($_GET['id']); // Ensure the ID is an integer to prevent SQL injection

$query = "SELECT * FROM subjects WHERE id = $id";
$result = mysqli_query($connection, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
} else {
    echo "Subjects not found."; // Handle Subjects not found scenario
    exit();
}
?>

<?php include("includes/header.php"); ?>
<body class="hold-transition login-page">
<?php include("includes/menubar.php"); ?>

        <!-- Jumbotron -->
        <div class="jumbotron">
            <h1>Update Subjects</h1>
        </div>

        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <form class="form-horizontal" action="update_subject.php" method="post">
                    <input type="hidden" name="id"
                        value="<?php echo htmlspecialchars($row['id']); ?>" />

                    <div class="form-group">
                        <label class="col-sm-5 control-label">Subject Name:</label>
                        <div class="col-sm-7">
                            <input type="text" name="subject" class="form-control"
                                value="<?php echo htmlspecialchars($row['subject_name']); ?>" required>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-5 control-label">Teacher Name:</label>
                        <div class="col-sm-7">
                            <input type="text" name="teacher" class="form-control"
                                value="<?php echo htmlspecialchars($row['teacher_name']); ?>" required>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-5 control-label">Time Start:</label>
                        <div class="col-sm-7">
                            <input type="time" name="time_start" class="form-control"
                                value="<?php echo htmlspecialchars($row['time_start']); ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-5 control-label">Time End:</label>
                        <div class="col-sm-7">
                            <input type="time" name="time_end" class="form-control"
                                value="<?php echo htmlspecialchars($row['time_end']); ?>" required>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-sm-offset-5 col-sm-7">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="home_subjects.php" class="btn btn-default">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <?php include("includes/modal_user.php"); ?>
    <?php include("includes/footer.php"); ?>