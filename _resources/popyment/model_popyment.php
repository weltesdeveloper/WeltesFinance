<?php

include('../..../../../_config/dbinfo.inc.php');
include('../..../../../_config/misc.func.php');
session_start();

if (!isset($_SESSION['user_finance'])) {
    echo <<< EOD
   <h1>You are UNAUTHORIZED !</h1>
   <p>INVALID usernames/passwords<p>
   <p><a href="/welteslogisticinventory/index_new.php">LOGIN PAGE</a></p>

EOD;
    exit;
}
// GENERATE THE APPLICATION PAGE
$username = $_SESSION['user_finance'];
$todaysDate = date("m/d/y");
?>


<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$ACTION = $_POST['action'];
switch ($ACTION) {
    case 'ViewSupplier';
        $query = "select DISTINCT SUPP_ID, SUPP_NM FROM VW_SUPP_INVOICE ORDER BY SUPP_NM ";
        $hasil = oci_parse($conn_finance, $query);
        oci_execute($hasil);

        $arr = array();
        while ($row = oci_fetch_array($hasil)) {
            array_push($arr, $row);
        }
        echo json_encode($arr);
        break;
        
    case 'ViewVia';
        $query = "select PAY_CATE_ID, PAY_CATE_NM FROM FINANCE_PAY_CATEGORY";
        $hasil = oci_parse($conn_finance, $query);
        oci_execute($hasil);

        $arr = array();
        while ($row = oci_fetch_array($hasil)) {
            array_push($arr, $row);
        }
        echo json_encode($arr);
        break;

    case 'listDetail';
        $supp= $_POST['supp__'];

        $query = "SELECT * "
                . "FROM VW_PAY_PO WHERE SUPP_ID = '$supp' AND TOT_PO_ITEM = TOT_INVOICE_ITEM  ORDER BY SUPP_ID";
        $hasil = oci_parse($conn_finance, $query);
        oci_execute($hasil);

        $arr = array();
        while ($row = oci_fetch_array($hasil)) {
            array_push($arr, $row);
        }
        echo json_encode($arr);
        break;

    case 'InputKategori';

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
}
?>
