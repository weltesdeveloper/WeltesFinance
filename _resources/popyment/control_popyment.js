$(document).ready(function () {
    date();
    ViewSupplier();
    ViewVia();
    $("#Supplier").change(function () {
        tableList();
        var inv = $('#Supplier option:selected').val();
        var supp = $('#Supplier option:selected').text();

        $("#lblSuppInvId").text(inv);
        $("#lblSupp").text(supp);

    });

    $('#btnCategory').click(function () {
        var namaKat = $("#nameKategori").val();
        var remarkKat = $("#remarkKategori").val();
        $.ajax({
            type: 'POST',
            dataType: 'json',
            data: {action: 'InputKategori', nama__: namaKat, remark__: remarkKat},
            url: "popyment/model_popyment.php",
            success: function (json) {
                alert(json);
                $('#infoModalDefaultHeader').modal('hide');
                ViewVia();
            }
        });
    });

    $('#btnProses').click(function () {
        if (confirm('Are You Sure to Input Data ?')) {

            var Supplier = $('#Supplier option:selected').val();
            var txtDate = $('#txtDate').val();
            var maxPyment = $('#maxPyment').val();
            var selectVia = $('#selectViaPembayaran option:selected').val();

            var po = [];
            var totPo = [];
            var totInv = [];

            var rows = $('#listDetail').dataTable().fnGetNodes();

            for (var x = 0; x < rows.length; x++) {
                var check = $(rows[x]).find("td:eq(0)").find('#check').is(':checked');
                if (check) {
                    po.push($(rows[x]).find("td:eq(1)").text());
                    totPo.push($(rows[x]).find("td:eq(2)").text());
                    totInv.push($(rows[x]).find("td:eq(3)").text());
                }
            }

            var sentReq = {
                action: 'inputData',
                Supplier__: Supplier,
                txtDate__: txtDate,
                maxPyment__: maxPyment,
                selectVia__: selectVia,
                po__: po,
                totPo__: totPo,
                totInv__: totInv,
            };
            console.log(sentReq);
            if (sentReq.Supplier__ == "") {
                swal("Pilih Supplier", "ERROR", "error");
                $('#NoInvoice').focus();
            } else if (sentReq.maxPyment__ == "") {
                swal("ISI Max Pembayaran", "ERROR", "error");
                $('#selectCur').focus();
            } else if (sentReq.selectVia__ == "") {
                swal("Pilih Via Pembayaran", "ERROR", "error");
                $('#selectCur').focus();
            } else if (sentReq.po__.length == 0) {
                swal("Pilih PO", "ERROR", "error");
            } else {
                inputPembayaran(sentReq);
            }
        } else {
            return false;
        }
    });

});

function date() {

    $('#pymentDate').datepicker({
        todayBtn: true,
        clearBtn: true,
        autoclose: true,
        todayHighlight: true,
        toggleActive: true
    });
}
function ViewSupplier() {
    var initSelect = $('#Supplier').chosen(config_chosen);
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: "popyment/model_popyment.php",
        data: {action: 'ViewSupplier'},
        beforeSend: function (xhr) {
        },
        success: function (json) {
            $("#Supplier").empty();
            var isi = "<option value='' disabled selected> -- [Select Supplier] -- </option>";
            $.each(json, function (index, row) {
                isi += '<option value="' + row.SUPP_ID + '">' + row.SUPP_NM + '</option>';
            });
            $("#Supplier").append(isi);
        },
        complete: function (json) {
            initSelect.trigger('chosen:updated');
        }
    });
}
function ViewVia() {
    var initSelect = $('#selectViaPembayaran').chosen(config_chosen);
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: "popyment/model_popyment.php",
        data: {action: 'ViewVia'},
        beforeSend: function (xhr) {
        },
        success: function (json) {
            $("#selectViaPembayaran").empty();
            var isi = "<option value='' disabled selected> -- [Select Via] -- </option>";
            $.each(json, function (index, row) {
                isi += '<option value="' + row.PAY_CATE_ID + '">' + row.PAY_CATE_NM + '</option>';
            });
            $("#selectViaPembayaran").append(isi);
        },
        complete: function (json) {
            initSelect.trigger('chosen:updated');
        }
    });
}


/*
 * Function untuk mengambil data detailsPo
 */

function listDetail(handledta) {
    var supp = $('#Supplier').val();
    return $.ajax({
        type: 'POST',
        dataType: 'json',
        url: "popyment/model_popyment.php",
        data: {action: 'listDetail', supp__: supp},
        success: function (json) {
            handledta(json);
        }
    });
}

var table = $('#listDetail').DataTable();
function tableList() {
    listDetail(function (respon) {
        var no = 0;
        table = $('#listDetail').DataTable({
            destroy: true,
            data: respon,
            columns: [
                {data: ""},
                {data: "PO_NO"},
                {data: "TOT_PRICE"},
                {data: "TOT_INVOICE"}
            ],
            "columnDefs": [
                {
                    "visible": true,
                    "targets": [0],
                    "render": function (data, type, row, meta) {
                        var isi = '<input type="checkbox" id="check" class="form-control">';
//                        var SUPP_INVOICE_PRICE = row.SUPP_INVOICE_PRICE;
//                        if (SUPP_INVOICE_PRICE != 0) {
//                            isi = '<input type="checkbox" id="check" class="form-control" disabled>';
//                        }
                        return isi;
                    }
                },
                {
                    "visible": true,
                    "targets": [2],
                    "render": function (data, type, row, meta) {
                        var isi = addCommas(parseFloat(data).toFixed(2));
                        return isi;
                    }
                },
                {
                    "visible": true,
                    "targets": [3],
                    "render": function (data, type, row, meta) {
                        var isi = addCommas(parseFloat(data).toFixed(2));
                        return isi;
                    }
                }
            ],
            "createdRow": function (nRow, aData, iDataIndex) {
                var api = this.api();

                var child = api.row(nRow).child("Heyyyy ");
                console.log(child);
                //$(nRow).attr('id', 'baris_' + i);
                //var child = table.row(nRow).child('yeahh');

                //if (child.isShown()) {
                //    child.hide();
                //}
                //else {
                child.show();
                //}
                console.log(nRow);
                no++;
            }
        });
    });
}

function inputPembayaran(sentReq) {
    console.log(sentReq);
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