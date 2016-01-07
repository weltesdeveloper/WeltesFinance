<?php

require_once '../../../_config/dbinfo.inc.php';
require_once '../../../_config/hash.pwd.php';
//$conn_finance = oci_connect(ORA_CON_UN, ORA_CON_PW, ORA_CON_DB) or die;
if (!$conn_finance) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

$fNameUsr = $_POST['fullname'];
$emUsr = $_POST['email'];
$pwdUsr = $_POST['password'];
$roleUsr = $_POST['role'];

// Begin hashing process
$encPassword = create_hash($pwdUsr);

// Begin insertion
$newUsrInsert = oci_parse($conn_finance, "INSERT INTO WEN_FINANCE_USER (FINANCE_FULL_NAME, FINANCE_EMAIL, FINANCE_PASS, FINANCE_ROLE_ID) VALUES (:name,:email,:pass,:role)");
oci_bind_by_name($newUsrInsert, ':name', $fNameUsr);
oci_bind_by_name($newUsrInsert, ':email', $emUsr);
oci_bind_by_name($newUsrInsert, ':pass', $encPassword);
oci_bind_by_name($newUsrInsert, ':role', $roleUsr);

// Begin query validation
$newUsrInsertExc = oci_execute($newUsrInsert);
if (!$newUsrInsertExc) {
    $e = oci_error($newUsrInsert);
    print htmlentities($e['message']);
    print "\n<pre>\n";
    print htmlentities($e['sqltext']);
    printf("\n%" . ($e['offset'] + 1) . "s", "^");
    print "\n</pre>\n";
} else {
    print("Inserted");
}