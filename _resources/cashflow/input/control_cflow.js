$(document).ready(function () {
    ViewClient();
    ViewKatPem();
    ViewVia();
    ViewCur();
    ViewKatPem();
    date();
    tableView();
    ViewSupp();
    ViewType();
    ViewTanggal();
    DisableEdit();

    /*
     * EDIT
     */
    $('#btnEditPembayaran').click(function () {
        if (confirm('Apa anda ingin melakukan edit data?')) {

            var editID = $('#editID').val();
            var EditJob = $('#EditJob option:selected').val();
            var EditDate = $('#EditDate').val();
            var EditKatPembayaran = $('#EditKatPembayaran option:selected').val();
            var editViaPembayaran = $('#editViaPembayaran option:selected').val();
            var editCur = $('#editCur option:selected').val();
            var editNominal = $('#editNominal').autoNumeric('get');
            var typeFlowEdit = $('input[name=typeFlowEdit]:checked').val();
            var editRemark = $('#editRemark').val();
            var EditSupp = $('#EditSupp').val();
            var editTipe = $('#editTipe').val();

            var sentReq = {
                action: 'editData',
                editID__: editID,
                EditJob__: EditJob,
                EditDate__: EditDate,
                EditKatPembayaran__: EditKatPembayaran,
                editViaPembayaran__: editViaPembayaran,
                editCur__: editCur,
                editNominal__: editNominal,
                typeFlowEdit__: typeFlowEdit,
                editRemark__: editRemark,
                EditSupp__: EditSupp,
                editTipe__: editTipe,
            };
            if (sentReq.editNominal__ == "") {
                swal("ISI Nominal", "ERROR", "error");
                $('#editNominal').focus();
            } else {
                prosesEditData(sentReq);
            }
        } else {
            return false;
        }
    });

    /*
     * Tambah Via Pembayaran
     */
    $('#btnCreateVia').click(function () {
        var namaKat = $("#nameKategoriVia").val();
        var remarkKat = $("#remarkKategoriVia").val();
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: "cashflow/input/model_cflow.php",
            data: {action: 'InputKategoriVia', nama__: namaKat, remark__: remarkKat},
            success: function (json) {
                alert(json);
                $('#modalViaPembayaran').modal('hide');
                ViewVia();
            }
        });
    });

    /*
     * Tambah Tipe
     */
    $('#btnTambahTipe').click(function () {
        var namaKat = $("#nameTipe").val();
        var remarkKat = $("#remarkTipe").val();
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: "cashflow/input/model_cflow.php",
            data: {action: 'InputTipe', nama__: namaKat, remark__: remarkKat},
            success: function (json) {
                alert(json);
                $('#modalselectType').modal('hide');
                ViewType();
            }
        });
    });

    /*
     * Tambah Kategori Pembayaran
     */
    $('#btnCategoryPembayaran').click(function () {
        var namaKat = $("#nameKategoriPembayaran").val();
        var remarkKat = $("#remarkKategoriPembayaran").val();
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: "cashflow/input/model_cflow.php",
            data: {action: 'InputKategoriPembayaran', nama__: namaKat, remark__: remarkKat},
            success: function (json) {
                alert(json);
                $('#modalKategoriPembayaran').modal('hide');
                ViewKatPem();
            }
        });
    });

    /*
     * Proses Input Pembayaran
     */
    $('#btnProsesInput').click(function () {
        if (confirm('Are You Sure to Input Data ?')) {

            var selectJob = $('#selectJob option:selected').val();
            var txtDate = $('#txtDate').val();
            var selectCur = $('#selectCur option:selected').val();
            var nominal = $('#nominal').autoNumeric('get');
            var selectKatPembayaran = $('#selectKatPembayaran option:selected').val();
            var selectViaPembayaran = $('#selectViaPembayaran option:selected').val();
            var typeFlow = $('input[name=typeFlow]:checked').val();
            var remark = $('#remark').val();
            var selectSupplier = $('#selectSupplier option:selected').val();
            var selectType = $('#selectType option:selected').val();


            var sentReq = {
                action: 'inputData',
                selectJob__: selectJob,
                txtDate__: txtDate,
                selectCur__: selectCur,
                nominal__: nominal,
                selectKatPembayaran__: selectKatPembayaran,
                selectViaPembayaran__: selectViaPembayaran,
                typeFlow__: typeFlow,
                remark__: remark,
                selectSupplier__: selectSupplier,
                selectType__: selectType,
            };
            console.log(sentReq);
            var getTahun = $('#txtDate').val();
            var tahun = getTahun.substring(6, getTahun.length);

            var include_tahun = $('#tahun').text().trim();
            if (include_tahun.indexOf(tahun) == -1) {
                swal("TOLONG MASUKKAN TAHUN YANG BENAR", "error", "error");
            } else if (sentReq.selectJob__ == "") {
                swal("Pilih Job", "ERROR", "error");
                $('#selectJob').focus();
            } else if (sentReq.nominal__ == "") {
                swal("ISI Nominal", "ERROR", "error");
                $('#nominal').focus();
            } else if (sentReq.selectKatPembayaran__ == "") {
                swal("Pilih Kategori Pembayaran", "ERROR", "error");
                $('#selectKatPembayaran').focus();
            } else if (sentReq.selectViaPembayaran__ == "") {
                swal("Pilih Via Pembayaran", "   ERROR", "error");
                $('#selectViaPembayaran').focus();
            } else if (sentReq.selectSupplier__ == "") {
                swal("Pilih Supplier", "ERROR", "error");
                $('#selectSupplier').focus();
            } else if (sentReq.selectType__ == "") {
                swal("Pilih Tipe", "ERROR", "error");
                $('#selectType').focus();
            } else {
                inputPembayaran(sentReq);
                ResetForm();
            }
        } else {
            return false;
        }
    });

    /*
     * Auto Number Inisialisasi 
     */
    $('#nominal').autoNumeric('init');
});

