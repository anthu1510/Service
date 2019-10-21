$(function () {

    var table = $('#engineers').DataTable( {
        "processing": true,
        "serverSide": true,
        "lengthMenu": [[10, 25, 50, 100, 500, 1000, -1], [10, 25, 50, 100, 500, 1000, "Show All"]],
        "ajax": ajaxphpurl
    } );

    $('#engineers tbody').on("click","#btnedit",function () {
        var data = table.row($(this).parents('tr')).data();
        EngineerEdit(data[0]);
    });

    $('#engineers tbody').on("click","#btnview",function () {
        var data = table.row($(this).parents('tr')).data();
        EngineerView(data[0]);
    });

    $('#engineers tbody').on("click","#btnraise",function () {
        var data = table.row($(this).parents('tr')).data();
        RaiseCompliant(data[0]);
    });

    $('#ser_date').datetimepicker({
        format: 'YYYY-MM-DD'
    });


});


function EngineerEdit(id) {

    $.ajax({
        url: editurl,
        data: {id:id},
        type: "post",
        success: function (data) {
           var json = $.parseJSON(data);

            $('#ser_id').val(json.id);
            $('#eng_name').val(json.name);
            $('#eng_mobile').val(json.mobile);
            $('#eng_mobile2').val(json.mobile2);
            $('#eng_email').val(json.email);
            $('#eng_street').val(json.street);
            $('#eng_place').val(json.place);
            $('#eng_city').val(json.city);
            $('#eng_pin').val(json.pin);
            $('#eng_state').selectpicker('val',json.state);
            $('#eng_status').selectpicker('val',json.status);

            $('#engineers_edit_form').modal('show');
        }
    });
}

function EngineerView(id) {
    $.ajax({
        url: editurl,
        data: {id:id},
        type: 'POST',
        success: function (data) {

            var json = $.parseJSON(data);

            $('.eng_name').text(json.name);
            $('.eng_mobile').text(json.mobile);
            $('.eng_mobile2').text(json.mobile2);
            $('.eng_email').text(json.email);
            $('.eng_street').text(json.street);
            $('.eng_place').text(json.place);
            $('.eng_city').text(json.city);
            $('.eng_pin').text(json.pin);
            $('.eng_state').text(json.state);
            $('.eng_status').text(json.status);

            $('#engineers_view_details').modal('show');
        }
    });
}

function RaiseCompliant(id) {

    $('#compliant_id').val(id);
    $('#engineers_raise_compliant_form').modal('show');
}

