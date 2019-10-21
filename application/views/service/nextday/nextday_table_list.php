<div class="row">
    <?php echo $message; ?>
</div>
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2>Next Day List</small></h2>
            <button onclick="fnButtonClick()" class="btn btn-success pull-right">Allocate to Enginner</button>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

            <table id="nextday" class="table table-striped table-bordered bulk_action employee">
                <thead>
                <tr>
                    <th><input name="select_all" value="1" type="checkbox"> </th>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Name</th>
                    <th>Company</th>
                    <th>Mobile</th>
                    <th>Place</th>
                    <th>Engineer Name</th>
                    <th>Compliant</th>
                    <th>Action</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
