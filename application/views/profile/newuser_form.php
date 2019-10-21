<div class="row">
    <?php echo $message; ?>
</div>
<div class="row">
    <div class="col-md-offset-3 col-md-6 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>New User Form</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <form id="useradd" class="useradd" method="post" action="<?php echo site_url('company/usersave'); ?>">
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
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="userpass" id="userpass" class="form-control validate[required]"  placeholder="Enter Password">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="form-group">
                                <label>Conform Password</label>
                                <input type="password" name="userconpass" id="userconpass" class="form-control  validate[required,equals[userpass]]"  placeholder="Enter Conform Password">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Mobile No</label>
                        <input type="text" name="usermobile" id="usermobile" class="form-control"  placeholder="Enter Mobile No">
                    </div>
                    <div class="form-group">
                        <label></label>
                        <button class="btn btn-primary pull-right">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>