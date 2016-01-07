<?php

include('../../../_config/dbinfo.inc.php');
include('../../../_config/misc.func.php');

$username = $_SESSION['user_finance'];
$todaysDate = date("m/d/y");
?>


<?php

$ACTION = $_POST['action'];
switch ($ACTION) {
    case 'ViewClient';
        $query = "SELECT DISTINCT CLIENT_ID,CLIENT_NAME FROM VW_PROJ_INFO ORDER BY CLIENT_NAME";
        $hasil = oci_parse($conn_weltes, $query);
        oci_execute($hasil);

        $arr = array();
        while ($row = oci_fetch_array($hasil)) {
            array_push($arr, $row);
        }
        echo json_encode($arr);
        break;

    case 'Viewjob';
        $CLIENT_NAME = $_POST['CLIENT_NAME__'];
        $query = "SELECT DISTINCT PROJECT_NO FROM VW_PROJ_INFO WHERE CLIENT_NAME= '$CLIENT_NAME' ";
        $hasil = oci_parse($conn_weltes, $query);
        oci_execute($hasil);

        $arr = array();
        while ($row = oci_fetch_array($hasil)) {
            array_push($arr, $row);
        }
        echo json_encode($arr);
        break;

    case 'ViewCur';
        $query = "SELECT distinct po_unit_curr as jancok from VW_SUPP_INVOICE";
        $hasil = oci_parse($conn_finance, $query);
        oci_execute($hasil);

        $arr = array();
        while ($row = oci_fetch_array($hasil)) {
            array_push($arr, $row);
        }
        echo json_encode($arr);
        break;

    case 'ViewSupp';
        $query = "SELECT SUPP_ID,SUPP_NM from MST_SUPPLIER ORDER BY SUPP_NM";
        $hasil = oci_parse($conn_logistic, $query);
        oci_execute($hasil);

        $arr = array();
        while ($row = oci_fetch_array($hasil)) {
            array_push($arr, $row);
        }
        echo json_encode($arr);
        break;

    case 'ViewVia';
        $query = "select PAY_CATE_ID, PAY_CATE_NM FROM FINANCE_PAY_CATEGORY order by PAY_CATE_NM";
        $hasil = oci_parse($conn_finance, $query);
        oci_execute($hasil);

        $arr = array();
        while ($row = oci_fetch_array($hasil)) {
            array_push($arr, $row);
        }
        echo json_encode($arr);
        break;

    case 'ViewType';
        $query = "select CFLOW_TYPE_ID, CFLOW_TYPE_NAME FROM FINANCE_CFLOW_TYPE order by CFLOW_TYPE_NAME";
        $hasil = oci_parse($conn_finance, $query);
        oci_execute($hasil);

        $arr = array();
        while ($row = oci_fetch_array($hasil)) {
            array_push($arr, $row);
        }
        echo json_encode($arr);
        break;

    case 'ViewKatPem';
        $query = "select CFLOW_CATE_ID, CFLOW_CATE_NM FROM FINANCE_CFLOW_CATEGORY order by CFLOW_CATE_NM";
        $hasil = oci_parse($conn_finance, $query);
        oci_execute($hasil);

        $arr = array();
        while ($row = oci_fetch_array($hasil)) {
            array_push($arr, $row);
        }
        echo json_encode($arr);
        break;

    case 'InputKategoriVia';
        $nama = $_POST['nama__'];
        $remark = $_POST['remark__'];

        $query = "INSERT INTO FINANCE_PAY_CATEGORY "
                . "VALUES(SEQ_INVOICE_CAT.NEXTVAL,'$nama','$remark') ";
        $hasil = oci_parse($conn_finance, $query);
        $exe = oci_execute($hasil);

        if ($exe) {
            echo json_encode("SUKSES");
        } else {
            echo json_encode("GAGAL");
        }

        break;

    case 'InputTipe';
        $nama = $_POST['nama__'];
        $remark = $_POST['remark__'];

        $query = "INSERT INTO FINANCE_CFLOW_TYPE "
                . "VALUES(SEQ_FLOW_TYPE.NEXTVAL,'$nama','$remark') ";
        $hasil = oci_parse($conn_finance, $query);
        $exe = oci_execute($hasil);

        if ($exe) {
            echo json_encode("SUKSES");
        } else {
            echo json_encode("GAGAL");
        }

        break;

    case 'InputKategoriPembayaran';
        $nama = $_POST['nama__'];
        $remark = $_POST['remark__'];

        $query = "INSERT INTO FINANCE_CFLOW_CATEGORY "
                . "VALUES(SEQ_FLOW_CAT.NEXTVAL,'$nama','$remark') ";
        $hasil = oci_parse($conn_finance, $query);
        $exe = oci_execute($hasil);

        if ($exe) {
            echo json_encode("SUKSES");
        } else {
            echo json_encode("GAGAL");
        }

        break;

    case 'inputData';
        $selectJob = $_POST['selectJob__'];
        $txtDate = $_POST['txtDate__'];
        $selectCur = $_POST['selectCur__'];
        $nominal = $_POST['nominal__'];
        $txtDate = str_replace("\\", "", $_POST['txtDate__']);
        $selectKatPembayaran = $_POST['selectKatPembayaran__'];
        $selectViaPembayaran = $_POST['selectViaPembayaran__'];
        $typeFlow = $_POST['typeFlow__'];
        $remark = $_POST['remark__'];
        $selectSupplier = $_POST['selectSupplier__'];
        $selectType = $_POST['selectType__'];

        $response = "";

        $query = "INSERT INTO FINANCE_CFLOW "
                . "(CFLOW_ID,PROJECT_NO,CFLOW_CATE_ID,PAY_CATE_ID,CFLOW_PRICE,CFLOW_CURR,CFLOW_SIGN,CFLOW_DATE,CFLOW_SYSDATE,CFLOW_TYPE,CFLOW_REM,CFLOW_TYPE_ID,SUPP_ID) "
                . "VALUES(SEQ_FINANCE_CFLOW.NEXTVAL,'$selectJob','$selectKatPembayaran','$selectViaPembayaran','$nominal','$selectCur','$username',TO_DATE ('$txtDate', 'MM/DD/YYYY'),SYSDATE,'$typeFlow','$remark','$selectType','$selectSupplier') ";
        $hasil = oci_parse($conn_finance, $query);
        $exe = oci_execute($hasil);
        if ($exe) {
            oci_commit($conn_finance);
            $response .= "SUKSES";
        } else {
            oci_rollback($conn_finance);
            $response .= "GAGAL";
        }
        echo json_encode($response);
        break;

    case 'takeListEdit';
        $id = $_POST['id__'];

        $query = "SELECT FC.*, TO_CHAR(CFLOW_DATE, 'MM/DD/YYYY') AS TANGGAL FROM FINANCE_CFLOW FC WHERE FC.CFLOW_ID = '$id'";
        $hasil = oci_parse($conn_finance, $query);
        oci_execute($hasil);

        $arr = array();
        while ($row = oci_fetch_array($hasil)) {
            array_push($arr, $row);
        }
        echo json_encode($arr);
        break;

    case 'listTable';
        $query = "SELECT * FROM VW_CFLOW_INFO WHERE CFLOW_SIGN = '$username' AND CFLOW_CHECK <> '1' ORDER BY CFLOW_CHECK DESC";
        $hasil = oci_parse($conn_finance, $query);
        oci_execute($hasil);

        $arr = array();
        while ($row = oci_fetch_array($hasil)) {
            array_push($arr, $row);
        }
        echo json_encode($arr);
        break;

    case "edit_data":
        $id = $_POST['id__'];

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

    case "hapusData":
        $id = $_POST['id__'];

        $sql_text = "DELETE FINANCE_CFLOW WHERE CFLOW_ID = '$id' ";
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

    case "editData":

        $editID = $_POST['editID__'];
        $EditJob = $_POST['EditJob__'];
        $EditKatPembayaran = $_POST['EditKatPembayaran__'];
        $editViaPembayaran = $_POST['editViaPembayaran__'];
        $editNominal = $_POST['editNominal__'];
        $editCur = $_POST['editCur__'];
        $EditDate = str_replace("\\", "", $_POST['EditDate__']);
        $typeFlowEdit = $_POST['typeFlowEdit__'];
        $editRemark = $_POST['editRemark__'];
        $EditSupp = $_POST['EditSupp__'];
        $editTipe = $_POST['editTipe__'];

        $sql_text = "UPDATE FINANCE_CFLOW SET PROJECT_NO = '$EditJob',"
                . "CFLOW_PRICE = '$editNominal',"
                . "CFLOW_CATE_ID = '$EditKatPembayaran',"
                . "PAY_CATE_ID = '$editViaPembayaran',"
                . "CFLOW_CURR = '$editCur',"
                . "CFLOW_SIGN = '$username',"
                . "CFLOW_DATE = TO_DATE ('$EditDate', 'MM/DD/YYYY'),"
                . "CFLOW_TYPE = '$typeFlowEdit',"
                . "CFLOW_REV = CFLOW_REV+1,"
                . "CFLOW_CHECK = '0',"
                . "CFLOW_TYPE_ID = '$editTipe',"
                . "SUPP_ID = '$EditSupp',"
                . "CFLOW_REM = '$editRemark' WHERE CFLOW_ID = '$editID' ";
        echo $sql_text;
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

    case "SettingTanggal":
        $sql = "SELECT CFLOW_SETT_YEAR FROM FINANCE_CFLOW_SETTING WHERE CFLOW_SETT_SHOW = '1'";
        $parse = oci_parse($conn_finance, $sql);
        oci_execute($parse);
        $response1212 = array();
        while ($row1 = oci_fetch_array($parse)) {
            array_push($response1212, $row1);
        }

        echo json_encode($response1212);
        break;

    case "getVia":
        $via = $_POST['via'];
        $sql = "SELECT * FROM FINANCE_PAY_CATEGORY WHERE PAY_CATE_ID = '$via'";
        $parse = oci_parse($conn_finance, $sql);
        oci_execute($parse);
        $response = array();
        while ($row2 = oci_fetch_array($parse)) {
            array_push($response, $row2);
        }
        echo json_encode($response);
        break;

    case "edit_via":
        $via_id = $_POST['via_id'];
        $via_name = $_POST['via_name'];
        $via_keterangan = $_POST['via_keterangan'];
        $sql = "UPDATE FINANCE_PAY_CATEGORY SET PAY_CATE_NM =  '$via_name', PAY_CATE_REM = '$via_keterangan' WHERE PAY_CATE_ID = '$via_id'";
        $parse = oci_parse($conn_finance, $sql);
        $exe = oci_execute($parse);
        if ($exe) {
            oci_commit($conn_finance);
            echo json_encode("sukses");
        } else {
            oci_rollback($conn_finance);
            echo json_encode("gagal");
        }
        break;

    case "getPos":
        $pos = $_POST['pos'];
        $sql = "SELECT * FROM FINANCE_CFLOW_CATEGORY WHERE CFLOW_CATE_ID = '$pos'";
        $parse = oci_parse($conn_finance, $sql);
        oci_execute($parse);
        $response = array();
        while ($row2 = oci_fetch_array($parse)) {
            array_push($response, $row2);
        }
        echo json_encode($response);
        break;

    case "edit_pos":
        $pos_id = $_POST['pos_id'];
        $pos_name = $_POST['pos_name'];
        $pos_keterangan = $_POST['pos_keterangan'];
        $sql = "UPDATE FINANCE_CFLOW_CATEGORY SET CFLOW_CATE_NM =  '$pos_name', CFLOW_CATE_REM = '$pos_keterangan' WHERE CFLOW_CATE_ID = '$pos_id'";
        $parse = oci_parse($conn_finance, $sql);
        $exe = oci_execute($parse);
        if ($exe) {
            oci_commit($conn_finance);
            echo json_encode("sukses");
        } else {
            oci_rollback($conn_finance);
            echo json_encode("gagal");
        }
        break;

    case "getTipe":
        $tipe = $_POST['tipe'];
        $sql = "SELECT * FROM FINANCE_CFLOW_TYPE WHERE CFLOW_TYPE_ID = '$tipe'";
        $parse = oci_parse($conn_finance, $sql);
        oci_execute($parse);
        $response = array();
        while ($row2 = oci_fetch_array($parse)) {
            array_push($response, $row2);
        }
        echo json_encode($response);
        break;

    case "edit_tipe":
        $tipe_id = $_POST['tipe_id'];
        $tipe_name = $_POST['tipe_name'];
        $tipe_keterangan = $_POST['tipe_keterangan'];
        $sql = "UPDATE FINANCE_CFLOW_TYPE SET CFLOW_TYPE_NAME =  '$tipe_name', CFLOW_TYPE_REM = '$tipe_keterangan' WHERE CFLOW_TYPE_ID = '$tipe_id'";
        $parse = oci_parse($conn_finance, $sql);
        $exe = oci_execute($parse);
        if ($exe) {
            oci_commit($conn_finance);
            echo json_encode("sukses");
        } else {
            oci_rollback($conn_finance);
            echo json_encode("gagal");
        }
        break;
}
?>
