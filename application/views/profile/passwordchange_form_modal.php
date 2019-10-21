<!-- Modal -->
<div id="newuser_pwd_change_form" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Password Change Form</h4>
            </div>
            <div class="modal-body">
                <form id="changepassword" class="passchange" method="post" action="<?php echo site_url('company/userpasswordchange'); ?>">
                    <div class="form-group">
                        <label>Enter New Password</label>
                        <input type="hidden" id="user_id" name="user_id">
                        <input type="password" name="newpassword" id="newpassword" class="form-control validate[required]" placeholder="Enter New Password">
                    </div>
                    <div class="form-group">
                        <label>Enter Conform Password</label>
                        <input type="password" name="conpassword" id="conpassword" class="form-control validate[required,equals[newpassword]]" placeholder="Enter Conform Password">
                    </div>
                    <div class="form-group">
                        <label></label>
                        <button class="btn btn-primary pull-right">Change</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
