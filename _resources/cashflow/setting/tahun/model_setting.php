<?php

require_once('../../../../_config/dbinfo.inc.php');
require_once('../../../../_config/misc.func.php');
$username = $_SESSION['user_finance'];

$ACTION = $_POST['action'];
switch ($ACTION) {
    case "show_list":
        $sql = "SELECT * FROM VW_CFLOW_SETT ORDER BY TAHUN DESC";
        $parse = oci_parse($conn_finance, $sql);
        oci_execute($parse);

        $arr = array();
        while ($row = oci_fetch_assoc($parse)) {
            array_push($arr, $row);
        }

        echo json_encode($arr);
        break;

    case "insert_to_db":
        $arr_thun = $_POST['arr_thun'];
        $arr_thun_chk = $_POST['arr_thun_chk'];

        $sql = "TRUNCATE TABLE FINANCE_CFLOW_SETTING";
        $parse = oci_parse($conn_finance, $sql);
        oci_execute($parse);
        oci_commit($conn_finance);

        for ($i = 0; $i < sizeof($arr_thun); $i++) {
            $sql = "INSERT INTO FINANCE_CFLOW_SETTING(CFLOW_SETT_YEAR,CFLOW_SETT_SHOW) VALUES ('$arr_thun[$i]','$arr_thun_chk[$i]') ";
            $parse = oci_parse($conn_finance, $sql);
            $exe = oci_execute($parse);

            if ($exe) {
                oci_commit($conn_finance);
            } else {
                oci_rollback($conn_finance);
                exit();
                break;
            }
        }
        echo 'success';

        break;

    default:
        break;
}