<div class="row">
    <?php echo $message; ?>
</div>
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>User List</small></h2>
            <a class="btn btn-info pull-right" href="<?php echo site_url('company/newuser');?>"><i class="fa fa-plus" aria-hidden="true"></i> New User</a>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

            <table id="newuser" class="table table-striped table-bordered nowrap">
                <thead>
                <tr>
                    <th>ID</th>
                    <th width="10%">Engineer ID</th>
                    <th>Name</th>
                    <th>Email ID</th>
                    <th width="10%">Mobile No</th>
                    <th width="10%">User Roll</th>
                    <th width="10%">Status</th>
                    <th width="10%">Action</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
</div>