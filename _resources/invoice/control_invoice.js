$(document).ready(function () {
    ViewPoNo();
    ViewCur();
    date();
    $('#dialogTablePodetails').hide(true);
    $("#selectPoNo").change(function () {
        var po = $("#selectPoNo").val();
        $('span#lblPo').text(po);
        $('#dialogTablePodetails').addClass("animated fadeIn").fadeIn();
        tableList();
        var namaSp__ = $('#selectPoNo option:selected').data('id');
        var alamatSp__ = $('#selectPoNo option:selected').data('id2');
        var ppn = $('#selectPoNo option:selected').data('id3');
        $("#labelNamaSupp").text(namaSp__);
        $("#labelAlamatSupp").text(alamatSp__);
        $("#labelPpn").text(ppn + ' %');
        $('#NoInvoice').val('');
        $('#remark').val('');
    });
});
function date() {
    $('#invoiceDate').datepicker({
        todayBtn: true,
        clearBtn: true,
        autoclose: true,
        todayHighlight: true,
        toggleActive: true
    });
    $('#invoiceReceiveDate').datepicker({
        todayBtn: true,
        clearBtn: true,
        autoclose: true,
        todayHighlight: true,
        toggleActive: true
    });
//    $('#selectCur').selectpicker();
}

function ViewPoNo() {
    var initSelectpicker = $('#selectPoNo').chosen(config_chosen);
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: "invoice/model_invoice.php",
        data: {action: 'ViewPoNo'},
        beforeSend: function (xhr) {
            $("#selectPoNo").empty();
        },
        success: function (json) {

            var isi = "<option value='' disabled selected> -- [Select Po No] -- </option>";
            $.each(json, function (index, row) {
                isi += '<option data-id="' + row.SUPP_NM + '" data-id2="' + row.SUPP_ADDR + '" data-id3="' + row.PO_TAX + '" value="' + row.PO_NO + '">' + row.PO_NO + '</option>';
            });
            $("#selectPoNo").append(isi);
        },
        complete: function (json) {
            initSelectpicker.trigger('chosen:updated');
        }
    });
}

function ViewCur() {
    var initSelect = $('#selectCur').chosen(config_chosen);
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: "invoice/model_invoice.php",
        data: {action: 'ViewCur'},
        beforeSend: function (xhr) {

        },
        success: function (json) {
            $("#selectCur").empty();
            var isi = "";
            $.each(json, function (index, row) {
                isi += '<option value="' + row.JANCOK + '">' + row.JANCOK + '</option>';
            });
            $("#selectCur").append(isi);
        },
        complete: function (json) {
            $("#selectCur option[value='IDR']").prop('selected', 'selected');
            initSelect.trigger('chosen:updated');
        }
    });
}

/*
 * Function untuk mengambil data detailsPo
 */

function listDetailPo(handledta) {
    var po = $('#selectPoNo').val();
    return $.ajax({
        type: 'POST',
        dataType: 'json',
        url: "invoice/model_invoice.php",
        data: {action: 'listDetailPo', po__: po},
        success: function (json) {
            handledta(json);
        }
    });
}

function tableList() {
    listDetailPo(function (respon) {
        var no = 0;
        var table = $('#listDetailPo').DataTable({
            destroy: true,
            data: respon,
            columns: [
                {data: ""},
                {data: "INV_ID"},
                {data: "INV_DESC_CONCAT"},
                {data: "PO_INV_QTY"}
//                {data: "SUB_TOTAL"}
            ],
            "columnDefs": [
                {
                    "visible": true,
                    "targets": [0],
                    "render": function (data, type, row, meta) {
                        var SUPP_INVOICE_PRICE = row.SUPP_INVOICE_PRICE;
                        var isi = '<input type="checkbox" id="check" class="form-control">';
                        if (SUPP_INVOICE_PRICE != 0) {
                            isi = '<input type="checkbox" id="check" class="form-control" disabled>';
                        }
                        return isi;
                    }
                },
                {
                    "visible": true,
                    "targets": [3],
                    "render": function (data, type, row, meta) {
                        var isi = data + " " + row.PO_UNIT_PIECE;
                        return isi;
                    }
                },
                {
                    "visible": true,
                    "targets": [4],
                    "render": function (data, type, row, meta) {
                        var price = addCommas(parseFloat(row.SUB_TOTAL).toFixed(2));
                        return price;
                    }
                },
                {
                    "visible": true,
                    "targets": [5],
                    "render": function (data, type, row, meta) {
                        var SUPP_INVOICE_PRICE = row.SUPP_INVOICE_PRICE;
                        var price = addCommas(parseFloat(row.SUB_TOTAL).toFixed(2));//num.toPrecision(2);
                        var isi = '<a href="#" style="cursor:pointer" class="initStockClass text-center" data-pk="' + price + '" data-set="COMP_WEIGHT" >' + price + '</a>';
                        if (SUPP_INVOICE_PRICE != 0) {
                            isi = addCommas(parseFloat(row.SUPP_INVOICE_PRICE).toFixed(2));
                        }
                        return isi;
                    }
                },
            ],
            "drawCallback": function (settings) {
                initEditable();
            },
        });
    });
}

