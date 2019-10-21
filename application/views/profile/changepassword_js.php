<script>
    $(document).ready(function(){
        $("#changepassword,.useradd").validationEngine();
    });

    $('#user_roll').on('change', function () {
        var value = $(this).val();
        if(value == 'Admin')
        {
            $('#eng_id_field').hide();
        }
        else
        {
            $('#eng_id_field').show();
        }
    });
</script>
