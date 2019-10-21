<script>
    var ajaxphpurl = "<?php echo site_url('customer/customercallcloserserverside'); ?>";
    var redirecturl = "<?php echo site_url('customer/clientcomplientlist'); ?>";
    var editurl = "<?php echo site_url('customer/customeredit'); ?>";
    var viewurl = "<?php echo site_url('customer/customerview'); ?>";

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

<script type="text/javascript" src="<?php echo base_url('assets/custom-js/customer_closer_datatables_script.js'); ?>"></script>