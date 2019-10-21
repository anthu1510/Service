$(function () {

    var table = $('#newuser').DataTable( {
        "processing": true,
        "serverSide": true,
        "lengthMenu": [[10, 25, 50, 100, 500, 1000, -1], [10, 25, 50, 100, 500, 1000, "Show All"]],
        "ajax": ajaxphpurl
    } );

    table.column(0).visible(false);

    $('#newuser tbody').on("click","#btnedit",function () {
        var data = table.row($(this).parents('tr')).data();
        UserEdit(data[0]);
    });

    $('#newuser tbody').on("click","#btnview",function () {
        var data = table.row($(this).parents('tr')).data();
        UserView(data[0]);
    });

    $('#newuser tbody').on("click","#btnpwd",function () {
        var data = table.row($(this).parents('tr')).data();
        ChangePassword(data[0]);
    });

    $('#newuser tbody').on("click","#btnstatus",function () {
        var data = table.row($(this).parents('tr')).data();
        Status(data[0]);
    });



    $('#ser_date').datetimepicker({
        format: 'YYYY-MM-DD'
    });

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


function UserEdit(id) {
    $.ajax({
        url: editurl,
        data: {id:id},
        type: "post",
        success: function (data) {
            var json = $.parseJSON(data);

            var value = json.u_role;
            if(value == 'Admin')
            {
                $('#eng_id_field').hide();
            }
            else
            {
                $('#eng_id_field').show();
            }

            $('#u_id').val(json.u_id);
            $('#user_roll').selectpicker('val', json.u_role);
            $('#eng_id').val(json.eng_id);
            $('#username').val(json.u_name);
            $('#useremail').val(json.u_email);
            $('#usermobile').val(json.u_mobile);

            $('#newuser_edit_form').modal('show');
        }
    });
}

function UserView(id) {
    $.ajax({
        url: viewurl,
        data: {id:id},
        type: 'POST',
        success: function (data) {
            var json = $.parseJSON(data);

            $('.eng_id').text(json.eng_id);
            $('.u_name').text(json.u_name);
            $('.u_email').text(json.u_email);
            $('.u_mobile').text(json.u_mobile);
            $('.u_role').text(json.u_role);
            $('.u_cdate').text(json.u_cdate);
            $('.u_udate').text(json.u_udate);
            $('.status').text(json.status);

            $('#user_view_details').modal('show');
        }
    });
}

function ChangePassword(id) {

    $('#user_id').val(id);
    $('#newuser_pwd_change_form').modal('show');
}

function Status(id) {
    var staurl = statusurl+'/'+id+'/';
    window.location.href = staurl;
}

$(function () {
    $(".passchange").validationEngine();
});

