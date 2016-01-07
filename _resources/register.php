<?php
require_once '../_config/dbinfo.inc.php';
//$conn = oci_connect(ORA_CON_UN, ORA_CON_PW, ORA_CON_DB);
if (!$conn_finance) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">

        <!-- Include the title -->
        <title>FINANCE | Register</title>

        <!-- Fonts -->
        <!--<link href='//fonts.googleapis.com/css?family=Raleway:300,400,600,700,800' rel='stylesheet' type='text/css'>-->
        <!--<link href='//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800' rel='stylesheet' type='text/css'>-->
        <!-- / Fonts -->

        <!-- Style Sheets -->
        <link rel="stylesheet" href="../_templates/styles/vendor/pace-theme-minimal.css">
        <link rel="stylesheet" href="../_templates/styles/vendor/bootstrap.min.css">
        <link rel="stylesheet" href="../_templates/styles/vendor/metisMenu.min.css">
        <link rel="stylesheet" href="../_templates/styles/vendor/animate.min.css">
        <link rel="stylesheet" href="../_templates/styles/vendor/toastr.min.css">
        <link rel="stylesheet" href="../_templates/styles/vendor/font-awesome.min.css">
        <link rel="stylesheet" href="../_templates/styles/style.min.css">
        <link rel="stylesheet" href="../_templates/styles/themes/theme-all.min.css">
        <link rel="stylesheet" href="../_templates/styles/demo.min.css">
        <link rel="stylesheet" href="../_templates/styles/login.min.css">
        <link href="../_templates/styles/vendor/sweetalert.css" rel="stylesheet" type="text/css"/>

    </head>
    <body data-theme='default'>
        <div class="single-container register-screen animated fadeInDown">
            <section class="sign-widget-title">
                <h1>WEN <b>Finance</b></h1>
                <h4>Register User</h4>
            </section>
            <section class="sign-widget">
                <header>
                    <h4>Fill in your details below</h4>
                </header>
                <div class="body">

                    <fieldset>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-users"></i>
                                </span>
                                <input type="text" placeholder="Full name" class="form-control" id="fullname">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-mail-forward"></i>
                                </span>
                                <input type="email" placeholder="Email" class="form-control" id="email">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-key"></i>
                                </span>
                                <input type="password" placeholder="Password" class="form-control" id="password">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <select class="form-control" style="width: 350px;" id="reg-user-role">
                                    <?php
                                    $roleParse = oci_parse($conn_finance, "SELECT WFR.FINANCE_ROLE_NAME ROLE, WFR.FINANCE_ROLE_ID ID FROM WEN_FINANCE_ROLE WFR ORDER BY WFR.FINANCE_ROLE_NAME ASC");
                                    $roleExcErr = oci_execute($roleParse);
                                    if (!$roleExcErr) {
                                        $e = oci_error($roleParse);
                                        print htmlentities($e['message']);
                                        print "\n<pre>\n";
                                        print htmlentities($e['sqltext']);
                                        printf("\n%" . ($e['offset'] + 1) . "s", "^");
                                        print "\n</pre>\n";
                                    }
                                    while ($row = oci_fetch_array($roleParse)) {
                                        echo "<option value=" . $row['ID'] . ">" . $row['ROLE'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </fieldset>

                    <div class="form-actions">
                        <button class="btn btn-block btn-primary" type="submit" id="submit-new-user">
                            <span class="fa-icon-circle">
                                <i class="fa fa-sign-in"></i>
                            </span>
                            <small class="l-mar-5">Register</small>
                        </button>
                        <a href="_resources/login.php" class="register">Go to Login</a>
                    </div>

                    <div id="alert-box"></div>

                </div>
            </section>
        </div>
    </body>
    <script src="../_js/vendor/jquery.min.js" type="text/javascript"></script>
    <script src="../_js/vendor/sweetalert.min.js" type="text/javascript"></script>
    <script>
        $('#submit-new-user').on('click', function () {
            var newUserArr = {};
            var timer = null;
            newUserArr["fullname"] = $('#fullname').val();
            newUserArr["email"] = $('#email').val();
            newUserArr["password"] = $('#password').val();
            newUserArr["role"] = $('#reg-user-role').val();

            $.ajax({
                type: 'POST',
                data: {
                    fullname: newUserArr["fullname"],
                    email: newUserArr["email"],
                    password: newUserArr["password"],
                    role: newUserArr["role"]
                },
                url: 'process/register/registerDB.php',
                success: function (response)
                {
                    swal({
                        title: "Submit User ?",
                        text: "Contact admin for more information..",
                        type: "warning",
                        showCancelButton: false,
                        confirmButtonColor: "#DD6B55 !important",
                        confirmButtonText: "Yes, Submit",
                        closeOnConfirm: false
                    },
                    function (isConfirm) {
                        if (isConfirm) {
                            location.href = 'login.php';
                        }
                    });
                }
            });
        });
    </script>

