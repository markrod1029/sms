<?php
include ("auth.php");
include ("db.php");
?>
<?php include("includes/header.php"); ?>
<body class="hold-transition login-page">
<?php include("includes/menubar.php"); ?>

    <!-- Jumbotron -->
    <div class="jumbotron">
      <h1>Student Grade Section</h1>
    </div>

    <div class="well bs-component">
      <form class="form-horizontal">

        <fieldset>
          <p align="center"><big><b><?php echo $_SESSION['fullname']?> Grades </b></big></p>
          <div class="table-responsive">
            <form method="post" action="">
              <!-- Table ng Deductions -->
              <table class="table table-hover table-condensed" id="myTable">
                <thead>
                  <tr>
                    <th>Subject Name</th>
                    <th>Batch</th>
                    <th>Grade</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  // Query para sa pagkuha ng lahat ng deductions kasama ang employee details

                  $id = $_SESSION['id'];
                  $query = "SELECT *, grades.id AS grade_id FROM grades 
                  LEFT JOIN students ON students.id = grades.student_id
                  LEFT JOIN subjects ON subjects.id = grades.subject_id
                  WHERE students.id = '$id' ";
                  $result = $connection->query($query);

                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                      ?>
                      <tr>
                        <td><?php echo $row['subject_name']; ?></td>
                        <td><?php echo $row['batch']; ?></td>
                        <td><?php echo $row['grade']; ?></td>
                        
                      </tr>
                      <?php
                    }
                  } else {
                    echo "<tr><td colspan='8'>No records found.</td></tr>";
                  }
                  ?>
                </tbody>
              </table>

            </form>
          </div>
        </fieldset>
      </form>
    </div>

    <?php include("includes/grade_modal.php"); ?>
    <?php include("includes/modal_user.php"); ?>
    <?php include("includes/footer.php"); ?>
