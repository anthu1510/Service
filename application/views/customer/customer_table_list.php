<div class="row">
    <?php echo $message; ?>
</div>
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Customer List</small></h2>
            <a class="btn btn-info pull-right" href="#" data-toggle="modal" data-target="#customer_add_form"><i class="fa fa-plus" aria-hidden="true"></i> New Customer</a>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

            <table id="customer" width="100%" class="table table-striped table-bordered nowrap">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Company</th>
                        <th>Mobile</th>
                        <th>Place</th>
                        <th>City</th>
                        <th width="10%">Compliant</th>
                        <th width="10%">Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>