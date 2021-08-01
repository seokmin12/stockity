<?php 
    include 'php/inc_head.php';
?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/index.css">

    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="js/scrolldown.js"></script>
    <script src="js/contact.js"></script>
    <script src="js/sign_up.js"></script>
    <script src="js/search_yahoo.js"></script>
    <script src="js/modal.js"></script>
    <script>
        function login_chk() {
            var uid = "<?php echo $_SESSION['id'] ?>";
            if (uid == "") {
                alert('This service is only available to members\nPlease sign in');
                document.location.href = "sign_in.php"
            } else {
                document.location.href = "service.php"
            }
        }
    </script>
    <title>Stockity</title>
</head>

<body>
    <header id="header">
        <?php include 'header.php' ?>
    </header>
    <div class="wrap">
        <div class="background">
        </div>
        <?php if(!$user_login) { ?>
        <div class="sign_up">
            <h1>Sign Up Now!<br>Use Our Service!</h1>
            <form action="sign_up.php" method="post">
                <input type="email" id="address" name="address" placeholder="Email address" autocomplete="off">
                <input type="submit" id="sign_up" value="Sign up">
            </form>
        </div>
        <?php } else if ($user_login) { ?>
        <div class="sign_up">
            <h1>Search symbols!</h1>
            <input type="text" id="search_symbol" name="search" placeholder="Symbol for search" autocomplete="off">
        </div>
        <?php } ?>
    </div>
    <section class="row" id="about">
        <div class="col" id="col1">
            <div class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" class="bi bi-window"
                    viewBox="0 0 16 16" style="color: #0d6efd;">
                    <path
                        d="M2.5 4a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1zm2-.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm1 .5a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z" />
                    <path
                        d="M2 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2H2zm13 2v2H1V3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1zM2 14a1 1 0 0 1-1-1V6h14v7a1 1 0 0 1-1 1H2z" />
                </svg>
            </div>
            <h3>Fully Responsive</h3>
            <p>This service will look great on any device, no matter the size!</p>
        </div>
        <div class="col" id="col2">
            <div class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" class="bi bi-layers"
                    viewBox="0 0 16 16" style="color: #0d6efd;">
                    <path
                        d="M8.235 1.559a.5.5 0 0 0-.47 0l-7.5 4a.5.5 0 0 0 0 .882L3.188 8 .264 9.559a.5.5 0 0 0 0 .882l7.5 4a.5.5 0 0 0 .47 0l7.5-4a.5.5 0 0 0 0-.882L12.813 8l2.922-1.559a.5.5 0 0 0 0-.882l-7.5-4zm3.515 7.008L14.438 10 8 13.433 1.562 10 4.25 8.567l3.515 1.874a.5.5 0 0 0 .47 0l3.515-1.874zM8 9.433 1.562 6 8 2.567 14.438 6 8 9.433z" />
                </svg>
            </div>
            <h3>Made by 이석민</h3>
            <a href="https://github.com/seokmin12" target="_blank">https://github.com/seokmin12</a>
        </div>
        <div class="col" id="col3">
            <div class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor"
                    class="bi bi-terminal" viewBox="0 0 16 16" style="color: #0d6efd;">
                    <path
                        d="M6 9a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3A.5.5 0 0 1 6 9zM3.854 4.146a.5.5 0 1 0-.708.708L4.793 6.5 3.146 8.146a.5.5 0 1 0 .708.708l2-2a.5.5 0 0 0 0-.708l-2-2z" />
                    <path
                        d="M2 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2H2zm12 1a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V3a1 1 0 0 1 1-1h12z" />
                </svg>
            </div>
            <h3>Easy to Use</h3>
            <p>Ready to use with your own content, or customize the source files!</p>
        </div>
    </section>
    <div class="about">
        <div class="about_row">
            <div class="about_img" style="background-image: url('img/candle_chart.jpg'); order: 2;"></div>
            <div class="about_description">
                <p>This service was created from the question of how to make stocks easier.</p>
            </div>
        </div>
        <div class="about_row">
            <div class="about_img" style="background-image: url('img/coding.jpg');"></div>
            <div class="about_description">
                <p>This service recommends stocks every day by using AI.</p>
            </div>
        </div>
    </div>
    <div class="contact" id="contact">
        <h1>Contact Us</h1>
        <form action="contact.php" method="post">
            <input type="text" id="user_name" placeholder="Your Name" autocomplete="off">
            <input type="email" id="user_email" placeholder="Your Email" autocomplete="off">
            <textarea id="message" cols="30" rows="10" placeholder="Your Message" autocomplete="off"></textarea>
            <input type="submit" id="send" value="Send Message">
        </form>
    </div>


    <footer>
        <div class="footer">
            <p>Copyright © 2021 - Stockity</p>
        </div>
    </footer>
</body>

</html>