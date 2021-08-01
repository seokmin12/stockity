<head>
    <script>
        $(document).ready(function () {
            $("#keyword").keyup(function () {
                var k = $(this).val().toUpperCase();
                $(".table > tbody > tr").hide();
                var temp = $(".table > tbody > tr > td:nth-child(5n+1):contains('" + k + "')");

                $(temp).parent().show();
            })
        })
    </script>
</head>
<div class="table">
    <div class="sub">
        <h1 id="page_num"><?= $page ?>page</h1>
        <input type="text" name="keyword" id="keyword" autocomplete="off" placeholder="Search for symbol">
    </div>
    <div class="main">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>symbol</th>
                    <th>now_price</th>
                    <th>target_price</th>
                    <th>predict_price</th>
                    <th>money</th>
                    <th>can_buy_stock_amount</th>
                    <th>profit</th>
                    <th>pre_market_price</th>
                    <th>predict</th>
                </tr>
            </thead>

            <tbody>
                <?php 

        $page_sql = mysqli_query($conn, "SELECT * FROM nasdaq_stock;");
        $total_record = mysqli_num_rows($page_sql);

        $list = 20;
        $block_cnt = 5;
        $block_num = ceil($page / $block_cnt);

        $block_start = (($block_num - 1) * $block_cnt) + 1;
        $block_end = $block_start + $block_cnt - 1;

        $total_page = ceil($total_record / $list);
        if($block_end > $total_page)
            $block_end = $total_page;

        $total_block = ceil($total_page / $block_cnt);
        $page_start = ($page - 1) * $list;

    ?>
                <?php
        $nasdaq_sql = "SELECT * FROM nasdaq_stock number LIMIT $page_start, $list;";

        $nasdaq_result = mysqli_query($conn, $nasdaq_sql);

        while($nasdaq_row = mysqli_fetch_array($nasdaq_result)) {
            $symbol = $nasdaq_row['symbol'];
            $now_price = $nasdaq_row['now_price'];
            $target_price = $nasdaq_row['target_price'];
            $predict_price = $nasdaq_row['predict_price'];
            $pre_market_price = $nasdaq_row['pre_market_price'];
            $predict = $nasdaq_row['predict'];
    ?>
                <tr>
                    <td id="symbol">
                        <?= '<a href="https://finance.yahoo.com/quote/'.$symbol.'" target="_blank">'.$symbol.'</a>' ?>
                    </td>
                    <td>
                        <?= $now_price ?>
                    </td>
                    <td>
                        <?= $target_price ?>
                    </td>
                    <td>
                        <?= $now_price + $predict_price ?>
                    </td>
                    <td id="money">
                        <?= $_SESSION['money'] ?>
                    </td>
                    <td id="can_buy_stock_amount">
                        <?php $can_buy_stock_amount = floor($_SESSION['money'] / $now_price);
                            echo $can_buy_stock_amount;
                        ?>
                    </td>
                    <td id="profit">
                        <?php 
                            if($target_price * $can_buy_stock_amount == 0) {
                                $profit = "<span style='font-weight: bold;'>0.0</span>";
                                echo $profit;
                            }else {
                                $profit = round(($now_price + round($predict_price, 3)) * $can_buy_stock_amount / ($target_price * $can_buy_stock_amount) * 100 - 100, 3);
                            }

                            $profit_price = ($target_price - $now_price) * $can_buy_stock_amount;

                            if($profit > 0) {
                                echo "<span style='color: red; font-weight: bold;'>$profit% (+$$profit_price)</span>";
                            } elseif($profit < 0) {
                                echo "<span style='color: blue; font-weight: bold;'>$profit% (-$$profit_price)</span>";
                            }
                        ?>
                    </td>
                    <td>
                        <?= $pre_market_price ?>
                    </td>
                    <td>
                        <?php 
                            if($can_buy_stock_amount == 0) {
                                echo "You Can't Buy It";
                            }elseif($predict_price > 0 && $can_buy_stock_amount != 0) {
                                echo "It will be increased";
                            }elseif($predict_price < 0) {
                                echo "It will be decreased";
                            }

                        ?>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <div id="page_num">
            <?php
            if ($page <= 1) {
                //빈 값
            } else {
                echo "<a id='paging' href='service.php?page=1'>처음</a>";
            }
            if ($page <= 1) {
                //빈 값
            } else {
                $pre = $page - 1;
                echo "<a id='paging' href='service.php?page=$pre'>◀ 이전</a>";
            }
            for ($i = $block_start; $i <= $block_end; $i++) {
                if ($page == $i) {
                    echo "<b> $i </b>";
                } else {
                    echo "<a id='paging' href='service.php?page=$i'> $i </a>"; 
                }                            
            }
            if ($page >= $total_page) {
                //빈 값
            } else {
                $next = $page + 1;
                echo "<a id='paging' href='service.php?page=$next'> 다음 ▶</a>";
            }
            if ($page >= $total_page) {
                //빈 값
            } else {
                echo "<a id='paging' href='service.php?page=$total_page'>마지막</a>";
            }
        ?>
        </div>
    </div>
</div>