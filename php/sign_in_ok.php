<?php

session_start(); // 세션

include 'conn.php';

$id = $_POST['id'];
$pw = $_POST['pw'];
$sql = "SELECT * FROM user_info WHERE id='$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$password_hash = $row['pw'];

if ($id==$row['id'] && password_verify($pw, $password_hash)) {
   $_SESSION['id']=$row['id'];
   $_SESSION['level']=$row['level'];
   echo "<script>location.href='../index.php';</script>";
} else {
   echo "<script>window.alert('잘못된 아이디 또는 비밀번호 입니다.');</script>"; // 잘못된 아이디 또는 비빌번호 입니다
   echo "<script>location.href='../sign_in.php';</script>";
};

// if(isset($id) && isset($pw)){
//    if($id == "admin" && $pw == "admin"){
//        session_start();
//        // session 변수에 아이디를 저장해서 인증처리하고
//        // 인증된 사용자에게 보여줄 컨텐츠를 노출한다
//        $_SESSION['name'] = 'manager';
//        $_SESSION['id'] = $id;
//        header("Location: ../admin/admin.php");
//        exit();
//    }
// }

?>