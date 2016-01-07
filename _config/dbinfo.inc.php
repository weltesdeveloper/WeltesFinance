<?php

// All connections to the database use these credentials
// DO NOT MODIFY THIS PAGE UNLESS YOU WANT TO ADD MORE CREDENTIALS
//define("ORA_CON_UN", "WELTESFINANCEADMIN");
//define("ORA_CON_PW", "weltespass");
//define("ORA_CON_DB", "192.168.100.71/WENFINANCE");
//$conn = oci_connect(ORA_CON_UN, ORA_CON_PW, ORA_CON_DB);

/* $con = oci_connect(ORA_CON_UN, ORA_CON_PW, ORA_CON_DB);
  if($con)
  echo 'success';
  else
  echo 'fail';

  $sql = "select count(inv_desc) from MASTER_INV where inv_desc = 'MIKO H'";
  $r = oci_parse($con, $sql);
  oci_execute($r);
  $row = oci_fetch_array($r);
  echo $row[0]; */

require_once 'DbConfig.php';
session_start();
$dbconfig = new DbConfig();
$conn_finance = $dbconfig->ConnFinance();
$conn_logistic = $dbconfig->ConnWenloginv();
$conn_weltes = $dbconfig->ConnWeltes();

if (!isset($_SESSION['user_finance'])) {
    echo <<< EOD
   <h1>You are UNAUTHORIZED !</h1>
   <p>INVALID usernames/passwords<p>
   <p><a href="/weltesfinance/">LOGIN PAGE</a></p>

EOD;
    exit;
}

$username = $_SESSION['user_finance'];
$user_role = $_SESSION['user_finance_role'];
$user_id = $_SESSION['user_finance_id'];
?>
