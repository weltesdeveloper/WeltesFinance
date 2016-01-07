<?php
require_once '../_config/dbinfo.inc.php';
?>
<nav id="sidebar-nav" class="sidebar-nav">
    <div id="sidebar-wrapper" class="sidebar-wrapper" data-background="dark">
        <component>sidebar-nav</component>
        <ul class="side-nav-top nav">
            <li class="sidebar-nav-logo">
            <component>sidebar-nav-logo</component>
            <img src="../_templates/img/logo_weltes_resized_1.jpg" alt="Dee Admin">
            <span class="logo-text">
                <b>WEN</b> Finance
            </span>
            </li>
            <li class="sidebar-nav-profile">
            <component>sidebar-nav-profile</component>
            <div class="profile">
                <span class="name">
                    <?php echo $username;  ?>&nbsp;<i id="user-profile-settings-toggler" style="cursor: pointer;" class="fa fa-caret-down l-pad-5"></i>
                </span>
                <span class="info">                    
                </span>
            </div>
            </li>
            <!-- Profile settings -->
            <li class="side-nav-profile-settings" style="display: none;">
                <ul class="inline-list">
                    <li>
                        <a id="right-notifier-toggler-3" 
                           class="btn btn-white-hover mb-5" 
                           data-placement="top" 
                           data-toggle="tooltip" 
                           data-original-title="Notifications">
                            <i class="fa fa-bell-o"></i>
                        </a>
                    </li>
                    <li>
                        <a class="btn btn-white-hover mb-5"
                           data-placement="top" 
                           data-toggle="tooltip"
                           data-original-title="Profile"
                           href="profile.html">
                            <i class="fa fa-user"></i>
                        </a>
                    </li>
                    <li>
                        <a class="btn btn-white-hover mb-5"
                           data-placement="top" 
                           data-toggle="tooltip"
                           data-original-title="Inbox"
                           href="inbox.html">
                            <i class="fa fa-inbox"></i>
                        </a>
                    </li>
                    <li>
                        <a class="btn btn-white-hover mb-5" 
                           data-placement="top" 
                           data-toggle="tooltip" 
                           data-original-title="Desktop">
                            <i class="fa fa-desktop"></i>
                        </a>
                    </li>
                    <li>
                        <a class="btn btn-white-hover mb-5"
                           data-placement="top" 
                           data-toggle="tooltip"
                           data-original-title="Support">
                            <i class="fa fa-support"></i>
                        </a>
                    </li>
                    <li>
                        <a class="btn btn-white-hover mb-5"
                           data-placement="top" 
                           data-toggle="tooltip"
                           data-original-title="Log out"
                           href="/weltesfinance/">
                            <i class="fa fa-sign-out l-pad-5"></i>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- / Profile settings -->
        </ul>
        <ul id="side-nav" class="side-nav nav">
            <li class="active">
                <a href="http://192.168.100.195:7777/WeltesFinance/_resources/main.php">
                    <i class="fa fa-tachometer"></i> 
                    <span class="name">Dashboard</span>
                </a>
            </li>

            <?php if ($user_role == 'OPERATOR' || $user_role == 'SUPERADMIN'): ?>
                <li class="activate-ui-elements">
                    <a href="#">
                        <i class="fa fa-envelope-square"></i> 
                        <span class="name">Supplier Invoice</span>
                        <span class="fa expand"></span>
                    </a>
                    <ul class="nav nav-second-level collapse">
                        <li><a onclick="invoice('INPUT_INVOICE')" style="cursor: pointer;">Input Invoice</a></li>                    
                        <li><a onclick="invoice('REVISI_INVOICE')" style="cursor: pointer;">Revisi Invoice</a></li>                    
                        <li><a onclick="invoice('MONITOR_INVOICE')" style="cursor: pointer;">Monitor Invoice</a></li>
                    </ul>
                </li>
                <li class="activate-ui-elements">
                    <a href="#">
                        <i class="fa fa-money"></i> 
                        <span class="name">Pembayaran</span>
                        <span class="fa expand"></span>
                    </a>
                    <ul class="nav nav-second-level collapse">
                        <li><a onclick="po_payment('PEMBAYARAN_PO')" style="cursor: pointer;">By Invoice</a></li>
                    </ul>
                </li>
            <?php endif; ?>

            <li class="activate-ui-elements">
                <a href="#">
                    <i class="fa fa-sitemap"></i> 
                    <span class="name">Cash Flow</span>
                    <span class="fa expand"></span>
                </a>
                <ul class="nav nav-second-level collapse">
                    <?php if ($user_role == 'OPERATOR' || $user_role == 'SUPERADMIN'): ?>
                        <li><a onclick="cflow('INPUT_CFLOW')" style="cursor: pointer;"><i class="fa fa-pencil"></i> Input</a></li>
                    <?php endif; ?>

                    <?php if ($user_role == 'ADMIN' || $user_role == 'SUPERADMIN' || $user_role == 'SUPERUSER'): ?>
                        <li>
                            <a href="#">
                                <i class="fa fa-user-md"></i> 
                                <span class="name">Approval</span>
                                <span class="fa expand"></span>
                            </a>
                            <ul class="nav nav-third-level collapse">
                                <?php if ($user_role == 'ADMIN' || $user_role == 'SUPERADMIN'): ?>
                                    <li><a onclick="cflow('CHECK_CFLOW')" style="cursor: pointer;"><i class="fa fa-check"></i> Check</a></li>
                                <?php endif; ?>
                                <?php if ($user_role == 'SUPERUSER' || $user_role == 'SUPERADMIN'): ?>
                                    <li><a onclick="cflow('REV_CHECK_CFLOW')" style="cursor: pointer;"><i class="fa fa-edit"></i> Revisi</a></li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>

                    <?php if ($user_role == 'ADMIN' || $user_role == 'SUPERADMIN' || $user_role == 'SUPERUSER'): ?>
                        <li><a onclick="cflow('RPT_CFLOW')" style="cursor: pointer;"><i class="fa fa-list"></i> Laporan</a></li>
                    <?php endif; ?>

                    <li>
                        <a href="#">
                            <i class="fa fa-sliders"></i> 
                            <span class="name">Pengaturan</span>
                            <span class="fa expand"></span>
                        </a>
                        <ul class="nav nav-third-level collapse">
                            <?php if ($user_role == 'ADMIN' || $user_role == 'SUPERADMIN'): ?>
                                <li><a onclick="cflow('SETT_CFLOW')" style="cursor: pointer;">Tahun Transaksi</a></li>
                            <?php endif; ?>
                            <li><a onclick="cflow('CHANGE_PASS_CFLOW')" style="cursor: pointer;">Ganti Password</a></li>
                        </ul>
                    </li>
                </ul>
            </li>

            <!--<li class="@@activate-ui-elements">
                <a href="#">
                    <i class="fa fa-database"></i> 
                    <span class="name">Database</span>
                    <span class="fa expand"></span>
                </a>
                <ul class="nav nav-second-level collapse">
                    <li><a onclick="database('SITE_INVOICE')" style="cursor: pointer;">Backup</a></li>
                    <li><a onclick="database('MISC_INVOICE')" style="cursor: pointer;">Restore</a></li>
                    <li><a onclick="database('MISC_INVOICE')" style="cursor: pointer;">Generate Script</a></li>
                </ul>
            </li>

            <li class="@@activate-ui-elements">
                <a href="#">
                    <i class="fa fa-users"></i> 
                    <span class="name">User Group</span>
                    <span class="fa expand"></span>
                </a>
                <ul class="nav nav-second-level collapse">
                    <li><a onclick="user('ADD')" style="cursor: pointer;">Add User</a></li>
                    <li><a onclick="user('LIST')" style="cursor: pointer;">List user</a></li>
                    <li><a onclick="user('MANAGE_RIGHTS')" style="cursor: pointer;">Manage Rights</a></li>
                </ul>
            </li>

            <li>
                <a href="#">
                    <i class="fa fa-print"></i> 
                    <span class="name">Reports</span>
                    <span class="fa expand"></span>
                </a>
                <ul class="nav nav-second-level collapse">
                    <li>
                        <a href="javascript:void(0);">
                            Financial<span class="fa expand"></span>
                        </a>
                        <ul class="nav nav-third-level collapse">
                            <li><a onclick="financialReports('BALANCE_SHEET')" style="cursor: pointer;">Balance Sheet</a></li>
                            <li><a onclick="financialReports('INCOME_STMT')" style="cursor: pointer;">Income Statement</a></li>
                            <li><a onclick="financialReports('SALES_TAX')" style="cursor: pointer;">Sales Tax</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);">
                            Customers<span class="fa expand"></span>
                        </a>
                        <ul class="nav nav-third-level collapse">
                            <li><a onclick="customerReport('INCOME')" style="cursor: pointer;">Income By Cust</a></li>
                            <li><a onclick="customerReport('AGED_RECEIVABLES')" style="cursor: pointer;">Aged Receivables</a></li>
                            <li><a onclick="customerReport('LIST')" style="cursor: pointer;">Customer List</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);">
                            Vendors<span class="fa expand"></span>
                        </a>
                        <ul class="nav nav-third-level collapse">
                            <li><a onclick="vendorReport('EXPENSES')" style="cursor: pointer;">Vendor Expenses</a></li>
                            <li><a onclick="vendorReport('AGED_PAYABLES')" style="cursor: pointer;">Aged Payables</a></li>
                            <li><a onclick="vendorReport('LIST')" style="cursor: pointer;">Vendor List</a></li>
                        </ul>
                    </li>
                    <li><a onclick="reports('ADD')" style="cursor: pointer;">General Ledger</a></li>
                    <li><a onclick="reports('TRIAL')" style="cursor: pointer;">Trial Balance</a></li>
                    <li><a onclick="reports('TRANSACTION')" style="cursor: pointer;">Acct Transactions</a></li>
                    <li><a onclick="reports('GAINLOSS')" style="cursor: pointer;">Gain/Loss</a></li>
                    <li><a onclick="reports('PO')" style="cursor: pointer;">Purchase Order</a></li>
                </ul>
            </li>

            <li>
                <a href="#">
                    <i class="fa fa-align-left"></i> 
                    <span class="name">Menu levels</span>
                    <span class="fa expand"></span>
                </a>
                <ul class="nav nav-second-level collapse">
                    <li>
                        <a href="javascript:void(0);">
                            Item 1.1<span class="fa expand"></span>
                        </a>
                        <ul class="nav nav-third-level collapse">
                            <li>
                                <a href="javascript:void(0);">
                                    Item 1.1.1<span class="fa expand"></span>
                                </a>
                                <ul class="nav nav-fourth-level collapse">
                                    <li>
                                        <a href="javascript:void(0);">Item 1.1.1.1</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);">Item 1.1.1.2</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);">Item 1.1.2</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);">Item 1.2</a>
                    </li>
                    <li>
                        <a href="javascript:void(0);">Item 1.3</a>
                    </li>
                </ul>
            </li>
            <li class="@@activate-classes">
                <a href="classes.html">
                    <i class="fa fa-cubes"></i> 
                    <span class="name">Generic classes</span>
                </a>
            </li>
            <li class="@@activate-classes">
                <a href="classes.html">
                    <i class="fa fa-gear"></i> 
                    <span class="name">Global Settings</span>
                </a>
            </li>
            <li class="side-nav-info">
                <div class="row">
                    <div class="col-md-9">
                        Pending tasks
                    </div>
                    <div class="col-md-3">
                        <span class="badge badge-warning">6</span>
                    </div>
                </div>
            </li>
            <li class="side-nav-separator">
            <li class="side-nav-info">
                <div class="row">
                    <div class="col-md-12">
                        <small>
                            Application server progress
                        </small>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="progress progress-striped active progress-xs no-mb mt-5">
                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100" style="width: 55%">
                                <span class="sr-only">5%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li class="side-nav-info">
                <div class="row">
                    <div class="col-md-12">
                        <small>
                            Database backup progress 
                        </small>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-md-12">
                        <div class="progress progress-striped active progress-xs no-mb mt-5">
                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%">
                                <span class="sr-only">75%</span>
                            </div>
                        </div>
                    </div>
                </div>
            </li>-->

        </ul>
    </div>
