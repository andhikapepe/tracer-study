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
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="<?php echo base_url('assets/landing-page'); ?>/css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="<?php echo base_url('assets/landing-page'); ?>/css/mdb.min.css" rel="stylesheet">

  <?php echo (isset($additional_head) ? $additional_head : ''); ?>
  <style type="text/css">
    html,
    body,
    header,
    .jarallax {
      height: 100%;
    }

    @media (min-width: 560px) and (max-width: 740px) {

      html,
      body,
      header,
      .jarallax {
        height: 500px;
      }
    }

    @media (min-width: 800px) and (max-width: 850px) {

      html,
      body,
      header,
      .jarallax {
        height: 500px;
      }
    }

    @media (min-width: 800px) and (max-width: 850px) {
      .navbar:not(.top-nav-collapse) {
        background: #1C2A48 !important;
      }

      .navbar {
        box-shadow: 0 2px 5px 0 rgba(0, 0, 0, .16), 0 2px 10px 0 rgba(0, 0, 0, .12) !important;
      }
    }

    .map-container-5 {
      overflow: hidden;
      padding-bottom: 56.25%;
      position: relative;
      height: 0;
    }

    .map-container-5 iframe {
      left: 0;
      top: 0;
      height: 100%;
      width: 100%;
      position: absolute;
    }
  </style>
</head>

