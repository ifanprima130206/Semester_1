<?php
    $connect = mysqli_connect('localhost', 'root', '', 'stt_tokoroti');

    if (!$connect) {
        die("Connection failed: " . mysqli_connect_error());
    }

    function read($table) {
        global $connect;

        $data = mysqli_query($connect, "SELECT * FROM $table");
        return $data;
    }

    function countRows($table) {
        global $connect;

        $result = mysqli_query($connect, "SELECT COUNT(*) AS total_rows FROM $table");
        $row = mysqli_fetch_assoc($result);

        return $row['total_rows'];
    }
?>
