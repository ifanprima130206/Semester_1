<?php
    session_start();
    include "../../../App/config.php";
    $id = $_GET['id'];
    $result = mysqli_query($connect, "DELETE FROM product WHERE id=$id");
    if ($result) {
        $_SESSION['message'] = "Product data has been successfully deleted";
        header("location:index.php");
    } else {
        $_SESSION['error_message'] = "Product data failed to delete";
        header("location:index.php");
    }
?>