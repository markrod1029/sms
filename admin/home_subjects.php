<?php
include ("auth.php");
include ("db.php");
?>

<?php include("includes/header.php"); ?>
  <body class="hold-transition login-page">
  <?php include("includes/menubar.php"); ?>
    <div class="jumbotron">
      <h1>Manage Subjects</h1>
    </div>

    <div class="well bs-component">
      <form class="form-horizontal">
        <fieldset>
          <button type="button" data-toggle="modal" data-target="#addGrade" class="btn btn-info"
            style="border-radius:0%"><i class="fa fa-plus"> </i> Add subject</button>
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
                    <th>Date</th>
                    <th>Action</th>
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
                        <td><?php echo date('M d, Y', strtotime($row['created_at'])); ?></td>

                        <td>
                          <!-- Edit Button -->
                          <a class="btn btn-warning edit-btn"
                            href="view_subject.php?id=<?php echo $row["id"]; ?>">
                            <i class="fa fa-edit"></i> Edit
                          </a>
                          <!-- Delete Button (Kung nais mo itong ilagay) -->
                          <a class="btn btn-danger"
                            href="delete_subject.php?id=<?php echo $row["id"]; ?>">
                            <i class="fa fa-trash"></i> Delete
                          </a>
                        </td>
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


 
  <?php include("includes/subject_modal.php"); ?>
    <?php include("includes/modal_user.php"); ?>
    <?php include("includes/footer.php"); ?>