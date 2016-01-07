<?php
require_once('../../../_config/dbinfo.inc.php');
?>

<style>
    #listDetailApprove thead tr th{
        text-align: center;
        vertical-align: middle;
    }
    
    #listDetailApprove tbody tr.group td {
        background-color: #D1CFD0;
    }
    
    #listDetailApprove tbody tr.selected td {
        background-color: lightgoldenrodyellow;
    }
    #listDetailApprove tbody tr.success td {
        background-color: lightgreen;
    }
    #listDetailApprove tbody tr.failed td {
        background-color: lightpink;
    }
    #listDetailApprove tbody tr.cancel td {
        background-color: lightgrey;
    }
</style>
<div class="panel mar-10">
    <div class="panel-heading">
        <div class="panel-title">
            <strong>Approval</strong>
            <small> / Cash Flow</small>
        </div>
    </div>

    <div class="panel-body panel-full" id="div_appr_cflow">
        <div class="row">
            <hr/>
            <!--kolom 1-->
            <div class="col-md-12">
                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-2">
                            <label class="option no-mb">
                                <span class="l-mar-5"> Job</span>
                            </label>
                        </div>
                        <div class="col-xs-10">
                            <div class="input-group-addon" style="text-align: left; ">
                                <select class="form-control" id="selectJob"></select>
                            </div>
                        </div>
                    </div>
                </div>                
            </div>          
        </div>
        <hr>

        <!--conten-->
        <div id='dialogTablePodetails'>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <!-- Include the panel-controlgrunt live -->
                            <div class="panel-control">
                                <button class="btn btn-primary btn-sm" id="btn_refresh"><i class="fa fa-refresh"></i> Refresh Data</button>
                            </div>                        
                            <div class="panel-title">
                                List Cash Flow Siap Approve... <strong id="vendorInitPull"></strong>
                            </div>
                        </div>

                        <div class="panel-body">
                            <table id="listDetailApprove" class="display table table-bordered table-hover" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>NO TRANSAKSI</th>
                                        <th>JOB</th>
                                        <th>TANGGAL INPUT</th>
                                        <th>USER INPUT</th>
                                        <th>KATEGORY</th>
                                        <th>VIA</th>
                                        <th style="background-color: lightblue">NOMINAL MASUK</th>
                                        <th style="background-color: lightpink">NOMINAL KELUAR</th>
                                        <th>KETERANGAN</th>
                                        <th style="width: 10px;">REV KE</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>                                
                            </table>  
                        </div>

                        <div class="panel-footer panel-footer-color">
                            <div class="row">
                                <div class="pull-left">
                                    <button class="btn btn-group btn-success" id="btnProses"><i class="fa fa-check"></i>&nbsp;&nbsp;SUBMIT APPROVAL</button>
                                </div>
                                <div class="pull-right">
                                    <!--<h4>TOTAL INVOICE AMOUNT</h4>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--MODAL conten-->
<div class="modal modal-header-color fade" id="modalApprove" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            
        </div>
    </div>
</div>

<script src="cashflow/approval/control_approval.js" type="text/javascript"></script>
