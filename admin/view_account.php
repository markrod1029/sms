<?php
// Include database connection and authentication files
include ("db.php");
include ("auth.php");

// Fetch employee details based on emp_id from URL parameter
$id = intval($_REQUEST['emp_id']); // Ensure the ID is an integer to prevent SQL injection

$query = $connection->prepare("SELECT * FROM students WHERE id = ?");
$query->bind_param("i", $id);
$query->execute();
$result = $query->get_result();

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "Students not found."; // Handle employee not found scenario
    exit();
}

// Close the statement
$query->close();
?>

<?php include("includes/header.php"); ?>
<body class="hold-transition login-page">
<?php include("includes/menubar.php"); ?>

    <!-- Jumbotron -->
    <div class="jumbotron">
      <h1>Update Student</h1>
    </div>

        <?php if (isset($row)): ?>
            <form class="form-horizontal" action="update_account.php" method="post" name="form">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>" />

                <div class="form-group">
                    <label class="col-sm-5 control-label">Student ID:</label>
                    <div class="col-sm-4">
                        <input type="text" name="net" class="form-control"
                            value="<?php echo htmlspecialchars($row['student_id']); ?>" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-5 control-label">Last Name:</label>
                    <div class="col-sm-4">
                        <input type="text" name="lname" class="form-control"
                            value="<?php echo htmlspecialchars($row['lname']); ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-5 control-label">First Name:</label>
                    <div class="col-sm-4">
                        <input type="text" name="fname" class="form-control"
                            value="<?php echo htmlspecialchars($row['fname']); ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-5 control-label">Gender:</label>
                    <div class="col-sm-4">
                        <input type="text" name="gender" class="form-control"
                            value="<?php echo htmlspecialchars($row['gender']); ?>" required>
                    </div>
                </div>
              
                <div class="form-group">
                    <label class="col-sm-5 control-label">Contact:</label>
                    <div class="col-sm-4">
                        <input type="text" name="contact" class="form-control"
                            value="<?php echo htmlspecialchars($row['contact']); ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-5 control-label">Address:</label>
                    <div class="col-sm-4">
                        <input type="text" name="address" class="form-control"
                            value="<?php echo htmlspecialchars($row['address']); ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-5 control-label">Email:</label>
                    <div class="col-sm-4">
                        <input type="email" name="email" class="form-control"
                            value="<?php echo htmlspecialchars($row['email']); ?>" required>
                    </div>
                </div>
              
                
                <div class="form-group">
                    <label class="col-sm-5 control-label">Section:</label>
                    <div class="col-sm-4">
                        <input type="text" name="section" class="form-control"
                            value="<?php echo htmlspecialchars($row['section']); ?>" required>
                    </div>
                </div>


                
                <div class="form-group">
                    <label class="col-sm-5 control-label">Password:</label>
                    <div class="col-sm-4">
                        <input type="password" name="section" class="form-control"
                            >
                    </div>
                </div>



                <div class="form-group">
                    <label class="col-sm-5 control-label"></label>
                    <div class="col-sm-4">
                        <input type="submit" name="submit" style="border-radius:0%" value="Update" class="btn btn-danger">
                        <a href="home_employee.php" style="border-radius:0%" class="btn btn-primary">Cancel</a>
                    </div>
                </div>
            </form>
        <?php endif; ?>

        <?php include("includes/modal_user.php"); ?>
    <?php include("includes/footer.php"); ?>