<?php

require_once('../../../../_config/dbinfo.inc.php');
require_once('../../../../_config/misc.func.php');

$ACTION = $_POST['action'];
switch ($ACTION) {
    case 'show_data':
        $sql = "SELECT * FROM FINANCE_USER WHERE FINANCE_USER_ID = '$user_id' ";
        $parse = oci_parse($conn_finance, $sql);
        oci_execute($parse);
        $arr = array();
        while ($row = oci_fetch_assoc($parse)) {
            array_push($arr, $row);
        }
        echo json_encode($arr);
        break;

    default:
        break;
}