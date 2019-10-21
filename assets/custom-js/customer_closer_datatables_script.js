$(function () {

    var table = $('#customer').DataTable( {
        "processing": true,
        "serverSide": true,
        "lengthMenu": [[10, 25, 50, 100, 500, 1000, -1], [10, 25, 50, 100, 500, 1000, "Show All"]],
        "ajax": ajaxphpurl
    } );

    // Setup - add a text input to each footer cell
    $('#customer tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input id="search" type="text" style="background-color:#00a1ff;color: white "   placeholder="Search '+title+'" />' );
    } );

    // Apply the search
    table.columns().every( function () {
        var that = this;

        $( 'input', this.footer() ).on( 'keyup change', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );


    table.column(0).visible(false);

    $('#customer tbody').on("click","#btnedit",function () {
        var data = table.row($(this).parents('tr')).data();
        CustomerEdit(data[0]);
    });

    $('#customer tbody').on("click","#btnview",function () {
        var data = table.row($(this).parents('tr')).data();
        CustomerView(data[0]);
    });

    $('#customer tbody').on("click","#btncompleintlist",function () {
        var data = table.row($(this).parents('tr')).data();
        ComplientList(data[0]);
    });

    $('#ser_date').datetimepicker({
        format: 'YYYY-MM-DD'
    });


});


function CustomerEdit(id) {
   $.ajax({
        url: editurl,
        data: {id:id},
        type: "post",
        success: function (data) {

            var json = $.parseJSON(data);

            $('#cus_id').val(json.cus_id);
            $('#cus_name').val(json.cus_name);
            $('#cus_comp_name').val(json.cus_compnay_name);
            $('#cus_email').val(json.cus_email);
            $('#cus_mobile').val(json.cus_mobile1);
            $('#cus_mobile2').val(json.cus_mobile2);
            $('#cus_phone').val(json.cus_phone);
            $('#cus_address1').val(json.cus_address1);
            $('#cus_address2').val(json.cus_address2);
            $('#cus_place').val(json.cus_place);
            $('#cus_city').val(json.cus_city);
            $('.selectpicker').selectpicker('val',json.cus_state);
            $('#cus_state_code').val(json.cus_state_code);
            $('#cus_country').val(json.cus_country);
            $('#cus_pin_code').val(json.cus_pin_code);
            $('#cus_website').val(json.cus_website);
            $('#cus_gstin_code').val(json.cus_gstin_no);

            $('#customer_edit_form').modal('show');
        }
    });
}

function CustomerView(id) {
    $.ajax({
        url: viewurl,
        data: {id:id},
        type: 'POST',
        success: function (data) {
                var json = $.parseJSON(data);

            $('.cus_name').text(json.cus_name);
            $('.cus_compnay_name').text(json.cus_compnay_name);
            $('.cus_email').text(json.cus_email);
            $('.cus_mobile1').text(json.cus_mobile1);
            $('.cus_mobile2').text(json.cus_mobile2);
            $('.cus_phone').text(json.cus_phone);
            $('.cus_address1').text(json.cus_address1);
            $('.cus_address2').text(json.cus_address2);
            $('.cus_place').text(json.cus_place);
            $('.cus_city').text(json.cus_city);
            $('.cus_state').text(json.cus_state);
            $('.cus_state_code').text(json.cus_state_code);
            $('.cus_country').text(json.cus_country);
            $('.cus_pin_code').text(json.cus_pin_code);
            $('.cus_website').text(json.cus_website);
            $('.cus_gstin_no').text(json.cus_gstin_no);
            $('.cus_cdate').text(json.cus_cdate);
            $('.status').text(json.status);

            $('#customer_view_details').modal('show');
        }
    });
}

function ComplientList(id) {
   window.location.href = redirecturl+'/'+id+'/';
}

