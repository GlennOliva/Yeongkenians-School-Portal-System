<!-- Edit Grade -->
<div class="modal fade" id="edit_<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Edit Grade</h4></center>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form method="POST" action="edit_grade.php?id=<?php echo $row['id']; ?>">
                        <!-- Update input names based on the database fields -->
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Student ID:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="student_id" value="<?php echo $row['student_id']; ?>">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">1st Grading:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="1st_grading" value="<?php echo $row['1st_grading']; ?>">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">2nd Grading:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="2nd_grading" value="<?php echo $row['2nd_grading']; ?>">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">3rd Grading:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="3rd_grading" value="<?php echo $row['3rd_grading']; ?>">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">4th Grading:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="4th_grading" value="<?php echo $row['4th_grading']; ?>">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Average:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="average" value="<?php echo $row['average']; ?>">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Remarks:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="remarks" value="<?php echo $row['remarks']; ?>">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                <button type="submit" name="edit" class="btn btn-success"><span class="glyphicon glyphicon-check"></span> Update</button>
            </div>
        </div>
    </div>
</div>
