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

    
    <div class="well bs-component">
      <form class="form-horizontal">
        <fieldset>
          <p align="center"><big><b>Subjects Records </b></big></p>
          <div class="table-responsive">
            <form method="post" action="">
              <!-- Table ng Deductions -->
              <table class="table table-hover table-condensed" id="myTable">
                <thead>
                  <tr>
                    <th>Subject Name</th>
                    <th>Teacher Name</th>
                    <th>Time Start</th>
                    <th>Time End</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  // Query para sa pagkuha ng lahat ng deductions kasama ang employee details
                  $query = "SELECT * FROM subjects ";
                  $result = $connection->query($query);

                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                      ?>
                      <tr>
                        <td><?php echo $row['subject_name']; ?></td>
                        <td><?php echo $row['teacher_name']; ?></td>
                        <td><?php echo date("g:i A", strtotime($row['time_start'])); ?></td>
                        <td><?php echo date("g:i A", strtotime($row['time_end'])); ?></td>

                      </tr>
                      <?php
                    }
                  } else {
                    echo "<tr><td colspan='9'>No records found.</td></tr>";
                  }
                  ?>
                </tbody>
              </table>

            </form>
          </div>
        </fieldset>
      </form>
    </div>
    <?php include("includes/modal_user.php"); ?>
    <?php include("includes/footer.php"); ?>


    
    