//untuk mengambil tanggal
function date() {
    $('#cflow_date, #Edit_cflow_date').datepicker({
        todayBtn: 'linked',
        clearBtn: true,
        autoclose: true,
        todayHighlight: true,
        toggleActive: true
    });
}

//untuk mengambil client
function ViewClient() {
    var initSelect = $('#selectJob').chosen(config_chosen);
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: "cashflow/input/model_cflow.php",
        data: {action: 'ViewClient'},
        beforeSend: function (xhr) {
        },
        success: function (json) {
            $("#selectJob").empty();
            var isi = "<option value='' disabled selected> -- [Select Job] -- </option>";
            $.each(json, function (index, row) {
                isi += '<optgroup label="' + row.CLIENT_NAME + '">';
                Viewjob(row.CLIENT_NAME, function (data) {
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

//untuk mengambil job
function Viewjob(CLIENT_NAME, callback) {
    $.ajax({
        async: false,
        type: 'POST',
        dataType: 'json',
        url: "cashflow/input/model_cflow.php",
        data: {action: 'Viewjob', CLIENT_NAME__: CLIENT_NAME},
        success: callback
    });
}

//untuki mendapatkan currency
function ViewCur() {
    var initSelect = $('#selectCur').chosen(config_chosen);
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: "cashflow/input/model_cflow.php",
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

//untuk mengambil supplier
function ViewSupp() {
    var initSelect = $('#selectSupplier').chosen(config_chosen);
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: "cashflow/input/model_cflow.php",
        data: {action: 'ViewSupp'},
        beforeSend: function (xhr) {

        },
        success: function (json) {
            $("#selectSupplier").empty();
            var isi = "<option value='' disabled selected> -- [Select Supplier] -- </option>";
            $.each(json, function (index, row) {
                isi += '<option value="' + row.SUPP_ID + '">' + row.SUPP_NM + '</option>';
            });
            $("#selectSupplier").append(isi);
        },
        complete: function (json) {
            initSelect.trigger('chosen:updated');
        }
    });
}

//unutk mengambil via
function ViewVia() {
    var initSelect = $('#selectViaPembayaran').chosen(config_chosen);
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: "cashflow/input/model_cflow.php",
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

//untuk mengambil tipe
function ViewType() {
    var initSelect = $('#selectType').chosen(config_chosen);
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: "cashflow/input/model_cflow.php",
        data: {action: 'ViewType'},
        beforeSend: function (xhr) {
        },
        success: function (json) {
            $("#selectType").empty();
            var isi = "<option value='' disabled selected> -- [Select Tipe] -- </option>";
            $.each(json, function (index, row) {
                isi += '<option value="' + row.CFLOW_TYPE_ID + '">' + row.CFLOW_TYPE_NAME + '</option>';
            });
            $("#selectType").append(isi);
        },
        complete: function (json) {
            initSelect.trigger('chosen:updated');
        }
    });
}

//untuk mengambil kategori pembayaran/pos
function ViewKatPem() {
    var initSelect = $('#selectKatPembayaran').chosen(config_chosen);
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: "cashflow/input/model_cflow.php",
        data: {action: 'ViewKatPem'},
        beforeSend: function (xhr) {
        },
        success: function (json) {
            $("#selectKatPembayaran").empty();
            var isi = "<option value='' disabled selected> -- [Select POS] -- </option>";
            $.each(json, function (index, row) {
                isi += '<option value="' + row.CFLOW_CATE_ID + '">' + row.CFLOW_CATE_NM + '</option>';
            });
            $("#selectKatPembayaran").append(isi);
        },
        complete: function (json) {
            initSelect.trigger('chosen:updated');
        }
    });
}

//untuk proses input pembayaran
function inputPembayaran(sentReq) {
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: "cashflow/input/model_cflow.php",
        data: sentReq,
        beforeSend: function (json) {
        },
        success: function (json) {
            if (json = "SUKSES") {
                swal("Good job!", "Berhasil Input Cash FLow!", "success");
            } else {
                swal("Pilih Job", "ERROR", "error");
            }
        },
        complete: function (json) {
            tableView();
        }
    });
}

