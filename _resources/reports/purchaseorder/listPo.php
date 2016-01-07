<?php
require_once('../../../_config/dbinfo.inc.php');
require_once('../../../_config/misc.func.php');
session_start();

if (!isset($_SESSION['username'])) {
    echo <<< EOD
   <h1>You are UNAUTHORIZED !</h1>
   <p>INVALID usernames/passwords<p>
   <p><a href="/welteslogisticinventory/index_new.php">LOGIN PAGE</a></p>

EOD;
    exit;
}

// GENERATE THE APPLICATION PAGE
$conn = oci_connect(ORA_CON_UN, ORA_CON_PW, ORA_CON_DB) or die;

// 1. SET THE CLIENT IDENTIFIER AFTER EVERY CALL
// 2. USING UNIQUE VALUE FOR BACK END USER
oci_set_client_identifier($conn, $_SESSION['username']);

$username = htmlentities($_SESSION['username'], ENT_QUOTES);
$companyRole = htmlentities($_SESSION['role'], ENT_QUOTES);

$todaysDate = date("m/d/y");
?>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">

            <div class="panel-heading">
                <!-- Include the panel-controlgrunt live -->
                <div class="panel-control">              
                    <button class="btn btn-s btn-bordered btn-default" type="button">
                        <i class="fa fa-cog"></i>
                    </button>
                    <button class="btn btn-s btn-bordered btn-default" type="button" data-panel="refresh">
                        <i class="fa fa-repeat"></i>
                    </button>
                    <button class="btn btn-s btn-bordered btn-default" type="button" data-panel="collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                    <button class="btn btn-s btn-bordered btn-default" type="button" data-panel='close'>
                        <i class="fa fa-remove"></i>
                    </button>
                </div>                        
                <div class="panel-title">
                    <font size="3"><b>PT. Weltes Energi Nusantara</b> Purchase Order List</font>
                </div>
            </div>

            <div class="panel-body">
                <div class="col-md-12"><br/>
                    <table class="table table-condensed table-responsive" id="vendorlist" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>PO #</th> <!-- PO_NO -->
                                <th>AMOUNT</th> <!-- PO_AMOUNT -->
                                <th>DATE</th> <!-- PO_DATE -->
                                <th>SUPPLIER</th> <!-- SUPP_NM -->
                                <th>JOB</th> <!-- PROJECT_NO -->
                                <th>SUBJOB</th> <!-- PROJECT_NAME -->
                                <th>DETAILS</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>PO #</th> <!-- PO_NO -->
                                <th>AMOUNT</th> <!-- PO_AMOUNT -->
                                <th>DATE</th> <!-- PO_DATE -->
                                <th>SUPPLIER</th> <!-- SUPP_NM -->
                                <th>JOB</th> <!-- PROJECT_NO -->
                                <th>SUBJOB</th> <!-- PROJECT_NAME -->
                                <th>DETAILS</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <hr class="dotted"/>
                <span loremizer loremizer-words="15"></span>
            </div>

            <div class="panel-footer panel-footer-color">
                <div class="row">

                </div>
            </div>

        </div>
    </div>
</div>

<script>
    $.getJSON('reports/purchaseorder/process_po/process_po_list.php', function (response) {

        // Initialize button for ajax data processing
        $.each(response, function () {
            this.vendButton = "<button id='editVendor' data-id='" + this.PO_NO + "'>SHOW DETAILS</button>";
        });

        function MoneyFormat(c, d, t) {
            var n = this,
                    c = isNaN(c = Math.abs(c)) ? 2 : c,
                    d = d === undefined ? "." : d,
                    t = t === undefined ? "," : t,
                    s = n < 0 ? "-" : "",
                    i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "",
                    j = (j = i.length) > 3 ? j % 3 : 0;
            return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
        }
        ;
        
//    function RenderDecimalNumber(oObj) {
//        var num = new NumberFormat();
//        num.setInputDecimal('.');
//        num.setNumber(oObj.aData[oObj.iDataColumn]);
//        num.setPlaces(this.oCustomInfo.decimalPlaces, true);
//        num.setCurrency(false);
//        num.setNegativeFormat(num.LEFT_DASH);
//        num.setSeparators(true, this.oCustomInfo.decimalSeparator, this.oCustomInfo.thousandSeparator);
//
//        return num.toFormatted();
//    }

        // Initialize DataTables
        var vendorTable = $('#vendorlist').DataTable({
            initComplete: initComp,
            iDisplayLength: 22,
            processing: true,
            data: response,
            columns: [
                {data: "PO_NO"},
//                {data: (this.PO_AMOUNT).MoneyFormat(2, '.', ',')},
                {data: "PO_AMOUNT"},
                {data: "PO_DATE"},
                {data: "SUPP_NM"},
                {data: "PROJECT_NO"},
                {data: "PROJECT_NAME"},
                {data: "vendButton"}
            ],
            "columnDefs": [
                {
                    "visible": true,
                    "targets": [1],
                    "render": function (data, type, row, meta) {
                        var PO = parseInt(row.PO_AMOUNT);
//                        return (123456789.12345).MoneyFormat(2, '.', ',');
                        return MoneyFormat(PO, {
                                "decimalPlaces": 2,
                                "thousandSeparator": '.',
                                "decimalSeparator": ','});
                    }
                }                
            ]
        });

        // Button function
        $('#vendorlist tbody').on('click', 'button', function () {
            var data = vendorTable.row($(this).parents('tr')).data();
            alert(data['PO_NO']);
            //            $('#modal-form').modal("show");
        });
        // Initialize AJAX onClick Data Send
        window.someGlobalOrWhatever = response.balance;
    });


    function initComp() {
        this.api().columns().every(function () {
            var column = this;
            var select = $('<select class="selectpicker" data-width="100%" data-live-search="true"><option value=""></option></select>')
                    .appendTo($(column.footer()).empty())
                    .on('change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                                );

                        column
                                .search(val ? '^' + val + '$' : '', true, false)
                                .draw();
                    });

            column.data().unique().sort().each(function (d, j) {
                select.append('<option value="' + d + '">' + d + '</option>');
            });
        });
        $('.selectpicker').selectpicker();
    }
</script>