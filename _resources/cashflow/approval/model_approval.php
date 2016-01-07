<?php
require_once('../../../_config/dbinfo.inc.php');
$username = $_SESSION['user_finance'];

$ACTION = $_POST['action'];
switch ($ACTION) {
    case 'show_combobox_job':
        $type = $_POST['type'];
        switch ($type) {
            case 'show_client':
                $sql = "SELECT DISTINCT CLIENT_ID,CLIENT_NAME FROM VW_PROJ_INFO ORDER BY CLIENT_NAME ";
                $parse = oci_parse($conn_weltes, $sql);
                oci_execute($parse);

                $arr = array();
                while ($row = oci_fetch_assoc($parse)) {
                    array_push($arr, $row);
                }

                echo json_encode($arr);
                break;

            case 'show_job':
                $client_id = $_POST['client_id'];
                $sql = "SELECT DISTINCT PROJECT_NO FROM VW_PROJ_INFO WHERE CLIENT_ID = '$client_id' ORDER BY PROJECT_NO ";
                $parse = oci_parse($conn_weltes, $sql);
                oci_execute($parse);

                $arr = array();
                while ($row = oci_fetch_assoc($parse)) {
                    array_push($arr, $row);
                }

                echo json_encode($arr);
                break;
        }
        break;

    case 'show_list_cflow':
        $job = $_POST['job'];

        $sql = "SELECT M.*, TO_CHAR(M.CFLOW_SYSDATE,'DD-MON-YYYY HH24:MI:SS') TGL_INPUT FROM VW_CFLOW_INFO M WHERE PROJECT_NO like '$job' AND CFLOW_CHECK = 0 ";
        //echo $sql;
        $parse = oci_parse($conn_finance, $sql);
        oci_execute($parse);

        $arr = array();
        while ($row = oci_fetch_assoc($parse)) {
            array_push($arr, $row);
        }
        echo json_encode($arr);
        break;

    case "insert_to_db":
        $cflow_id = $_POST['cflow_id'];
        $approve = $_POST['approve'];

        if ($approve == 'true') {
            $sql = "UPDATE FINANCE_CFLOW SET CFLOW_CHECK = '1',CFLOW_CHECK_SIGN = '$username', CFLOW_CHECK_DATE = SYSDATE WHERE CFLOW_ID = '$cflow_id' ";
            $parse = oci_parse($conn_finance, $sql);
            $exe = oci_execute($parse);
            if ($exe) {
                oci_commit($conn_finance);
                echo 'success';
            } else {
                oci_rollback($conn_finance);
                echo 'FAILED ' . oci_error();
            }
        } else if ($approve == 'false') {
            $cancel_rem = $_POST['cancel_rem'];

            $sql = "UPDATE FINANCE_CFLOW SET CFLOW_CHECK = '2',CFLOW_CHECK_SIGN = '$username', CFLOW_CHECK_DATE = SYSDATE, CFLOW_CHECK_REM = '$cancel_rem' WHERE CFLOW_ID = '$cflow_id' ";
            $parse = oci_parse($conn_finance, $sql);
            $exe = oci_execute($parse);
            if ($exe) {
                oci_commit($conn_finance);
                echo 'success';
            } else {
                oci_rollback($conn_finance);
                echo 'FAILED ' . oci_error();
            }
        }
        break;

    case "modal_cancel_approve":
        $cflow_id = $_POST['cflow_id'];
        $cflow_no = $_POST['cflow_no'];
        ?>
        <div class="color-line"></div>
        <div class="modal-header">
            <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title">Pembatalan Approve</h4>
            <small class="font-bold" loremizer loremizer-words="15"></small>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12"></div>
                <div class="panel">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4 class="no-margin"><i class="fa fa-magic r-mar-10"></i>No : <?= $cflow_no ?></h4>
                        </div>
                    </div>
                    <div class="panel-body panel-full">
                        <form class="form-horizontal form-bordered" role="form">
                            <div class="form-body">                                
                                <div class="form-group">
                                    <div class="col-sm-3 to-right">
                                        <label for="email">Keterangan</label>
                                        <span class="form-sublabel">Cancel Remark</span>
                                    </div>
                                    <div class="col-sm-7">
                                        <textarea class="form-control" cols="10" rows="2" id="cancel_rem"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-7">
                                        <button type="button" class="btn btn-theme" onclick="submit_cancel('<?= $cflow_id ?>');">Submit </button>        
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer to-center">
            <small>Transaksi yang di batalkan akan diteruskan ke pada user penginput..</small>
        </div>
        <?php
        break;
}