</nav>

<script>
    // jangan dihapus public variable for chosen selector
    var config_chosen = {
        search_contains: true,
        no_results_text: 'Oops, nothing found!',
        width: "100%"
    };
    function addCommas(nStr) {
        nStr += '';
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        return x1 + x2;

        // return (nStr + "").replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
    }

    function invoice(param) {
        switch (param) {
            case "INPUT_INVOICE":
                $.ajax({
                    url: "../_resources/invoice/view_invoice.php",
                    data: {},
                    beforeSend: function (xhr) {
                        $('#maincontent').html();
                    },
                    success: function (response, textStatus, jqXHR) {
                        $('#maincontent').html(response);
                    }
                });
                break; // END OF CASE
        }
    }
    function po_payment(param) {
        switch (param) {
            case "PEMBAYARAN_PO":
                $.ajax({
                    url: "../_resources/popyment/view_popyment.php",
                    data: {},
                    beforeSend: function (xhr) {
                        $('#maincontent').html();
                    },
                    success: function (response, textStatus, jqXHR) {
                        $('#maincontent').html(response);
                    }
                });
                break; // END OF CASE
        }
    }
    function cflow(param) {
        switch (param) {
            case "INPUT_CFLOW":
                $.ajax({
                    url: "../_resources/cashflow/input/view_cflow.php",
                    data: {},
                    beforeSend: function (xhr) {
                        $('#maincontent').html();
                    },
                    success: function (response, textStatus, jqXHR) {
                        $('#maincontent').html(response);
                    }});
                break;

            case "CHECK_CFLOW":
                $.ajax({
                    url: "../_resources/cashflow/approval/view_approval.php",
                    data: {},
                    beforeSend: function (xhr) {
                        $('#maincontent').html();
                    },
                    success: function (response, textStatus, jqXHR) {
                        $('#maincontent').html(response);
                    }
                });
                break;

            case "RPT_CFLOW":
                $.ajax({
                    url: "../_resources/cashflow/report/view_report.php",
                    data: {},
                    beforeSend: function (xhr) {
                        $('#maincontent').html();
                    },
                    success: function (response, textStatus, jqXHR) {
                        $('#maincontent').html(response);
                    }
                });
                break;

            case "SETT_CFLOW":
                $.ajax({
                    url: "../_resources/cashflow/setting/tahun/view_setting.php",
                    data: {},
                    beforeSend: function (xhr) {
                        $('#maincontent').html();
                    },
                    success: function (response, textStatus, jqXHR) {
                        $('#maincontent').html(response);
                    }
                });
                break;

            case "CHANGE_PASS_CFLOW":
                $.ajax({
                    url: "../_resources/cashflow/setting/password/view_settpass.php",
                    data: {},
                    beforeSend: function (xhr) {
                        $('#maincontent').html();
                    },
                    success: function (response, textStatus, jqXHR) {
                        $('#maincontent').html(response);
                    }
                });
                break;
        }
    }


//    function reports(param) {
//        switch (param) {
//            case "PO":
//                $.ajax({
//                    url: "../_resources/reports/purchaseorder/listPo.php",
//                    data: {},
//                    beforeSend: function (xhr) {
//                        $('#maincontent').html();
//                    },
//                    success: function (response, textStatus, jqXHR) {
//                        $('#maincontent').html(response);
//                    }
//                });
//                break; // END OF CASE
//        }
//    }
//
//    function customerReport(param) {
//        switch (param) {
//            case "LIST":
//                $.ajax({
//                    url: "../_resources/reports/customer/customerlist.php",
//                    data: {},
//                    beforeSend: function (xhr) {
//                        $('#maincontent').html();
//                    },
//                    success: function (response, textStatus, jqXHR) {
//                        $('#maincontent').html(response);
//                    }
//                });
//                break; // END OF CASE
//        }
//    }
</script>