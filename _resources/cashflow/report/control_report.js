$(document).ready(function () {
    date();
    ViewClient();
    viewVia();
    vievPos();
    viewSupplier();
    /*
     * Tambah Kategori Pembayaran
     */
    $('#btnProses').click(function () {
        $("#dialogTablePodetails").removeAttr("hidden");
        tableView();
//        listTable();
//        alert("TES");
    });

});

function date() {
    $('#stratDate').datepicker({
        todayBtn: 'linked',
        clearBtn: true,
        autoclose: true,
        todayHighlight: true,
        toggleActive: true
    });
    $('#endDate').datepicker({
        todayBtn: 'linked',
        clearBtn: true,
        autoclose: true,
        todayHighlight: true,
        toggleActive: true
    });
}

function ViewClient() {
    var initSelect = $('#selectJob').chosen(config_chosen);
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: "cashflow/report/model_report.php",
        data: {action: 'ViewClient'},
        beforeSend: function (xhr) {
            $("#selectJob").empty();
        },
        success: function (json) {
//            var isi = "<option selected disabled></option>";
            var isi = "<option value='%'>[All Job]</option>";
//            console.log(json);
            $.each(json, function (index, row) {
                isi += '<optgroup label="' + row.CLIENT_NAME + '">';
                Viewjob(row.CLIENT_ID, function (data) {
                    $.each(data, function (index, rows) {
                        isi += '<option value="' + rows.PROJECT_NO + '">' + rows.PROJECT_NO + '</option>';
                    });
                });
                isi += '</optgroup>';
            });
            $("#selectJob").append(isi);
        },
        complete: function (json) {
            initSelect.trigger('chosen:updated');
        }
    });
}

function viewVia() {
    var initSelect = $('#selectVia').chosen(config_chosen);
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: "cashflow/report/model_report.php",
        data: {action: 'ViewVia'},
        beforeSend: function (xhr) {
            $("#selectVia").empty();
        },
        success: function (json) {
//            var isi = "<option selected disabled></option>";
            var isi = "<option value='%'>[All Via]</option>";
            $.each(json, function (index, row) {
                isi += "<option value='" + row.PAY_CATE_ID + "'>" + row.PAY_CATE_NM + "</option>";
            });
            $("#selectVia").append(isi);
        },
        complete: function (json) {
            initSelect.trigger('chosen:updated');
        }
    });
}

function vievPos() {
    var initSelect = $('#selectPos').chosen(config_chosen);
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: "cashflow/report/model_report.php",
        data: {action: 'ViewPos'},
        beforeSend: function (xhr) {
            $("#selectJob").empty();
        },
        success: function (json) {
//            var isi = "<option selected disabled></option>";
            var isi = "<option value='%'>[All Pos]</option>";
            $.each(json, function (index, row) {
                isi += "<option value='" + row.CFLOW_CATE_ID + "'>" + row.CFLOW_CATE_NM + "</option>";
            });
            $("#selectPos").append(isi);
        },
        complete: function (json) {
            initSelect.trigger('chosen:updated');
        }
    });
}

function viewSupplier() {
    var initSelect = $('#selectSupplier').chosen(config_chosen);
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: "cashflow/report/model_report.php",
        data: {action: 'ViewSupp'},
        beforeSend: function (xhr) {
            $("#selectSupplier").empty();
        },
        success: function (json) {
//            var isi = "<option selected disabled></option>";
            var isi = "<option value='%'>[All Supplier]</option>";
            $.each(json, function (index, row) {
                isi += "<option value='" + row.SUPP_ID + "'>" + row.SUPP_NM + "</option>";
            });
            $("#selectSupplier").append(isi);
        },
        complete: function (json) {
            initSelect.trigger('chosen:updated');
        }
    });
}

function Viewjob(CLIENT_ID, callback) {
    $.ajax({
        async: false,
        type: 'POST',
        dataType: 'json',
        url: "cashflow/report/model_report.php",
        data: {action: 'Viewjob', CLIENT_ID__: CLIENT_ID},
        success: callback
    });
}

