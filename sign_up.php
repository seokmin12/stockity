<?php
    include 'php/inc_head.php';
    include 'php/conn.php';

    $email = $_POST['address'];

    $sql = "SELECT * FROM user_info WHERE id = '$email'";
    $ret = mysqli_query($conn, $sql);
    $exist = mysqli_num_rows($ret);
    //아이디 중복 체크
    if ($exist>0) {
        echo "<script>window.alert('해당 이메일을 사용할 수 없습니다.')</script>";
        echo "<script>location.href='index.php';</script>";
        exit();
    }else {
        
    }
?>


<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/sign_up.css">

    <script src="js/pw_chk.js?asd"></script>
    <script src="js/sign_up_null_chk.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <title>Sign up</title>
</head>
<body>
    <header id="header">
        <?php include 'header.php'; ?>
    </header>
    <div class="background">
    </div>
    <div class="main">
        <form action="php/sign_up_ok.php" method="post" onsubmit="return validate()">
            <table>
                <tr>
                    <td class="text">이메일: </td>
                    <td class="contents">
                        <input type="text" value="<?= $email ?>" name="address" id="address" readonly>
                    </td>
                </tr>
                <tr>
                    <td class="text">비밀번호: </td>
                    <td class="contents">
                        <input type="password" name="pw" id="pw" autocomplete="off">
                    </td>
                </tr>
                <tr>
                    <td class="text">비밀번호 확인: </td>
                    <td class="contents">
                        <input type="password" name="pw_chk" id="pw_chk" autocomplete="off">
                        <span id="alert-success" style="display: none;">비밀번호가 일치합니다.</span>
                        <span id="alert-danger" style="display: none; color: #d92742; font-weight: bold; ">비밀번호가 일치하지 않습니다.</span>
                    </td>
                </tr>
            </table>
            <div class="submit">
                <input type="submit" value="Sign up" id="sign_up">
            </div>
        </form>
    </div>
</body>
</html>