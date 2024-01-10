<?php
    session_start();

    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
    $base_url = $protocol . "://" . $_SERVER['HTTP_HOST'] . "/";

    $_SESSION = array();

    session_destroy();

    header("Location: ".  $base_url);
    exit();
?>
