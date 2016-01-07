var elmnt_utama = $('#div_settpass_cflow');

$(document).ready(function () {
    show_data();
});

// kumpulan fungsi
function show_data() {
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: "cashflow/setting/password/model_settpass.php",
        data: {
            action: "show_data"
        },
        success: function (respon) {
            var data = respon[0];

            elmnt_utama.find('#txt_id').val(data.FINANCE_USER_ID);
            elmnt_utama.find('#txt_username').val(data.FINANCE_USER_NAME);
            elmnt_utama.find('#txt_email').val(data.FINANCE_USER_EMAIL);
            elmnt_utama.find('#txt_password').val(data.FINANCE_USER_PASS);
        },
        complete: function (json) {
        }
    });
}