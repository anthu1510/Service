<!-- Modal -->
<div id="customer_raise_compliant_form" class="modal fade" role="dialog">
    <div class="modal-dialog ">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Complient</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form class="form-horizontal form-label-left input_mask" method="post" enctype="multipart/form-data" action="<?php echo site_url('Customer/CustomerRaiseCompliantSave');?>">

                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Service Date</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <input type="hidden" name="compliant_id" id="compliant_id">
                                <input name="ser_date" id="ser_date" class="date-picker form-control col-md-7 col-xs-12" type="text" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Complient Title</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <input name="complient_title" id="complient_title" class="date-picker form-control col-md-7 col-xs-12" type="text" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Complient Description</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <textarea rows="3" name="complient_desc" id="complient_desc" class="date-picker form-control col-md-7 col-xs-12"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12"></label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <button class="btn btn-success pull-right">Save</button>
                            </div>

                        </div>

                    </form>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<!--/Modal -->
