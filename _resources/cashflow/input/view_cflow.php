<?php
require_once('../../../_config/dbinfo.inc.php');
$username = $_SESSION['user_finance'];
$todaysDate = date("m/d/Y");
?>

<div class="panel mar-10">
    <div class="panel-heading">
        <div class="panel-title col-sm-5">
            <strong>Cash Flow</strong>
            <small> / Input</small>
        </div>
        <!--        <div class="panel-title col-sm-6" style="text-align: right">
                    <span style="font-family: cursive; color: red; font-size: 12px;">Cash Flow yang ditampilkan adalah tahun : <b><i><span id="tahun">2015, 2014</span></i></b></span>
                </div>-->
    </div>
    <div class="panel-body panel-full" id="input_cflow">
        <br/>
        <div class="row">
            <div class="col-sm-1 to-right" >
                <label class="option no-mb text-right">
                    <span class="l-mar-5"> <b>Tanggal</b>  </span>
                </label>
            </div>
            <div class="col-md-3">
                <div class="input-group date" id="cflow_date" style="width: 100%;" onchange="CekTanggal();">
                    <input type="text" class="form-control" readonly="" id="txtDate" value="<?php echo date("m/d/Y"); ?>" onchange="CekTanggal();">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                </div>
            </div>

            <div class="col-sm-1 to-right">
                <label class="option no-mb">
                    <span class="l-mar-5"> <b>Job</b> </span>
                </label>
            </div>
            <div class="col-md-3">
                <div class="input-group-addon" style="text-align: left; ">
                    <select class="form-control" data-live-search="true" id="selectJob"></select>
                </div>
            </div>

            <div class="col-sm-1 to-right">
                <label for="name"><b>Supplier</b></label>
                <span class="form-sublabel"></span>
            </div>
            <div class="col-md-3">
                <div class="input-group" style="width: 100%">
                    <div class="input-group-addon text-right" style="text-align: left">
                        <select class="form-control" data-live-search="true" id="selectSupplier"></select>
                    </div>
                </div>
            </div>
        </div>
        <hr/>
        <div class="row">

            <div class="col-sm-1 to-right">
                <label for="name"><b>Via</b></label>
                <span class="form-sublabel"></span>
            </div>
            <div class="col-md-3">
                <div class="input-group" style="width: 100%">
                    <div class="input-group-addon text-left" style="text-align: left; ">
                        <select class="form-control" data-live-search="true" id="selectViaPembayaran" onchange="RubahDorpDown('editvia');"></select>
                    </div>
                    <div class="input-group-addon text-left">
                        <button class="btn btn-group btn-primary" onclick="ClickVia('new');" id="addvia"><i class="fa fa-plus"></i></button>
                        <button class="btn btn-group btn-warning" onclick="ClickVia('edit');" id="editvia"><i class="fa fa-edit"></i></button>
                    </div>
                </div>
            </div>

            <div class="col-sm-1 to-right">
                <label for="name1"><b>Tipe</b></label>
                <span class="form-sublabel"></span>
            </div>
            <div class="col-md-3">
                <div class="input-group" style="width: 100%">
                    <div class="input-group-addon text-left" style="text-align: left;" onchange="RubahDorpDown('edittipe');">
                        <select class="form-control" data-live-search="true" id="selectType"></select>
                    </div>
                    <div class="input-group-addon text-left">
                        <button class="btn btn-group btn-primary" onclick="ClickTipe('new');" id="addtipe"><i class="fa fa-plus"></i></button>
                        <button class="btn btn-group btn-warning" onclick="ClickTipe('edit');" id="edittipe"><i class="fa fa-edit"></i></button>
                    </div>
                </div>
            </div>
            <div class="col-sm-1 to-right">
                <label class="option no-mb text-right">
                    <span class="l-mar-5"><b>KAS</b> </span>
                </label>
            </div>
            <div class="col-md-1">
                <div class="input-group-addon text-left">
                    <label class="option block" for="varr17">
                        <input type="radio" id="varr17" name="typeFlow" value="out" checked>
                        <span class="radio"></span> <b>Keluar</b>
                    </label>                            
                </div>
            </div>
            <div class="col-md-1">
                <div class="input-group-addon text-left">
                    <label class="option block" for="varr16">
                        <input type="radio" id="varr16"  name="typeFlow" value="in">
                        <span class="radio"></span> <b>Masuk</b>
                    </label>
                </div>
            </div>
        </div>
        <hr/>
        <div class="row">
            <div class="col-sm-1 to-right">
                <label for="name1"><b>POS</b></label>
                <span class="form-sublabel"></span>
            </div>
            <div class="col-md-3">
                <div class="input-group" style="width: 100%">
                    <div class="input-group-addon text-left" style="text-align: left; ">
                        <select class="form-control" data-live-search="true" id="selectKatPembayaran" onchange="RubahDorpDown('editpos');"></select>
                    </div>
                    <div class="input-group-addon text-left" >
                        <button class="btn btn-group btn-primary" onclick="ClickPos('new');" id="addpos"><i class="fa fa-plus"></i></button>
                        <button class="btn btn-group btn-warning" onclick="ClickPos('edit');" id="editpos"><i class="fa fa-edit"></i></button>
                    </div>
                </div>
            </div>
            <div class="col-sm-1 to-right">
                <label class="option no-mb text-right">
                    <span class="l-mar-5"> <b>Nominal</b> </span>
                </label>
            </div>

            <div class="col-md-3">
                <div class="input-group mb-3">
                    <div class="input-group-addon" >
                        <select id="selectCur" class="form-control">
                        </select>
                    </div>
                    <div class="input-group-addon" style="width: 150px;">
                        <input type="text" class="form-control input-sm" id="nominal" placeholder="0.00" onchange="ChangeNominal();">
                    </div>
                </div>
            </div>
        </div>

        <hr/>
        <div class="row">
            <div class="form-group">
                <div class="col-sm-1 to-right">
                    <label for="email">Keterangan</label>
                    <span class="form-sublabel"></span>
                </div>
                <div class="col-sm-11">
                    <div class="input-group-addon" >
                        <textarea class="form-control" cols="10" rows="2" id="remark" placeholder="...di isi Bila ada keterangan lainnya."></textarea>
                    </div>
                </div>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="form-group">
                <div class="col-sm-1 to-right">
                    <label for="email"></label>
                    <span class="form-sublabel"></span>
                </div>
                <div class="col-sm-11">
                    <button class="btn btn-group btn-success col-sm-12" id="btnProsesInput"><i class="fa fa-check"></i>&nbsp;&nbsp;SUBMIT</button>
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
                                <!--<font size="3">PO NO. # : <b><span id="lblPo"></span></b></font> &nbsp;&nbsp;&nbsp;-->                    
                            </div>                        
                            <div class="panel-title">
                                List Pembayaran <strong id="vendorInitPull"></strong>
                            </div>
                        </div>

                        <div class="panel-body">
                            <table id="datatables-xeditable-example" class="display table table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th weidth="10">No. Transaksi</th>
                                        <th class="hidden">User</th>
                                        <th>Tanggal</th>
                                        <th>JOB</th>
                                        <th>SUPP</th>
                                        <th>POS</th>
                                        <th>VIA</th>
                                        <th style="background-color: lightblue">NOMINAL IN</th>
                                        <th style="background-color: lightpink">NOMINAL OUT</th>
                                        <th>KET</th>
                                        <th>TIPE</th>
                                        <th>Action</th>
                                        <th>Rev. Ke</th>
                                        <th>Pembatalan approve</th>
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
                                    <!--<button class="btn btn-group btn-success" id="btnProses"><i class="fa fa-check"></i>&nbsp;&nbsp;SUBMIT INVOICE</button>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<br/>