//menampilkan datatable dari cash flow
function listTable(handledata) {
    return $.ajax({
        type: 'POST',
        dataType: 'json',
        url: "cashflow/input/model_cflow.php",
        data: {action: "listTable"},
        success: function (json) {
            handledata(json);
        }
    });
}

//list table untuk menampilkan cash flow
function tableView() {
    listTable(function (respon) {
        var no = 0;
        var table = $("#datatables-xeditable-example").DataTable({
            destroy: true,
            data: respon,
            columns: [
                {data: "CFLOW_NO"}, // 0
                {data: "CFLOW_SIGN", className: "hidden"}, // 1 
                {data: "CFLOW_DATE"}, // 2
                {data: "PROJECT_NO"}, // 3 
                {data: "SUPP_NM"}, // 4 
                {data: "CFLOW_CATE_NM"}, // 5
                {data: "PAY_CATE_NM"}, // 6
                {data: "CFLOW_PRICE_IN"}, // 7 
                {data: "CFLOW_PRICE_OUT"}, // 8 
                {data: "CFLOW_REM"}, // 9
                {data: "CFLOW_TYPE_NAME"}, // 10
                {data: ""}, // 11 button
                {data: "CFLOW_REV"}, // 12
                {data: "CFLOW_CHECK_REM"} // 13
            ],
            "columnDefs": [
//                {
//                    "visible": true,
//                    "targets": [0],
//                    "render": function (data, type, row, meta) {
//                        no++;
//                        return no;
//                    }
//                },
                {
                    "visible": true,
                    "targets": [7],
                    "render": function (data, type, row, meta) {
                        var isi = "<i>" + row.CFLOW_CURR + "</i> " + addCommas(data);
                        return isi;
                    }
                },
                {
                    "visible": true,
                    "targets": [8],
                    "render": function (data, type, row, meta) {
                        var isi = "<i>" + row.CFLOW_CURR + "</i> " + addCommas(data);
                        return isi;
                    }
                },
                {
                    "visible": true,
                    "targets": [11],
                    "render": function (data, type, row, meta) {
                        var check = row.CFLOW_CHECK;
                        var isi = "";
                        if (check == '0') {
                            isi += '<button title="Hapus" onclick="hapusData(' + row.CFLOW_ID + ')" class="btn btn btn-icon social-pinterest-color"><i class="fa fa-times"></i></button> <button onclick="editData(' + row.CFLOW_ID + ')" class="btn btn btn-icon social-instagram-color"><i class="fa fa-magic"></i></button>';
                        } else {
                            isi += '<button onclick="editData(' + row.CFLOW_ID + ')" class="btn btn btn-icon social-linkedin-color"><i class="fa fa-magic"></i> Revisi</button>';
                        }

                        return isi;
                    }
                }
            ],
            "drawCallback": function (settings) {
//                initEditable();
            }
        });
    });

}

