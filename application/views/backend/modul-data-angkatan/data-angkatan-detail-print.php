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
    <link rel="icon" href="<?php echo (isset($_logo_website) ? base_url('assets/situs/' . $_logo_website) : base_url('assets/favicon.ico')); ?>" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="<?php echo base_url('assets/admin-page'); ?>/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
    <style type="text/css" media="print">
        @page {
            size: auto;
            margin: 0mm;
        }

        html {
            background-color: #FFFFFF;
            margin: 0px;
        }

        body {
            margin: 10mm 15mm 10mm 15mm;
        }
    </style>
</head>

<body onload="window.print(); return false">
    <div class="container-fluid">
        <div class="block-header" align="center">
            <h2>DATA LULUSAN TAHUN ANGKATAN <?php echo htmlspecialchars($this->uri->segment(3), ENT_QUOTES, 'UTF-8'); ?></h2>
            <small><?php echo $_app_name . ' - ' . $_app_slogan; ?></small>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Jurusan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($table as $val) {
                    ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo htmlspecialchars($val->username, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($val->email, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($val->prodi, ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($val->status, ENT_QUOTES, 'UTF-8'); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Bootstrap Core Js -->
    <script src="<?php echo base_url('assets/admin-page'); ?>/plugins/bootstrap/js/bootstrap.js"></script>
</body>

</html>