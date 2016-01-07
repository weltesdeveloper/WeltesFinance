<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>FINANCE | Login</title>

        <link rel="stylesheet" href="_templates/styles/vendor/pace-theme-minimal.css">
        <link rel="stylesheet" href="_templates/styles/vendor/bootstrap.min.css">
        <link rel="stylesheet" href="_templates/styles/vendor/metisMenu.min.css">
        <link rel="stylesheet" href="_templates/styles/vendor/animate.min.css">
        <link rel="stylesheet" href="_templates/styles/vendor/toastr.min.css">
        <link rel="stylesheet" href="_templates/styles/vendor/font-awesome.min.css">
        <link rel="stylesheet" href="_templates/styles/style.min.css">
        <link rel="stylesheet" href="_templates/styles/themes/theme-all.min.css">
        <link rel="stylesheet" href="_templates/styles/demo.min.css">
        <link rel="stylesheet" href="_templates/styles/login.min.css">

        <script src="_js/vendor/jquery.min.js"></script>
        <script type="text/javascript">
            $(function () {
                $("#username")
                        .focus()
                        .keypress(function (e) {
                            if (e.which == 13) {
                                // alert('You pressed enter!');
                                $('#password').focus();
                                $('#password').select();
                            }
                        });

                $("#password").keypress(function (e) {
                    if (e.which == 13) {
                        // alert('You pressed enter!');
                        $('#btn_login').click();
                    }
                });
            });

            function CheckLogin() {
                var username = $('#username').val();
                var password = $('#password').val();
                $.ajax({
                    type: 'POST',
                    url: "_resources/login/login_model.php",
                    data: {username: username, password: password},
                    success: function (response, textStatus, jqXHR) {
                        if (response == "SUKSES") {
                            window.location.href = "_resources/main.php";
                        } else {
                            alert("USER NAME DAN / ATAU PASSWORD SALAH");
                            $("#username").focus().select();
                        }
                    }
                });
            }
        </script>
    </head>
    <body data-theme='default'>
        <div class="single-container login-screen animated fadeInDown">
            <section class="sign-widget-title">
                <h1>WEN <b>Finance</b></h1>
                <h4>Login Page</h4>
            </section>
            <section class="sign-widget">
                <div class="body">

                    <form class="no-margin">
                        <fieldset>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-mail-forward"></i>
                                    </span>
                                    <input type="text" placeholder="Input UserName" class="form-control" id="username" name="username">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-key"></i>
                                    </span>
                                    <input type="password" placeholder="Input Password" class="form-control" id="password" name="password">
                                </div>
                            </div>
                        </fieldset>

                        <div class="form-actions">
                            <button type="button" id="btn_login" class="btn btn-sm btn-danger" onclick="CheckLogin();">
                                Login To Finance System
                            </button>
                            <br>
                            <a href="_resources/register.php" class="register">Create a new account</a>
                        </div>

                    </form>

                </div>
            </section>
        </div>
    </body>


</html>