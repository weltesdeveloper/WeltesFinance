<?php
require_once('../../../../_config/dbinfo.inc.php');
?>
<div class="panel mar-10">
    <div class="panel-heading">
        <div class="panel-title">
            <strong>Pengaturan</strong>
            <small> / Cash Flow</small>
        </div>
    </div>

    <div class="panel-body panel-full" id="div_sett_cflow">      
        <!--conten-->
        <div id='dialogTablePodetails'>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <!-- Include the panel-controlgrunt live -->
                            <div class="panel-control">
                                Pilih Tahun yang akan Anda Tampilkan...
                            </div>                        
                            <div class="panel-title">
                                Pengaturan Tahun Transaksi... <strong id="vendorInitPull"></strong>
                            </div>
                        </div>

                        <div class="panel-body">
                            <table id="listSettingCflow" class="display table table-bordered" cellspacing="0" align="center" style="width: 500px;">
                                <thead>
                                    <tr>
                                        <th>TAHUN</th>
                                        <th>TAMPILKAN</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>  
                                <tfoot>
                                    <tr>
                                        <td colspan="2" class="text-center" style="background-color: lightgrey;">
                                            <button class="btn btn-group btn-success" id="btnProses"><i class="fa fa-check"></i>&nbsp;&nbsp;SUBMIT</button>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>  
                        </div>

                        <div class="panel-footer panel-footer-color">
                            <div class="row">
                                <div class="pull-left">                                    
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

<script src="cashflow/setting/tahun/control_setting.js" type="text/javascript"></script>
