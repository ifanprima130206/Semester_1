<?php
    session_start();
    include($_SERVER['DOCUMENT_ROOT'] . '/App/config.php');

    $id = $_GET['id'];
    $user_id = $_SESSION['user_id'];

    // Fetch user details
    $user_query = "SELECT * FROM users WHERE id='$user_id'";
    $user_result = mysqli_query($connect, $user_query);
    $rowUser = mysqli_fetch_assoc($user_result);

    // Fetch order details
    $order_query = "SELECT order_product.*, product.name as product_name, product.price as product_price, users.name as userName 
                    FROM order_product 
                    JOIN product ON order_product.product_id = product.id 
                    JOIN users ON order_product.user_id = users.id 
                    WHERE order_product.id = '$id'";
    $result_set = mysqli_query($connect, $order_query);
    $order_data = mysqli_fetch_assoc($result_set);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembelian - Mentari Bakery</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .struk {
            max-width: 400px;
            margin: 20px auto;
            padding: 10px;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .info {
            margin-bottom: 10px;
        }
        .info span {
            font-weight: bold;
        }
        .produk-info {
            margin-top: 10px;
        }
        .produk-info table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .produk-info th, .produk-info td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="struk">
        <h1>Mentari Bakery</h1>

        <div class="info">
            <p><span>Nama Pembeli:</span> <?= $order_data['userName'] ?></p>
            <p><span>Alamat:</span> <?= $order_data['address'] ?></p>
            <p><span>Nomor Telepon:</span> <?= $order_data['no_telp'] ?></p>
        </div>

        <div class="produk-info">
            <h2>Detail Pesanan</h2>
            <table>
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?= $order_data['product_name'] ?></td>
                        <td><?= $order_data['quantity'] ?></td>
                        <td>Rp. <?= $order_data['product_price'] ?></td>
                    </tr>
                </tbody>
            </table>

            <div class="info">
                <p><span>Total:</span>Rp. <?= $order_data['total'] ?></p>
                <p><span>Status:</span> 
                <?php if ($order_data['status'] == '0') {
                    echo 'Process';
                } elseif($order_data['status'] == '1') {
                    echo 'Delivered';
                } else {
                    echo 'Done';
                } ?>
                </p>
                <p><span>Waktu Pemesanan:</span> <?= $order_data['created_at'] ?></p>
            </div>
        </div>
    </div>
</body>
</html>
