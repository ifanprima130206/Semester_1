<?php
    session_start();
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
    $base_url = $protocol . "://" . $_SERVER['HTTP_HOST'] . "/";

    include($_SERVER['DOCUMENT_ROOT'] . '/App/config.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="An impressive and flawless site template that includes various UI elements and countless features, attractive ready-made blocks and rich pages, basically everything you need to create a unique and professional website.">
  <meta name="keywords" content="bootstrap 5, business, corporate, creative, gulp, marketing, minimal, modern, multipurpose, one page, responsive, saas, sass, seo, startup, html5 template, site template">
  <meta name="author" content="elemis">
  <title>Mentari Bakery - <?= $page ?></title>
  <link rel="shortcut icon" href="<?= $base_url ?>Public/assets/homepage/img/favicon.png">
  <link rel="stylesheet" href="<?= $base_url ?>Public/assets/homepage/css/plugins.css">
  <link rel="stylesheet" href="<?= $base_url ?>Public/assets/homepage/css/style.css">
  <link rel="stylesheet" href="<?= $base_url ?>Public/assets/homepage/css/colors/yellow.css">
  <link rel="preload" href="<?= $base_url ?>Public/assets/homepage/css/fonts/urbanist.css" as="style" onload="this.rel='stylesheet'">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <style>
    @media (min-width: 992px) {
      .navbar-nav>.nav-item>.nav-link {
        position: relative;
      }

      .navbar-nav>.nav-item+.nav-item>.nav-link:before {
        content: "";
        display: block;
        position: absolute;
        width: 3px;
        height: 3px;
        top: 50%;
        left: -2px;
        background: rgba(0, 0, 0, 0.25);
        border-radius: 50%;
      }
    }
  </style>
</head>

<body class="onepage">
  <div class="content-wrapper">
    <header class="wrapper bg-gray">
      <nav class="navbar navbar-expand-lg extended extended-alt navbar-light navbar-bg-light">
        <div class="container flex-lg-column">
          <div class="topbar d-flex flex-row justify-content-lg-center align-items-center">
            <div class="navbar-brand"><a href="./index.html"><h4>Mentari Bakery</h4></a></div>
          </div>
          <!-- /.d-flex -->
          <div class="navbar-collapse-wrapper bg-white d-flex flex-row align-items-center justify-content-between">
            <div class="navbar-other w-100 d-none d-lg-block">
              <nav class="nav social social-muted">
                <a href="#"><i class="uil uil-twitter"></i></a>
                <a href="#"><i class="uil uil-facebook-f"></i></a>
                <a href="#"><i class="uil uil-instagram"></i></a>
              </nav>
              <!-- /.social -->
            </div>
            <!-- /.navbar-other -->
            <div class="navbar-collapse offcanvas offcanvas-nav offcanvas-start">
              <div class="offcanvas-header d-lg-none">
                <h3 class="text-white fs-30 mb-0">Mentari Bakery</h3>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
              </div>
              <div class="offcanvas-body d-flex flex-column h-100">
                <ul class="navbar-nav">
                  <li class="nav-item"><a class="nav-link <?= ($page == 'Home') ? 'active' : '' ?>" href="index.php">Home</a></li>
                  <li class="nav-item"><a class="nav-link <?= ($page == 'Product') ? 'active' : '' ?>" href="product.php">Product</a></li>
                  <li class="nav-item"><a class="nav-link <?= ($page == 'Gallery') ? 'active' : '' ?>" href="#portfolio">Gallery</a></li>
                  <li class="nav-item"><a class="nav-link <?= ($page == 'About') ? 'active' : '' ?>" href="#testimonials">About</a></li>
                </ul>
                <!-- /.navbar-nav -->
                <div class="offcanvas-footer d-lg-none">
                  <div>
                    <a href="mailto:first.last@email.com" class="link-inverse">info@email.com</a>
                    <br /> 00 (123) 456 78 90 <br />
                    <nav class="nav social social-white mt-4">
                      <a href="#"><i class="uil uil-twitter"></i></a>
                      <a href="#"><i class="uil uil-facebook-f"></i></a>
                      <a href="#"><i class="uil uil-dribbble"></i></a>
                      <a href="#"><i class="uil uil-instagram"></i></a>
                      <a href="#"><i class="uil uil-youtube"></i></a>
                    </nav>
                    <!-- /.social -->
                  </div>
                </div>
                <!-- /.offcanvas-footer -->
              </div>
            </div>
            <!-- /.navbar-collapse -->
            <div class="navbar-other w-100 d-flex">
              <ul class="navbar-nav flex-row align-items-center ms-auto">
                <li class="nav-item">
                  <?php if (isset($_SESSION['login']) == TRUE) { ?>
                    <a href="<?= $base_url ?>" class="nav-link"><i class='bx bx-laptop mt-2'></i></a></li>
                    <a href="<?= $base_url ?>View/Homepage/Auth/logout.php" class="nav-link"><i class='bx bx-log-out-circle mt-2'></i></a></li>
                  <?php } else { ?>
                    <a href="<?= $base_url ?>View/Homepage/Auth/login.php" class="nav-link"><i class='bx bx-log-in-circle mt-2'></i></a></li>
                  <?php } ?>
                <li class="nav-item d-lg-none">
                  <button class="hamburger offcanvas-nav-btn"><span></span></button>
                </li>
              </ul>
              <!-- /.navbar-nav -->
            </div>
            <!-- /.navbar-other -->
          </div>
          <!-- /.navbar-collapse-wrapper -->
        </div>
        <!-- /.container -->
      </nav>
      <!-- /.navbar -->
    </header>
    <!-- /header -->