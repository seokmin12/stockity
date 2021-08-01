<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/sign_in.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="js/sign_in.js"></script>
    <script>
        function login_chk() {
            var uid = "<?php echo $_SESSION['id'] ?>";
            if(uid == "") {
                alert('This service is only available to members\nPlease sign in');
                document.location.href = "sign_in.php"
            } else {
                document.location.href = "service.php"
            }
        }
    </script>
    <title>Sign In</title>
</head>

<body>
    <header id="header">
        <?php include 'header.php' ?>
    </header>
    <div class="wrap">
        <div class="background">
        </div>
        <div class="sign_in">
            <fieldset>
                <h1>Sign in to stockity</h1>
                <form action="php/sign_in_ok.php" method="post">
                    <input type="email" placeholder="Email address" autocomplete="off" id="id" name="id">
                    <input type="password" placeholder="Password" autocomplete="off" id="pw" name="pw">
                    <input type="submit" value="Sign in" id="sign_in">
                </form>
                <div class="lost">
                    <a href="find_pw.php">Forgot password?</a>
                </div>
            </fieldset>
        </div>
    </div>
</body>

</html>