<div class="container">
    <div class="masthead">
      <a href="home.php" class="decoration-none" style="text-decoration:none;">
        <h3>
          <b>Student Managment System</b>
          <a data-toggle="modal" href="#colins" class="pull-right"><b><button class="btn btn-danger"
                style="border-radius: 0%;"><i class="fa fa-user-circle"></i>
                <?php echo $_SESSION['fullname']; ?></button></b></a>
        </h3>
      </a>
      <nav>
        <ul class="nav nav-justified" style="border-radius:0%">
          <li><a href="home_students.php" class="text-primary">Student Section <span
                class="label label-primary"><?php include 'total_count.php'; ?></span></a></li>
          <li><a href="home_subjects.php" class="text-primary">Manage Subjects</a></li>
          <li><a href="home_Manage_grades.php" class="text-primary">Manage Grade</a></li>
          <li><a href="home_grades.php" class="text-primary">Student Grade Section</a></li>
        </ul>
      </nav>
    </div><br>

