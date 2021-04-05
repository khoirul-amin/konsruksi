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
  <title>Konstruksi - <?php if(empty($title)){}else{echo $title;} ?></title>
  <!-- Favicon -->
  <link rel="icon" href="/assets/img/brand/favicon.png" type="image/png">
  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
  <!-- Icons -->
  <link rel="stylesheet" href="/assets/vendor/nucleo/css/nucleo.css" type="text/css">
  <link rel="stylesheet" href="/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
  <!-- Page plugins -->
  <!-- Argon CSS -->
  <link rel="stylesheet" href="/assets/css/argon.css?v=1.2.0" type="text/css">
  <!-- Data Table -->
  <link rel="stylesheet" href="/assets/vendor/sweetalert2/dist/sweetalert2.min.css">
  <link rel="stylesheet" href="/assets/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css" type="text/css">
</head>
<?php
  $session = $this->session->userdata();
?>
<body>
  <!-- Sidenav -->
  <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header  align-items-center">
        <a class="navbar-brand" href="/">
          <img src="/assets/img/brand/blue.png" class="navbar-brand-img" alt="...">
        </a>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link <?php if($this->uri->segment('2') == 'home'){echo 'active';} ?>" href="/user/home">
                <i class="ni ni-tv-2 text-primary"></i>
                <span class="nav-link-text">Dashboard</span>
              </a>
            </li>
            <?php if($session['userLogin']->role == 2 || $session['userLogin']->role == 1){?>
            <li class="nav-item">
              <a class="nav-link <?php if($this->uri->segment('2') == 'pelanggan'){echo 'active';} ?>" href="/user/pelanggan">
                <i class="fas fa-users text-green"></i>
                <span class="nav-link-text">Data Pelanggan</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php if($this->uri->segment('2') == 'karyawan'){echo 'active';} ?>" href="/user/karyawan">
                <i class="fas fa-users-cog text-warning"></i>
                <span class="nav-link-text">Data Karyawan</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php if($this->uri->segment('2') == 'kategori'){echo 'active';} ?>" 
                href="/user/kategori">
                <i class="fas fa-list text-green"></i>
                <span class="nav-link-text">Kategori RAB</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php if($this->uri->segment('2') == 'posts'){echo 'active';} ?>" 
                href="/user/posts">
                <i class="fas fa-paste text-primary"></i>
                <span class="nav-link-text">Posts</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link <?php if($this->uri->segment('2') == 'proyek'){echo 'active';} ?>" href="/user/proyek">
                <i class="fas fa-building text-primary"></i>
                <span class="nav-link-text">Data Proyek</span>
              </a>
            </li>
            <?php }; ?>
            <?php if($session['userLogin']->role == 3){?>
            <li class="nav-item">
              <a class="nav-link <?php if($this->uri->segment('2') == 'pesanan'){echo 'active';} ?>" href="/user/pesanan">
                <i class="fas fa-building text-primary"></i>
                <span class="nav-link-text">Data Pesanan</span>
              </a>
            </li>
            <?php }; ?>
            <li class="nav-item">
              <a class="nav-link <?php if($this->uri->segment('2') == 'setting'){echo 'active';} ?>" href="/user/setting">
                <i class="fas fa-cog text-default"></i>
                <span class="nav-link-text">Setting</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>