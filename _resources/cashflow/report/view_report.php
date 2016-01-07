<?php
require_once('../../../_config/dbinfo.inc.php');
$username = $_SESSION['user_finance'];
$todaysDate = date("m/d/Y");
?>

<div class="panel mar-10">
    <div class="panel-heading">
        <div class="panel-title">
            <strong>Cash Flow</strong>
            <small> / Report</small>
        </div>
    </div>

    <div class="panel-body panel-full" id="input_cflow">
        <br/>
        <div class="row">
            <div class="col-sm-1 to-center">
                <label class="option no-mb">
                    <span class="l-mar-5">Periode</span>
                </label>
            </div>
            <div class="col-md-5">
                <div class="input-group date" id="stratDate" style="width: 100%;">
                    <input type="text" class="form-control" readonly="" id="txtStartDate" value="<?php echo date("m/d/Y"); ?>">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                </div>
            </div>

            <div class="col-sm-1 to-center">
                <label class="option no-mb">
                    <span class="l-mar-5 text-center"> S/D </span>
                </label>
            </div>
            <div class="col-md-5">
                <div class="input-group date" id="endDate" style="width: 100%;">
                    <input type="text" class="form-control" readonly="" id="txtEndDate" value="<?php echo date("m/d/Y"); ?>">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-1 to-center">
                <label class="option no-mb">
                    <span class="l-mar-5"> Job </span>
                </label>
            </div>
            <div class="col-md-5">
                <div class="input-group-addon" style="text-align: left; ">
                    <select class="form-control" data-live-search="true" id="selectJob"></select>
                </div>
            </div>

            <div class="col-sm-1 to-center">
                <label class="option no-mb">
                    <span class="l-mar-5"> Via </span>
                </label>
            </div>
            <div class="col-md-5">
                <div class="input-group-addon" style="text-align: left; ">
                    <select class="form-control" data-live-search="true" id="selectVia"></select>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-1 to-center">
                <label class="option no-mb">
                    <span class="l-mar-5"> Pos </span>
                </label>
            </div>
            <div class="col-md-5">
                <div class="input-group-addon" style="text-align: left; ">
                    <select class="form-control" data-live-search="true" id="selectPos"></select>
                </div>
            </div>

            <div class="col-sm-1 to-center">
                <label class="option no-mb">
                    <span class="l-mar-5 text-center"> Supplier </span>
                </label>
            </div>
            <div class="col-md-5">
                <div class="input-group-addon" style="text-align: left; ">
                    <select class="form-control" data-live-search="true" id="selectSupplier"></select>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="form-group">
                <div class="col-sm-1 to-center">
                    <label for="email"></label>
                    <span class="form-sublabel"></span>
                </div>
                <div class="col-sm-11">
                    <button class="btn btn-group btn-success col-sm-12" id="btnProses"><i class="fa fa-check"></i>&nbsp;&nbsp;SHOW DATA&nbsp;&nbsp;<i class="fa fa-check"></i></button>
                </div>
            </div>
        </div>
        <hr>
        <!--conten-->
        <div id='dialogTablePodetails' hidden="">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <!-- Include the panel-controlgrunt live -->
                            <div class="panel-control">
                                <!--<font size="3">PO NO. # : <b><span id="lblPo"></span></b></font> &nbsp;&nbsp;&nbsp;-->                    
                            </div>                        
                            <div class="panel-title">
                                List Pembayaran <strong id="vendorInitPull"></strong>
                            </div>
                        </div>

                        <div class="panel-body">
                            <table id="datatables-xeditable-example" class="table table-striped table-bordered table-hover dt-responsive" width="100%">
                                <thead>
                                    <tr>
                                        <th weidth="10" class="text-center">No.</th>
                                        <th class="text-center">Tanggal</th>
                                        <th class="text-center">Project No</th>
                                        <th class="text-center">Pembayaran </th>
                                        <th class="text-center">Via</th>
                                        <th class="text-center">Curency</th>
                                        <th class="text-center">Nominal In</th>
                                        <th class="text-center">Nominal Out</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>                                
                            </table>  
                        </div>
                        <br>
                        <br>
                        <div class="panel-footer panel-footer-color">
                            <div class="row">
                                <div class="pull-left">
                                    <!--<h4>TOTAL INVOICE AMOUNT</h4>-->
                                </div>
                                <div class="pull-right">
                                    <!--<button class="btn btn-group btn-success" id="btnProses"><i class="fa fa-check"></i>&nbsp;&nbsp;SUBMIT INVOICE</button>-->
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer panel-footer-color">
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="button" class="btn btn-danger col-sm-12" onclick="ExportPembayaran();">
                                        Export .XLS
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="cashflow/report/control_report.js" type="text/javascript"></script>
