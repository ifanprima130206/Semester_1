<?php
    session_start();
    include "../../../App/config.php";
    $id = $_GET['id'];
    $result = mysqli_query($connect, "DELETE FROM users WHERE id=$id");
    if ($result) {
        $_SESSION['message'] = "User data has been successfully deleted";
        header("location:index.php");
    } else {
        $_SESSION['error_message'] = "User data failed to delete";
        header("location:index.php");
    }
?>