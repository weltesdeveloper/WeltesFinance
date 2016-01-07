<?php

include('../..../../../_config/dbinfo.inc.php');
include('../..../../../_config/misc.func.php');
//session_start();

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
    case 'ViewPoNo';
        $query = "SELECT DISTINCT PO_NO ,SUPP_NM, SUPP_ADDR, PO_TAX ,PO_DISC,PO_DISC_TYPE FROM VW_SUPP_INVOICE WHERE SUPP_INVOICE_NO IS NULL ORDER BY PO_NO";
        $hasil = oci_parse($conn_finance, $query);
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

    case 'listDetailPo';
        $po = str_replace("\\", "", $_POST['po__']);

        $query = "SELECT PO_NO,INV_DESC_CONCAT,PO_INV_QTY,PO_UNIT_PIECE,PO_UNIT_PCE,PO_UNIT_PCE_VAL,SUB_TOTAL,INV_ID,SUPP_INVOICE_PRICE "
                . "FROM VW_SUPP_INVOICE WHERE PO_NO = '$po'  ORDER BY PO_NO";
        $hasil = oci_parse($conn_finance, $query);
        oci_execute($hasil);

        $arr = array();
        while ($row = oci_fetch_array($hasil)) {
            array_push($arr, $row);
        }
        echo json_encode($arr);
        break;

    case 'inputInvoice';

        $po = $_POST['po__'];
        $namaSupp = $_POST['namaSupp__'];
        $alamatSupp = $_POST['alamatSupp__'];
        $NoInv = $_POST['NoInv__'];
        $txtDate = $_POST['txtDate__'];
        $txtRecDate = $_POST['txtRecDate__'];
        $selectCur = $_POST['selectCur__'];
        $remark = $_POST['remark__'];

        $INV_ID = $_POST['INV_ID__'];
        $NamaBarang = $_POST['NamaBarang__'];
        $qty = $_POST['qty__'];
        $hargaPo = $_POST['hargaPo__'];
        $tagihan = $_POST['tagihan__'];
        
        $response = "";

        $sequence_ = SingleQryFld("SELECT SEQ_INVOICE_MST.NEXTVAL FROM DUAL", $conn_finance);
        $query = "INSERT INTO FINANCE_SUPP_INVOICE_MST "
                . "VALUES('$sequence_','$NoInv','$username',TO_DATE ('$txtDate', 'MM/DD/YYYY'),SYSDATE,TO_DATE ('$txtRecDate', 'MM/DD/YYYY'),'$selectCur','$po','$remark') ";
        $hasil = oci_parse($conn_finance, $query);
        $exe = oci_execute($hasil);
        if ($exe) {
            $response .= "SUKSES";
            for ($i = 0; $i < sizeof($INV_ID); $i++) {
                $tagihanX = str_replace(",", "", $tagihan[$i]);
                $queryDtl = "INSERT INTO FINANCE_SUPP_INVOICE_DTL "
                        . "VALUES('$sequence_','$INV_ID[$i]','$tagihanX') ";
//                echo $queryDtl;
                $hasilDtl = oci_parse($conn_finance, $queryDtl);
                $exeDtl = oci_execute($hasilDtl);
                if ($exeDtl) {
                    oci_commit($conn_finance);
                    $response .= "SUKSES";
                } else {
                    oci_rollback($conn_finance);
                    $response .= "GAGAL";
                }
            }
        }else{
            oci_rollback($conn_finance);
            $response .= "SUKSES";
        }
        echo json_encode($response);
        break;
}
?>
