<!--
=========================================================
* Argon Dashboard - v1.2.0
=========================================================
* Product Page: https://www.creative-tim.com/product/argon-dashboard


* Copyright  Creative Tim (http://www.creative-tim.com)
* Coded by www.creative-tim.com



=========================================================
* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
  <meta name="author" content="Creative Tim">
  <title>Jasa Konstruksi Bangunan</title>
  <!-- Bootstrap CSS -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?=base_url()?>assets/css/bootstrap/bootstrap.css" type="text/css">
  <link rel="stylesheet" href="<?=base_url()?>assets/css/custom-landing.css" type="text/css">
  <link rel="stylesheet" href="<?=base_url()?>assets/vendor/sweetalert2/dist/sweetalert2.min.css">
  <link rel="icon" href="<?=base_url()?>assets/img/brand/favicon.png" type="image/png">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <link rel="stylesheet" href="<?=base_url()?>assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
  <style>

  </style>
</head>
<body>
  <header>
    
  <nav class="navbar navbar-expand-lg navbar-dark pt-3 pb-3" <?php if(!empty($style)){echo $style;} ?> >
    <div class="container">
      <a class="navbar-brand" href="/">
        <img src="<?=base_url()?>assets/img/brand/white.png" width="100px" alt="">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse w-100 justify-content-end" id="navbarSupportedContent">
          <ul class="navbar-nav" style="margin-right:120px;">
            <li class="nav-item mr-4 <?php if($this->uri->segment(1) == 'pemesanan'){echo 'active';}; ?>">
              <a class="nav-link" href="/pemesanan">Pemesanan</a>
            </li>
            <li class="nav-item mr-4 <?php if($this->uri->segment(1) == 'kontak'){echo 'active';}; ?>">
              <a class="nav-link" href="/kontak">Kontak</a>
            </li>
            <li class="nav-item mr-4  <?php if($this->uri->segment(1) == 'tentangkami'){echo 'active';}; ?>">
              <a class="nav-link" href="/tentangkami">Tentang Kami</a>
            </li>
          </ul>
          <div class="">
            <a href="/pesanan" class="btn mr-lg-4 text-white"><i class="fas fa-shopping-bag"></i></a>
            <a href="/register" class="btn btn-outline-warning mr-lg-4 text-white">Sign Up</a>
            <a href="/login" class="btn btn-warning text-white">Sign In</a>
          </div>
      </div>
    </div>
  </nav>

  </header>