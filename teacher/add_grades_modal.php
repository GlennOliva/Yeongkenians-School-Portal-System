<!-- Add New -->
<div class="modal fade" id="addnew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Add New</h4></center>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form method="POST" action="add_grade.php">
                        <!-- Update input names based on the database fields -->
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Student ID:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="student_id">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">1st Grading:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="1st_grading">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">2nd Grading:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="2nd_grading">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">3rd Grading:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="3rd_grading">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">4th Grading:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="4th_grading">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Average:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="average">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Remarks:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="remarks">
                            </div>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <button type="submit" name="add" class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
