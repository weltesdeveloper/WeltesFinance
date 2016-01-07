var elmnt_utama = $('#div_appr_cflow');
var job = elmnt_utama.find('#selectJob');
job.chosen(config_chosen);
var tbl_element = elmnt_utama.find('#listDetailApprove');
var table_init = tbl_element.DataTable();

$(document).ready(function () {
    show_cbx_job();
    job.on('change', function () {
        show_list(this.value);
    });

    // Handle click on checkbox
    tbl_element.find('tbody').on('click', 'input[type="checkbox"]', function (e) {
        var $row = $(this).closest('tr');
        //console.log($row);

        // Get row data
        var data = table_init.row($row).data();

        // Get row ID
        var rowId = data[0];

        if (this.checked) {
            $row.addClass('selected');
        } else {
            $row.removeClass('selected');
        }

        // Prevent click event from propagating to parent
        e.stopPropagation();
    });

    elmnt_utama.find('#btnProses').on('click', function () {
        var baris = table_init.rows().nodes();
        var jml_chk = $('input[type = "checkbox"]:checked', baris).length;

        if (jml_chk == '0') {
            swal('FAILED', 'PILIH SALAH SATU DATA YANG AKAN DI APPROVE.', 'error');
            return false;
        }
        if (confirm("Apakah Anda Yakin Akan Approval " + jml_chk + " data yang terpilih ? \n *Data yang sudah di approve tidak bisa di rubah... ")) {
            submit_selected();
            return true;
        } else {
            return false;
        }
    });
    
    $('#btn_refresh').click(function (){
        show_list(job.val());
    });
});

// kumpulan fungsi
function show_cbx_job() {
    $.ajax({
        url: "cashflow/approval/model_approval.php",
        type: 'POST',
        dataType: 'json',
        data: {
            action: 'show_combobox_job',
            type: 'show_client'
        },
        beforeSend: function (xhr) {
            job.empty();
        },
        success: function (respon, textStatus, jqXHR) {
            var optgrop = "<option selected disabled></option>";
            optgrop += "<option value='%'>[All Job]</option>";
            $.each(respon, function (i, row) {
                optgrop += '<optgroup label="' + row.CLIENT_NAME + '">';
                show_cbx_item(row.CLIENT_ID, function (respon2) {
                    $.each(respon2, function (j, row2) {
                        optgrop += '<option value="' + row2.PROJECT_NO + '">' + row2.PROJECT_NO + '</option>';
                    });
                });
                optgrop += '</optgroup>';
            });
            job.append(optgrop);
        },
        complete: function () {
            job.trigger('chosen:updated');
        }
    });
}
function show_cbx_item(client_id, callback) {
    //alert(client_id);
    $.ajax({
        async: false,
        url: "cashflow/approval/model_approval.php",
        type: 'POST',
        dataType: 'json',
        data: {
            action: 'show_combobox_job',
            type: 'show_job',
            client_id: client_id
        },
        success: callback
    });
}

function show_list(job) {
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: "cashflow/approval/model_approval.php",
        data: {
            action: 'show_list_cflow',
            job: job
        },
        beforeSend: function (xhr) {
            tbl_element.DataTable({
                destroy: true,
                language: {
                    "emptyTable": "Please Wait..."
                }
            }).clear().draw();
        },
        success: function (response, textStatus, jqXHR)
        {
            //console.log(response);
            var i = 0;
            table_init = tbl_element.DataTable({
                destroy: true,
                processing: true,
                language: {
                    "processing": "Please Wait...",
                    "emptyTable": "No data available in table"
                },
                data: response,
                pageLength: 50,
                //orderFixed: [0, 'asc'],
                "order": [[1, 'asc']],
                "columns":
                        [
                            {"data": "CFLOW_ID"}, //0
                            {"data": "CFLOW_NO"}, //1
                            {"data": "PROJECT_NO"}, //2
                            {"data": "TGL_INPUT"}, //3
                            {"data": "CFLOW_SIGN"}, //4
                            {"data": "CFLOW_CATE_NM"}, //5
                            {"data": "PAY_CATE_NM"}, //6
                            {"data": "CFLOW_PRICE_IN"}, //7
                            {"data": "CFLOW_PRICE_OUT"}, //8
                            {"data": "CFLOW_REM"}, //9
                            {"data": "CFLOW_REV"}, //0
                            {"data": null}//11
                        ],
                "columnDefs":
                        [
                            {
                                "visible": true,
                                "targets": [0],
                                "orderable": false,
                                "className": 'text-center',
                                "render": function (data, type, row, meta) {
                                    var isi = "<input type='checkbox' style='cursor:pointer;' value='" + data + "' />";
                                    return isi;
                                }
                            },
                            {
                                "visible": true,
                                "targets": [7],
                                "className": 'text-left',
                                "render": function (data, type, row, meta) {
                                    var isi = "<i>" + row.CFLOW_CURR + "</i> " + addCommas(data);
                                    if (row.CFLOW_TYPE == 'out') {
                                        isi = '<i><b>-</b></i>';
                                    }
                                    //console.log(meta);
                                    return isi;
                                }
                            },
                            {
                                "visible": true,
                                "targets": [8],
                                "className": 'text-lefft',
                                "render": function (data, type, row, meta) {
                                    var isi = "<i>" + row.CFLOW_CURR + "</i> " + addCommas(data);
                                    if (row.CFLOW_TYPE == 'in') {
                                        isi = '<i><b>-</b></i>';
                                    }
                                    return isi;
                                }
                            },
                            {
                                "visible": true,
                                "targets": [11],
                                "className": 'text-lefft',
                                "render": function (data, type, row, meta) {
                                    var isi = '<button onclick="modal_cancel_approve(' + row.CFLOW_ID + ',' + "'" + row.CFLOW_NO + "'" + ')" class="btn btn-danger"><i class="fa fa-ban"></i> Tolak</button>';
                                    return isi;
                                }
                            }
                        ],
                "drawCallback": function (settings) {
//                    var api = this.api();
//                    var rows = api.rows({page: 'current'}).nodes();
//                    var last = null;
//                    api.column(1, {page: 'current'}).data().each(function (group, i) {
//                        if (last !== group) {
//                            $(rows).eq(i).before(
//                                    '<tr class="group"><td colspan="10">' + group + '</td></tr>'
//                                    );
//                            last = group;
//                        }
//                    });
                },
                "fnCreatedRow": function (nRow, aData, iDataIndex) {
                    //$(nRow).attr('id', 'baris_' + i);
                    i++;
                }
            });
        }
    }).done(function () {
        // prosess after done
    });
}

