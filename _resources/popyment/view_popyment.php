<?php
require_once('../../_config/dbinfo.inc.php');
require_once('../../_config/misc.func.php');
//session_start();

if (!isset($_SESSION['user_finance'])) {
    echo <<< EOD
   <h1>You are UNAUTHORIZED !</h1>
   <p>INVALID usernames/passwords<p>
   <p><a href="/welteslogisticinventory/index_new.php">LOGIN PAGE</a></p>

EOD;
    exit;
}

$username = $_SESSION['user_finance'];
//    $username = htmlentities($_SESSION['username'], ENT_QUOTES);
//    $companyRole = htmlentities($_SESSION['role'], ENT_QUOTES);

$todaysDate = date("m/d/y");
?>

<div class="panel mar-10">
    <div class="panel-heading">
        <div class="panel-title">
            <strong>Form</strong>
            <small> / Pembayaran</small>
        </div>

    </div>

    <div class="panel-body panel-full">
        <br>
        <div class="row">
            <div class="col-md-2">
                <label class="option no-mb">
                    <span class="l-mar-5"> Supplier </span>
                </label>
            </div>
            <div class="col-md-4">
                <div class="input-group-addon" style="text-align: left; ">
                    <select class="form-control" data-live-search="true" id="Supplier"></select>
                </div>
            </div>
            <div class="col-md-2">
                <label class="option no-mb text-right">
                    <span class="l-mar-5"> Tanggal Bayar  </span>
                </label>
            </div>
            <div class="col-md-4">
                <div class="input-group date" id="pymentDate" style="width: 150px;">
                    <input type="text" class="form-control" readonly="" id="txtDate" value="<?php echo date("m/d/Y"); ?>">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                </div>
            </div>
        </div>

        <hr>
        <div class="row">
            <div class="col-md-2">
                <label class="option no-mb">
                    <span class="l-mar-5"> Keterangan </span>
                </label>
            </div>
            <div class="col-md-4">
                <textarea class="form-control" id="maxPyment" style="width: 100%;" placeholder="...di isi Bila ada keterangan lainnya."></textarea>
            </div>
            <div class="col-md-2">
                <label class="option no-mb">
                    <span class="l-mar-5"> Via Pembayaran </span>
                </label>
            </div>
            <div class="col-md-4">
                <div class="input-group" style="width: 300px">
                    <div class="input-group-addon text-left">
                        <select class="form-control" data-live-search="true" id="selectViaPembayaran"></select>
                    </div>
                    <div class="input-group-addon text-left">
                        <button class="btn btn-group btn-primary" id="btnTmabah" data-toggle="modal" data-target="#infoModalDefaultHeader"><i class="fa fa-plus"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br/>

</div>

<br/>

<div id='dialogTable'>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <!-- Include the panel-controlgrunt live -->
                    <div class="panel-control">
                        <font size="3">Supplier. # : <b><span id="lblSuppInvId"></span> / <span id="lblSupp"></span></b></font> &nbsp;&nbsp;&nbsp;                    
                    </div>                        
                    <div class="panel-title">
                        List Po <strong id="vendorInitPull"></strong>
                    </div>
                </div>

                <div class="panel-body">
                    <table id="listDetail" class="table table-bordered table-condensed" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th weidth="10"></th>
                                <th>PO No.</th>
                                <th>Tot. Po</th>
                                <th>Tot. Invoice</th>
                                <!--<th>Action</th>-->
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>                                
                    </table>  
                </div>

                <div class="panel-footer panel-footer-color">
                    <div class="row">
                        <div class="pull-left">
                            <!--<h4>TOTAL INVOICE AMOUNT</h4>-->
                        </div>
                        <div class="pull-right">
                            <button class="btn btn-group btn-success" id="btnProses"><i class="fa fa-check"></i>&nbsp;&nbsp;SUBMIT INVOICE</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal modal-header-color fade" id="infoModalDefaultHeader" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="color-line"></div>
            <div class="modal-header">
                <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Via Category</h4>
                <small class="font-bold" loremizer loremizer-words="15"></small>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12"></div>
                    <div class="panel">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4 class="no-margin"><i class="fa fa-magic r-mar-10"></i>Optional information</h4>
                            </div>
                        </div>
                        <div class="panel-body panel-full">
                            <form class="form-horizontal form-bordered" role="form">
                                <div class="form-body">
                                    <div class="form-group">
                                        <div class="col-sm-3 to-right">
                                            <label for="name">Nama Kategori</label>
                                            <span class="form-sublabel">Name Category</span>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" id="nameKategori">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-3 to-right">
                                            <label for="email">Keterangan</label>
                                            <span class="form-sublabel">Remark</span>
                                        </div>
                                        <div class="col-sm-7">
                                            <textarea class="form-control" cols="10" rows="2" id="remarkKategori"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-3 col-sm-7">
                                            <button type="submit" class="btn btn-theme" id="btnCategory">Create </button>        
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer to-center">

            </div>
        </div>
    </div>
</div>

<script src="popyment/control_popyment.js" type="text/javascript"></script>

