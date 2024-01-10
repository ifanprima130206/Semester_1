<?php $page = "dashboard"?>
<?php include('View/Dashboard/Layout/header.php'); ?>

<?php

    $user_count = countRows('users');
    $product_count = countRows('product');
    $order_count = countRows('order_product');
    $category_count = countRows('category');
    
?>
<?php 
    if (isset($_SESSION['message'])) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">'
            . $_SESSION['message'] .
            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        unset($_SESSION['message']);
    }

?>
<div class="row">
    <div class="col-md-3">
        <div class="card bg-primary">
            <div class="card-body">
                <h6 style="float: right;"><a class="text-white" href="<?= $base_url . 'View/Dashboard/User/index.php' ?>">See All</a></h6>
                <h5 class="text-white">User</h5>
                <h4 class="text-white"><em class="bx bx-user"></em> <?= $user_count ?></h4>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-secondary">
            <div class="card-body">
                <h6 style="float: right;"><a class="text-white" href="<?= $base_url . 'View/Dashboard/User/index.php' ?>">See All</a></h6>
                <h5 class="text-white">Category</h5>
                <h4 class="text-white"><em class="bx bx-user"></em> <?= $category_count ?></h4>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-warning">
            <div class="card-body">
                <h6 style="float: right;"><a class="text-white" href="<?= $base_url . 'View/Dashboard/User/index.php' ?>">See All</a></h6>
                <h5 class="text-white">Product</h5>
                <h4 class="text-white"><em class="bx bx-user"></em> <?= $product_count ?></h4>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-success">
            <div class="card-body">
                <h6 style="float: right;"><a class="text-white" href="<?= $base_url . 'View/Dashboard/User/index.php' ?>">See All</a></h6>
                <h5 class="text-white">Order</h5>
                <h4 class="text-white"><em class="bx bx-user"></em> <?= $order_count ?></h4>
            </div>
        </div>
    </div>
</div>

<?php include('View/Dashboard/Layout/footer.php'); ?>