// submit approve
function submit_selected() {
    var baris = table_init.rows().nodes();
    $('input[type = "checkbox"]:checked', baris).each(function (i, rows) {
        var tr_row = $(this).closest('tr')[0];
        var td_row = $(tr_row).find('td:eq(0)');
        //console.log($(this));

        $.ajax({
            type: 'POST',
            url: "cashflow/approval/model_approval.php",
            data: {
                action: 'insert_to_db',
                approve: true,
                cflow_id: $(this).val()
            },
            success: function (respon, textStatus, jqXHR) {
                if (respon == 'success') {
                    $(td_row).html('<a class="fa fa-check fa-2x"></a>');
                    $(tr_row)
                            .removeClass('selected')
                            .addClass('success')
                            .find('button').prop('disabled', true);
                } else {
                    swal({
                        title: 'APPROVAL ERROR',
                        text: respon,
                        type: 'ERROR'
                    }, function () {
                        $(tr_row)
                                .removeClass('selected')
                                .addClass('failed');
                    });
                }
            }
        });
    });
}


//submit cancel approve
function modal_cancel_approve(cflow_id, cflow_no) {
    $.ajax({
        url: "cashflow/approval/model_approval.php",
        type: 'POST',
        data: {
            action: "modal_cancel_approve",
            cflow_id: cflow_id,
            cflow_no: cflow_no
        },
        beforeSend: function (xhr) {
            $('#modalApprove .modal-content').empty();
        },
        success: function (respon, textStatus, jqXHR) {
            $('#modalApprove')
                    .modal('show')
                    .find('.modal-content').html(respon);
        }
    });

}

function submit_cancel(cflow_id) {
    var cancel_rem = $('#modalApprove').find('#cancel_rem').val().trim();
    if (cancel_rem == '') {
        swal('FAILED', 'KETERANGAN HARUS DI ISI.', 'error');
        return false;
    }
    
    var this_elmnt = $("input[type=checkbox][value=" + cflow_id + "]").prop("checked", true);
    var td_row = $(this_elmnt).closest('td')[0];
    var tr_row = $(this_elmnt).closest('tr')[0];
    //console.log(this_elmnt);

    $.ajax({
        type: 'POST',
        url: "cashflow/approval/model_approval.php",
        data: {
            action: 'insert_to_db',
            approve: false,
            cflow_id: cflow_id,
            cancel_rem: cancel_rem
        },
        success: function (respon, textStatus, jqXHR) {
            if (respon == 'success') {
                $(td_row).html('<a class="fa fa-exclamation-triangle fa-2x" style="color:red;"></a>');
                $(tr_row)
                        .removeClass('selected')
                        .addClass('cancel')
                        .find('button').prop('disabled', true);
            } else {
                swal({
                    title: 'CANCEL APPROVAL ERROR',
                    text: respon,
                    type: 'ERROR'
                }, function () {
                    $(tr_row)
                            .removeClass('selected')
                            .addClass('failed');
                });
            }
        },
        complete: function (){
            $('#modalApprove')
                    .modal('hide');
        }
    });
}
