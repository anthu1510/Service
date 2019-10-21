<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Payroll!</span></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="<?php echo base_url('assets/images/user-512.png'); ?>" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php echo $name; ?></h2>
            </div>
        </div>
        <!-- /menu profile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                    <li><a><i class="fa fa-home"></i> Company <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?php echo site_url('Company/AddCompany');?>">Settings</a></li>
                            <li><a href="<?php echo site_url('company/newuser');?>">New User</a></li>
                            <li><a href="<?php echo site_url('company/userlist');?>">User List</a></li>
                        </ul>
                    </li>

                    <li><a><i class="fa fa-desktop"></i> Customer <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="#" data-toggle="modal" data-target="#customer_add_form">New Customer</a></li>
                            <li><a href="<?php echo site_url('customer/customerlist'); ?>">Customer List</a></li>
                        </ul>
                    </li>

                    <li><a><i class="fa fa-edit"></i> Engineer <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="" data-toggle="modal" data-target="#engineer_add_form">New Engineer</a></li>
                            <li><a href="<?php echo site_url('engineers/'); ?>">Engineer List</a></li>
                        </ul>
                    </li>

                    <li><a><i class="fa fa-camera"></i> Service <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?php echo site_url('customer/customerlist'); ?>">Complaint</a></li>
                            <li><a href="<?php echo site_url('service/'); ?>">Complaint List</a></li>
                            <li><a href="<?php echo site_url('service/allotmentlist'); ?>">Allotment List</a></li>
                            <li><a href="<?php echo site_url('service/nextdaylist'); ?>">Next Day List</a></li>
                            <li><a href="<?php echo site_url('service/scheduledlist'); ?>">Sheduled List</a></li>
                        </ul>
                    </li>

                    <li><a><i class="fa fa-table"></i> Call Closer <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?php echo site_url('callcloser/servicereport'); ?>">Service Report</a></li>
                            <li><a href="<?php echo site_url('customer/customercloser'); ?>">Service History</a></li>
                        </ul>
                    </li>

                    <li><a><i class="fa fa-edit"></i> User Profile <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?php echo site_url('welcome/editprofile'); ?>">Edit Profile</a></li>
                            <li><a href="<?php echo site_url('welcome/changepassword'); ?>">Change Password</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout" href="<?php echo site_url('welcome/Logout')?>">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>