<div class="modal modal-header-color fade" id="modalselectType" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="color-line"></div>
            <div class="modal-header">
                <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title text-center" id="title-tipe-pembayaran">Tambah Tipe</h4>
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
                                            <label for="name">Nama Tipe</label>
                                            <span class="form-sublabel">Name Type</span>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" id="nameTipe">
                                            <input type="hidden" class="form-control" id="idTipe">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-3 to-right">
                                            <label for="email">Keterangan</label>
                                            <span class="form-sublabel">Remark</span>
                                        </div>
                                        <div class="col-sm-7">
                                            <textarea class="form-control" cols="10" rows="2" id="remarkTipe"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-3 col-sm-7">
                                            <button type="button" class="btn btn-theme" id="btnTambahTipe">Create </button>      
                                            <button type="button" class="btn btn-theme col-sm-5 pull-left" id="btnEditTipe" onclick="EditTipe();">Edit </button> 
                                            <button type="button" class="btn btn-default col-sm-5 pull-right" data-dismiss="modal">Close</button>
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


<div class="modal modal-header-color fade" id="modalViaPembayaran" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="color-line"></div>
            <div class="modal-header">
                <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title text-center" id="title-via-pembayaran">Via Pembayaran</h4>
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
                                            <label for="name">Nama Via</label>
                                            <span class="form-sublabel">Name Via</span>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" id="nameKategoriVia">
                                            <input type="hidden" class="form-control" id="idKategoriVia">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-3 to-right">
                                            <label for="email">Keterangan</label>
                                            <span class="form-sublabel">Remark</span>
                                        </div>
                                        <div class="col-sm-7">
                                            <textarea class="form-control" cols="10" rows="2" id="remarkKategoriVia"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-3 col-sm-7">
                                            <button type="button" class="btn btn-theme col-sm-5 pull-left" id="btnCreateVia">Create </button> 
                                            <button type="button" class="btn btn-theme col-sm-5 pull-left" id="btnEditVia" onclick="EditVia();">Edit </button> 
                                            <button type="button" class="btn btn-default col-sm-5 pull-right" data-dismiss="modal">Close</button>
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

