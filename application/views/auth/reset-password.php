<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

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

<body class="signup-page">
    <div class="signup-box">
        <div class="logo">
            <a href="javascript:void(0);"><?php echo $_app_name; ?></a>
            <small><?php echo $_app_slogan; ?></small>
        </div>
        <div>
            <?php
            $this->load->view('./alert');
            ?>
        </div>
        <div class="card">
            <div class="body">
                <?php
                $code     = $this->input->get('code');
                $email    = $this->input->get('email');
                echo form_open('auth/reset-password?code=' . $code . '&email=' . $email . '', 'id="renew-password"') ?>
                <div class="msg">Perbarui Kata Sandi!</div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">lock</i>
                    </span>
                    <div class="form-line">
                        <?php echo form_input($password, '', 'class="form-control" minlength="5" placeholder="Kata Sandi" required') ?>
                    </div>
                </div>
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="material-icons">lock</i>
                    </span>
                    <div class="form-line">
                        <?php echo form_input($passconf, '', 'class="form-control" minlength="5" placeholder="Konfirmasi Kata Sandi" required') ?>
                    </div>
                </div>
                <?php echo form_submit('submit', 'Perbarui Kata Sandi', 'class="btn btn-block btn-lg bg-pink waves-effect"') ?>

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
    <script src="<?php echo base_url('assets/admin-page'); ?>/js/pages/examples/sign-up.js"></script>
</body>

</html>