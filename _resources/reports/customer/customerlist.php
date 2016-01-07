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
                    <font size="3"><b>PT. Weltes Energi Nusantara</b> Client/Customer List</font>
                </div>
            </div>
            
            <div class="panel-body">
                <div class="col-md-12"><br/>
                    <table class="table table-condensed table-responsive" id="customerlist" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>VENDOR NAME</th>
                                <th>ADDRESS</th>
                                <th>CITY</th>
                                <th>STATE/PROVINCE</th>
                                <th>CONT PERSON</th>
                                <th>CONT PHONE 1</th>
                                <th>CONT PHONE 2</th>
                                <th>CONT FAX</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>VENDOR NAME</th>
                                <th>ADDRESS</th>
                                <th>CITY</th>
                                <th>STATE/PROVINCE</th>
                                <th>CONT PERSON</th>
                                <th>CONT PHONE 1</th>
                                <th>CONT PHONE 2</th>
                                <th>CONT FAX</th>
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

    $.getJSON('reports/customer/process_customer/process_customer_list.php', function(response) {
        
        // Initialize DataTables
        var vendorTable = $('#customerlist').DataTable({
          initComplete: initCompp,
          iDisplayLength : 22,
          processing: true,
          data: response,
          columns: [
            {data: "CLIENT_ID"},
            {data: "CLIENT_NAME"},
            {data: "CLIENT_ADDR"},
            {data: "CLIENT_LOC"},
            {data: "CLIENT_PROV"},
            {data: "CLIENT_CONT_PERS"},
            {data: "CLIENT_CONT_PH1"},  
            {data: "CLIENT_CONT_PH2"},
            {data: "CLIENT_CONT_FAX"}
          ]
        });
        
        // Initialize AJAX onClick Data Send
        window.someGlobalOrWhatever = response.balance;
    });
    
    function initCompp(){
        this.api().columns().every( function () {
                var column = this;
                var select = $('<select id="custSelectpicker" data-width="100%" data-live-search="true"><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' );
                } );
            });
            $('#custSelectpicker').selectpicker();
    }
    

</script>