<div class="modal modal-header-color fade" id="modalKategoriPembayaran" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="color-line"></div>
            <div class="modal-header">
                <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title text-center" id="title-pos-pembayaran">Pos Pembayaran</h4>
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
                                            <label for="name">Nama Pos</label>
                                            <span class="form-sublabel">Pos Name</span>
                                        </div>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" id="nameKategoriPembayaran">
                                            <input type="hidden" class="form-control" id="idKategoriPembayaran">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-3 to-right">
                                            <label for="email">Keterangan</label>
                                            <span class="form-sublabel">Remark</span>
                                        </div>
                                        <div class="col-sm-7">
                                            <textarea class="form-control" cols="10" rows="2" id="remarkKategoriPembayaran"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-3 col-sm-7">
                                            <button type="button" class="btn btn-theme col-sm-5 pull-left" id="btnEditPos" onclick="EditPos();">Edit </button>
                                            <button type="button" class="btn btn-theme" id="btnCategoryPembayaran">Create </button>  
                                            <button type="button" class="btn btn-default col-sm-5 pull-right" data-dismiss="modal">Close</button>
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

<div class="modal modal-header-color fade" id="modalEditData" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="color-line"></div>
            <div class="modal-header">
                <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Edit Pembayaran</h4>
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
                                            <label for="name">Tanggal</label>
                                            <!--<span class="form-sublabel">Name Category</span>-->
                                        </div>
                                        <div class="col-sm-7">
                                            <div class="input-group date" id="Edit_cflow_date" style="width: 100%;">
                                                <input type="text" class="form-control" readonly="" id="EditDate" value="<?php echo date("m/d/Y"); ?>">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-3 to-right">
                                            <label for="name">JOB</label>
                                            <!--<span class="form-sublabel">Name Category</span>-->
                                        </div>
                                        <div class="col-sm-7">
                                            <div class="input-group-addon" style="text-align: left; ">
                                                <input type="text" id="editID" hidden>
                                                <select class="form-control" data-live-search="true" id="EditJob"></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-3 to-right">
                                            <label for="name">SUPPLIER</label>
                                            <!--<span class="form-sublabel">Name Category</span>-->
                                        </div>
                                        <div class="col-sm-7">
                                            <div class="input-group-addon" style="text-align: left; ">
                                                <input type="text" id="editID" hidden>
                                                <select class="form-control" data-live-search="true" id="EditSupp"></select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-3 to-right">
                                            <label for="name">POS</label>
                                            <span class="form-sublabel"></span>
                                        </div>
                                        <div class="col-sm-7">
                                            <div class="input-group-addon" style="text-align: left; ">
                                                <select class="form-control" data-live-search="true" id="EditKatPembayaran"></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-3 to-right">
                                            <label for="name">VIA</label>
                                            <span class="form-sublabel"></span>
                                        </div>
                                        <div class="col-sm-7">
                                            <div class="input-group-addon" style="text-align: left; ">
                                                <select class="form-control" data-live-search="true" id="editViaPembayaran"></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-3 to-right">
                                            <label for="name">TIPE</label>
                                            <span class="form-sublabel"></span>
                                        </div>
                                        <div class="col-sm-7">
                                            <div class="input-group-addon" style="text-align: left; ">
                                                <select class="form-control" data-live-search="true" id="editTipe"></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-3 to-right">
                                            <label for="name">NOMINAL</label>
                                            <span class="form-sublabel"></span>
                                        </div>
                                        <div class="col-sm-7">
                                            <div class="input-group-addon" >
                                                <select id="editCur" class="form-control">
                                                </select>
                                            </div>
                                            <div class="input-group-addon" style="width: 150px;">
                                                <input type="text" class="form-control input-sm" id="editNominal" placeholder="0.00" onchange="ChangeNominal();">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-3 to-right">
                                            <label for="name">KAS</label>
                                            <span class="form-sublabel"></span>
                                        </div>
                                        <div class="col-sm-7">
                                            <div class="col-md-4">
                                                <div class="input-group-addon text-left">
                                                    <label class="option block" for="out">
                                                        <input type="radio" id="out" name="typeFlowEdit" value="out" checked>
                                                        <span class="radio"></span> Keluar
                                                    </label>                            
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="input-group-addon text-left">
                                                    <label class="option block" for="in">
                                                        <input type="radio" id="in"  name="typeFlowEdit" value="in">
                                                        <span class="radio"></span> Masuk
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-3 to-right">
                                            <label for="email">Keterangan</label>
                                            <span class="form-sublabel">Remark</span>
                                        </div>
                                        <div class="col-sm-7">
                                            <textarea class="form-control" cols="10" rows="2" id="editRemark"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-3 col-sm-7">
                                            <button type="button" class="btn btn-theme" id="btnEditPembayaran">Create </button>        
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


<script src="cashflow/input/control_cflow.js" type="text/javascript"></script>
