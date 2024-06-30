<?php
include ("auth.php"); // Include auth.php file on all secure pages
include ("db.php"); // Include db.php file for database connection
?>

<?php include("includes/header.php"); ?>
<body class="hold-transition login-page">
<?php include("includes/menubar.php"); ?>

    <!-- Jumbotron -->
    <div class="jumbotron">
      <h1>Student Managment System</h1>
    </div>

    <?php include("includes/modal_user.php"); ?>
    <?php include("includes/footer.php"); ?>


    
    