<!-- Add New -->
<div class="modal fade" id="addnew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <center><h4 class="modal-title" id="myModalLabel">Add New Student</h4></center>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form method="POST" action="add.php">
                        <!-- Update input names based on the database fields -->
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">First Name:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="first_name">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Middle Name:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="middle_name">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Last Name:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="last_name">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Gender:</label>
                            </div>
                            <div class="col-sm-10">
           
								<select name="gender" class="form-control" >
									<option value="male" >Male</option>
									<option value="female" >Female</option>
								</select>

                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Email:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="email">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Contact Number:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="contact_number">
                            </div>
                        </div>
                        <!-- <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Strand:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="strand">
                            </div>
                        </div> -->
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Date Enrolled:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" name="date_enrolled">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Mother Name:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="mother_name">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Mother Occupation:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="mother_occupation">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Mother Contact No:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="mother_contact_no">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Father Name:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="father_name">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Father Occupation:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="father_occupation">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Father Contact No:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="father_contact_no">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">LRN:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="lrn">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Year Level:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="year_level">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Section:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="section">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Civil Status:</label>
                            </div>
                            <div class="col-sm-10">

                                <select name="civil_status" class="form-control">
                                    <option value="single">Single</option>
                                    <option value="married">Married</option>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Religion:</label>
                            </div>
                            <div class="col-sm-10">
                              
                                <select name="religion" class="form-control">
                                    <option value="catholic">Roman Catholic</option>
                                    <option value="muslim">Islam</option>
                                    <option value="christian">Christian</option>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Birth Date:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" name="birth_date">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-2">
                                <label class="control-label" style="position:relative; top:7px;">Address:</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="address">
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