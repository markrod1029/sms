<!-- Modal for adding new deduction -->
<div class="modal fade" id="addGrade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="padding:20px 50px;">
                <button type="button" class="close" data-dismiss="modal" title="Close">&times;</button>
                <h3 align="center"><b>Add New Subject</b></h3>
            </div>
            <div class="modal-body" style="padding:40px 50px;">
                <form class="form-horizontal" action="add_subject.php" method="post" id="deductionForm">

                    
                    

                    <div class="form-group">
                        <label class="col-sm-4 control-label">Subject Name</label>
                        <div class="col-sm-8">
                            <input type="text" name="subject" class="form-control" required>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-4 control-label">Assign Teacher</label>
                        <div class="col-sm-8">
                            <input type="text" name="teacher" class="form-control" required>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-4 control-label">Time Start</label>
                        <div class="col-sm-8">
                            <input type="time" name="time_start" class="form-control" required>
                        </div>
                    </div>


                    
                    <div class="form-group">
                        <label class="col-sm-4 control-label">Time End</label>
                        <div class="col-sm-8">
                            <input type="time" name="time_end" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label"></label>
                        <div class="col-sm-8">
                            <button type="submit" name="submit" class="btn btn-success" style="border-radius:60px;"> <i
                                    class="fa fa-check "></i> Insert</button>
                            <button type="reset" class="btn btn-danger" style="border-radius:60px;"> <i
                                    class="fa fa-times "></i>
                                Reset</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>