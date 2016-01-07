<?php
require_once('../../_config/DbConfig.php');
$dbconfig = new DbConfig();
$financeConn = $dbconfig->ConnFinance();
session_start();
$username = $_POST['username'];
$password = $_POST['password'];
$sql = "SELECT * FROM FINANCE_USER WHERE FINANCE_USER_NAME = '$username' AND FINANCE_USER_PASS = '$password'";
$s = oci_parse($financeConn, $sql);
oci_execute($s);
$r = oci_fetch_array($s, OCI_ASSOC);
if ($r) {
    echo "SUKSES";
    $_SESSION['user_finance'] = $username;
    $_SESSION['user_finance_role'] = $r['FINANCE_USER_ROLE'];
    $_SESSION['user_finance_id'] = $r['FINANCE_USER_ID'];
} else {
    echo "GAGAL";
}
