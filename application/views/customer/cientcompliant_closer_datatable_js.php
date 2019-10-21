
<script>
    var ajaxphpurl = "<?php echo site_url('customer/clientcompliantserverside/'.$comp_cus_id.'/'); ?>";
    var viewurl = "<?php echo site_url('customer/customerview'); ?>";
    var historyurl = "<?php echo site_url('customer/servicehistory'); ?>";
    var imgpath = "<?php echo base_url('images/service-entry-images/') ?>";

    $(function () {
        $("#comp_logo").fileinput({
            maxFileCount: 10,
            showUpload: false,
            allowedFileTypes: ["image"]
        });
    });

    $('#cus_state').on("change",function () {
        var state = $(this).val();

        $.post("<?php echo site_url('Welcome/GetStateCode'); ?>",{state:state},function (data) {
            $('#comp_state_Code').val(data);
        });
    });
</script>

<script type="text/javascript" src="<?php echo base_url('assets/custom-js/clientcompliant_list_datatables_script.js'); ?>"></script>