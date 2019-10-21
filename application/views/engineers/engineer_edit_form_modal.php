<!-- Modal -->
<div id="engineers_edit_form" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">New Engineer</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form class="form-horizontal form-label-left input_mask" method="post" enctype="multipart/form-data" action="<?php echo site_url('engineers/engineerupdate');?>">
                        <div class="col-lg-6 col-md-6 col-xs-12">

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Engineer Name</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input type="hidden" name="ser_id" id="ser_id">
                                    <input name="eng_name" id="eng_name" class="date-picker form-control col-md-7 col-xs-12" type="text" placeholder="Enter Engineer Name">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Mobile No</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input name="eng_mobile" id="eng_mobile" class="date-picker form-control col-md-7 col-xs-12" type="text" placeholder="Enter Engineer Mobile">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Mobile No 2</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input name="eng_mobile2" id="eng_mobile2" class="date-picker form-control col-md-7 col-xs-12" type="text" placeholder="Enter Engineer Mobile Others eg:9688007350,9942346409">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Email Id</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input name="eng_email" id="eng_email" class="date-picker form-control col-md-7 col-xs-12" type="text" placeholder="Enter Engineer Email">
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Street</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input name="eng_street" id="eng_street" class="date-picker form-control col-md-7 col-xs-12" type="text" placeholder="Enter Street">
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-6 col-md-6 col-xs-12">

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Place</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input name="eng_place" id="eng_place" class="date-picker form-control col-md-7 col-xs-12" type="text" placeholder="Enter Place">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">City</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input name="eng_city" id="eng_city" class="date-picker form-control col-md-7 col-xs-12" type="text" placeholder="Enter City">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Pin Code</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <input name="eng_pin" id="eng_pin" class="date-picker form-control col-md-7 col-xs-12" type="text" placeholder="Enter the Pin Code">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">State</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <select name="eng_state" id="eng_state" class="form-control selectpicker" title="Select Your State">
                                        <?php
                                        foreach ($stateload as $v)
                                        {
                                            echo "<option value='$v->name'>$v->name</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <select name="eng_status" id="eng_status" class="selectpicker form-control col-md-7 col-xs-12">
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </div>
                            </div>

                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="pull-right">
                                    <button type="submit" class="btn btn-success">Update</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal" class="btn btn-default">Discard</button>
                                </div>
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