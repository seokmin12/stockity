<div class="table">
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

            <?php 
                $vip_sql = "SELECT * FROM nasdaq_stock";
                $vip_nasdaq_result = mysqli_query($conn, $vip_sql);

                while($vip_nasdaq_row = mysqli_fetch_array($vip_nasdaq_result)) {
                $vip_symbol = $vip_nasdaq_row['symbol'];
                $vip_now_price = $vip_nasdaq_row['now_price'];
                $vip_target_price = $vip_nasdaq_row['target_price'];
                $vip_predict_price = $vip_nasdaq_row['predict_price'];
                $vip_pre_market_price = $vip_nasdaq_row['pre_market_price'];
                $vip_predict = $vip_nasdaq_row['predict'];

                $vip_can_buy_stock_amount = floor($_SESSION['money'] / $vip_now_price);

                if($vip_target_price * $vip_can_buy_stock_amount == 0) {
                    $vip_profit = '0.0';
                }else {
                    $vip_profit = round(($vip_now_price + round($vip_predict_price, 3)) * $vip_can_buy_stock_amount / ($vip_target_price * $vip_can_buy_stock_amount) * 100 - 100, 3);
                }

                if($vip_profit > 20) {
            ?>
            <tr>
                <td>
                    <?= '<a href="https://finance.yahoo.com/quote/'.$vip_symbol.'" target="_blank">'.$vip_symbol.'</a>' ?>
                </td>
                <td>
                    <?= $vip_now_price ?>
                </td>
                <td>
                    <?= $vip_target_price ?>
                </td>
                <td>
                    <?= $vip_now_price + $vip_predict_price ?>
                </td>
                <td id="money">
                    <?= $_SESSION['money'] ?>
                </td>
                <td id="can_buy_stock_amount">
                    <?php
                            echo $vip_can_buy_stock_amount;
                        ?>
                </td>
                <td id="profit">
                    <?php 
                            $vip_profit_price = ($vip_target_price - $vip_now_price) * $vip_can_buy_stock_amount;
                            echo "<span style='color: red; font-weight: bold;'>$vip_profit% (+$$vip_profit_price)</span>"
                        ?>
                </td>
                <td>
                    <?= $vip_pre_market_price ?>
                </td>
                <td>
                    <?php 
                            if($vip_can_buy_stock_amount == 0) {
                                echo "You Can't Buy It";
                            }elseif($vip_predict_price > 0 && $vip_can_buy_stock_amount != 0) {
                                echo "It will be increased";
                            }elseif($vip_predict_price < 0) {
                                echo "It will be decreased";
                            }
                        ?>
                </td>
            </tr>
            <?php 
                }
            } ?>
        </table>
    </div>
</div>