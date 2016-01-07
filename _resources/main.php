<!doctype html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <!-- Include the title -->
        <title>FINANCE | Dashboard</title>       

        <!--<link href='//fonts.googleapis.com/css?family=Raleway:300,400,600,700,800' rel='stylesheet' type='text/css'>-->
        <!--<link href='//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800' rel='stylesheet' type='text/css'>-->

        <link rel="stylesheet" href="../_templates/styles/vendor/pace-theme-minimal.css">
        <link rel="stylesheet" href="../_templates/styles/vendor/bootstrap.min.css">
        <!--<link rel="stylesheet" href="../_templates/styles/vendor/metisMenu.min.css">-->
        <link rel="stylesheet" href="../_templates/styles/vendor/animate.min.css">
        <!--        <link rel="stylesheet" href="../_templates/styles/vendor/toastr.min.css">-->
        <link rel="stylesheet" href="../_templates/styles/vendor/font-awesome.min.css">
        <link rel="stylesheet" href="../_templates/styles/style.min.css">
        <link rel="stylesheet" href="../_templates/styles/themes/theme-all.min.css">
        <link rel="stylesheet" href="../_templates/styles/demo.min.css">
        <link rel="stylesheet" href="../_js/bootstrap3-editable/css/bootstrap-editable.css">

        <link href="../_templates/styles/vendor/bootstrap-select.min.css" rel="stylesheet" type="text/css"/>
        <link href="../_templates/styles/vendor/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css"/>

        <link href="../_templates/styles/vendor/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="../_templates/styles/vendor/sweetalert.css" rel="stylesheet" type="text/css"/>
        <link href="../_templates/styles/vendor/chosen.min.css" rel="stylesheet" type="text/css"/>
        <!--SWEET ALERT-->
        <link href="../_templates/styles/vendor/sweetalert.css" rel="stylesheet" type="text/css"/>


    </head>

    <body data-theme="chocolate">
        <div id="wrapper">
            <?php include './elements/sidebar.php'; ?>
            <div id="container-wrapper" class="container-wrapper">

                <?php include './elements/navbar.php'; ?>

                <div id="container-content" class="container-content">
                    <?php include './elements/settings.php'; ?>
                    <div id="maincontent">
                        <?php //include './elements/dashboard.php'; ?>
                    </div>
                </div>

            </div>
        </div>

        <!-- Scroll up -->
        <a href="#" class="fa scrollup"></a>   

        <script src="../_js/vendor/jquery.min.js"></script>
        <script src="../_js/vendor/jquery-ui.min.js"></script>
        <script src="../_js/vendor/bootstrap.min.js"></script>

        <script src="../_js/main.min.js"></script>
        <script src="../_js/loremizer.min.js"></script>
        <script src="../_js/panels.min.js"></script>
        <script src="../_js/deepassword.min.js"></script>
        <script src="../_js/demo/demo.min.js"></script>

        <script src="../_js/vendor/toastr.min.js"></script>
        <script src="../_js/vendor/pace.min.js"></script>
        <script src="../_js/vendor/metisMenu.min.js"></script>
        <script src="../_js/vendor/jquery.slimscroll.min.js"></script>

        <script src="../_js/vendor/lodash.min.js"></script>
        <script src="../_js/vendor/moment.min.js"></script>

        <script src="../_js/vendor/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="../_js/vendor/dataTables.bootstrap.min.js" type="text/javascript"></script>

        <script src="../_js/vendor/jquery.peity.min.js"></script>
        <script src="../_js/vendor/index.js"></script>
        <script src="../_js/vendor/Chart.min.js"></script>

        <!--<script src="../_js/demo/demo-dashboard.js"></script>-->
        <script src="../_js/vendor/bootstrap-select.min.js" type="text/javascript"></script>
        <script src="../_js/vendor/holder.min.js"></script>
        <script src="../_js/vendor/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <script src="../_js/vendor/sweetalert.min.js" type="text/javascript"></script>
        <script src="../_js/vendor/chosen.jquery.min.js" type="text/javascript"></script>

        <!--BOOTSRAP EDITABLE-->
        <script src="../_js/bootstrap3-editable/js/bootstrap-editable.min.js" type="text/javascript"></script>

        <!--SWEET ALERT-->
        <script src="../_js/vendor/sweetalert.min.js"></script>

        <!--AUTO NUMERIC-->
        <script src="../_js/autonumeric/autoNumeric.js  "></script>        
        <script type="text/javascript">
            jQuery(function ($) {
                ViewTanggal();
            });

            function ViewTanggal() {
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: "cashflow/input/model_cflow.php",
                    data: {action: "SettingTanggal"},
                    success: function (response, textStatus, jqXHR) {
                        var tanggal = "";
                        $.each(response, function (key, value) {
                            tanggal += value.CFLOW_SETT_YEAR + ",";
                        });
                        tanggal = tanggal.substr(0, tanggal.length - 1);
                        $('#tahun').html(tanggal);
                    }
                });
            }
        </script>
    </body>
</html>