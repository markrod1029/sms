<?php
// Include database connection and authentication files
include ("db.php");
include ("auth.php");

// Fetch user data from the database using session user ID
$id = $_SESSION['id'];
$query = "SELECT * FROM user WHERE id = '$id'";
$result = mysqli_query($connection, $query);
$user = mysqli_fetch_assoc($result);
?>
<?php include("includes/header.php"); ?>
<body class="hold-transition login-page">
    <?php include("includes/menubar.php"); ?>

        <!-- Jumbotron -->
        <div class="jumbotron">
            <h1>Update Account</h1>
        </div>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <?php echo $_SESSION['error'];
                unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <form class="form-horizontal" action="update_profile.php" method="post" name="form">
            <div class="form-group">
                <label class="col-sm-5 control-label">Full Name:</label>
                <div class="col-sm-4">
                    <input type="text" name="fullname" class="form-control"
                        value="<?php echo htmlspecialchars($user['fullname']); ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-5 control-label">Username:</label>
                <div class="col-sm-4">
                    <input type="text" name="username" class="form-control"
                        value="<?php echo htmlspecialchars($user['username']); ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-5 control-label">Email:</label>
                <div class="col-sm-4">
                    <input type="email" name="email" class="form-control"
                        value="<?php echo htmlspecialchars($user['email']); ?>" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-5 control-label">New Password:</label>
                <div class="col-sm-4">
                    <input type="password" name="new_password" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-5 control-label">Confirm New Password:</label>
                <div class="col-sm-4">
                    <input type="password" name="confirm_password" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-5 control-label"></label>
                <div class="col-sm-4">
                    <input type="submit" name="submit" style="border-radius:0%" value="Update" class="btn btn-danger">
                    <a href="home.php" style="border-radius:0%" class="btn btn-primary">Cancel</a>
                </div>
            </div>
        </form>

 
        <?php include("includes/modal_user.php"); ?>
    <?php include("includes/footer.php"); ?>