
var rows_selected = [];
$(function () {

    $('#ser_date,#close_date').datetimepicker({
        format: 'YYYY-MM-DD'
    });

    var table = $('#allotment').DataTable( {
        "processing": true,
        "serverSide": true,
        "lengthMenu": [[10, 25, 50, 100, 500, 1000, -1], [10, 25, 50, 100, 500, 1000, "Show All"]],
        "ajax": ajaxphpurl,
        'columnDefs': [{
            'targets': 0,
            'searchable':false,
            'orderable':false,
            'width':'1%',
            'className': 'dt-body-center',
            'render': function (data, type, full, meta){
                return '<input type="checkbox">';
            }
        }],
        'order': [1, 'asc'],
        'rowCallback': function(row, data, dataIndex){
            // Get row ID
            var rowId = data[0];

            // If row ID is in the list of selected row IDs
            if($.inArray(rowId, rows_selected) !== -1){
                $(row).find('input[type="checkbox"]').prop('checked', true);
                $(row).addClass('selected');
            }
        }
    } );

    table.column(1).visible(false);

    $('#allotment tbody').on("click","#btnstatus",function () {

        var data = table.row($(this).parents('tr')).data();
        StatusEdit(data[1]);
    });

    $('#allotment tbody').on("click","#btnedit",function () {
        var data = table.row($(this).parents('tr')).data();
        AllotmentEdit(data[1]);
    });

    $('#allotment tbody').on("click","#btnview",function () {
        var data = table.row($(this).parents('tr')).data();
        AllotmentView(data[1]);
    });


    function AllotmentEdit(id) {

        $.ajax({
            url:ajaxViewurl,
            type:'post',
            data:{id:id},
            success:function (data) {

                var jsonval=$.parseJSON(data);

                $(".complient_id").val(jsonval.id);
                $(".ser_date").val(jsonval.ser_date);
                $(".complient_title").val(jsonval.complient_title);
                $(".complient_desc").val(jsonval.complient_desc);
                //$("#complient_status").val(jsonval.complient_status);
                $(".complient_status").selectpicker('val',jsonval.complient_status);
                $(".close_date").val(jsonval.close_date);

                $("#complient_edit_form").modal("show");

            }

        });

    }

    function AllotmentView(id) {
//alert("ok AllotmentView");

        //$("#btnsave").  attr("disabled", "disabled");
        $.ajax({
            url:ajaxViewurl,
            type:'post',
            data:{id:id},
            success:function (data) {

                var jsonval = $.parseJSON(data);

                $(".complient_id").text(jsonval.id);
                $(".ser_date").text(jsonval.ser_date);
                $(".complient_title").text(jsonval.complient_title);
                $(".complient_desc").text(jsonval.complient_desc);
                $(".complient_status").text(jsonval.complient_status);
                $(".close_date").text(jsonval.close_date);

                $("#compliant_view_details").modal("show");
            }
        });
    }

    function StatusEdit(id) {

        $("#complient_id_h").val(id);
        $("#complient_only").modal("show");
        $.ajax({
            url:ajaxViewurl,
            type:'post',
            data:{id:id},
            success:function (data) {

                var jsonval=$.parseJSON(data);

                $("#complient_status_allocate").selectpicker('val',jsonval.complient_status);


            }

        });

    }

//
// Updates "Select all" control in a data table
//
    function updateDataTableSelectAllCtrl(table){
        var $table             = table.table().node();
        var $chkbox_all        = $('tbody input[type="checkbox"]', $table);
        var $chkbox_checked    = $('tbody input[type="checkbox"]:checked', $table);
        var chkbox_select_all  = $('thead input[name="select_all"]', $table).get(0);

        // If none of the checkboxes are checked
        if($chkbox_checked.length === 0){
            chkbox_select_all.checked = false;
            if('indeterminate' in chkbox_select_all){
                chkbox_select_all.indeterminate = false;
            }

            // If all of the checkboxes are checked
        } else if ($chkbox_checked.length === $chkbox_all.length){
            chkbox_select_all.checked = true;
            if('indeterminate' in chkbox_select_all){
                chkbox_select_all.indeterminate = false;
            }

            // If some of the checkboxes are checked
        } else {
            chkbox_select_all.checked = true;
            if('indeterminate' in chkbox_select_all){
                chkbox_select_all.indeterminate = true;
            }
        }
    }


// Handle click on checkbox
    $('#allotment tbody').on('click', 'input[type="checkbox"]', function(e){
        var $row = $(this).closest('tr');

        // Get row data
        var data = table.row($row).data();

        // Get row ID
        var rowId = data[1];


        // Determine whether row ID is in the list of selected row IDs
        var index = $.inArray(rowId, rows_selected);

        // If checkbox is checked and row ID is not in list of selected row IDs
        if(this.checked && index === -1){
            rows_selected.push(rowId);

            // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
        } else if (!this.checked && index !== -1){
            rows_selected.splice(index, 1);
        }

        if(this.checked){
            $row.addClass('selected');
        } else {
            $row.removeClass('selected');
        }

        // Update state of "Select all" control
        updateDataTableSelectAllCtrl(table);

        // Prevent click event from propagating to parent
        e.stopPropagation();
    });

// Handle click on table cells with checkboxes
    $('#allotment').on('click', 'tbody td, thead th:first-child', function(e){
        $(this).parent().find('input[type="checkbox"]').trigger('click');
    });


// Handle click on "Select all" control
    $('thead input[name="select_all"]', table.table().container()).on('click', function(e){
        if(this.checked){
            $('#allotment tbody input[type="checkbox"]:not(:checked)').trigger('click');
        } else {
            $('#allotment tbody input[type="checkbox"]:checked').trigger('click');
        }

        // Prevent click event from propagating to parent
        e.stopPropagation();
    });

// Handle table draw event
    table.on('draw', function(){
        // Update state of "Select all" control
        updateDataTableSelectAllCtrl(table);
    });

// Handle form submission event
    $('#frm-example').on('submit', function(e) {
        var form = this;

        // Iterate over all selected checkboxes
        $.each(rows_selected, function (index, rowId) {
            // Create a hidden element
            $(form).append(
                $('<input>')
                    .attr('type', 'hidden')
                    .attr('name', 'id[]')
                    .val(rowId)
            );
        });

    });





});



function fnButtonClick() {

    $("#complient_engineer").modal("show");

    var x="";
    $.each(rows_selected, function (index, rowId) {
        //alert(rowId);
        if(x=="")
        {
            x=rowId;
        }
        else
        {
            x=x +','+rowId;
        }
    });
    $("#complient_list_id").val(x);

}


