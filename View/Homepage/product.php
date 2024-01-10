<?php
    $page = 'Product';
    include('Layout/navbar.php'); 
    $product = read('product');
?>

<div class="wrapper bg-gray overflow-hidden">
    <div class="container px-xl-4 pt-6 pb-10">
        <div class="row">
            <?php while($result = mysqli_fetch_array($product)) { ?>
                <div class="col-md-4 mb-2">
                    <div class="card">
                        <img class="card-img-top" style="object-fit: cover; height: 250px; width: 100%;" src="<?= $base_url ?>Public/assets/upload/product/<?= $result['image'] ?>" alt="" />
                        <div class="card-body">
                            <h6><?= $result['name'] ?></h6>
                            <p style="font-size: 14px;" class="text-secondary">Rp. <?= $result['price'] ?></p>
                            
                            <?php 
                                $shortDescription = substr($result['description'], 0, 100);
                            ?>
                                 <p><?= $shortDescription ?><a href="detail.php?id=<?= $result['id'] ?>">.....</a></p>
                            <div class="row">
                                <div class="col-sm-6">
                                    <a href="detail.php?id=<?= $result['id'] ?>" class="w-100 btn btn-primary btn-sm">Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<?php include('Layout/footbar.php'); ?>
