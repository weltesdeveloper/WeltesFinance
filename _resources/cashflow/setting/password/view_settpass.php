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

    <div class="panel-body panel-full" id="div_settpass_cflow">      
        <!--conten-->
        <div id='dialogTablePodetails'>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-inverse">
                        <div class="panel-heading">
                            <!-- Include the panel-controlgrunt live -->
                            <div class="panel-control">
                                Ubah Input Text Sesuai keinginan...
                            </div>                        
                            <div class="panel-title">
                                Pastikan Anda Ingat selalu Password anda... <strong id="vendorInitPull"></strong>
                            </div>
                        </div>

                        <div class="panel-body">
                            <div class="form-group">
                                <div class="row">                                
                                    <div class="col-sm-4">
                                        <label class="text-shadow-3d">USERNAME</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" readonly="" id="txt_username" class="form-control" />
                                        <input type="hidden" id="txt_id" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">                                
                                    <div class="col-sm-4">
                                        <label class="text-shadow-3d">EMAIL</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="text" id="txt_email" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="text-shadow-3d">PASSWORD</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <input type="password" id="txt_password" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="text-shadow-3d">CONFIRM PASSWORD</label>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-times" id="info_confirm"></i>
                                            </span>
                                            <input type="password" id="txt_password_confirm" class="form-control" placeholder="silahkan confirm password anda.." />
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-sm-4">
                                        &nbsp;
                                    </div>
                                    <div class="col-sm-8">
                                        <button id="btn_simpan" class="btn btn-success"><i class="fa fa-check"></i> SUBMIT</button>
                                    </div>
                                </div>
                            </div>
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

<script src="cashflow/setting/password/control_settpass.js" type="text/javascript"></script>
