
<?php
    require_once '../../../_config/dbinfo.inc.php';
    require_once '../../../_config/hash.pwd.php';
    session_start();

    $email = $_POST['email'];
    $pass = $_POST['password'];

    oci_set_client_identifier($conn_finance, 'admin');

    $sql = oci_parse($conn_finance, 'SELECT WFU.FINANCE_PASS HASHPASS, WFU.FINANCE_ROLE_ID COMP_ROLE, WFU.FINANCE_FULL_NAME FULLNAME FROM WEN_FINANCE_USER WFU WHERE WFU.FINANCE_EMAIL = :finemail');

    oci_bind_by_name($sql, ":finemail", $email);
    oci_define_by_name($sql, "COMP_ROLE", $role);
    oci_define_by_name($sql, "HASHPASS", $hashpass);
    oci_define_by_name($sql, "FULLNAME", $username);
    oci_execute($sql);

    $r = oci_fetch_array($sql, OCI_ASSOC);

    $passMatchInt = validate_password($pass, $hashpass);

    if ($passMatchInt == 1) {
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $role;
        echo ('<script>location.href="../../main.php"</script>');
    } else {
        echo ('<script>alert("LOGIN FAILED !!! \nPLEASE ENTER APPROPRIATE USER NAME AND PASSWORD")</script>');
        echo ('<script>location.href="../../login.php"</script>');
    }
    

