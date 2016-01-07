                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-8 no-pad">
                            <div class="row">
                                <div class="col-md-4 no-pad">
                                    <div class="widget bg-inverse">
                                        <div class="widget-icon widget-icon-top bg-inverse-light">
                                            <i class="fa fa-dollar r-mar-10"></i>
                                        </div>
                                        <div class="widget-progress">
                                            <div class="progress-bar progress-bar-animated" style="width: 65%;" aria-valuenow="65"></div>
                                        </div>
                                        <div class="widget-content to-center">
                                            Today's income (65%)
                                            <h2 class="bold">1.200,00$</h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 no-pad">
                                    <div class="widget bg-green-soft">
                                        <div class="widget-icon widget-icon-top bg-green-soft-light">
                                            <i class="fa fa-shopping-cart r-mar-10"></i>
                                        </div>
                                        <div class="widget-progress">
                                            <div class="progress-bar progress-bar-animated" style="width: 85%;" aria-valuenow="85"></div>
                                        </div>
                                        <div class="widget-content to-center">
                                            Today's sales (85%)
                                            <h2 class="bold">1,024</h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 no-pad">
                                    <div class="widget bg-default">
                                        <div class="widget-icon widget-icon-top bg-default-light">
                                            <i class="fa fa-user r-mar-10"></i>
                                        </div>
                                        <div class="widget-progress">
                                            <div class="progress-bar progress-bar-animated" style="width: 45%;" aria-valuenow="45"></div>
                                        </div>
                                        <div class="widget-content to-center">
                                            Today's visitors (45%)
                                            <h2 class="bold">1,024</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 no-pad">
                            <!-- Maintenance -->
                            <div class="widget bg-success">
                                <div class="to-center bg-success-dark pad-v-10 fs-14">
                                    Maintenance tasks
                                </div>
                                <div class="widget-progress">
                                    <div class="progress-bar progress-bar-animated progress-striped pba1" style="width: 15%;" aria-valuenow="15"></div>
                                </div>
                                <div class="widget-content bg-success-light pad-v-10">
                                    Server backup (<span class="progress-bar-percent pbp1">15%</span>)
                                </div>
                                <div class="widget-progress">
                                    <div class="progress-bar progress-bar-animated pba2" style="width: 2%;" aria-valuenow="2"></div>
                                </div>
                                <div class="widget-content bg-success-light pad-v-10">
                                    DB backup (<span class="progress-bar-percent pbp2">2%</span>)
                                </div>
                                <div class="widget-progress">
                                    <div class="progress-bar progress-bar-animated pba3" style="width: 35%;" aria-valuenow="35"></div>
                                </div>
                                <div class="widget-content bg-success-light pad-v-10">
                                    Script execution (<span class="progress-bar-percent pbp3">35%</span>)
                                </div>
                            </div>
                            <!-- / Maintenance -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 no-pad">
                            <div class="row">
                                <div class="col-md-12 no-pad">
                                    <div class="panel mar-10">
                                        <div class="panel-body">
                                            <h4 class="mb-10"><strong>Sales</strong> Expected / Real</h4>
                                            <div style="height: 256px" class="mt-10 mb-10">
                                                <canvas id="chartjsLineChart"></canvas>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 no-h-pad">
                                                    <div class="widget bg-default">
                                                        <div class="widget-icon widget-icon-top bg-default-light to-center">
                                                            <div id="sparkline-bar"></div>
                                                        </div>
                                                        <div class="widget-content to-center">
                                                            <i class="fa fa-user r-mar-5"></i>
                                                            Visitors expected
                                                            <h3 class="bold">2.048</h3>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 no-h-pad">
                                                    <div class="widget bg-default">
                                                        <div class="widget-icon widget-icon-top bg-default-light to-center">
                                                            <div id="sparkline-area"></div>
                                                        </div>
                                                        <div class="widget-content to-center">
                                                            <i class="fa fa-dollar r-mar-5"></i>
                                                            Anual incomes
                                                            <h3 class="bold">120.000,00$</h3>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 no-h-pad">
                                                    <div class="widget bg-default">
                                                        <div class="widget-icon widget-icon-top bg-default-light to-center">
                                                            <div id="sparkline-bar-2"></div>
                                                        </div>
                                                        <div class="widget-content to-center">
                                                            <i class="fa fa-shopping-cart r-mar-5"></i>
                                                            Sales expected
                                                            <h3 class="bold">128</h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 no-pad">
                                    <div class="widget bg-success">
                                        <div class="widget-content bg-success-light">
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <h4>Top active projects</h4>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <table class="table table-responsive wp100 no-mb">
                                                        <tbody>
                                                            <tr>
                                                                <td class="w25">1</td>
                                                                <td>Dee Admin Template</td>
                                                                <td class="wp25">
                                                                    <div class="progress progress-xs mb-5 mt-5">
                                                                        <div class="progress-bar progress-bar-success" role="progressbar" 
                                                                             aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" 
                                                                             style="width: 90%"></div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="w25">2</td>
                                                                <td>Lorem Admin Template</td>
                                                                <td class="wp25">
                                                                    <div class="progress progress-xs mb-5 mt-5">
                                                                        <div class="progress-bar progress-bar-success" role="progressbar" 
                                                                             aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" 
                                                                             style="width: 20%"></div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="w25">3</td>
                                                                <td>Ipsum Admin Template</td>
                                                                <td class="wp25">
                                                                    <div class="progress progress-xs mb-5 mt-5">
                                                                        <div class="progress-bar progress-bar-success" role="progressbar" 
                                                                             aria-valuenow="35" aria-valuemin="0" aria-valuemax="100" 
                                                                             style="width: 35%"></div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="w25">3</td>
                                                                <td>Dolor Admin Template</td>
                                                                <td class="wp25">
                                                                    <div class="progress progress-xs mb-5 mt-5">
                                                                        <div class="progress-bar progress-bar-success" role="progressbar" 
                                                                             aria-valuenow="65" aria-valuemin="0" aria-valuemax="100" 
                                                                             style="width: 65%"></div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 no-pad">
                                     <div class="widget bg-info">
                                        <div class="widget-content">
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <h3>Active projects</h3>
                                                </div>
                                                <div class="col-md-2 to-right">
                                                    <h2 class="bold">8</h2>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="widget-refer">
                                            <a href="javascript:void(0);">
                                                <span class="pull-right">
                                                    View all projects
                                                    <i class="fa fa-caret-right l-mar-5"></i>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 no-pad">
                                    <div class="widget bg-warning">
                                        <div class="widget-content">
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <h3>Pending projects</h3>
                                                </div>
                                                <div class="col-md-2 to-right">
                                                    <h2 class="bold">16</h2>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="widget-refer">
                                            <a href="javascript:void(0);">
                                                <span class="pull-right">
                                                    View all projects
                                                    <i class="fa fa-caret-right l-mar-5"></i>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 no-pad">
                                     <div class="widget bg-inverse">
                                        <div class="widget-content">
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <h3>Closed projects</h3>
                                                </div>
                                                <div class="col-md-2 to-right">
                                                    <h2 class="bold">64</h2>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="widget-refer">
                                            <a href="javascript:void(0);">
                                                <span class="pull-right">
                                                    View all projects
                                                    <i class="fa fa-caret-right l-mar-5"></i>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 no-pad">
                                    <!-- Activity -->                  
                                    <div class="panel mar-10">
                                        <div class="panel-heading">
                                            <div class="panel-title">
                                                <strong>Activity</strong>
                                                <small> / Your social activity</small>
                                            </div>
                                        </div>
                                        <div class="panel-body panel-full">
                                            <div class="feed-element mar-h-20">
                                                <div class="pull-left r-mar-10" >
                                                    <a href="javascript:void(0);">
                                                        <img alt="Warren Beatty" class="img-thumbnail" data-src="holder.js/42x42?text=WB&theme=social&size=12" >
                                                    </a>
                                                </div>
                                                <div class="feed-element-body">
                                                    <small class="pull-right feed-element-time">
                                                        5m ago @ 14:20 pm
                                                        <div class="btn-group l-mar-5">
                                                            <a class="btn btn-xs social-facebook-color pad-h-5"><i class="fa fa-thumbs-up"></i></a>
                                                            <a class="btn btn-xs social-twitter-color pad-h-5"><i class="fa fa-twitter"></i></a>
                                                        </div>
                                                    </small>
                                                    <strong>Warren Beatty</strong> (@wbeatty) started following you.<br>
                                                    <p class="to-justify mt-5">
                                                        I love your account and <span loremizer loremizer-words="20" loremizer-no-p></span>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="feed-element mar-h-20">
                                                <div class="pull-left r-mar-10" >
                                                    <a href="javascript:void(0);">
                                                        <img alt="Peter Boussa" class="img-thumbnail" data-src="holder.js/42x42?text=PB&theme=social&size=12">
                                                    </a>
                                                </div>
                                                <div class="feed-element-body">
                                                    <small class="pull-right feed-element-time">03/05/2020 @ 13:20 pm</small>
                                                    <strong>You</strong> started following <strong>Martin Scout</strong>.<br>
                                                    <div class="mt-5 to-justify">
                                                        <span loremizer loremizer-words="24" loremizer-no-p></span>
                                                    </div>
                                                    <div class="mt-5">
                                                        <a class="btn btn-xs social-facebook-color"><i class="fa fa-thumbs-up r-mar-5"></i>Like</a>
                                                        <a class="btn btn-xs social-twitter-color"><i class="fa fa-twitter r-mar-5"></i>Follow</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="feed-element mar-h-20">
                                                <div class="pull-left r-mar-10">
                                                    <a href="javascript:void(0);">
                                                        <img alt="Patrick Wallentines" class="img-thumbnail" data-src="holder.js/42x42?text=PW&theme=sky&size=12" >
                                                    </a>
                                                </div>
                                                <div class="feed-element-body">
                                                    <small class="pull-right feed-element-time">
                                                        Yesterday @ 11:21 am
                                                        <div class="btn-group l-mar-5">
                                                            <a class="btn btn-xs social-facebook-color pad-h-5"><i class="fa fa-thumbs-up"></i></a>
                                                            <a class="btn btn-xs social-twitter-color pad-h-5"><i class="fa fa-twitter"></i></a>
                                                        </div>
                                                    </small>
                                                    <strong>Patrick Wallentines</strong> posted new content.<br>
                                                    <p class="to-justify mt-5">
                                                        Sometimes in live <span loremizer loremizer-words="50" loremizer-no-p></span>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="feed-element mar-h-20">
                                                <div class="pull-left r-mar-10" >
                                                    <a href="javascript:void(0);">
                                                        <img alt="Martin Scout" class="img-thumbnail" data-src="holder.js/42x42?text=MS&theme=social&size=12" >
                                                    </a>
                                                </div>
                                                <div class="feed-element-body">
                                                    <small class="pull-right feed-element-time">
                                                        03/05/2020 @ 13:20 pm
                                                        <div class="btn-group l-mar-5">
                                                            <a class="btn btn-xs social-facebook-color pad-h-5"><i class="fa fa-thumbs-up"></i></a>
                                                            <a class="btn btn-xs social-twitter-color pad-h-5"><i class="fa fa-twitter"></i></a>
                                                        </div>
                                                    </small>
                                                    <strong>Martin Scout</strong> (@mscoutter) started following you.<br>
                                                    <p class="to-justify mt-5">
                                                        <span loremizer loremizer-words="36"></span>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="feed-element mar-h-20 nbb">
                                                <div class="pull-left r-mar-10" >
                                                    <a href="javascript:void(0);">
                                                        <img alt="Pietro McOussa" class="img-thumbnail" data-src="holder.js/42x42?text=PM&theme=social&size=12" >
                                                    </a>
                                                </div>
                                                <div class="feed-element-body">
                                                    <small class="pull-right feed-element-time">
                                                        08/05/2020 @ 16:20 pm
                                                        <div class="btn-group l-mar-5">
                                                            <a class="btn btn-xs social-facebook-color pad-h-5"><i class="fa fa-thumbs-up"></i></a>
                                                            <a class="btn btn-xs social-twitter-color pad-h-5"><i class="fa fa-twitter"></i></a>
                                                        </div>
                                                    </small>
                                                    <strong>Pietro McOussa</strong> (@pmcoussa) started following you.<br>
                                                    <p class="to-justify mt-5">
                                                        <span loremizer loremizer-words="12"></span>
                                                    </p>
                                                </div>
                                            </div>
                                            <a class="btn btn-block btn-success">
                                                Show more...
                                            </a>
                                        </div>
                                    </div>
                                    <!-- / Activity -->  
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 no-pad">
                                    <!-- Comments -->
                                    <div class="widget bg-primary">
                                        <div class="widget-icon bg-primary-light">
                                            <div id="sparkline-pie"></div>
                                        </div>
                                        <div class="widget-content ">
                                            <div class="row">
                                                <div class="col-md-4 to-center">
                                                    <div>Positive comments</div>
                                                    <div class="fs-20"><strong>128</strong> <small class="fs-12">/ 61.5%</small></div>
                                                </div>
                                                <div class="col-md-4 to-center">
                                                    <div>Pending comments</div>
                                                    <div class="fs-20"><strong>64</strong> <small class="fs-12">/ 30.8%</small></div>
                                                </div>
                                                <div class="col-md-4 to-center">
                                                    <div>Negative comments</div>
                                                    <div class="fs-20"><strong>16</strong> <small class="fs-12">/ 7.7%</small></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- / Comments -->  
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 no-pad">
                            <!-- Server Statistics -->
                            <div class="panel mar-10">
                                <div class="panel-body">
                                    <ul class="non-styled-list">
                                        
                                        <li>
                                            <div class="row">
                                                <div class="col-md-12 no-h-pad to-center">
                                                    <div class="well mb-10">
                                                        <span class="peityCPULoad no-mb">55,65,60,64,55,58,62,75,80,90,80,84,82,79,25,30,35,35,38,35</span>
                                                        <div id="wellcpu" class="well no-v-pad no-mb color-white pad-v-5">
                                                            <small>Server load (<span id="cpuload">55</span>%)</small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <h5><strong>Maintenance</strong></h5>
                                            <h6>Application server script progress</h6>
                                            <div class="progress progress-striped active progress-xs">
                                                <div style="width: 90%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="90" role="progressbar" 
                                                     class="progress-bar">
                                                    <span class="sr-only">90%</span>
                                                </div>
                                            </div>
                                            <h6>Database maintenance progress</h6>
                                            <div class="progress progress-striped active progress-xs">
                                                <div style="width: 55%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="55" role="progressbar" 
                                                     class="progress-bar">
                                                    <span class="sr-only">55%</span>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <h5><strong>Server statistics</strong></h5>
                                            <h6>Traffic (last hour)</h6>
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    132 requests
                                                </div>
                                                <div class="col-xs-6 to-right color-success bold">
                                                    <i class="fa fa-caret-up pad-h-5"></i>22.2%
                                                </div>
                                            </div>
                                            <h6>Average server response (last hour)</h6>
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    100 ms
                                                </div>
                                                <div class="col-xs-6 to-right color-warning bold">
                                                    <i class="fa fa-caret-up pad-h-5"></i>12.1%
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
</div>                
                            <!-- / Server Statistics -->      
                            
                            <!-- Contacts -->
                            <div class="panel mar-10">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <strong>Contacts</strong>
                                        <small> / Keep in contact</small>
                                    </div>
                                </div>
                                <div class="panel-body panel-full">
                                    <ul class="striped-list no-mb">
                                        <li>
                                            <div class="row">
                                                <div class="col-xs-2 no-h-pad to-center text-shadow-inset-dark">
                                                    <i class="fa fa-user fa-3x opacity-25"></i>
                                                </div>
                                                <div class="col-xs-7 l-pad-10">
                                                    Ronald C. Stevens
                                                    <br/>
                                                    <i class="fa fa-circle color-success r-pad-5"></i><small>Online</small>
                                                </div>
                                                <div class="col-xs-3 to-right">
                                                    <span class="label social-facebook-color label-s">
                                                        <i class="fa fa-facebook"></i>
                                                    </span>
                                                    <br/><i><small>Yesterday</small></i>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="row">
                                                <div class="col-xs-2 no-h-pad to-center text-shadow-inset-dark">
                                                    <i class="fa fa-fax fa-3x opacity-25"></i>
                                                </div>
                                                <div class="col-xs-7 l-pad-10">
                                                    Chanell W. Orcutt
                                                    <br/>
                                                    <i class="fa fa-circle color-success r-pad-5"></i><small>Online</small>
                                                </div>
                                                <div class="col-xs-3 to-right">
                                                    <span class="label social-facebook-color label-s">
                                                        <i class="fa fa-facebook"></i>
                                                    </span>
                                                    <br/><i><small>2 days ago</small></i>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                             <div class="row">
                                                <div class="col-xs-2 no-h-pad to-center text-shadow-inset-dark">
                                                    <i class="fa fa-user fa-3x opacity-25"></i>
                                                </div>
                                                <div class="col-xs-7 l-pad-10">
                                                    Blake J. Gibson
                                                    <br/>
                                                    <i class="fa fa-circle color-success r-pad-5"></i><small>Online</small>
                                                </div>
                                                 <div class="col-xs-3 to-right">
                                                    <span class="label social-google-color label-s">
                                                        <i class="fa fa-google-plus"></i>
                                                    </span>
                                                    <br/><i><small>last week</small></i>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="row">
                                                <div class="col-xs-2 no-h-pad to-center text-shadow-inset-dark">
                                                    <i class="fa fa-institution fa-3x opacity-25"></i>
                                                </div>
                                                <div class="col-xs-7 l-pad-10">
                                                    Laura E. Fagin
                                                    <br/>
                                                    <i class="fa fa-circle color-danger r-pad-5"></i><small>Offline</small>
                                                </div>
                                                <div class="col-xs-3 to-right">
                                                    <span class="label social-twitter-color label-s">
                                                        <i class="fa fa-twitter"></i>
                                                    </span>
                                                    <br/><i><small>22 oct</small></i>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="row">
                                                <div class="col-xs-2 no-h-pad to-center text-shadow-inset-dark">
                                                    <i class="fa fa-user-md fa-3x opacity-25"></i>
                                                </div>
                                                <div class="col-xs-7 l-pad-10">
                                                    Bobby V. Becker
                                                    <br/>
                                                    <i class="fa fa-circle color-success r-pad-5"></i><small>Online</small>
                                                </div>
                                                <div class="col-xs-3 to-right">
                                                    <span class="label social-linkedin-color label-s">
                                                        <i class="fa fa-linkedin"></i>
                                                    </span>
                                                    <br/><i><small>11 dec</small></i>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <a class="btn btn-block  btn-success">
                                        Show all my contacts...
                                    </a>
                                </div>
                            </div>            
                            <!-- / Contacts -->                  
              
                            <!-- Notifications -->
                            <div class="panel mar-10">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <strong>Notifications</strong>
                                    </div>
                                    <div class="panel-control">
                                        <span class="label label-warning">10 notifications</span>
                                    </div>
                                </div>
                                <div class="panel-body panel-full">
                                    <ul class="striped-list no-mb">
                                        <li>
                                            <div class="row">
                                                <div class="col-xs-2 no-h-pad to-center text-shadow-inset-dark">
                                                    <i class="fa fa-twitter fa-3x opacity-25"></i>
                                                </div>
                                                <div class="col-xs-10 l-pad-10">
                                                    You have one new follower!
                                                    <br/>
                                                    <small>@deeTemplate is following you</small>
                                                    <br/>
                                                    <i><small>12/11/2022 11:26h</small></i>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="row">
                                                <div class="col-xs-2 no-h-pad to-center text-shadow-inset-dark">
                                                    <i class="fa fa-facebook fa-3x opacity-25"></i>
                                                </div>
                                                <div class="col-xs-10 l-pad-10">
                                                    You have one new friend!
                                                    <br/>
                                                    <small>Dee Admin Template is your friend</small>
                                                    <br/>
                                                    <i><small>12/11/2022 11:11h</small></i>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="row">
                                                <div class="col-xs-2 no-h-pad to-center text-shadow-inset-dark">
                                                    <i class="fa fa-envelope fa-3x opacity-25"></i>
                                                </div>
                                                <div class="col-xs-10 l-pad-10">
                                                    You have 4 new mails!
                                                    <br/>
                                                    <small>Go to webmail to read it</small>
                                                    <br/>
                                                    <i><small>12/11/2022 11:01h</small></i>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="row">
                                                <div class="col-xs-2 no-h-pad to-center text-shadow-inset-dark">
                                                    <i class="fa fa-linkedin-square fa-3x opacity-25"></i>
                                                </div>
                                                <div class="col-xs-10 l-pad-10">
                                                    Someone visited you professional profile!
                                                    <br/>
                                                    <small>Go to Linkedin and check-it</small>
                                                    <br/>
                                                    <i><small>12/11/2022 10:42h</small></i>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="row">
                                                <div class="col-xs-2 no-h-pad to-center text-shadow-inset-dark">
                                                    <i class="fa fa-google-plus fa-3x opacity-25"></i>
                                                </div>
                                                <div class="col-xs-10 l-pad-10">
                                                    You have been added to the Dee Circle!
                                                    <br/>
                                                    <small>Go to Google+ and check-it</small>
                                                    <br/>
                                                    <i><small>12/11/2022 10:31h</small></i>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <a class="btn btn-block btn-success">
                                        Load more notifications...
                                    </a>
                                </div>
                            </div>
                            <!-- / Notifications -->
                            
                            <!-- Today's tasks -->
                            <div class="panel mar-10">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <div class="panel-title">
                                            <strong>Today's tasks</strong>
                                            <small> / You have 5 tasks</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body panel-full">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <span class="label label-danger">10:00h</span>
                                            <label class="option no-mb">
                                                <input type="checkbox" name="varcb1">
                                                <span class="checkbox checkbox-thin"></span> 
                                                <span class="l-mar-5">
                                                    Partner evaluation
                                                </span>
                                            </label>
                                        </li>
                                        <li class="list-group-item">
                                            <span class="label label-warning">11:00h</span>
                                            <label class="option no-mb">
                                                <input type="checkbox" name="varcb2">
                                                <span class="checkbox checkbox-thin"></span> 
                                                <span class="l-mar-5">
                                                    Do maintenance work in server
                                                </span>
                                            </label>
                                        </li>
                                        <li class="list-group-item ">
                                            <span class="label label-warning">12:00h</span>
                                            <label class="option no-mb">
                                                <input type="checkbox" name="varcb3">
                                                <span class="checkbox checkbox-thin"></span> 
                                                <span class="l-mar-5">
                                                    Check server status (Database)
                                                </span>
                                            </label>
                                        </li>
                                        <li class="list-group-item ">
                                            <span class="label label-warning">12:30h</span>
                                            <label class="option no-mb">
                                                <input type="checkbox" name="varcb4">
                                                <span class="checkbox checkbox-thin"></span> 
                                                <span class="l-mar-5">
                                                    Meeting with partners
                                                </span>
                                            </label>
                                        </li>
                                        <li class="list-group-item">
                                            <span class="label label-success">17:00h</span>
                                            <label class="option no-mb">
                                                <input type="checkbox" name="varcb5">
                                                <span class="checkbox checkbox-thin"></span> 
                                                <span class="l-mar-5">
                                                    Video conference with Australia
                                                </span>
                                            </label>
                                        </li>
                                    </ul>
                                    <a class="btn btn-block btn-success">
                                        Show all tasks...
                                    </a>
                                </div>
                            </div>
                            <!-- / Today's tasks -->
                        </div>
                    </div>
                </div>    