//fungsi untuk menghapus data
function hapusData(id) {
    if (confirm('Are You Sure to Delete Data ?')) {
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "cashflow/input/model_cflow.php",
            data: {action: "hapusData", id__: id},
            success: function (json) {
                if (json == 'success') {
                    swal("Good job!", "Data Berhasil di Hapus", "success");
                    tableView();
                } else {
                    swal("Pilih Job", "ERROR" + json, "error");
                }
            }
        });
    } else {
        return false;
    }
}

//reset form ke value null
function ResetForm() {
    $("#selectJob").chosen().val("").trigger("chosen:updated");
    $("#selectCur").chosen().val("IDR").trigger("chosen:updated");
    $("#selectKatPembayaran").chosen().val("").trigger("chosen:updated");
    $("#selectViaPembayaran").chosen().val("").trigger("chosen:updated");
    $("#selectSupplier").chosen().val("").trigger("chosen:updated");
    $("#selectType").chosen().val("").trigger("chosen:updated");
    $('#nominal,#remark').val("");
    $('#varr17').prop("checked", true);
}

//cek jika nominal kosong
function ChangeNominal() {
    var nominal = $('#nominal');
    if (nominal.val() == "") {
        nominal.val("0.00");
    }
}


/*
 * KUMPULAN FUNGSI 
 * EDIT VIA, POS, DAN TIPE
 */
//MODAL VIA
function ClickVia(param) {
    if (param == "new") {
        $('#nameKategoriVia').val("");
        $('#remarkKategoriVia').val("");
        $('#title-via-pembayaran').text("TAMBAH VIA PEMBAYARAN");
        $('#btnEditVia').hide();
        $('#btnCreateVia').show();
        $('#modalViaPembayaran').modal('show');
    } else if (param == "edit") {
        var via = $('#selectViaPembayaran').val();
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: "cashflow/input/model_cflow.php",
            data: {action: 'getVia', via: via},
            beforeSend: function (xhr) {
                $('#nameKategoriVia').val("");
                $('#remarkKategoriVia').val("");
            },
            success: function (json) {
                $('#title-via-pembayaran').text("EDIT VIA PEMBAYARAN");
                $('#btnEditVia').show();
                $('#btnCreateVia').hide();
                $('#idKategoriVia').val(json[0].PAY_CATE_ID);
                $('#nameKategoriVia').val(json[0].PAY_CATE_NM);
                $('#remarkKategoriVia').val(json[0].PAY_CATE_REM);
                $('#modalViaPembayaran').modal('show');
            }
        });
    }
}

