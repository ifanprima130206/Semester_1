<?php
ob_start(); 
$page = "order";
?>
<?php include('../Layout/header.php'); ?>

<?php
    $user_id = $_SESSION['user_id'];
    $user = mysqli_query($connect, "SELECT * FROM users WHERE id='$user_id'");
    $rowUser = mysqli_fetch_assoc($user);

    if ($rowUser['role'] == '1') {
        $result_set = mysqli_query($connect ,"SELECT order_product.*, product.name as product_name, users.name as userName FROM order_product JOIN product ON order_product.product_id = product.id JOIN users ON order_product.user_id = users.id");
    } else {
        $result_set = mysqli_query($connect ,"SELECT order_product.*, product.name as product_name, users.name as userName FROM order_product JOIN product ON order_product.product_id = product.id JOIN users ON order_product.user_id = users.id WHERE user_id = '$user_id'");
    }
?>


<div class="row">
    <div class="col-md-12">
        <?php include('../Layout/alert.php') ?>
    </div>
    <div class="col-12 my-2">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="myTable">
                        <thead>
                            <tr>
                                <th>No Resi</th>
                                <th>Name</th>
                                <th>Telphone</th>
                                <th>Product</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1; 
                            while ($result = mysqli_fetch_array($result_set)) {
                            ?>
                                <tr>
                                    <td><?php echo $result['id'] ?></td>
                                    <td class="text-nowrap"><?php echo $result['userName']; ?></td>
                                    <td class="text-nowrap"><?php echo $result['no_telp']; ?></td>
                                    <td class="text-nowrap"><?php echo $result['product_name']; ?></td>
                                    <td class="text-nowrap">
                                        <?php if($result['status'] == '0'): ?>
                                            <span class="badge bg-warning">Process</span>
                                        <?php elseif($result['status'] == '1'): ?>    
                                            <span class="badge bg-primary">Delivered</span>
                                        <?php else: ?>    
                                            <span class="badge bg-success">Done</span>
                                        <?php endif; ?>    
                                    </td>
                                    <td>
                                        <div class="btn-group dropstart">
                                            <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                <em class="bx bx-dots-vertical-rounded"></em>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <?php if($rowUser['role'] == '1'): ?>

                                                    <?php if($result['status'] == '0'): ?>
                                                    <li>
                                                        <a href="status.php?id=<?= $result['id'] ?>" class="dropdown-item py-2" id="edit">Delivered</a>
                                                    </li>
                                                    <?php elseif($result['status'] == '1'): ?>
                                                    <li>
                                                        <a href="status.php?id=<?= $result['id'] ?>" class="dropdown-item py-2" id="edit">Done</a>
                                                    </li>
                                                    <?php else: ?>
                                                    <li>
                                                        <span class="badge bg-success">Done</span>
                                                    </li>
                                                    <?php endif; ?>

                                                <?php else: ?>

                                                    <li>
                                                        <a href="receipt.php?id=<?= $result['id'] ?>" class="dropdown-item py-2" id="edit">Order Receipt</a>
                                                    </li>

                                                <?php endif; ?>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            <?php 
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
ob_end_flush();
include('../Layout/footer.php'); 
?>
