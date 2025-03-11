<?php require 'config.php'; require 'session.php';
$cart_id = $_GET['cart_id'];
?>
<!doctype html>
<html lang="fr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Custom Style -->
    <link rel="stylesheet" href="invoice.css">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

    <title>Invoice_n°_<?php echo $cart_id;?></title>
</head>

<body>
    <div class="my-5 page" size="A4" id="print-area">
        <div class="p-5">
            <?php
            $sql = "SELECT o.*,a.ad_id,a.ad_name,a.ad_telephone
            FROM orders o
            INNER JOIN admin a ON o.seller = a.ad_id
            WHERE o.cart_id = '$cart_id'
            ";
            $result = mysqli_query($con, $sql) or die(mysqli_error($con));
            $row = mysqli_fetch_assoc($result);
            $order_date = date("d/m/Y", strtotime($row['order_date']));
            ?>
            <section class="top-content bb d-flex justify-content-between">
                <div class="logo">
                    <h1>POS</h1>
                </div>
                <div class="top-left">
                    <div class="graphic-path">
                        <p>Invoice</p>
                    </div>
                    <div class="position-relative">
                        <p>Invoice No. <span><?php echo $cart_id ?></span></p>
                    </div>
                </div>
            </section>

            <section class="store-user mt-5">
                <div class="col-12">
                    <div class="row bb pb-3">
                        <div class="col-6">
                            <p>Supplier:</p>
                            <h6><?php echo $row['ad_name']; ?></h6>
                            <p class="address"> 777 Brockton Avenue, <br> Abington MA 2351, <br>Vestavia Hills AL </p>
                            <div class="txn mt-2">TXN: XXXXXXX</div>
                        </div>
                        <div class="col-6">
                            <p>Client:</p>
                            <h6>Walk in Customer</h6>
                            <p class="address"> 777 Brockton Avenue, <br> Abington MA 2351, <br>Vestavia Hills AL </p>
                            <div class="txn mt-2">TXN: XXXXXXX</div>
                        </div>
                    </div>
                    <div class="row extra-info pt-3">
                        <div class="col-7">
                            <p>Payment Method: <span>bKash</span></p>
                            <p>Order Number: <span>#<?php echo $row['transaction_id']; ?></span></p>
                        </div>
                        <div class="col-5">
                            <p>Deliver Date: <span><?php echo $order_date; ?></span></p>
                        </div>
                    </div>
                </div>
            </section>

            <section class="product-area mt-4">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <td>Item</td>
                            <td>Price</td>
                            <td>Quantity</td>
                            <td>Total</td>
                            <td>Status</td>
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
                            <td>
                                <div class="media">
                                    <img class="mr-3 img-fluid" src="assets/img/product/<?php echo $row_items['main_image']; ?>" alt="Product 01">
                                    <div class="media-body">
                                        <p class="mt-0 title"><?php echo $row_items['product_name']; ?></p>
                                        <!-- Cras sit amet nibh libero, in gravida nulla. -->
                                    </div>
                                </div>
                            </td>
                            <td><?php echo $prix; ?>$</td>
                            <td><?php echo $qtt; ?></td>
                            <td><?php echo $total_price; ?>$</td>
                            <td>
                                <?php
                                    echo '<h6 class="'. $color. '" aria-label="view">'. $status. '</h6>';
                                ?>
                            </td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </section>

            <section class="balance-info">
                <div class="row">
                    <div class="col-8">
                        <p class="m-0 font-weight-bold"> Note: </p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. In delectus, adipisci vero est dolore praesentium.</p>
                    </div>
                    <div class="col-4">
                        <table class="table border-0 table-hover">
                            <tr>
                                <td>Sub Total:</td>
                                <td><?php echo $row['grand_total']; ?>$</td>
                            </tr>
                            <tr>
                                <td>Tax:</td>
                                <td>0$</td>
                            </tr>
                            <tr>
                                <td>Deliver:</td>
                                <td>0$</td>
                            </tr>
                            <tfoot>
                                <tr>
                                    <td>Total:</td>
                                    <td><?php echo $row['grand_total']; ?>$</td>
                                </tr>
                            </tfoot>
                        </table>

                        <!-- Signature -->
                        <div class="col-12">
                            <img src="signature.png" class="img-fluid" alt="">
                            <p class="text-center m-0"> Director Signature </p>
                        </div>
                    </div>
                </div>
            </section>
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

    <script>
        function printInvoice(){
            window.print();
        }
    </script>
    <!-- ionicon link -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>