//MODAL POS
function ClickPos(param) {
    if (param == "new") {
        $('#nameKategoriPembayaran').val("");
        $('#remarkKategoriPembayaran').val("");
        $('#title-pos-pembayaran').text("TAMBAH POS PEMBAYARAN");
        $('#btnCategoryPembayaran').show();
        $('#btnEditPos').hide();
        $('#modalKategoriPembayaran').modal('show');
    } else if (param == "edit") {
        var pos = $('#selectKatPembayaran').val();
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: "cashflow/input/model_cflow.php",
            data: {action: 'getPos', pos: pos},
            beforeSend: function (xhr) {
                $('#nameKategoriPembayaran').val("");
                $('#remarkKategoriPembayaran').val("");
            },
            success: function (json) {
                $('#title-pos-pembayaran').text("EDIT POS PEMBAYARAN");
                $('#btnEditPos').show();
                $('#btnCategoryPembayaran').hide();
                $('#idKategoriPembayaran').val(json[0].CFLOW_CATE_ID);
                $('#nameKategoriPembayaran').val(json[0].CFLOW_CATE_NM);
                $('#remarkKategoriPembayaran').val(json[0].CFLOW_CATE_REM);
                $('#modalKategoriPembayaran').modal('show');
            }
        });
    }
}

//MODAL TIPE
function ClickTipe(param) {
    if (param == "new") {
        $('#nameTipe').val("");
        $('#remarkTipe').val("");
        $('#title-tipe-pembayaran').text("TAMBAH TIPE PEMBAYARAN");
        $('#btnEditTipe').hide();
        $('#btnTambahTipe').show();
        $('#modalselectType').modal('show');
    } else if (param == "edit") {
        var tipe = $('#selectType').val();
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: "cashflow/input/model_cflow.php",
            data: {action: 'getTipe', tipe: tipe},
            beforeSend: function (xhr) {
                $('#nameTipe').val("");
                $('#remarkTipe').val("");
            },
            success: function (json) {
                $('#title-tipe-pembayaran').text("EDIT POS PEMBAYARAN");
                $('#btnEditTipe').show();
                $('#btnTambahTipe').hide();
                $('#idTipe').val(json[0].CFLOW_TYPE_ID);
                $('#nameTipe').val(json[0].CFLOW_TYPE_NAME);
                $('#remarkTipe').val(json[0].CFLOW_TYPE_REM);
                $('#modalselectType').modal('show');
            }
        });
    }
}

//EDIT VIA
function EditVia() {
    var via_id = $("#idKategoriVia").val();
    var via_name = $("#nameKategoriVia").val();
    var via_keterangan = $("#remarkKategoriVia").val();

    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: "cashflow/input/model_cflow.php",
        data: {action: 'edit_via', via_id: via_id, via_name: via_name, via_keterangan: via_keterangan},
        success: function (json) {
            if (json == "sukses") {
                swal("Berhasil Update", "good job", "success");
                AfterUpdate("selectViaPembayaran", via_id, "ViewVia");
                $('#modalViaPembayaran').modal('hide');
            } else {
                swal("Gagal Update", json, "error");
            }
        }
    });
}

/*FUNGSI SETELAH UPDATE*/
function AfterUpdate(dropdown, id, action) {
    var initSelect = $('#' + dropdown).chosen(config_chosen);
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: "cashflow/input/model_cflow.php",
        data: {action: action},
        beforeSend: function (xhr) {
            $('#' + dropdown).empty();
        },
        success: function (json) {
            var isi = "<option value='' disabled selected> -- [Select Tipe] -- </option>";
            $.each(json, function (index, row) {
                isi += '<option value="' + row[0] + '">' + row[1] + '</option>';
            });
            $('#' + dropdown).append(isi);
        },
        complete: function (json) {
            $("#" + dropdown + " option[value='" + id + "']").prop('selected', 'selected');
            initSelect.trigger('chosen:updated');
        }
    });
}

//EDIT POS
function EditPos() {
    var pos_id = $("#idKategoriPembayaran").val();
    var pos_name = $("#nameKategoriPembayaran").val();
    var pos_keterangan = $("#remarkKategoriPembayaran").val();

    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: "cashflow/input/model_cflow.php",
        data: {action: 'edit_pos', pos_id: pos_id, pos_name: pos_name, pos_keterangan: pos_keterangan},
        success: function (json) {
            if (json == "sukses") {
                swal("Berhasil Update", "good job", "success");
                AfterUpdate("selectKatPembayaran", pos_id, "ViewKatPem");
                $('#modalKategoriPembayaran').modal('hide');
            } else {
                swal("Gagal Update", json, "error");
            }
        }
    });
}

