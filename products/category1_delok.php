<?php

    include '../include/dbcon.inc.php';

    if(!isset($_POST['is_ajax'])) exit;
    if(!isset($_POST['idx'])) exit;

    $is_ajax = $_POST['is_ajax'];
    $varIdx = trim($_POST['idx']);

    if (!$conn -> query("DELETE FROM category1 WHERE idx=$varIdx")) {
        exit;

        // if (!mysqli_query($conn, $strQuery)) {
        //     die('Error: ' . mysqli_error($conn));
        // }

    }
    else {
        echo "success";	
    }
?>