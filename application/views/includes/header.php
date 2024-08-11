<?php 
// echo "<pre>";print_r($_SESSION);exit;
    if(!isset($_SESSION['admin_role_id']) && !isset($_SESSION['profile_image'])){
        redirect(PANELURL.'logout');
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>YOGINTRA CRM | Dashboard</title>
    <link rel="manifest" href="manifest.json">
    <script>
        //if browser support service worker
        // if('serviceWorker' in navigator) {
        //   navigator.serviceWorker.register('serviceWorker.js');
        // };
      </script>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="<?= base_url('assets/') ?>plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>plugins/summernote/summernote-bs4.min.css">
    <!-- logo favicon -->
    <link rel="shortcut icon" href="<?= base_url('assets/') ?>site-logo.png" type="image/x-icon">

    <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css" integrity="sha512-yVvxUQV0QESBt1SyZbNJMAwyKvFTLMyXSyBHDO4BG5t7k/Lw34tyqlSDlKIrIENIzCl+RVUNjmCPG+V/GMesRw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    
    <!-- jQuery -->
    <script src="<?= base_url('assets/') ?>plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?= base_url('assets/') ?>plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js" integrity="sha512-rMGGF4wg1R73ehtnxXBt5mbUfN9JUJwbk21KMlnLZDJh7BkPmeovBuddZCENJddHYYMkCh9hPFnPmS9sspki8g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <script>
   

        $.widget.bridge('uibutton', $.ui.button)
        let PANELURL = "<?= PANELURL ?>";
    </script>

    <style>
        .dataTables_filter label {
            display: flex;
        }
        input.form-control.form-control-sm {
            margin-left: 12px;
        }
        .hidden {
            display: none !important;
        }

        .show {
            display: block;
        }

        .overlay i {
            animation: mymove 5s infinite;
        }

        @keyframes mymove {
            100% {
                transform: rotate(360deg);
            }
        }


        
        @media (min-width: 768px){
            .main-sidebar, .main-sidebar::before {
                transition: margin-left .3s ease-in-out,width .3s ease-in-out;
                width: 15%;
            }
                body:not(.sidebar-mini-md):not(.sidebar-mini-xs):not(.layout-top-nav) .content-wrapper, body:not(.sidebar-mini-md):not(.sidebar-mini-xs):not(.layout-top-nav) .main-footer, body:not(.sidebar-mini-md):not(.sidebar-mini-xs):not(.layout-top-nav) .main-header {
                transition: margin-left .3s ease-in-out;
                margin-left: 15%;
            }
        }

        .sidebar-mini .main-sidebar .nav-link, .sidebar-mini-md .main-sidebar .nav-link, .sidebar-mini-xs .main-sidebar .nav-link {
            width: 100% !important;
            transition: width ease-in-out .3s;
        }

        /* .table thead th {
            vertical-align: inherit !important;
            border-bottom: 2px solid #dee2e6;
            text-align: center !important;
        } */

        .table td, .table th {
            padding: 4px 2px;
            vertical-align: inherit;
            border-top: 1px solid #dee2e6;
            /* width: 8% !important; */
            text-align: center !important;
            font-size: 14px;
        }
        .user-panel {
            position: relative !important;
            flex-direction: column !important;
            justify-content: center !important;
            text-align: center !important;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div id="toastsContainerTopRight" class="toasts-top-right fixed">

    </div>
    <div class="wrapper">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="<?= base_url('assets/') ?>logo.png" alt="AdminLTELogo" width="20%">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  href="#" role="button" onclick="location.reload();">
                    <i class="fas fa-sync-alt"></i>
                    </a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <img class=" ml-auto" style="margin-left:2rem; width:15% !important" src="<?= base_url('assets/') ?>logo.png"
                        alt="AdminLTE Logo" class="brand-image">
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #FEEEEF!important; color:red">
            <!-- Brand Logo -->
            <!-- <a href="<?= PANELURL . 'dashboard' ?>" class="brand-link">
                <img style="margin-left:2rem" style="width:60%" src="<?= base_url('assets/') ?>logo.png"
                    alt="AdminLTE Logo" class="brand-image">
                <span class="brand-text font-weight-light">&nbsp;</span>
            </a> -->

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?php if($_SESSION['profile_image'] != ''){ 
                                            echo (PANELURL. $_SESSION['profile_image']); 
                                        }else{ 
                                            echo (PANELURL.'assets/dist/img/default-profile.png');
                                        }?>" class="img-circle elevation-2"
                            alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">
                            <?= $_SESSION['fullName'] ?>
                        </a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->

                        <li class="nav-item">
                            <?php if ($this->uri->segment(1) == '' || $this->uri->segment(1) == 'dashboard') {
                                $openingClass = 'active';
                            } ?>
                            <a href="<?= PANELURL ?>dashboard" class="nav-link <?= @$openingClass ?>">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <?php if($_SESSION['admin_role_id'] == 1 || $_SESSION['admin_role_id'] == 2 || $_SESSION['admin_role_id'] == 3){ ?>
                            
                            
                            <li class="nav-item">
                                <?php if ($this->uri->segment(1) == 'allData') {
                                    $allData = 'active';
                                } ?>
                                <a href="<?= PANELURL ?>allData" class="nav-link <?= @$allData ?>">
                                    <i class="nav-icon fas fa-plus"></i>
                                    <p>
                                        All Data
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    
                                    <li class="nav-item">
                                        <?php if ($this->uri->segment(1) == 'allData') {
                                            $allData = 'active';
                                        } ?>
                                        <a href="<?= PANELURL ?>allData" class="nav-link">
                                            <i class="nav-icon fas fa-arrow-right"></i>
                                            <p>
                                                Data
                                            </p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <?php if ($this->uri->segment(1) == 'rejected') {
                                            $rejected = 'rejected';
                                        } ?>
                                        <a href="<?= PANELURL ?>rejected" class="nav-link <?= @$rejected ?>">
                                            <i class="nav-icon fas fa-times-circle"></i>
                                            <p>
                                                Rejected Data
                                            </p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php } ?>
                        <?php if($_SESSION['admin_role_id'] == 1 || $_SESSION['admin_role_id'] == 2 || $_SESSION['admin_role_id']==3){ ?>
                            <li class="nav-item">
                                <?php if ($this->uri->segment(1) == 'lead') {
                                    $lead = 'active';
                                } ?>
                                <a href="<?= PANELURL ?>lead" class="nav-link <?= @$lead ?>">
                                    <i class="nav-icon fas fa-clipboard"></i>
                                    <p>
                                        Leads
                                    </p>
                                </a>
                            </li>
                        <?php } ?>
                        
                        <?php if($_SESSION['admin_role_id'] == 1 || $_SESSION['admin_role_id'] == 2 || $_SESSION['admin_role_id']==3){ ?>
                            <li class="nav-item">
                            <?php if ($this->uri->segment(1) == 'telecalling') {
                                    $telecalling = 'active';
                                } ?>
                                <a href="<?= PANELURL ?>telecalling" class="nav-link <?= @$telecalling ?>">
                                    <i class="nav-icon fas fa-headset"></i>
                                    <p>
                                        Telecalling
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                            <?php if ($this->uri->segment(1) == 'renewal') {
                                    $renewal = 'active';
                                } ?>
                                <a href="<?= PANELURL ?>renewal" class="nav-link <?= @$renewal ?>">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>
                                        Renewal
                                    </p>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if($_SESSION['admin_role_id'] == 1 || $_SESSION['admin_role_id'] == 2 || $_SESSION['admin_role_id']==3){ ?>
                            <li class="nav-item">
                                <?php if ($this->uri->segment(1) == 'customer') {
                                    $customer = 'active';
                                } ?>
                                <a href="<?= PANELURL ?>customer" class="nav-link <?= @$customer ?>">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>
                                        Customers
                                    </p>
                                </a>
                            </li>
                        <?php } ?>
                        <?php if($_SESSION['admin_role_id'] == 1 || $_SESSION['admin_role_id'] == 2 || $_SESSION['admin_role_id'] == 3|| $_SESSION['admin_role_id'] == 4){ ?>
                            <li class="nav-item">
                                <a href="<?= PANELURL . 'trainer' ?>" class="nav-link">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>
                                        Trainers
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                <?php if($_SESSION['admin_role_id'] != 3){ ?>
                                    <li class="nav-item">
                                        <a href="<?= PANELURL . 'recruiter' ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Recruits</p>
                                        </a>
                                    </li>
                                <?php } ?>
                                    <li class="nav-item">
                                        <a href="<?= PANELURL . 'trainers' ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>All Trainers</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php } ?>
                        <?php if($_SESSION['admin_role_id'] == 13 ){ ?>
                            <li class="nav-item">
                                <a href="<?= PANELURL ?>yoga-bookings" class="nav-link">
                                    <i class="nav-icon fas fa-calendar"></i>
                                    <p>
                                        Yoga Center
                                    </p>
                                </a>
                            </li>
                        <?php }?>
                        <?php if($_SESSION['admin_role_id'] == 1 || $_SESSION['admin_role_id'] == 2 || $_SESSION['admin_role_id'] == 5 ){ ?>
                            <li class="nav-item">
                                <a href="<?= PANELURL ?>event" class="nav-link">
                                    <i class="nav-icon fas fa-calendar"></i>
                                    <p>
                                        Events
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= PANELURL ?>yoga-bookings" class="nav-link">
                                    <i class="nav-icon fas fa-calendar"></i>
                                    <p>
                                        Yoga Center
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= PANELURL . 'accounts' ?>" class="nav-link">
                                    <i class="nav-icon fas fa-copy"></i>
                                    <p>
                                        Accounts
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= PANELURL . 'ledger' ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Ledger</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= PANELURL . 'summary' ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Summary</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= PANELURL . 'office-expences' ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                        <p>Expenses</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php } ?>
                        
                        <?php if($_SESSION['admin_role_id'] == 1 || $_SESSION['admin_role_id'] == 2){ ?>
                            <li class="nav-item">
                                <a href="<?= PANELURL . 'Admin_roles' ?>" class="nav-link">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>
                                        Roles & Permission
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= PANELURL . 'Admin_roles' ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Roles & Permission</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= PANELURL . 'Admin_roles/module' ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Module</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="<?= PANELURL . 'Admin' ?>" class="nav-link">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>
                                        User
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="<?= PANELURL . 'Admin' ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>User list</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?= PANELURL . 'Admin/add' ?>" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Add User</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        <?php } ?>
                        <?php if($_SESSION['admin_role_id'] == 1){ ?>
                        <!--<li class="nav-item has-treeview <?php if($this->uri->segment(2) == "setting"){ echo "menu-open";}?>">-->
                        <!--    <a href="#" class="nav-link <?php if($this->uri->segment(2) == "setting"){ echo "active";}?>">-->
                        <!--      <i class="nav-icon fas fa-tools"></i>-->
                        <!--      <p>-->
                        <!--        Setting -->
                        <!--        <i class="fas fa-angle-left right"></i>-->
                        <!--      </p>-->
                        <!--    </a>-->
                        <!--    <ul class="nav nav-treeview">-->
                        <!--    <li class="nav-item ">-->
                        <!--      <a href="<?php echo base_url() ?>adm/setting/application_setting" class="nav-link <?php if($this->uri->segment(3) =="application_setting"){echo 'active';}?>">-->
                        <!--        <i class="far fa-circle nav-icon"></i>-->
                        <!--        <p>Application</p>-->
                        <!--      </a>-->
                        <!--    </li>-->
                        <!--    <li class="nav-item ">-->
                        <!--      <a href="<?php echo base_url() ?>adm/setting/visual_setting" class="nav-link <?php if($this->uri->segment(3) =="visual_setting"){echo 'active';}?>">-->
                        <!--        <i class="far fa-circle nav-icon"></i>-->
                        <!--        <p>Visual</p>-->
                        <!--      </a>-->
                        <!--    </li> -->
                        <!--    </ul>-->
                        <!--  </li>-->
                        <?php }; ?>
                        <li class="nav-item">
                            <a href="<?= PANELURL ?>logout" class="nav-link">
                                <i class="nav-icon fas fa-arrow-right"></i>
                                <p>
                                    Sign out
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <style type="text/css">
            body, .sidebar a
            {
                color: #434C66!important;
            }
            .navbar-white {
              background-color: #feeeef!important;
              color: #1f2d3d;
            }
            .user-panel {
          border-bottom: 0!important;
        }
        .card
        {
            background-color: #feeeef!important;
        }
        .table td, .table th
        {
            text-align: left!important;
        }
        .sidebar-dark-primary .nav-sidebar > .nav-item > .nav-link.active, .sidebar-light-primary .nav-sidebar > .nav-item > .nav-link.active, .btn-primary:hover, .btn-primary, .page-item.active .page-link
        {
            background-color: #01aeb7!important;
            color: #FEEEEF!important;
        }
        table a
        {
            color: #01aeb7!important;
        }
        </style>