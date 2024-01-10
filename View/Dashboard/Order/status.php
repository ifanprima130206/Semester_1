<?php
    session_start();
    include($_SERVER['DOCUMENT_ROOT'] . '/App/config.php');
    $id = $_GET['id'];
    $order_query = "SELECT * FROM order_product WHERE id = '$id'";
    
    $order_result = mysqli_query($connect, $order_query);
    $order_data = mysqli_fetch_assoc($order_result);

    $current_status = $order_data['status'];

    if ($current_status < 2) {

        $new_status = $current_status + 1;
    } else {
        
        $new_status = 2;
    }

    $result = "UPDATE order_product SET status = '$new_status' WHERE id = '$id'";
    mysqli_query($connect, $result);

    if ($result) {
        $_SESSION['message'] = "Order updated successfully";
        header("location:index.php");
    } else {
        $_SESSION['error_message'] = "Order failed to update";
        header("location:index.php");
    }
?>
