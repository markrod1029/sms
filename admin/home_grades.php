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
          <p align="center"><big><b>Student Grades </b></big></p>
          <div class="table-responsive">
            <form method="post" action="">
              <!-- Table ng Deductions -->
              <table class="table table-hover table-condensed" id="myTable">
                <thead>
                  <tr>
                  <th>Student ID</th>
                  <th>Student Name</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  // Query para sa pagkuha ng lahat ng deductions kasama ang employee details
                  $query = "SELECT * FROM students ";
                  $result = $connection->query($query);

                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                      ?>
                      <tr>
                      <td><?php echo $row['student_id']; ?></td>
                        <td><?php echo $row['fname'] . ' ' . $row['lname']; ?></td>
                        <td>
                          </button>
                          <!-- Delete Button (Kung nais mo itong ilagay) -->
                          <a class="btn btn-primary" href="student_grade.php?id=<?php echo $row["id"]; ?>">
                            <i class="fa fa-print"></i> View Grade
                          </a>
                        </td>
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

    <?php include("includes/modal_user.php"); ?>
    <?php include("includes/footer.php"); ?>
