
<?php
if($comp_count == 1)
{
    ?>
    <script>
        $(function () {
            $.post("<?php echo site_url('company/companyedit'); ?>",function (data) {
                var json = $.parseJSON(data);

                $("#comp_id").val(json.comp_id);
                $("#comp_name").val(json.comp_name);
                $("#comp_email").val(json.comp_email);
                $("#comp_mobile").val(json.comp_mobile1);
                $("#comp_mobile2").val(json.comp_mobile2);
                $("#comp_phone").val(json.comp_phone);
                $("#comp_address1").val(json.comp_address1);
                $("#comp_address2").val(json.comp_address2);
                $("#comp_place").val(json.comp_place);
                $("#comp_city").val(json.comp_city);
                $("#comp_state").selectpicker('val',json.comp_state);
                $("#comp_state_Code").val(json.comp_state_code);
                $("#comp_country").val(json.comp_country);
                $("#comp_pin_code").val(json.comp_pin_code);
                $("#comp_website").val(json.comp_website);
                $("#comp_gstin_code").val(json.comp_gstin_code);
                $("#comp_cdate").val(json.comp_cdate);

                $("#comp_logo").fileinput({
                    showUpload: false,
                    allowedFileTypes: ["image"],
                    overwriteInitial: true,
                    initialPreviewAsData: true,
                    initialPreview: "http://localhost/projects/codeigniter/service/images/company/FB_IMG_1482296173756.jpg"
                });
            });
        });

        $('#comp_state').on("change",function () {
            var state = $(this).val();

            $.post("<?php echo site_url('Welcome/GetStateCode'); ?>",{state:state},function (data) {
                $('#comp_state_Code').val(data);
            });
        });
        


    </script>
    <?php
}
else
{
    ?>
        <script>
            $(function () {
                $("#comp_logo").fileinput({
                    showUpload: false,
                    allowedFileTypes: ["image"]
                });
            });

            $('#comp_state').on("change",function () {
                var state = $(this).val();

                $.post("<?php echo site_url('Welcome/GetStateCode'); ?>",{state:state},function (data) {
                    $('#comp_state_Code').val(data);
                });
            });

        </script>
    <?php
}
?>



