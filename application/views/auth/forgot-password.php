<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
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
</head>

<body class="fp-page">
    <div class="fp-box">
        <div class="logo">
            <a href="javascript:void(0);"><?php echo $_app_name; ?></a>
            <small><?php echo $_app_slogan; ?></small>
        </div>
        <div class="card">
            <div class="body">
                <?php
                $this->load->view('alert');
                ?>
                <?php echo form_open('auth/forgot-password', 'id="forgot_password"'); ?>
                <div class="msg">
                    Masukkan alamat surel yang telah anda daftarkan. Kami akan mengirimkan surel yang berisi tautan untuk me-reset kata sandi.
                </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">email</i>
                    </span>
                    <div class="form-line">
                        <?php echo form_input($email, '', 'class="form-control" placeholder="Masukkan Alamat Surel" required autofocus'); ?>
                    </div>
                </div>
                <?php echo form_submit('reset-akun', 'Reset Kata Sandi', 'class="btn btn-block btn-lg bg-pink waves-effect"'); ?>

                <div class="row m-t-20 m-b--5 align-center">
                    <a href="login">Login</a>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="<?php echo base_url('assets/admin-page'); ?>/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="<?php echo base_url('assets/admin-page'); ?>/plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="<?php echo base_url('assets/admin-page'); ?>/plugins/node-waves/waves.js"></script>

    <!-- Validation Plugin Js -->
    <script src="<?php echo base_url('assets/admin-page'); ?>/plugins/jquery-validation/jquery.validate.js"></script>

    <!-- Custom Js -->
    <script src="<?php echo base_url('assets/admin-page'); ?>/js/admin.js"></script>
    <script src="<?php echo base_url('assets/admin-page'); ?>/js/pages/examples/forgot-password.js"></script>
</body>

</html>