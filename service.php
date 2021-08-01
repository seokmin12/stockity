<?php 
    include 'php/inc_head.php';

    if (isset($_GET["page"])) {
        $page = $_GET["page"];
    } else {
        $page = 1;
    }
?>


<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>

    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->

    <link rel="stylesheet" href="css/service.css">
    <link rel="stylesheet" href="css/index.css">

    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
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
    <title>Service</title>
</head>

<body>
    <header id="header">
        <?php include 'header.php'; ?>
    </header>

    <?php include 'php/list.php' ?>
    <!-- <div id="loading" class="animated bounce">
        <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div> -->

</body>

</html>