<!-- Modal -->
<div id="complient_edit_form" class="modal fade" role="dialog">
    <div class="modal-dialog ">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Complient</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form  id="comp_edit" class="form-horizontal form-label-left input_mask" method="post" enctype="multipart/form-data" action="<?php echo site_url('Service/CustomerCompliantUpdate');?>">

                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Complinet Id</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <input name="complient_id" id="complient_id" class="date-picker form-control col-md-7 col-xs-12 complient_id" type="text"readonly>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Service Date</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <input name="ser_date" id="ser_date" class="date-picker form-control col-md-7 col-xs-12 ser_date" type="text" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Complient Title</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <input name="complient_title" id="complient_title" class="date-picker form-control col-md-7 col-xs-12 complient_title" type="text" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Complient Description</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <input name="complient_desc" id="complient_desc" class="date-picker form-control col-md-7 col-xs-12 complient_desc" type="text" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Status</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <select name="complient_status" id="complient_status" class="form-control selectpicker show-tick complient_status" title="Select Your State">
                                    <?php
                                    foreach ($comp_status   as $v)
                                    {
                                        echo "<option value='$v->status'>$v->status</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Close Date</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <input name="close_date" id="close_date" class="date-picker form-control col-md-7 col-xs-12 close_date" type="text" >
                            </div>
                        </div>
                        <button id="btnsave" class="btn btn-success pull-right" >Update</button>
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

<!-- Modal -->
<div id="complient_form" class="modal fade" role="dialog">
    <div class="modal-dialog ">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Complient</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form class="form-horizontal form-label-left input_mask" method="post" enctype="multipart/form-data" action="<?php echo site_url('Customer/CustomerSave');?>">

                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Complinet Id</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <input name="complient_id" id="complient_id" class="date-picker form-control col-md-7 col-xs-12" type="text"readonly>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Service Date</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
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
                                <input name="complient_desc" id="complient_desc" class="date-picker form-control col-md-7 col-xs-12" type="text" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Status</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <select name="complient_status" id="complient_status" class="form-control selectpicker show-tick" title="Select Your State">
                                    <?php
                                    foreach ($comp_status   as $v)
                                    {
                                        echo "<option value='$v->status'>$v->status</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Close Date</label>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <input name="close_date" id="close_date" class="date-picker form-control col-md-7 col-xs-12" type="text" >
                            </div>
                        </div>
                        <button id="btnsave" class="btn btn-success pull-right" >Save</button>
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

<!-- Modal -->
<div id="complient_only" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm ">

        <!-- Modal content-->
        <div class="modal-content">

            <form class="form-horizontal form-label-left input_mask" method="post" enctype="multipart/form-data" action="<?php echo site_url('service/statusupdate');?>">
            <!--onclick="$('#complient_only).modal('hide');"
            <button type="button" class="close" data-dismiss="modal">&times;</button>-->

            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal">&times;</button><br>
                <!--<a href="#" class="close" data-dismiss="modal"  >x</a>-->
                <div class="row">
                    <?php $acturl = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']; $this->session->set_userdata('redirect',$acturl); ?>
                        <input type="hidden" id="complient_id_h" name="complient_id_h">
                        <label>Select Status</label>
                        <select name="complient_status_allocate" id="complient_status_allocate" class="form-control selectpicker show-tick" title="Select Your Status">
                            <?php
                            foreach ($comp_status   as $v)
                            {
                                echo "<option value='$v->status'>$v->status</option>";
                            }
                            ?>
                        </select>



                        <div class="col-lg-6 col-md-6 col-xs-12">

                        </div>

                </div>
            </div>
            <div class="modal-footer">

                <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                <button class="btn btn-success ">Submit</button>

            </div>
            </form>
        </div>

    </div>
</div>
<!--/Modal -->

<!-- Modal -->
<div id="complient_engineer" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm ">

        <!-- Modal content-->
        <div class="modal-content">

            <form class="form-horizontal form-label-left input_mask" method="post" enctype="multipart/form-data" action="<?php echo site_url('service/allocateserviceengineer');?>">
                <!--onclick="$('#complient_only).modal('hide');"
                <button type="button" class="close" data-dismiss="modal">&times;</button>-->

                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal">&times;</button><br>
                    <!--<a href="#" class="close" data-dismiss="modal"  >x</a>-->
                    <div class="row">

                        <input type="hidden" id="complient_list_id" name="complient_list_id">
                        <input type="hidden" id="redirect_url" name="redirect_url">
                        <label>Select Engineer</label>
                        <select name="enginner_list" id="enginner_list" class="form-control selectpicker show-tick" title="Select Enginner">
                            <?php
                            foreach ($engineer_list   as $v)
                            {
                                echo "<option value='$v->id'>$v->name</option>";
                            }
                            ?>
                        </select>



                        <div class="col-lg-6 col-md-6 col-xs-12">

                        </div>

                    </div>
                </div>
                <div class="modal-footer">

                    <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                    <button class="btn btn-success ">Submit</button>

                </div>
            </form>
        </div>

    </div>
</div>
<!--/Modal -->

<!-- Modal -->
<style>
    tr:nth-child(even) {background-color: #f2f2f2;}
</style>
<div id="compliant_view_details" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Compliant View</h4>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th width="45%">Property</th>
                        <th>Values</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Service Date :</td>
                        <td class="ser_date"></td>
                    </tr>
                    <tr>
                        <td>Compliant Title :</td>
                        <td class="complient_title"></td>
                    </tr>
                    <tr>
                        <td>Compliant Description :</td>
                        <td class="complient_desc"></td>
                    </tr>
                    <tr>
                        <td>Compliant Status :</td>
                        <td class="complient_status"></td>
                    </tr>
                    <tr>
                        <td>Closed Date :</td>
                        <td class="close_date"></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<!--/Modal -->