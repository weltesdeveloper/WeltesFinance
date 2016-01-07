<?php

include('../../../_config/dbinfo.inc.php');
include('../../../_config/misc.func.php');

$username = $_SESSION['user_finance'];
$todaysDate = date("m/d/y");

/*
 * START CODING
 */

$ACTION = $_POST['action'];
switch ($ACTION) {
    case 'ViewClient';
        $query = "SELECT DISTINCT CLIENT_ID, CLIENT_NAME "
                . "FROM VW_CFLOW_INFO VCI "
                . "INNER JOIN VW_PROJ_INFO@FINANCE_WELTES_LINK VPI "
                . "ON VPI.PROJECT_NO = VCI.PROJECT_NO";
        $hasil = oci_parse($conn_finance, $query);
        oci_execute($hasil);

        $arr = array();
        while ($row = oci_fetch_array($hasil)) {
            array_push($arr, $row);
        }
        echo json_encode($arr);
        break;

    case 'Viewjob';
        $CLIENT_ID = $_POST['CLIENT_ID__'];
        $query = "SELECT DISTINCT VCI.PROJECT_NO, "
                . "CLIENT_ID, "
                . "CLIENT_NAME "
                . "FROM VW_CFLOW_INFO VCI "
                . "INNER JOIN VW_PROJ_INFO@FINANCE_WELTES_LINK VPI "
                . "ON VPI.PROJECT_NO = VCI.PROJECT_NO "
                . "WHERE CLIENT_ID= '$CLIENT_ID' ";
//        $query = "SELECT DISTINCT PROJECT_NO FROM VW_PROJ_INFO WHERE CLIENT_NAME= '$CLIENT_NAME' ";
        $hasil = oci_parse($conn_finance, $query);
        oci_execute($hasil);

        $arr = array();
        while ($row = oci_fetch_array($hasil)) {
            array_push($arr, $row);
        }
        echo json_encode($arr);
        break;

    case 'listTable';
        $job = $_POST['job']; // selectJob,
        $start = $_POST['start']; // StartDate,
        $end = $_POST['end']; // EndDate,
        $via = $_POST['via']; // via,
        $pos = $_POST['pos']; //pos,
        $supplier = $_POST['supplier']; // Supplier

        $query = "SELECT * "
                . "FROM VW_CFLOW_INFO "
                . "WHERE PROJECT_NO LIKE '$job' "
                . "AND PAY_CATE_ID LIKE '$via' "
                . "AND CFLOW_CATE_ID LIKE '$pos' "
                . "AND SUPP_ID LIKE '$supplier' "
                . "AND CFLOW_DATE BETWEEN TO_DATE('$start', 'MM/DD/YYYY') "
                . "AND TO_DATE('$end', 'MM/DD/YYYY')";
//        echo $query;
        $hasil = oci_parse($conn_finance, $query);
        oci_execute($hasil);
        $arr = array();
        while ($row = oci_fetch_array($hasil)) {
            array_push($arr, $row);
        }
        echo json_encode($arr);
        break;

    case "edit_data":
        $where = $_POST['where__'];
        $setDataUpdate = $_POST['setDataUpdate__'];
        $setDataUpdateInOut = $_POST['setDataUpdateInOut__'];
        $newValue = str_replace("'", '"', $_POST['newValue']);

        $sql_text = "UPDATE FINANCE_CFLOW SET $setDataUpdate = '$newValue', CFLOW_TYPE = '$setDataUpdateInOut' WHERE CFLOW_ID = '$where' ";
        $parse = oci_parse($conn_finance, $sql_text);
        $res = oci_execute($parse);
        if ($res) {
            oci_commit($conn_finance);
            echo json_encode('success');
        } else {
            oci_rollback($conn_finance);
            echo json_encode('error');
        }
        break;

    case "ViewVia":
        $sql = "SELECT * FROM FINANCE_PAY_CATEGORY ORDER BY PAY_CATE_NM";
//    echo "$sl";
        $parse = oci_parse($conn_finance, $sql);
        oci_execute($parse);
        $response = array();
        while ($row1 = oci_fetch_array($parse)) {
            array_push($response, $row1);
        }
        echo json_encode($response);
        break;

    case "ViewPos":
        $sql = "SELECT * FROM FINANCE_CFLOW_CATEGORY ORDER BY CFLOW_CATE_NM";
        $parse = oci_parse($conn_finance, $sql);
        oci_execute($parse);
        $response = array();
        while ($row1 = oci_fetch_array($parse)) {
            array_push($response, $row1);
        }
        echo json_encode($response);
        break;
        break;

    case "ViewSupp":
        $sql = "SELECT DISTINCT SUPP_ID, SUPP_NM FROM VW_CFLOW_INFO ORDER BY SUPP_NM";
        $parse = oci_parse($conn_finance, $sql);
        oci_execute($parse);
        $response = array();
        while ($row1 = oci_fetch_array($parse)) {
            array_push($response, $row1);
        }
        echo json_encode($response);
        break;
}
?>
