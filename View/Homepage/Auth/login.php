<?php
    session_start();
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
    $base_url = $protocol . "://" . $_SERVER['HTTP_HOST'] . "/";

    include($_SERVER['DOCUMENT_ROOT'] . '/App/config.php');

    if (isset($_POST['login'])){
        $email = $_POST['email'];
        $password = md5($_POST['password']);

        $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
        $result = $connect->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            $_SESSION['login'] = TRUE;
            $_SESSION['user_id'] = $row['id'];

            $_SESSION['message'] = "Login successfully";
            if ($row['role'] == '1') {

              header("Location: ../../../index.php");
            }else{
              header("Location: ../../../View/Dashboard/Order/index.php");
            }
            exit();
        } else {
            $_SESSION['error_message'] = "Failed to login";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="An impressive and flawless site template that includes various UI elements and countless features, attractive ready-made blocks and rich pages, basically everything you need to create a unique and professional website.">
  <meta name="keywords" content="bootstrap 5, business, corporate, creative, gulp, marketing, minimal, modern, multipurpose, one page, responsive, saas, sass, seo, startup, html5 template, site template">
  <meta name="author" content="elemis">
  <title>Mentari Bakery - Register</title>
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
    <section class="wrapper bg-dark text-white">
      <div class="container pt-18 pt-md-20 pb-21 pb-md-21 text-center">
        <div class="row">
          <div class="col-lg-8 mx-auto">
            <h1 class="display-1 text-white mb-3">Sign In</h1>
            <nav class="d-inline-block" aria-label="breadcrumb">
              <ol class="breadcrumb text-white">
                <li class="breadcrumb-item"><a href="../index.php" class="nav-link hover">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Sign In</li>
              </ol>
            </nav>
            <!-- /nav -->
          </div>
          <!-- /column -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container -->
    </section>
    <section class="wrapper bg-light">
        <div class="container pb-14 pb-md-16">
        <div class="row">
            <div class="col mt-n19">
            <div class="card shadow-lg">
                <div class="row gx-0 text-center">
                <div class="col-lg-6 image-wrapper bg-image bg-cover rounded-top rounded-lg-start d-none d-md-block" data-image-src="<?= $base_url ?>Public/assets/homepage/img/photos/tm3.jpg">
                </div>
                <!--/column -->
                <div class="col-lg-6">
                    <div class="p-10 p-md-11 p-lg-13">
                    <?php include('../../Dashboard/Layout/alert.php') ?>
                    <h2 class="mb-3 text-start">Welcome Back</h2>
                    <p class="lead mb-6 text-start">Fill your email and password to sign in.</p>
                    <form action="" method="post" class="text-start mb-3">
                        <div class="form-floating mb-4">
                        <input type="email" class="form-control" name="email" placeholder="Email" id="loginEmail">
                        <label for="loginEmail">Email</label>
                        </div>
                        <div class="form-floating password-field mb-4">
                        <input type="password" name="password" class="form-control" placeholder="Password" id="loginPassword">
                        <span class="password-toggle"><i class="uil uil-eye"></i></span>
                        <label for="loginPassword">Password</label>
                        </div>
                        <button type="submit" name="login" class="btn btn-primary rounded-pill btn-login w-100 mb-2">Sign In</button>
                    </form>
                    <!-- /form -->
                    <p class="mb-1"></p>
                    <p class="mb-0">Don't have an account? <a href="register.php" class="hover">Sign up</a></p>
                    <div class="divider-icon my-4">or</div>
                    <nav class="nav social justify-content-center text-center">
                        <a href="#" class="btn btn-circle btn-sm btn-google"><i class="uil uil-google"></i></a>
                        <a href="#" class="btn btn-circle btn-sm btn-facebook-f"><i class="uil uil-facebook-f"></i></a>
                        <a href="#" class="btn btn-circle btn-sm btn-twitter"><i class="uil uil-twitter"></i></a>
                    </nav>
                    <!--/.social -->
                    </div>
                    <!--/div -->
                </div>
                <!--/column -->
                </div>
                <!--/.row -->
            </div>
            <!-- /.card -->
            </div>
            <!-- /column -->
        </div>
        <!-- /.row -->
        </div>
        <!-- /.container -->
    </section>
    <!-- /section -->
</div>
<!-- /.content-wrapper -->
<footer class="bg-gray">
    <div class="container pt-13 pb-7">
      <div class="d-md-flex align-items-center justify-content-between">
        <p class="mb-2 mb-lg-0">© 2024 Mentari Bakery. All rights reserved.</p>
        <nav class="nav social social-muted mb-0 text-md-end">
          <a href="#"><i class="uil uil-twitter"></i></a>
          <a href="#"><i class="uil uil-facebook-f"></i></a>
          <a href="#"><i class="uil uil-dribbble"></i></a>
          <a href="#"><i class="uil uil-instagram"></i></a>
          <a href="#"><i class="uil uil-youtube"></i></a>
        </nav>
        <!-- /.social -->
      </div>
    </div>
    <!-- /.container -->
</footer>
<div class="progress-wrap">
<svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
    <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
</svg>
</div>
<script src="<?= $base_url ?>Public/assets/homepage/js/plugins.js"></script>
<script src="<?= $base_url ?>Public/assets/homepage/js/theme.js"></script>
</body>
</html>