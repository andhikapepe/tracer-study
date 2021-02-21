<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="description" content="<?php echo $_meta_deskripsi; ?>">
    <meta name="keywords" content="<?php echo $_meta_keyword; ?>">
    <meta name="author" content="Andhika Putra Pratama">
    <title><?php echo $title; ?></title>
    <!-- Favicon-->
    <link rel="icon" href="<?php echo (!empty($_logo_website) ? base_url('uploads/situs/' . $_logo_website) : base_url('assets/favicon.ico')); ?>" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="<?php echo base_url('assets/admin-page'); ?>/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="<?php echo base_url('assets/admin-page'); ?>/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="<?php echo base_url('assets/admin-page'); ?>/plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="<?php echo base_url('assets/admin-page'); ?>/css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="<?php echo base_url('assets/admin-page'); ?>/css/themes/all-themes.css" rel="stylesheet" />

    <?php echo (isset($additional_head) ? $additional_head : ''); ?>
</head>

<body class="theme-blue">
    <?php
    $this->load->view('alert');
    ?>
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-blue">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="<?php echo site_url('dashboard'); ?>"><?php echo $_app_name . ' <small>' . $_app_slogan . '</small>'; ?></a>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <?php if (!empty($this->session->userdata('profilfoto'))) { ?>
                        <img src="<?php echo base_url('uploads/foto-profil/' . $this->session->userdata('profilfoto')); ?>" width="48" height="48" alt="User" />
                    <?php } else { ?>
                        <img src="<?php echo base_url('assets/admin-page'); ?>/images/user.png" width="48" height="48" alt="User" />
                    <?php } ?>
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo ucfirst($this->session->userdata('username')); ?></div>
                    <div class="email"><?php echo $this->session->userdata('email'); ?></div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            <li><a href="<?php echo site_url('akun'); ?>"><i class="material-icons">person</i>Akun</a></li>
                            <li><a href="<?php echo site_url('auth/logout'); ?>"><i class="material-icons">input</i>Sign Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="active"></li>
                    <li class="header">MAIN NAVIGATION</li>
                    <li>
                        <a href="<?php echo site_url('dashboard'); ?>">
                            <i class="material-icons">dashboard</i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <?php if ($this->session->userdata('role_active') == 2) { ?>
                        <li>
                            <a href="<?php echo site_url('data-diri'); ?>">
                                <i class="material-icons">school</i>
                                <span>Data diri</span>
                            </a>
                        </li>
                        <?php if ($this->session->userdata('menu_active') == TRUE) { ?>
                            <li>
                                <a href="<?php echo base_url('bursakerja'); ?>">
                                    <i class="material-icons">work</i>
                                    <span>Bursa Kerja</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('event'); ?>">
                                    <i class="material-icons">event</i>
                                    <span>Event</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('testimoni'); ?>">
                                    <i class="material-icons">record_voice_over</i>
                                    <span>Testimoni</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle">
                                    <i class="material-icons">forum</i>
                                    <span>Kritik & Saran</span>
                                </a>
                                <ul class="ml-menu">
                                    <li>
                                        <a href="<?php echo site_url('kritik'); ?>">Kritik</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo site_url('saran'); ?>">Saran</a>
                                    </li>
                                </ul>
                            </li>
                    <?php }
                    } ?>
                    <?php if ($this->session->userdata('role_active') == 1) { ?>
                        <li>
                            <a href="<?php echo base_url('data-angkatan'); ?>">
                                <i class="material-icons">group</i>
                                <span>Data Angkatan</span>
                            </a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="menu-toggle">
                                <i class="material-icons">settings</i>
                                <span>Manajemen</span>
                            </a>
                            <ul class="ml-menu">
                                <li>
                                    <a href="<?php echo site_url('kritik/m-kritik'); ?>">Kritik</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('saran/m-saran'); ?>">Saran</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('testimoni/m-testimoni'); ?>">Testimoni</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('bursakerja/m-bursakerja'); ?>">Bursa Kerja</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('event/m-event'); ?>">Event</a>
                                <li>
                                    <a href="<?php echo site_url('role'); ?>">Role</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('pengguna'); ?>">Pengguna</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="menu-toggle">
                                <i class="material-icons">public</i>
                                <span>Identitas</span>
                            </a>
                            <ul class="ml-menu">
                                <li>
                                    <a href="<?php echo site_url('situs'); ?>">Situs</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('kontak'); ?>">Kontak</a>
                                </li>
                            </ul>
                        </li>
                    <?php } ?>
                    <li>
                        <a href="<?php echo site_url('akun'); ?>">
                            <i class="material-icons">person</i>
                            <span>Akun</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('auth/logout'); ?>">
                            <i class="material-icons">input</i>
                            <span>Keluar</span>
                        </a>
                    </li>
                </ul>
            </div>
            <script>
                $(document).ready(function() {
                    /** add active class and stay opened when selected */
                    var url = window.location;

                    // for sidebar menu entirely but not cover treeview
                    $('ul.list a').filter(function() {
                        return this.href == url;
                    }).parent().siblings().removeClass('active').end().addClass('active');

                    // for treeview
                    $('ul.ml-menu a').filter(function() {
                        return this.href == url;
                    }).parentsUntil(".list > .ml-menu").siblings().removeClass('active').end().addClass('active');
                });
            </script>
            <!-- #Menu -->
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    Copyright &copy; <?php echo date('Y'); ?>. <a href="mailto:andhika6@gmail.com?subject=Tanya aplikasi Tracer Study">Andhika Putra Pratama</a>.
                </div>
                <div class="version">
                    Theme admin by : <b>AdminBSB</b> - Version: 1.0.5
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
    </section>

    <?php
    if (isset($content) && $content) {
        $this->load->view($content);
    }
    ?>

    <!-- Jquery Core Js -->
    <script src="<?php echo base_url('assets/admin-page'); ?>/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="<?php echo base_url('assets/admin-page'); ?>/plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <script src="<?php echo base_url('assets/admin-page'); ?>/plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="<?php echo base_url('assets/admin-page'); ?>/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="<?php echo base_url('assets/admin-page'); ?>/plugins/node-waves/waves.js"></script>

    <!-- Custom Js -->
    <script src="<?php echo base_url('assets/admin-page'); ?>/js/admin.js"></script>

    <!-- Demo Js -->
    <script src="<?php echo base_url('assets/admin-page'); ?>/js/demo.js"></script>

    <?php echo (isset($additional_body) ? $additional_body : ''); ?>
</body>

</html>