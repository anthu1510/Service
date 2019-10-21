$(function () {

    var table = $('#customer').DataTable( {
        "processing": true,
        "serverSide": true,
        "lengthMenu": [[10, 25, 50, 100, 500, 1000, -1], [10, 25, 50, 100, 500, 1000, "Show All"]],
        "ajax": ajaxphpurl
    } );

    /*// Setup - add a text input to each footer cell
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
    } );*/

    table.column(0).visible(false);

    $('#customer tbody').on("click","#btnview",function () {
        var data = table.row($(this).parents('tr')).data();
        CustomerView(data[0]);
    });

    $('#customer tbody').on("click","#servhis",function () {
        var data = table.row($(this).parents('tr')).data();
        ServiceHistory(data[0]);
    });

    $('#ser_date').datetimepicker({
        format: 'YYYY-MM-DD'
    });
});
function ServiceHistory(id) {

    $.ajax({
        url: historyurl,
        data: {id:id},
        type: 'POST',
        success: function (data) {

            var json = $.parseJSON(data);

               $('.complient_title').text(json.complient_title);
               $('.complient_desc').text(json.complient_desc);
               $('.ser_date').text(json.ser_date);
               $('.close_date').text(json.close_date);
               $('.ser_title').text(json.ser_title);
               $('.ser_desc').text(json.ser_desc);
               $('.name').text(json.name);
               $.each(json.img,function (i,v) {
                   $('.imgs').append('<img src="'+imgpath+v+'" class="img-thumbnail"/>');
               });
            $('#clientcompliant_view_details').modal('show');
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



