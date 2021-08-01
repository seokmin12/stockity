<?php
    include 'conn.php';
    $id = $_POST['id'];

    $sql = "SELECT * FROM user_info WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $real_pw = $row['real_pw'];

    if($id==$row['id']) {
        echo "<script>window.alert('Your password is: $real_pw');</script>"; 
        echo "<script>location.href='../sign_in.php';</script>";
    } else {
        echo "<script>window.alert('아이디를 확인해 주세요');</script>"; 
        echo "<script>location.href='../find_pw.php';</script>";
    }
?>