function listTable(handledata) {
    var selectJob = $("#selectJob").val();
    var StartDate = $("#txtStartDate").val();
    var EndDate = $("#txtEndDate").val();
    var via = $('#selectVia').val();
    var pos = $('#selectPos').val();
    var Supplier = $('#selectSupplier').val();

    var sentReq = {
        "action": "listTable",
        job: selectJob,
        start: StartDate,
        end: EndDate,
        via: via,
        pos: pos,
        supplier: Supplier
    };

    return $.ajax({
        type: 'POST',
        dataType: 'json',
        url: "cashflow/report/model_report.php",
        data: sentReq,
        success: function (json) {
            handledata(json);
//            alert(json);
        }
    });
}

function tableView() {
    listTable(function (respon) {
        var no = 0;
        var table = $("#datatables-xeditable-example").DataTable({
            destroy: true,
            data: respon,
            columns: [
                {data: "CFLOW_ID", "className": "text-center"},
                {data: "CFLOW_DATE", "className": "text-center"},
                {data: "PROJECT_NO", "className": "text-center"},
                {data: "CFLOW_CATE_NM", "className": "text-center"},
                {data: "PAY_CATE_NM", "className": "text-center"},
                {data: "CFLOW_CURR", "className": "text-center"},
                {data: "CFLOW_PRICE", "className": "text-right"}
            ],
            "columnDefs": [
                {
                    "visible": true,
                    "targets": [0],
                    "render": function (data, type, row, meta) {
                        no++;
                        return no;
                    }
                },
                {
                    "visible": true,
                    "targets": [6],
                    "className": "text-right",
                    "render": function (data, type, row, meta) {
                        var isi = addCommas(parseFloat(row.CFLOW_PRICE_IN).toFixed(2));
                        return isi;
                    }
                },
                {
                    "visible": true,
                    "targets": [7],
                    "className": "text-right",
                    "render": function (data, type, row, meta) {
                        var isi = addCommas(parseFloat(row.CFLOW_PRICE_OUT).toFixed(2));
                        return isi;
                    }
                }
            ],
            "drawCallback": function (settings) {
                var api = this.api();
                var rows = api.rows({page: 'current'}).nodes();
                var last = null;
                api.column(2, {page: 'current'}).data().each(function (group, i) {
                    if (last !== group) {
                        $(rows).eq(i).before(
                                '<tr class="group"><td colspan="10">' + group + '</td></tr>'
                                );
                        last = group;
                    }
                });
            },
        });
    });
}

function initEditable() {
    $('#datatables-xeditable-example .initStockClass').editable({
        title: function () {
            $(this).attr('title');
        },
        validate: function (value) {
            if ($.trim(value) == '') {
                return 'This field is required';
            }
        },
        success: function (response, newValue) {

            var elmnt = $(this);
            var where = elmnt.data('pk');
            var setDataUpdate = elmnt.data('set');
            var setDataUpdateInOut = elmnt.data('set2');
            if (newValue !== '') {
                $.ajax({
                    type: "POST",
                    dataType: 'json',
                    url: "cashflow/input/model_cflow.php",
                    data: {
                        action: 'edit_data',
                        where__: where,
                        setDataUpdate__: setDataUpdate,
                        setDataUpdateInOut__: setDataUpdateInOut,
                        newValue: newValue.trim()
                    },
                    success: function (json) {
                        if (json !== 'success') {
                            elmnt.text('FAILED');
                            elmnt.css("color", "red").css("font-style", "italic");
                        } else {
                            tableView();
                        }
                    }
                });
            }
        },
        error: function (response, newValue)
        {
            console.log('FAILED');
            console.log(response);
            console.log(newValue);
        }
    });
}

function ExportPembayaran() {
    var job = $("#selectJob").val();
    var start = $("#txtStartDate").val();
    var end = $("#txtEndDate").val();
    var via = $('#selectVia').val();
    var pos = $('#selectPos').val();
    var supplier = $('#selectSupplier').val();
    window.open("reports/cashflow/period_report.php?job=" +
            job + "&start=" + start + "&end=" + end + "&via=" + via + "&pos=" + pos + via + "&supplier=" + supplier);
}

function addCommas(nStr) {
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}