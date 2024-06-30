
    <!-- Modal for user details -->
    <div class="modal fade" id="colins" role="dialog">
      <div class="modal-dialog modal-sm">
        <div class="modal-content">
          <div class="modal-header" style="padding:20px 50px;">
            <button type="button" class="close" data-dismiss="modal" title="Close">&times;</button>
            <h3 align="center">You are logged in as <b><?php echo $_SESSION['fullname']; ?></b></h3>
          </div>
          <div class="modal-body" style="padding:40px 50px;">
            <div align="center">
              <a href="view_profile.php" class="btn btn-block btn-primary">Update Profile</a>
            </div>
            <br>

            <div align="center">
              <a href="logout.php" class="btn btn-block btn-danger">Logout</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