//EDIT TIPE
function EditTipe() {
    var tipe_id = $("#idTipe").val();
    var tipe_name = $("#nameTipe").val();
    var tipe_keterangan = $("#remarkTipe").val();

    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: "cashflow/input/model_cflow.php",
        data: {action: 'edit_tipe', tipe_id: tipe_id, tipe_name: tipe_name, tipe_keterangan: tipe_keterangan},
        success: function (json) {
            if (json == "sukses") {
                swal("Berhasil Update", "good job", "success");
                AfterUpdate("selectType", tipe_id, "ViewType");
                $('#modalselectType').modal('hide');
            } else {
                swal("Gagal Update", json, "error");
            }
        }
    });
}

/*
 * FUNGSI EDIT CASH FLOW
 * EDIT ######################################################
 */
function editData(id) {

    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: "cashflow/input/model_cflow.php",
        data: {action: 'takeListEdit', id__: id},
        beforeSend: function (xhr) {

        },
        success: function (json) {
            $('#editID').val(json[0].CFLOW_ID);
            ViewClientEdit(json[0].PROJECT_NO);
            ViewCurEdit(json[0].CFLOW_CURR);
            ViewViaEdit(json[0].PAY_CATE_ID);
            ViewKatPemEdit(json[0].CFLOW_CATE_ID);
            ViewSuppEdit(json[0].SUPP_ID);
            ViewTypeEdit(json[0].CFLOW_TYPE_ID)

            $('#EditDate').val(json[0].TANGGAL);
            $('#editNominal').val(json[0].CFLOW_PRICE);
            $('input[type="radio"]#' + json[0].CFLOW_TYPE).prop('checked', true);
            $('#editRemark').val(json[0].CFLOW_REM);
        },
        complete: function (jqXHR, textStatus) {
            $('#modalEditData').modal('show');
            $('#editNominal').autoNumeric('init');
        }
    });


}


