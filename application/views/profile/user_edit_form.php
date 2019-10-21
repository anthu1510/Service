<!-- Modal -->
<div id="newuser_edit_form" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">User Edit Form</h4>
            </div>
            <div class="modal-body">
                <form class="useradd" method="post" action="<?php echo site_url('company/userupdate'); ?>">
                    <input type="hidden" id="u_id" name="u_id">
                    <div class="form-group">
                        <label>User Roll</label>
                        <select name="user_roll" id="user_roll" class="form-control selectpicker validate[required]" title="Select User Roll">
                            <option value="Admin">Admin</option>
                            <option value="Engineer">Engineer</option>
                        </select>
                    </div>
                    <div class="form-group" id="eng_id_field">
                        <label>Engineer Id</label>
                        <input type="text" name="eng_id" id="eng_id" class="form-control validate[required]"  placeholder="Enter Engineer Id">
                    </div>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="username" id="username" class="form-control validate[required]"  placeholder="Enter Name">
                    </div>
                    <div class="form-group">
                        <label>Email Id</label>
                        <input type="text" name="useremail" id="useremail" class="form-control validate[required]"  placeholder="Enter Email Id">
                    </div>
                    <div class="form-group">
                        <label>Mobile No</label>
                        <input type="text" name="usermobile" id="usermobile" class="form-control validate[required]"  placeholder="Enter Mobile No">
                    </div>
                    <div class="form-group">
                        <label></label>
                        <button class="btn btn-primary pull-right">Update</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>