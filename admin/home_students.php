<?php
include ("auth.php");

// Include db.php for database connection
include ("db.php");

?>

<?php include("includes/header.php"); ?>
<body class="hold-transition login-page">
<?php include("includes/menubar.php"); ?>

    <!-- Jumbotron -->
    <div class="jumbotron">
      <h1>Students Section</h1>
    </div>

    <div class="well bs-component">
      <form class="form-horizontal">
        <fieldset>
          <button type="button" data-toggle="modal" data-target="#addStudent" class="btn btn-info"
            style="border-radius:0%"><i class="fa fa-user-plus"></i> Add Student Records</button>
          <p align="center"><big><b>Students Records </b></big></p>
          <div class="table-responsive">
            <form method="post" action="">
              <table class="table table-hover table-condensed" id="myTable">
                <thead>
                  <tr>
                    <th>
                      <p align="center">Student ID</p>
                    </th>
                    <th>
                      <p align="center">Fullname</p>
                    </th>
                    <th>
                      <p align="center">Contact</p>
                    </th>
                    <th>
                      <p align="center">Email</p>
                    </th>
                    <th>
                      <p align="center">Gender</p>
                    </th>
                    
                    <th>
                      <p align="center">Section</p>
                    </th>

                    <th>
                      <p align="center">Date</p>
                    </th>

                    <th>
                      <p align="center">Action</p>
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  // Query to select all employees
                  $query = "SELECT * FROM students ORDER BY id ASC";
                  $result = $connection->query($query);

                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                      ?>
                      <tr>
                      <td align="center"><?php echo $row['student_id'] ?>
                        </td>
                        <td align="center">
                          <?php echo $row['lname'] ?>
                        </td>
                        <td align="center"><?php echo $row['contact'] ?>
                        </td>
                        <td align="center"><?php echo $row['email'] ?>
                        </td>
                        <td align="center">
                          <?php echo ($row['gender'] == 'Male') ? '<i class="fas fa-male"></i> M' : '<i class="fas fa-female"></i> F'; ?>
                        </td>

                        <td align="center"><?php echo $row['section'] ?>
                        </td>

                        <td align="center">
                          <?php echo date('M d, Y', strtotime($row['created_at'])) ?>
                        </td>

                        <td align="center">
                          <a class="btn btn-warning" style="border-radius:60px;"
                            href="view_account.php?emp_id=<?php echo $row["id"]; ?>"><i
                              class="fa fa-file-invoice"></i></a>
                          <a class="btn btn-danger" style="border-radius:60px;"
                            href="delete_student.php?emp_id=<?php echo $row["id"]; ?>"><i class="fa fa-trash"></i></a>
                        </td>
                      </tr>
                      <?php
                    }
                  } else {
                    echo "No records found.";
                  }

                  // Close MySQL connection
                  $connection->close();

                  // Function to get employee type label based on type value
                  function getEmployeeTypeLabel($type)
                  {
                    switch ($type) {
                      case 'Shiftworker':
                        return '<span class="label label-primary">' . $type . '</span>';
                      case 'Full-Time':
                        return '<span class="label label-danger">' . $type . '</span>';
                      case 'Part-Time':
                        return '<span class="label label-warning">' . $type . '</span>';
                      case 'Casual':
                        return '<span class="label label-success">' . $type . '</span>';
                      default:
                        return $type;
                    }
                  }
                  ?>
                </tbody>
              </table>
            </form>
          </div>
        </fieldset>
      </form>
    </div>

  
    <?php include("includes/student_modal.php"); ?>
    <?php include("includes/modal_user.php"); ?>
    <?php include("includes/footer.php"); ?>