function ViewClientEdit(job) {
    var initSelect = $('#EditJob').chosen(config_chosen);
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: "cashflow/input/model_cflow.php",
        data: {action: 'ViewClient'},
        beforeSend: function (xhr) {
        },
        success: function (json) {
            $("#selectJob").empty();
            var isi = "";
            $.each(json, function (index, row) {
                isi += '<optgroup label="' + row.CLIENT_NAME + '">';
                ViewjobEdit(row.CLIENT_NAME, function (data) {
                    $.each(data, function (index, rows) {
                        isi += '<option value="' + rows.PROJECT_NO + '">' + rows.PROJECT_NO + '</option>';
                    });
                });
                isi += '</optgroup>';
            });
            $("#EditJob").append(isi);
        },
        complete: function (json) {
            $("#EditJob option[value='" + job + "']").prop('selected', 'selected');
            initSelect.trigger('chosen:updated');
        }
    });
}
function ViewjobEdit(CLIENT_NAME, callback) {
    $.ajax({
        async: false,
        type: 'POST',
        dataType: 'json',
        url: "cashflow/input/model_cflow.php",
        data: {action: 'Viewjob', CLIENT_NAME__: CLIENT_NAME},
        success: callback
    });
}
function ViewCurEdit(curr) {
    var initSelect = $('#editCur').chosen(config_chosen);
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: "cashflow/input/model_cflow.php",
        data: {action: 'ViewCur'},
        beforeSend: function (xhr) {

        },
        success: function (json) {
            $("#editCur").empty();
            var isi = "";
            $.each(json, function (index, row) {
                isi += '<option value="' + row.JANCOK + '">' + row.JANCOK + '</option>';
            });
            $("#editCur").append(isi);
        },
        complete: function (json) {
            $("#editCur option[value='" + curr + "']").prop('selected', 'selected');
            initSelect.trigger('chosen:updated');
        }
    });
}
function ViewViaEdit(via) {
    var initSelect = $('#editViaPembayaran').chosen(config_chosen);
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: "cashflow/input/model_cflow.php",
        data: {action: 'ViewVia'},
        beforeSend: function (xhr) {
        },
        success: function (json) {
            $("#editViaPembayaran").empty();
            var isi = "";
            $.each(json, function (index, row) {
                isi += '<option value="' + row.PAY_CATE_ID + '">' + row.PAY_CATE_NM + '</option>';
            });
            $("#editViaPembayaran").append(isi);
        },
        complete: function (json) {
            $("#editViaPembayaran option[value='" + via + "']").prop('selected', 'selected');
            initSelect.trigger('chosen:updated');
        }
    });
}
function ViewKatPemEdit(kat) {
    var initSelect = $('#EditKatPembayaran').chosen(config_chosen);
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: "cashflow/input/model_cflow.php",
        data: {action: 'ViewKatPem'},
        beforeSend: function (xhr) {
        },
        success: function (json) {
            $("#EditKatPembayaran").empty();
            var isi = "";
            $.each(json, function (index, row) {
                isi += '<option value="' + row.CFLOW_CATE_ID + '">' + row.CFLOW_CATE_NM + '</option>';
            });
            $("#EditKatPembayaran").append(isi);
        },
        complete: function (json) {
            $("#EditKatPembayaran option[value='" + kat + "']").prop('selected', 'selected');
            initSelect.trigger('chosen:updated');
        }
    });
}
function ViewSuppEdit(supp) {
    var initSelect = $('#EditSupp').chosen(config_chosen);
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: "cashflow/input/model_cflow.php",
        data: {action: 'ViewSupp'},
        beforeSend: function (xhr) {

        },
        success: function (json) {
            $("#EditSupp").empty();
            var isi = "<option value='' disabled selected> -- [Select Supplier] -- </option>";
            $.each(json, function (index, row) {
                isi += '<option value="' + row.SUPP_ID + '">' + row.SUPP_NM + '</option>';
            });
            $("#EditSupp").append(isi);
        },
        complete: function (json) {
            $("#EditSupp option[value='" + supp + "']").prop('selected', 'selected');
            initSelect.trigger('chosen:updated');
        }
    });
}
function ViewTypeEdit(tipe) {
    var initSelect = $('#editTipe').chosen(config_chosen);
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: "cashflow/input/model_cflow.php",
        data: {action: 'ViewType'},
        beforeSend: function (xhr) {
        },
        success: function (json) {
            $("#editTipe").empty();
            var isi = "<option value='' disabled selected> -- [Select Tipe] -- </option>";
            $.each(json, function (index, row) {
                isi += '<option value="' + row.CFLOW_TYPE_ID + '">' + row.CFLOW_TYPE_NAME + '</option>';
            });
            $("#editTipe").append(isi);
        },
        complete: function (json) {
            $("#editTipe option[value='" + tipe + "']").prop('selected', 'selected');
            initSelect.trigger('chosen:updated');
        }
    });
}
function prosesEditData(sentReq) {
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: "cashflow/input/model_cflow.php",
        data: sentReq,
        success: function (json) {
//            if (json = "success") {
//                swal("Good job!", "You clicked the button!", "success");
//            } else {
//                swal("Pilih Job", "ERROR", "error");
//            }
        },
        complete: function (jqXHR, textStatus) {
            swal("Good job!", "You clicked the button!", "success");
            $('#modalEditData').modal('hide');
            tableView();
        }
    });
}
function CekTanggal() {
    var getTahun = $('#txtDate').val();
    var tahun = getTahun.substring(6, getTahun.length);

    var include_tahun = $('#tahun').text().trim();
    if (include_tahun.indexOf(tahun) == -1) {
        swal("TOLONG MASUKKAN TAHUN YANG BENAR", "error", "error");
    }
}
//DISABLE EDIT BUTTON
function DisableEdit() {
    $('#editvia').prop("disabled", true);
    $('#editpos').prop("disabled", true);
    $('#edittipe').prop("disabled", true);
}
function RubahDorpDown(param) {
    console.log(param);
    $('#' + param).prop("disabled", false);
}

