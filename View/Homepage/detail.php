<?php
    session_start();
    $page = "Product";
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
    $base_url = $protocol . "://" . $_SERVER['HTTP_HOST'] . "/";

    include($_SERVER['DOCUMENT_ROOT'] . '/App/config.php');

    $id = $_GET['id'];
    $result_set = mysqli_query($connect ,"SELECT product.*, category.name as category_name 
              FROM product 
              JOIN category ON product.category_id = category.id
              WHERE product.id = $id");
    $row = mysqli_fetch_assoc($result_set);
    
    if (isset($_POST['checkout'])) {
      $user_id = $_SESSION['user_id'];
      
      $quantity = $_POST['quantity'];
      $total = $_POST['total'];
      $no_telp = $_POST['no_telp'];
      $address = $_POST['address'];
      
      
      $result = mysqli_query($connect, "INSERT INTO order_product (user_id, product_id, address, no_telp, quantity, total, status) VALUES ('$user_id', '$id', '$address', '$no_telp', '$quantity', '$total', '0')");
      
      if ($row['stock'] > 0) {
        
        $new_stock = $row['stock'] - $quantity;
        
        mysqli_query($connect, "UPDATE product SET stock = $new_stock WHERE id = $id");
        
      }
      
      if ($result) {
          $_SESSION['message'] = "User saved successfully";
          header("location:product.php");
      } else {
          $_SESSION['error_message'] = "User failed to save";
          header("location:product.php");
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
<div class="wrapper bg-gray overflow-hidden">
    <div class="container px-xl-4 pt-6 pb-10">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <img src="<?= $base_url ?>Public/assets/upload/product/<?= $row['image'] ?>" style="height: 300px;width: 100%;border-radius: 15px;" alt="" srcset="">
                        <p><a href="product.php" class="btn btn-secondary mt-4">Back </a> <button class="btn btn-primary mt-4" data-bs-toggle="modal" data-bs-target="#orderModal">
                          <?php if ($row['stock'] > 0): ?>
                            Order Now
                          <?php else: ?>
                            Pre Order
                          <?php endif; ?>
                        </button></p>
                    </div>
                    <div class="col-md-6">
                        <h4><?= $row['name'] ?> <span class="badge bg-success"><?= $row['category_name'] ?></span> <span class="badge bg-primary">Available : <?= $row['stock'] ?></span></h4>
                        <p class="font-size: 14px;" class="text-secondary">Rp. <?= $row['price'] ?></p>
                        <p style="text-align: justify;"><?= $row['description'] ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
  <?php if(isset($_SESSION['login']) !== TRUE): ?>
    <div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <form action="" method="post">
            <div class="modal-body">
              <div class="row">
                <h4>Harap <a href="Auth/login.php">Login</a> Terlebih dahulu sebelum melakukan order!</h4>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  <?php else: ?>
    <div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <form action="" method="post">
            <div class="modal-body">
              <div class="row">
                <div class="col-md-6">
                  <img src="<?= $base_url ?>Public/assets/upload/product/<?= $row['image'] ?>" alt="" style="height: 200px;width: 100%;">
                </div>
                <div class="col-md-6">
                  <h4><?= $row['name'] ?> <span class="badge bg-success"><?= $row['category_name'] ?></span> <span class="badge bg-primary">Available : <?= $row['stock'] ?></span></h4>
                  <p class="font-size: 14px;" class="text-secondary">Rp. <?= $row['price'] ?></p>
                      <input type="number" required class="form-control mb-2" placeholder="Quantity" name="quantity" id="quantity" min="0" max="<?= $row['stock'] ?>">
                      <input type="number" required class="form-control mb-2" placeholder="Total" name="total" id="total" readonly>
                </div>
                <div class="col-md-12">
                  <input type="text" name="no_telp" id="no_telp" required class="form-control mb-2" placeholder="Telphone Number"></input>
                </div>
                <div class="col-md-12">
                  <textarea name="address" id="address" cols="30" rows="3" required class="form-control" placeholder="Address"></textarea>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" name="checkout">Checkout</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  <?php endif; ?>

<!-- your existing head content -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function () {
        var price = <?= $row['price'] ?>;
        
        $("#quantity").on("input", function () {

            var quantity = $(this).val();

            if (quantity == 0 || quantity == '') {
              
              var total = '';
            } else {

              var total = price * quantity + 5000;
            }

            $("#total").val(total);
        });
    });
</script>


<?php include('Layout/footbar.php') ?>