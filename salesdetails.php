<?php require 'config.php'; require 'session.php';
$cart_id = $_GET['cart_id'];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="POS - Bootstrap Admin Template">
    <meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, invoice, html5, responsive, Projects">
    <meta name="author" content="Dreamguys - Bootstrap Admin Template">
    <meta name="robots" content="noindex, nofollow">
    <title>POS /Sale Details</title>

    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="assets/css/animate.css">

    <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">

    <link rel="stylesheet" href="assets/css/dataTables.bootstrap4.min.css">

    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div id="global-loader">
<div class="whirly-loader"> </div>
</div>

<div class="main-wrapper">

    <!--Header --->
    <?php include('header.php');?>
    <!--Header --->
    <!--Sidebar --->
    <?php include('sidebar.php');?>
    <!--Sidebar --->
    <?php
    $sql_main = "SELECT oi.*,o.cart_id,o.grand_total,c.customer_id,c.customer_name,c.customer_email,c.customer_mobile,c.customer_address,p.product_id,p.product_name,p.product_price,p.main_image,o.status
    FROM order_items oi
    INNER JOIN customers c ON c.customer_id = oi.customer_id
    INNER JOIN products p ON p.product_id = oi.product_id
    INNER JOIN orders o ON o.cart_id = oi.cart_id
    WHERE oi.cart_id = '$cart_id'
    ";
    $result_main = mysqli_query($con, $sql_main) or die(mysqli_error($con));
    $row_main = mysqli_fetch_assoc($result_main)?>
    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Sale Details</h4>
                    <h6>View sale details</h6>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="card-sales-split">
                        <h2>Sale Detail : <?php echo $cart_id;?></h2>
                        <ul>
                            <li>
                            <a href="editsales.php?cart_id=<?php echo $cart_id; ?>"><img src="assets/img/icons/edit.svg" alt="img"></a>
                            </li>
                            <li>
                            <a href="javascript:void(0);"><img src="assets/img/icons/pdf.svg" alt="img"></a>
                            </li>
                            <li>
                            <a href="javascript:void(0);"><img src="assets/img/icons/excel.svg" alt="img"></a>
                            </li>
                            <li>
                            <a href="javascript:void(0);"><img src="assets/img/icons/printer.svg" alt="img"></a>
                            </li>
                        </ul>
                    </div>
                    <div class="invoice-box table-height" style="max-width: 1600px;width:100%;overflow: auto;margin:15px auto;padding: 0;font-size: 14px;line-height: 24px;color: #555;">
                        <table cellpadding="0" cellspacing="0" style="width: 100%;line-height: inherit;text-align: left;">
                            <tbody>
                                <tr class="top">
                                    <td colspan="6" style="padding: 5px;vertical-align: top;">
                                        <table style="width: 100%;line-height: inherit;text-align: left;">
                                            <tbody>
                                                <tr>
                                                    <td style="padding:5px;vertical-align:top;text-align:left;padding-bottom:20px">
                                                    <font style="vertical-align: inherit;margin-bottom:25px;"><font style="vertical-align: inherit;font-size:14px;color:#7367F0;font-weight:600;line-height: 35px; ">Customer Info</font></font><br>
                                                    <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"> <?php echo $row_main['customer_name'];?></font></font><br>
                                                    <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"> <a href="mailto:<?php echo $row_main['customer_email'];?>" class="__cf_email__" data-cfemail=""><?php echo $row_main['customer_email'];?></a></font></font><br>
                                                    <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"> <?php echo $row_main['customer_mobile'];?></font></font><br>
                                                    <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"> <?php echo $row_main['customer_address'];?></font></font><br>
                                                    </td>
                                                    <td style="padding:5px;vertical-align:top;text-align:left;padding-bottom:20px">
                                                    <font style="vertical-align: inherit;margin-bottom:25px;"><font style="vertical-align: inherit;font-size:14px;color:#7367F0;font-weight:600;line-height: 35px; ">Company Info</font></font><br>
                                                    <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"> DGT </font></font><br>
                                                    <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"> <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="9ffefbf2f6f1dffae7fef2eff3fab1fcf0f2">[email&#160;protected]</a></font></font><br>
                                                    <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;">6315996770</font></font><br>
                                                    <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"> 3618 Abia Martin Drive</font></font><br>
                                                    </td>
                                                    <td style="padding:5px;vertical-align:top;text-align:left;padding-bottom:20px">
                                                    <font style="vertical-align: inherit;margin-bottom:25px;"><font style="vertical-align: inherit;font-size:14px;color:#7367F0;font-weight:600;line-height: 35px; ">Invoice Info</font></font><br>
                                                    <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"> Reference </font></font><br>
                                                    <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"> Payment Status</font></font><br>
                                                    <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"> Status</font></font><br>
                                                    </td>
                                                    <td style="padding:5px;vertical-align:top;text-align:left;padding-bottom:20px">
                                                    <font style="vertical-align: inherit;margin-bottom:25px;"><font style="vertical-align: inherit;font-size:14px;color:#7367F0;font-weight:600;line-height: 35px; ">&nbsp;</font></font><br>
                                                    <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#000;font-weight: 400;"><?php echo $cart_id;?> </font></font><br>
                                                    <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#2E7D32;font-weight: 400;"> Paid</font></font><br>
                                                    <font style="vertical-align: inherit;"><font style="vertical-align: inherit;font-size: 14px;color:#2E7D32;font-weight: 400;"> <?php echo $row_main['status'];?></font></font><br>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>

                                <tr class="heading" style="background: #F3F2F7;">
                                <td>
                                Product Name
                                </td>
                                <td>
                                QTY
                                </td>
                                <td>
                                Price
                                </td>
                                <td>
                                Discount
                                </td>
                                <td>
                                TAX
                                </td>
                                <td>
                                Subtotal
                                </td>
                                <td>
                                Status
                                </td>
                                </tr>

                                <?php
                                $sql = "SELECT oi.*,o.cart_id,o.grand_total,c.customer_id,c.customer_name,p.product_id,p.product_name,p.product_price,p.main_image
                                FROM order_items oi
                                INNER JOIN customers c ON c.customer_id = oi.customer_id
                                INNER JOIN products p ON p.product_id = oi.product_id
                                INNER JOIN orders o ON o.cart_id = oi.cart_id
                                WHERE oi.cart_id = '$cart_id'
                                ";
                                $result = mysqli_query($con, $sql) or die(mysqli_error($con));
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $TotalPrice = 0; // Variable to store the total price
                                    $product_id = $row['product_id'];
                                    $qtt = $row['item_quantity'];
                                    $prix = $row['product_price'];
                                    $subtotal = $prix * $qtt;
                                    $grand_total = $row['grand_total'];
                                ?>
                                    <tr class="details" style="border-bottom:1px solid #E9ECEF ;">
                                    <td style="padding: 10px;vertical-align: top; display: flex;align-items: center;">
                                    <img src="assets/img/product/<?php echo $row['main_image']; ?>" alt="img" class="me-2" style="width:40px;height:40px;">
                                    <?php echo $row['product_name']; ?>
                                    </td>
                                    <td style="padding: 10px;vertical-align: top; ">
                                    <?php echo $qtt; ?>
                                    </td>
                                    <td style="padding: 10px;vertical-align: top; ">
                                    <?php echo $prix; ?>
                                    </td>
                                    <td style="padding: 10px;vertical-align: top; ">
                                    0.00
                                    </td>
                                    <td style="padding: 10px;vertical-align: top; ">
                                    0.00
                                    </td>
                                    <?php 
                                    if ($row['item_status'] == 'Completed') {
                                        echo '<td style="padding: 10px;vertical-align: top; ">' .$subtotal .'</td>';
                                        echo '<td class="text-success" style="padding: 10px;vertical-align: top; ">' .$row['item_status'] .'</td>';
                                    }else{
                                        echo'<td style="padding: 10px;vertical-align: top; "><del>' .$subtotal .'</del></td>';
                                        echo'<td class="text-danger" style="padding: 10px;vertical-align: top; ">' .$row['item_status'] .'</td>';
                                    }?>
                                    </tr>
                                <?php }?>

                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 ">
                            <div class="total-order w-100 max-widthauto m-auto mb-4">
                                <ul>
                                    <li>
                                        <h4>Order Tax</h4>
                                        <h5>$ 0.00 (0.00%)</h5>
                                    </li>
                                    <li>
                                        <h4>Discount</h4>
                                        <h5>$ 0.00</h5>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-6 ">
                            <div class="total-order w-100 max-widthauto m-auto mb-4">
                                <ul>
                                    <li>
                                        <h4>Shipping</h4>
                                        <h5>$ 0.00</h5>
                                    </li>
                                    <li class="total">
                                        <h4>Grand Total</h4>
                                        <h5>$ <?php echo $grand_total; ?></h5>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="assets/js/jquery-3.6.0.min.js"></script>

<script src="assets/js/feather.min.js"></script>

<script src="assets/js/jquery.slimscroll.min.js"></script>

<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/dataTables.bootstrap4.min.js"></script>

<script src="assets/js/bootstrap.bundle.min.js"></script>

<script src="assets/plugins/select2/js/select2.min.js"></script>

<script src="assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
<script src="assets/plugins/sweetalert/sweetalerts.min.js"></script>

<script src="assets/js/script.js"></script>
</body>
</html>