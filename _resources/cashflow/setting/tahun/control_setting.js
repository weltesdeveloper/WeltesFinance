var elmnt_utama = $('#div_sett_cflow');
var tbl_element = elmnt_utama.find('#listSettingCflow');
var table_init = tbl_element.DataTable();

$(document).ready(function () {
    showList();

    elmnt_utama.find('#btnProses').on('click', function () {
        if (confirm("Apakah Anda Yakin Akan Menyimpan Setting Tahun ini? \n *Data Otomatis akan berubah sesuai tahun yang ditentukan... ")) {
            submit_selected();
            return true;
        } else {
            return false;
        }
    });
});

//kumpulan fungsi
function showList() {
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: "cashflow/setting/tahun/model_setting.php",
        data: {
            action: 'show_list'
        },
        beforeSend: function (xhr) {
            table_init.destroy();
        },
        success: function (response, textStatus, jqXHR)
        {

            $.each(response, function (i, row) {
                var chk_no = 'checked';
                var chk_yes = '';
                if (row.SHOW_SETT == '1') {
                    chk_no = '';
                    chk_yes = 'checked';
                }

                var isi_check = '<div class="input-group">\n\
                                    <div class="input-group-addon text-left">\n\
                                        <label class="option block" for="chk_showYes' + i + '"><input type="radio"  id="chk_showYes' + i + '" name="chk_show' + i + '" value="1" ' + chk_yes + '>\n\
                                            <span class="radio"></span> <b class="text-primary">Ya</b>\n\
                                        </label>\n\
                                    </div>\n\
                                    <div class="input-group-addon text-left">\n\
                                        <label class="option block" for="chk_showNo' + i + '"><input type="radio"  id="chk_showNo' + i + '" name="chk_show' + i + '" value="0" ' + chk_no + '>\n\
                                            <span class="radio"></span> <b class="text-danger">Tidak</b>\n\
                                        </label>\n\
                                    </div>\n\
                                </div>';

                var isi = "<tr>\n\
                                <td>" + row.TAHUN + "</td>\n\
                                <td>\n\
                                    " + isi_check + "\n\
                                </td>\n\
                            </tr>";
                $(tbl_element).find('tbody').append(isi);
            });

        }
    }).done(function () {
        // prosess after done
        table_init = tbl_element.DataTable({
            destroy: true,
            processing: true,
            language: {
                "processing": "Please Wait...",
                "emptyTable": "No data available in table"
            },
            paging: false,
            filter: false,
            info: false,
            "order": [[0, 'desc']]
        });
    });
}

function submit_selected() {
    var arr_thun = [];
    var arr_thun_chk = [];
    var baris = table_init.rows();
    baris.every(function () {
        var tr = this.nodes();
        var data = this.data();
        var thun = data[0];
        var thun_chk = $(tr).find('input[name ^= "chk_show"]:checked').val();

        //console.log(thun + '  ' + chk_thun);

        arr_thun.push(thun);
        arr_thun_chk.push(thun_chk);
    });

    var sentdata = {
        action: 'insert_to_db',
        arr_thun: arr_thun,
        arr_thun_chk: arr_thun_chk
    };

    $.ajax({
        type: 'POST',
        url: "cashflow/setting/tahun/model_setting.php",
        data: sentdata,
        success: function (respon, textStatus, jqXHR) {
            if (respon == 'success') {
                swal({
                    title: 'UPDATE SUCCESS',
                    text: 'Data Berhasil Di rubah',
                    type: 'success'
                }, function () {
                    ViewTanggal();
                });
            } else {
                swal({
                    title: 'UPDATE ERROR',
                    text: respon,
                    type: 'ERROR'
                }, function () {
                    // no action
                });
            }
        }
    });
}