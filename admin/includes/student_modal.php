  <!-- Modal for adding new employee -->
  <div class="modal fade" id="addStudent" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header" style="padding:20px 50px;">
            <button type="button" class="close" data-dismiss="modal" title="Close">&times;</button>
            <h3 align="center"><b>Add New Student</b></h3>
          </div>
          <div class="modal-body" style="padding:40px 50px;">
            <form class="form-horizontal" action="add_student.php" name="form" method="post">
              <div class="form-group">
                <label class="col-sm-4 control-label">Firstname</label>
                <div class="col-sm-8">
                  <input type="text" name="fname" class="form-control" required="required">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-4 control-label">Lastname</label>
                <div class="col-sm-8">
                  <input type="text" name="lname" class="form-control" required="required">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-4 control-label">Gender</label>
                <div class="col-sm-8">
                  <select name="gender" class="form-control" required>
                    <option value="">Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-4 control-label">Email</label>
                <div class="col-sm-8">
                  <input type="email" name="email" class="form-control" required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-4 control-label">Contact</label>
                <div class="col-sm-8">
                  <input type="number" name="contact" class="form-control" required>
                </div>
              </div>


              <div class="form-group">
                <label class="col-sm-4 control-label">Address</label>
                <div class="col-sm-8">
                  <input type="text" name="address" class="form-control" required>
                </div>
              </div>



             
              <div class="form-group">
                <label class="col-sm-4 control-label">Section</label>
                <div class="col-sm-8">
                  <input type="text" name="section" class="form-control" required>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-4 control-label"></label>
                <div class="col-sm-8">
                  <button type="submit" name="submit" class="btn btn-success" style="border-radius:60px;"> <i
                      class="fa fa-check "></i> Insert</button>
                  <button type="reset" name="" class="btn btn-danger" style="border-radius:60px;"> <i
                      class="fa fa-times "></i> Reset</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>