function initEditable() {
    $('#listDetailPo .initStockClass').editable({
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
            var comp_id = elmnt.data('pk');
            var setDataUpdate = elmnt.data('set');
            if (newValue !== '') {
                $.ajax({
                    type: "POST",
                    dataType: 'json',
                    url: "divpages/process/processRev.php",
                    data: {
                        action: 'edit_data',
                        comp_id__: comp_id,
                        setDataUpdate__: setDataUpdate,
                        newValue: newValue.trim()
                    },
                    success: function (json) {
                        if (json !== 'success') {
                            elmnt.text('FAILED');
                            elmnt.css("color", "red").css("font-style", "italic");
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

$('#btnProses').click(function () {
    if (confirm('Are You Sure to Input Data ?')) {

        var po = $('#selectPoNo option:selected').val();
        var namaSupp = $('#labelNamaSupp').text();
        var alamatSupp = $('#labelAlamatSupp').text();
        var NoInv = $('#NoInvoice').val();
        var txtDate = $('#txtDate').val();
        var txtRecDate = $('#txtRecDate').val();
        var selectCur = $('#selectCur option:selected').val();
        var remark = $('#remark').val();

        var INV_ID = [];
        var NamaBarang = [];
        var qty = [];
        var hargaPo = [];
        var tagihan = [];

        var rows = $('#listDetailPo').dataTable().fnGetNodes();

        for (var x = 0; x < rows.length; x++) {
            var check = $(rows[x]).find("td:eq(0)").find('#check').is(':checked');
            if (check) {
                INV_ID.push($(rows[x]).find("td:eq(1)").text());
                NamaBarang.push($(rows[x]).find("td:eq(2)").text());
                qty.push($(rows[x]).find("td:eq(3)").text());
                hargaPo.push($(rows[x]).find("td:eq(4)").text());
                tagihan.push($(rows[x]).find("td:eq(5)").text());
            }
        }

        var sentReq = {
            action: 'inputInvoice',
            po__: po,
            namaSupp__: namaSupp,
            alamatSupp__: alamatSupp,
            NoInv__: NoInv,
            txtDate__: txtDate,
            txtRecDate__: txtRecDate,
            selectCur__: selectCur,
            remark__: remark,
            INV_ID__: INV_ID,
            NamaBarang__: NamaBarang,
            qty__: qty,
            hargaPo__: hargaPo,
            tagihan__: tagihan,
        };
        console.log(sentReq);
        if (sentReq.NoInv__ == "") {
            swal("ISI NOMER INVOICE", "ERROR", "error");
            $('#NoInvoice').focus();
        } else if (sentReq.selectCur__ == "") {
            swal("ISI CURRENCY", "ERROR", "error");
            $('#selectCur').focus();
        } else if (sentReq.INV_ID__.length == 0) {
            swal("CENTANG MINIMAL SATU BARANG", "ERROR", "error");
        } else {
            inputInvoice(sentReq);
        }
    } else {
        return false;
    }
});

function inputInvoice(sentReq) {
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: "invoice/model_invoice.php",
        data: sentReq,
        success: function (json) {
            if (json.indexOf("GAGAL") == -1) {
                swal("BERHASIL INPUT INVOICE", "GOOD JOB", "success");
                ResetForm();
            } else {
                swal("GAGAL INPUT INVOICE", "ERROR", "success");
            }
        }
    });
}

function ResetForm() {
    $("#selectPoNo").change();
//    var NoInv = $('#NoInvoice').val('');
//    var txtDate = $('#txtDate').val('');
//    var txtRecDate = $('#txtRecDate').val('');
//    var selectCur = $('#selectCur option:selected').val('');
//    var remark = $('#remark').val('');
}