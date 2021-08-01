<head>
    <link rel="stylesheet" href="css/header.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
    
    <script src="js/toggle_btn.js"></script>
    <script src="js/user_menu.js"></script>
</head>

<nav>
    <div class="logo">
        <a href="index.php"><img src="img/stockity.png"></a>
    </div>
    <div class="navbar_content">
        <ul class="navbar_menu">
            <li class="navbar_item">
                <a href="#about" id="about_btn">About</a>
            </li>
            <li class="navbar_item">
                <a href="#contact" id="contact_btn">Contact</a>
            </li>
            <li class="navbar_item">
                <a href="" id="service" onclick="login_chk(); return false;">Go To Service</a>
                <input type="hidden" value="$SESSION_['id']" class="user_id">
            </li>
            <li class="navbar_item">
                <?php if($user_login) { ?>
                <p id="user_id">
                    <?php echo $_SESSION['id']; ?>
                </p>
                <div class="user_menu">
                    <p>Your level is:</p>
                    <h3><?php echo $_SESSION['level'] ?></h3>
                    <form action="php/get_money.php" method="post">
                        <input type="number" name="money" id="money" placeholder="Your Money ($)">
                        <input type="submit" value="submit" id="money_submit">
                    </form>
                    <a href='php/logout.php'><input type='button' value='Logout' id='logout'></a>
                </div>
                <?php } else if (!$user_login) { ?>
                <a href="sign_in.php">Sign in</a>
                <?php } ?>
            </li>
        </ul>
    </div>
    <i class="fas fa-bars" id="toggle_btn"></i>
</nav>