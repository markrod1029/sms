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
      <button type="button" data-toggle="modal" data-target="#addGrade" class="btn btn-info"
            style="border-radius:0%"><i class="fa fa-plus"> </i> Add Grade</button>

        <fieldset>
          <p align="center"><big><b>Student Grades </b></big></p>
          <div class="table-responsive">
            <form method="post" action="">
              <!-- Table ng Deductions -->
              <table class="table table-hover table-condensed" id="myTable">
                <thead>
                  <tr>
                    <th>Student Name</th>
                    <th>Subject Name</th>
                    <th>Batch</th>
                    <th>Grade</th>
                    <th>Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  // Query para sa pagkuha ng lahat ng deductions kasama ang employee details
                  $query = "SELECT *, grades.id AS grade_id FROM grades 
                  LEFT JOIN students ON students.id = grades.student_id
                  LEFT JOIN subjects ON subjects.id = grades.subject_id";
                  $result = $connection->query($query);

                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                      ?>
                      <tr>
                        <td><?php echo $row['fname'] . ' ' . $row['lname']; ?></td>
                        <td><?php echo $row['subject_name']; ?></td>
                        <td><?php echo $row['batch']; ?></td>
                        <td><?php echo $row['grade']; ?></td>
                        <td><?php echo date('M d, Y', strtotime($row['created_at'])); ?></td>
                        <td>
                          <!-- Edit Button -->
                          <a class="btn btn-warning edit-btn"
                            href="view_grade.php?id=<?php echo $row["grade_id"]; ?>">
                            <i class="fa fa-edit"></i> Edit
                          </a>
                          <!-- Delete Button (Kung nais mo itong ilagay) -->
                          <a class="btn btn-danger"
                            href="delete_grade.php?id=<?php echo $row["grade_id"]; ?>">
                            <i class="fa fa-trash"></i> Delete
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

    <?php include("includes/grade_modal.php"); ?>
    <?php include("includes/modal_user.php"); ?>
    <?php include("includes/footer.php"); ?>
