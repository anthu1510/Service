<!-- Modal -->
<div id="serviceentry_form_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Parts Ordered Entry</h4>
            </div>
            <div class="modal-body">
                <form  method="post" enctype="multipart/form-data" action="<?php echo site_url('CallCloser/ServiceEntrySave'); ?>">
                    <div class="form-group">
                        <label>Service Close Date :</label>
                        <input type="text" name="close_date" id="close_date" class="form-control" placeholder="Enter Service Close Date">
                    </div>
                    <div class="form-group">
                        <label>Service Entry Title :</label>
                        <input type="hidden" id="comp_id" name="comp_id">
                        <input type="text" name="serviceentry_title" id="serviceentry_title" class="form-control" placeholder="Enter Service Entry Title">
                    </div>
                    <div class="form-group">
                        <label>Service Entry Description :</label>
                        <textarea rows="3" name="serviceentry_desc" id="serviceentry_desc" class="form-control" placeholder="Enter Service Entry Description"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="file" name="service_entry_images[]" id="service_entry_images" multiple>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-info pull-right">Submit</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>