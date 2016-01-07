<?php
require_once('../../_config/dbinfo.inc.php');
require_once('../../_config/misc.func.php');

$username = $_SESSION['user_finance'];
$todaysDate = date("m/d/y");
?>

<div class="panel mar-10">
    <div class="panel-heading">
        <div class="panel-title">
            <strong>Input</strong>
            <small> / Invoice</small>
        </div>
    </div>

    <div class="panel-body panel-full">
        <br>
        <div class="row">
            <div class="col-md-2">
                <label class="option no-mb">
                    <span class="l-mar-5"> PO No.</span>
                </label>
            </div>
            <div class="col-md-3">
                <div class="input-group" style="width: 100%">
                    <select class="form-control" data-live-search="true" id="selectPoNo"></select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="input-group text-center" style="width: 100%">
                   
                </div>
            </div>
            <div class="col-md-2">
                <label class="option no-mb">
                    <span class="l-mar-5"> No. Invoice </span>
                </label>
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control" id="NoInvoice" placeholder="Eg : INVOICE/1234/456/WEN/2015">
            </div>
        </div>

        <hr>
        <div class="row">
            <div class="col-md-2">
                <label class="option no-mb">
                    <span class="l-mar-5"> Nama Supplier  </span>
                </label>
            </div>
            <div class="col-md-3">
                <label class="option no-mb">
                    <span class="l-mar-5" id = "labelNamaSupp"></span>
                </label>
            </div>
            <div class="col-md-2">
                <div class="input-group text-center" style="width: 100%">
                   
                </div>
            </div>
            <div class="col-md-2">
                <label class="option no-mb">
                    <span class="l-mar-5"> Tanggal Invoice </span>
                </label>
            </div>
            <div class="col-md-3">
                <div class="input-group date" id="invoiceDate">
                    <input type="text" class="form-control" id="txtDate" value="<?php echo date("m/d/Y"); ?>">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                </div>
            </div>
        </div>

        <hr>
        <div class="row">
            <div class="col-md-2">
                <label class="option no-mb">
                    <span class="l-mar-5"> Alamat Supplier  </span>
                </label>
            </div>
            <div class="col-md-3">
                <label class="option no-mb">
                    <span class="l-mar-5" id = "labelAlamatSupp"></span>
                </label>
            </div>
            <div class="col-md-2">
                <div class="input-group text-center" style="width: 100%">
                   
                </div>
            </div>
            <div class="col-md-2">
                <label class="option no-mb">
                    <span class="l-mar-5"> Tanggal Penerimaan Invoice </span>
                </label>
            </div>
            <div class="col-md-3">
                <div class="input-group date" id="invoiceReceiveDate">
                    <input type="text" class="form-control" id="txtRecDate"value="<?php echo date("m/d/Y"); ?>">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                </div>
            </div>
        </div>

        <hr>
        <div class="row">
            <div class="col-md-2">
                <label class="option no-mb">
                    <span class="l-mar-5"> PPN  </span>
                </label>
            </div>
            <div class="col-md-3">
                <label class="option no-mb">
                    <span class="l-mar-5" id = "labelPpn"></span>
                </label>
            </div>
            <div class="col-md-2">
                <div class="input-group text-center" style="width: 100%">
                   
                </div>
            </div>
            <div class="col-md-2">
                <label class="option no-mb">
                    <span class="l-mar-5"> Currency </span>
                </label>
            </div>
            <div class="col-md-3">
                <div class="input-group" style="width: 100%">
                    <select class="form-control" data-live-search="true" id="selectCur"></select>
                </div>
            </div>
        </div>

        <hr>
        <div class="row">
            <div class="col-md-2">
                <label class="option no-mb">
                    <span class="l-mar-5"> Keterangan  </span>
                </label>
            </div>
            <div class="col-md-10">
                <label class="option no-mb col-md-12">
                    <textarea class="form-control" cols="117" rows="4" id="remark" placeholder="Keterangan Untuk Pembutan Invoice"></textarea>
                </label>
            </div>
        </div>
        <br/>
    </div>
</div>
<br/>
<div id='dialogTablePodetails'>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <!-- Include the panel-controlgrunt live -->
                    <div class="panel-control">
                        <font size="3">PO NO. # : <b><span id="lblPo"></span></b></font> &nbsp;&nbsp;&nbsp;                    
                    </div>                        
                    <div class="panel-title">
                        List Barang <strong id="vendorInitPull"></strong>
                    </div>
                </div>

                <div class="panel-body">
                    <table id="listDetailPo" class="display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th weidth="10"></th>
                                <th>INV_ID</th>
                                <th>Nama Barang </th>
                                <th>Qty</th>
                                <th>Harga PO</th>
                                <th>Tagihan</th>
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

<script src="invoice/control_invoice.js" type="text/javascript"></script>
