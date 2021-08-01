<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/sign_in.css">
    <title>Find my password</title>
</head>
<body>
    <header id="header">
        <?php include 'header.php' ?>
    </header>
    <div class="wrap">
        <div class="background">
        </div>
        <div class="sign_in">
            <form action="php/find_pw_ok.php" method="post">
                <input type="email" placeholder="Your Email Address" id="id" name="id" autocomplete="off">
                <input type="submit" value="Find Password" id="sign_in">
            </form>
        </div>
    </div>
</body>
</html>