<body class="event-lp">
  <?php
  $this->load->view('alert');
  ?>
  <!--Navigation & Intro-->
  <header>
    <!--Navbar-->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark scrolling-navbar">
      <div class="container">
        <a class="navbar-brand" href="#">
          <strong><?php echo $_app_name; ?></strong>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <!--Links-->
          <ul class="navbar-nav mr-auto smooth-scroll">
            <li class="nav-item">
              <a class="nav-link" href="#home">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <?php if ($testimoni->num_rows()) { ?>
              <li class="nav-item">
                <a class="nav-link" href="#testimonials" data-offset="100">Testimoni</a>
              </li>
            <?php } ?>
          </ul>
          <!--Social Icons-->
          <ul class="navbar-nav nav-flex-icons">
            <li class="nav-item">
              <?php echo (!empty($kontak['facebook_url']) ? anchor($kontak['facebook_url'], '<i class="fab fa-facebook-f"></i>', 'class="nav-link"') : '<a href="#" class="nav-link"><i class="fab fa-facebook-f"></i></a>'); ?>
            </li>
            <li class="nav-item">
              <?php echo (!empty($kontak['twitter_url']) ? anchor($kontak['twitter_url'], '<i class="fab fab fa-twitter"></i>', 'class="nav-link"') : '<a href="#" class="nav-link"><i class="fab fab fa-twitter"></i></a>'); ?>
            </li>
            <li class="nav-item">
              <?php echo (!empty($kontak['instagram_url']) ? anchor($kontak['instagram_url'], '<i class="fab fa-instagram"></i>', 'class="nav-link"') : '<a href="#" class="nav-link"><i class="fab fa-instagram"></i></a>'); ?>
            </li>
            <?php if ($this->session->userdata('is_Logged') == TRUE) { ?>
              <li class="nav-item avatar dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-55" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <?php if (!empty($this->session->userdata('profilfoto'))) { ?>
                    <img src="<?php echo base_url('uploads/foto-profil/' . $this->session->userdata('profilfoto')); ?>" class="rounded-circle z-depth-0" alt="avatar image" />
                  <?php } else { ?>
                    <img src="<?php echo base_url('assets/admin-page'); ?>/images/user.png" class="rounded-circle z-depth-0" alt="avatar image" />
                  <?php } ?>
                </a>
                <div class="dropdown-menu dropdown-menu-lg-right dropdown-secondary" aria-labelledby="navbarDropdownMenuLink-55">
                  <a class="dropdown-item" href="dashboard">Dashboard</a>
                  <a class="dropdown-item" href="auth/logout">Logout</a>
                </div>
              </li>
            <?php } ?>
          </ul>
        </div>
      </div>
    </nav>
    <!--Navbar-->
    <!-- Intro Section -->
    <div id="home" class="view jarallax" data-jarallax='{"speed": 0.2}' style="background-image: url('<?php echo base_url('assets/landing-page/images/47088.jpg'); ?>'); background-repeat: no-repeat; background-size: cover; background-position: center center;">
      <div class="mask rgba-black-strong">
        <div class="container h-100 d-flex justify-content-center align-items-center">
          <div class="row smooth-scroll">
            <div class="col-md-12 white-text text-center">
              <div class="wow fadeInDown" data-wow-delay="0.2s">
                <h2 class="display-3 font-weight-bold mb-2"><?php echo $_app_name; ?></h2>
                <hr class="hr-light">
                <h3 class="subtext-header mt-4 mb-5"><?php echo $_app_slogan; ?></h3>
              </div>
              <a href="auth/register-user" data-offset="100" class="btn btn-info wow fadeInLeft" data-wow-delay="0.2s">Daftar</a>
              <a href="auth/login" data-offset="100" class="btn btn-warning wow fadeInRight" data-wow-delay="0.2s">Login</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
  <!--Navigation & Intro-->
  <!--Main content-->
  <main>
    <?php if ($testimoni->num_rows()) { ?>
      <div class="container-fluid background-r" id="testimonials">
        <div class="container py-3">
          <!-- Section: Testimonials v.2 -->
          <section class="text-center my-5">

            <!-- Section heading -->
            <h2 class="h1-responsive font-weight-bold my-5">Apa Kata Alumni</h2>

            <div class="wrapper-carousel-fix">
              <!-- Carousel Wrapper -->
              <div id="carousel-example-1" class="carousel no-flex testimonial-carousel slide carousel-fade" data-ride="carousel" data-interval="false">
                <!--Slides-->
                <div class="carousel-inner" role="listbox">
                  <?php
                  $count = 0;
                  foreach ($testimoni->result_array() as $val) {
                    $count++;
                    if ($count === 1) {
                      $class = 'active';
                    } else {
                      $class = '';
                    }
                    echo '<div class="carousel-item ' . $class . '">'; ?>
                    <div class="testimonial">
                      <!--Avatar-->
                      <div class="avatar mx-auto mb-4">
                        <img src="<?php echo (!empty($val['foto']) ? base_url('uploads/foto-profil/' . $val['foto'] . '') : base_url('assets/admin-page/images/user.png')); ?>" class="rounded-circle img-fluid" alt="First sample avatar image">
                      </div>
                      <!--Content-->
                      <p>
                        <i class="fas fa-quote-left"></i><?php echo ucfirst(htmlspecialchars($val['testimoni'], ENT_QUOTES, 'UTF-8')); ?>
                      </p>
                      <h4 class="font-weight-bold"><?php echo ucfirst(htmlspecialchars($val['username'], ENT_QUOTES, 'UTF-8')); ?></h4>
                      <h6 class="font-weight-bold my-3"><?php echo ucfirst(htmlspecialchars('Lulusan Tahun: ' . $val['tahun_lulus'], ENT_QUOTES, 'UTF-8')); ?></h6>
                      <!--Review-->
                      <i class="fas fa-star blue-text"> </i>
                      <i class="fas fa-star blue-text"> </i>
                      <i class="fas fa-star blue-text"> </i>
                      <i class="fas fa-star blue-text"> </i>
                      <i class="fas fa-star blue-text"> </i>
                    </div>
                </div>
              <?php } ?>
              </div>
              <!--Slides-->
              <!--Controls-->
              <a class="carousel-control-prev left carousel-control" href="#carousel-example-1" role="button" data-slide="prev">
                <span class="icon-prev" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next right carousel-control" href="#carousel-example-1" role="button" data-slide="next">
                <span class="icon-next" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
              <!--Controls-->
            </div>
            <!-- Carousel Wrapper -->
        </div>

        </section>
        <!-- Section: Testimonials v.2 -->
      </div>
      </div>
    <?php } ?>
  </main>
  <!--Main content-->

  <!--Footer-->

  <footer class="page-footer indigo darken-3 text-center text-md-left pt-5">

    <!--Footer Links-->
    <div class="container mb-3">

      <!--First row-->
      <div class="row">

        <!--First column-->
        <div class="col-md-4 mt-1 mb-1 wow fadeIn" data-wow-delay="0.3s">
          <!--About-->
          <h5 class="title mb-4 font-weight-bold">Tentang <?php echo $_app_name; ?></h5>

          <p align="justify">
            <?php echo $_app_name; ?> merupakan aplikasi berbasis web untuk melaksanakan pemetaan terhadap lulusan.
            Sistem digunakan untuk menjaring data dari para alumni yang belum atau telah bekerja, kuliah maupun berwirausaha,
            umumnya dilakukan cara mengisi kuisioner secara manual berupa pengiriman surat.
          </p>
          <p align="justify">
            Hasil dari pemetaan lulusan ini nantinya diharapkan dapat digunakan dalam penyusunan kurikulum
            yang berbasis pada kebutuhan terkini pada institusi dan sebagai salah satu syarat dalam akreditasi.
          </p>
          <!--/About -->

        </div>
        <!--/First column-->

        <hr class="w-100 clearfix d-md-none">

        <!--Second column-->
        <div class="col-lg-3 ml-lg-auto col-md-4 mt-1 mb-1 wow fadeIn" data-wow-delay="0.3s">
          <!--Search-->
          <h5 class="text-uppercase mb-4 font-weight-bold">Hubungi Kami</h5>

          <!--Info-->
          <p><i class="fas fa-home pr-1"></i> <?php echo (!empty($kontak['alamat']) ? $kontak['alamat'] : 'New York, NY 10012, US'); ?></p>
          <p><i class="fas fa-envelope pr-1"></i> <?php echo (!empty($kontak['email']) ? $kontak['email'] : 'info@example.com'); ?></p>
          <p><i class="fas fa-phone pr-1"></i> <?php echo (!empty($kontak['no_telp']) ? $kontak['no_telp'] : '+ 01 234 567 88'); ?></p>
          <p><i class="fas fa-print pr-1"></i> <?php echo (!empty($kontak['no_fax']) ? $kontak['no_fax'] : '+ 01 234 567 89'); ?></p>

        </div>
        <!--/Second column-->

        <hr class="w-100 clearfix d-md-none">

        <!--Third column-->
        <div class="col-lg-3 ml-lg-auto col-md-4 mt-1 mb-1 wow fadeIn" data-wow-delay="0.3s">
          <!--Contact-->
          <h5 class="text-uppercase mb-4 font-weight-bold">Peta Lokasi</h5>

          <!--Google map-->
          <div id="map-container-google-9" class="z-depth-1-half map-container-5" style="height: 300px">
            <?php echo (!empty($kontak['maps_iframe']) ? $kontak['maps_iframe'] : '
          <iframe src="https://maps.google.com/maps?q=manhatan&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0"
            style="border:0" allowfullscreen>
          </iframe>
          '); ?>
          </div>
          <!--Google Maps-->

        </div>
        <!--/Third column-->

      </div>
      <!--/First row-->

    </div>
    <!--/Footer Links-->

    <!--Copyright-->
    <div class="footer-copyright py-3 text-center">
      <div class="container-fluid">
        © 2019 Copyright: <a href="https://mdbootstrap.com/education/bootstrap/" target="_blank"> MDBootstrap.com </a>
      </div>
    </div>
    <!--/Copyright-->

  </footer>
  <!--/Footer-->

  <!--SCRIPTS-->

  <!--JQuery-->
  <script type="text/javascript" src="<?php echo base_url('assets/landing-page'); ?>/js/jquery-3.4.0.min.js"></script>

  <!--Bootstrap tooltips-->
  <script type="text/javascript" src="<?php echo base_url('assets/landing-page'); ?>/js/popper.min.js"></script>

  <!--Bootstrap core JavaScript-->
  <script type="text/javascript" src="<?php echo base_url('assets/landing-page'); ?>/js/bootstrap.min.js"></script>

  <!--MDB core JavaScript-->
  <script type="text/javascript" src="<?php echo base_url('assets/landing-page'); ?>/js/mdb.min.js"></script>
  <?php echo (isset($additional_body) ? $additional_body : ''); ?>
  <script>
    //Animation init
    new WOW().init();

    // Material Select Initialization
    $(document).ready(function() {
      $('.mdb-select').material_select();

    });
  </script>
  <?php if (isset($kontak['whatsapp_number'])) { ?>
    <!-- GetButton.io widget -->
    <script type="text/javascript">
      (function() {
        var options = {
          whatsapp: "<?php echo $kontak['whatsapp_number']; ?>", // WhatsApp number
          call_to_action: "Butuh Bantuan?", // Call to action
          position: "right", // Position may be 'right' or 'left'
        };
        var proto = document.location.protocol,
          host = "getbutton.io",
          url = proto + "//static." + host;
        var s = document.createElement('script');
        s.type = 'text/javascript';
        s.async = true;
        s.src = url + '/widget-send-button/js/init.js';
        s.onload = function() {
          WhWidgetSendButton.init(host, proto, options);
        };
        var x = document.getElementsByTagName('script')[0];
        x.parentNode.insertBefore(s, x);
      })();
    </script>
    <!-- /GetButton.io widget -->
  <?php } ?>
</body>

</html>