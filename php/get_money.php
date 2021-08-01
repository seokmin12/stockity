<?php
    session_start();

    $money = $_POST['money'];
    $_SESSION['money'] = $money;

    if($_SESSION['money'] == true){
        echo "<script>window.alert('Your Money is saved.');</script>";
        echo "<script>location.href='../index.php';</script>";
    } else {
        echo "<script>window.alert('Insert your money!');</script>";
        echo "<script>location.href='../index.php';</script>";
    }
?>