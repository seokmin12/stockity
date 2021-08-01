<?php
    include 'conn.php';

    $email = $_POST['address'];
    $user_pw = $_POST['pw'];
    $pw = password_hash($user_pw, PASSWORD_DEFAULT);
    $pw_chk = $_POST['pw_chk'];

    if($user_pw != $pw_chk) {
        echo "<script>window.alert('비밀번호가 일치하지 않습니다.')</script>";
        echo "<script>window.history.back();</script>";
        exit();
    }


    $insert_sql = "INSERT INTO user_info (id, real_pw, pw, level, created) VALUES ('$email','$user_pw', '$pw', 'Bronze', NOW())";

    $result = mysqli_query($conn, $insert_sql);
    if($result === false) {
        echo "<script>window.alert('저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요')</script>";
        echo "<script>location.href='../index.php'</script>";
     
        error_log($mysqli_error($conn));
     } else {
         echo "<script>window.alert('가입 되었습니다. 로그인 해주세요.')</script>";
         echo "<script>location.href='../sign_in.php';</script>";
     }

?>