<?php
    include 'conn.php';
?>

<div class="container">
    <div id="board_area">
        <?php
            if($_SESSION['level'] == "Bronze"){
                include 'bronze_list.php'; 
        } ?>
        <?php
            if($_SESSION['level'] == "Silver") {
                include 'bronze_list.php'; 
                include 'silver_list.php';
        } ?>
    </div>
</div>