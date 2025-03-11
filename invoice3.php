<?php include("config.php");
session_start();
$cart_id = $_GET['cart_id'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Invoice No: <?php echo $cart_id ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="./assets/css/style.css">
        <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
        <style>
            *,
            *::after,
            *::before{
                padding: 0;
                margin: 0;
                box-sizing: border-box;
            }

            :root{
                --success-color: #28c76f;
                --danger-color: rgb(241, 8, 8);
                --blue-color: #0c2f54;
                --dark-color: #535b61;
                --white-color: #fff;
            }

            ul{
                list-style-type: none;
            }
            ul li{
                margin: 2px 0;
            }

            .success{
                color: var(--success-color);
            }
            .danger{
                color: var(--danger-color);
            }
            /* text colors */
            .text-dark{
                color: var(--dark-color);
            }
            .text-blue{
                color: var(--blue-color);
            }
            .text-end{
                text-align: right;
            }
            .text-center{
                text-align: center;
            }
            .text-start{
                text-align: left;
            }
            .text-bold{
                font-weight: 700;
            }
            /* hr line */
            .hr{
                height: 1px;
                background-color: rgba(0, 0, 0, 0.1);
            }
            /* border-bottom */
            .border-bottom{
                border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            }

            body{
                font-family: 'Poppins', sans-serif;
                color: var(--dark-color);
                font-size: 14px;
            }
            .invoice-wrapper{
                min-height: 100vh;
                background-color: rgba(0, 0, 0, 0.1);
                padding-top: 20px;
                padding-bottom: 20px;
            }
            .invoice{
                max-width: 850px;
                margin-right: auto;
                margin-left: auto;
                background-color: var(--white-color);
                padding: 70px;
                border: 1px solid rgba(0, 0, 0, 0.2);
                border-radius: 5px;
                min-height: 920px;
            }
            .invoice-head-top-left img{
                width: 130px;
            }
            .invoice-head-top-right h3{
                font-weight: 500;
                font-size: 27px;
                color: var(--blue-color);
            }
            .invoice-head-middle, .invoice-head-bottom{
                padding: 16px 0;
            }
            .invoice-body{
                border: 1px solid rgba(0, 0, 0, 0.1);
                border-radius: 4px;
                overflow: hidden;
            }
            .invoice-body table{
                border-collapse: collapse;
                border-radius: 4px;
                width: 100%;
            }
            .invoice-body table td, .invoice-body table th{
                padding: 12px;
            }
            .invoice-body table tr{
                border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            }
            .invoice-body table thead{
                background-color: rgba(0, 0, 0, 0.02);
            }
            .invoice-body-info-item{
                display: grid;
                grid-template-columns: 80% 20%;
            }
            .invoice-body-info-item .info-item-td{
                padding: 12px;
                background-color: rgba(0, 0, 0, 0.02);
            }
            .invoice-foot{
                padding: 30px 0;
            }
            .invoice-foot p{
                font-size: 12px;
            }
            .invoice-btns{
                margin-top: 20px;
                display: flex;
                justify-content: center;
            }
            .invoice-btn{
                padding: 3px 9px;
                color: var(--dark-color);
                font-family: inherit;
                border: 1px solid rgba(0, 0, 0, 0.1);
                cursor: pointer;
            }

            .invoice-head-top, .invoice-head-middle, .invoice-head-bottom{
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                padding-bottom: 10px;
            }

            @media screen and (max-width: 992px){
                .invoice{
                    padding: 40px;
                }
            }

            @media screen and (max-width: 576px){
                .invoice-head-top, .invoice-head-middle, .invoice-head-bottom{
                    grid-template-columns: repeat(1, 1fr);
                }
                .invoice-head-bottom-right{
                    margin-top: 12px;
                    margin-bottom: 12px;
                }
                .invoice *{
                    text-align: left;
                }
                .invoice{
                    padding: 28px;
                }
            }

            .overflow-view{
                overflow-x: scroll;
            }
            .invoice-body{
                min-width: 600px;
            }

            @media print{
                .print-area{
                    visibility: visible;
                    width: 100%;
                    position: absolute;
                    left: 0;
                    top: 0;
                    overflow: hidden;
                }

                .overflow-view{
                    overflow-x: hidden;
                }

                .invoice-btns{
                    display: none;
                }
            }
        </style>
    </head>
    <body>

        <div class = "invoice-wrapper" id = "print-area">
            <div class = "invoice">
                <div class = "invoice-container">
                    <div class = "invoice-head">
                        <?php
                        $sql = "SELECT o.*,a.ad_id,a.ad_name,a.ad_telephone
                        FROM orders o
                        INNER JOIN admin a ON o.seller = a.ad_id
                        WHERE o.cart_id = '$cart_id'
                        ";
                        $result = mysqli_query($con, $sql) or die(mysqli_error($con));
                        $row = mysqli_fetch_assoc($result)?>
                        <div class = "invoice-head-top">
                            <div class = "invoice-head-top-left text-start">
                                <h1>POS</h1>
                            </div>
                            <div class = "invoice-head-top-right text-end">
                                <h3>Invoice</h3>
                            </div>
                        </div>
                        <div class = "hr"></div>
                        <div class = "invoice-head-middle">
                            <div class = "invoice-head-middle-left text-start">
                                <p><span class = "text-bold">Date</span>: <?php $order_date = date("d/m/Y", strtotime($row['order_date'])); echo $order_date; ?></p>
                            </div>
                            <div class = "invoice-head-middle-right text-end">
                                <p><spanf class = "text-bold">Invoice No:</span> <?php echo $cart_id ?></p>
                            </div>
                        </div>
                        <div class = "hr"></div>
                        <div class = "invoice-head-bottom">
                            <div class = "invoice-head-bottom-left">
                                <ul>
                                    <li class = 'text-bold'>Invoiced By:</li>
                                    <li><?php echo $row['admin_name']; ?></li>
                                    <li><?php echo $row['ad_telephone']; ?></li>
                                    <!-- <li>United Kingdom</li> -->
                                </ul>
                            </div>
                            <div class = "invoice-head-bottom-right">
                                <ul class = "text-end">
                                    <li class = 'text-bold'>Pay To:</li>
                                    <li>Walk in Customer</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class = "overflow-view">
                        <div class = "invoice-body">
                            <table>
                                <thead>
                                    <tr>
                                        <td class = "text-bold">Product</td>
                                        <td class = "text-bold">Price</td>
                                        <td class = "text-bold">QTY</td>
                                        <td class = "text-bold text-end">Amount</td>
                                        <td class = "text-bold text-end">Status</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $sql_items = "SELECT oi.cart_id, oi.product_id, oi.customer_id, oi.item_quantity, oi.item_status, o.cart_id,o.status,o.approuve_date,o.grand_total, p.product_name, p.product_price, p.main_image
                                                FROM order_items oi
                                                INNER JOIN orders o ON o.cart_id = oi.cart_id
                                                INNER JOIN products p ON oi.product_id = p.product_id
                                                WHERE oi.cart_id = '$cart_id'";
                                        $result_items = mysqli_query($con, $sql_items) or die(mysqli_error($con));
                                        while ($row_items = mysqli_fetch_assoc($result_items)) {
                                            $TotalPrice = 0;
                                            $qtt = $row_items['item_quantity'];
                                            $pcart_id = $row_items['cart_id'];
                                            $pproduct_id = $row_items['product_id'];
                                            $prix = $row_items['product_price'];
                                            $total_price = $prix * $qtt;
                                            // Add the current item's total price to the totalPrice variable
                                            $TotalPrice += $total_price;
                                            $status = $row_items['item_status'];
                                            if($status =='Completed'){
                                                $color = 'success';
                                            }else{
                                                $color = 'danger';
                                            }
                                    ?>
                                    <tr>
                                        <td><?php echo $row_items['product_name']; ?></td>
                                        <td>$<?php echo $prix; ?></td>
                                        <td><?php echo $qtt; ?></td>
                                        <td class = "text-end">$<?php echo $total_price; ?></td>
                                        <td class = "text-end">
                                            <?php
                                                echo '<p class="'. $color. '" aria-label="view">'. $status. '</p>';
                                            ?>
                                        </td>
                                    </tr>
                                    <?php }?>
                                    <!-- <tr>
                                        <td colspan="4">10</td>
                                        <td>$500.00</td>
                                    </tr> -->
                                </tbody>
                            </table>
                            <div class = "invoice-body-bottom">
                                <div class = "invoice-body-info-item border-bottom">
                                    <div class = "info-item-td text-end text-bold">Sub Total:</div>
                                    <div class = "info-item-td text-end">$<?php echo $row['grand_total']; ?></div>
                                </div>
                                <div class = "invoice-body-info-item border-bottom">
                                    <div class = "info-item-td text-end text-bold">Tax:</div>
                                    <div class = "info-item-td text-end">$0</div>
                                </div>
                                <div class = "invoice-body-info-item">
                                    <div class = "info-item-td text-end text-bold">Total:</div>
                                    <div class = "info-item-td text-end">$<?php echo $row['grand_total']; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class = "invoice-foot text-center">
                        <p><span class = "text-bold text-center">NOTE:&nbsp;</span>This is computer generated receipt and does not require physical signature.</p>

                        <div class = "invoice-btns">
                            <button type ="button" class ="invoice-btn" onclick="printInvoice()">
                                <span>
                                    <i class="fa-solid fa-print"></i>
                                </span>
                                <span>Print</span>
                            </button>
                            <button type = "button" class = "invoice-btn">
                                <span>
                                    <i class="fa-solid fa-download"></i>
                                </span>
                                <span>Download</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <script>
            function printInvoice(){
                window.print();
            }
        </script>

          <script src="./assets/js/script.js" defer></script>
  <!-- 
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    </body>
</html>