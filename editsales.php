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
    <title>POS /Edit Sale</title>

    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="assets/css/bootstrap-datetimepicker.min.css">

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


    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Edit Sale</h4>
                    <h6>Edit your sale details</h6>
                </div>
            </div>
            <div class="card">
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
                <div class="card-body">
                    <div class="row">
                        <div class="table-responsive mb-3">
                            <table class="table">
                                <thead>
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>Product Name</th>
                                        <th>QTY</th>
                                        <th>Price</th>
                                        <!-- <th>Discount</th> -->
                                        <!-- <th>Tax</th> -->
                                        <th>Subtotal</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
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
                                    $itteration = 0;
                                    while ($row_items = mysqli_fetch_assoc($result_items)) {
                                        $TotalPrice = 0;
                                        $qtt = $row_items['item_quantity'];
                                        $cart_id = $row_items['cart_id'];
                                        $product_id = $row_items['product_id'];
                                        $prix = $row_items['product_price'];
                                        $subtotal = $prix * $qtt;
                                        // Add the current item's total price to the totalPrice variable
                                        $grand_total = $row['grand_total'];
                                        $itteration ++;
                                        $status = $row_items['item_status'];
                                        if($status =='Completed'){
                                            $color = 'text-success';
                                        }else{
                                            $color = 'text-danger';
                                        }
                                    ?>
                                    <tr class="text-center">
                                        <td><?php echo $itteration; ?></td>
                                        <td class="productimgname text-wrap">
                                        <a class="product-img">
                                        <img src="assets/img/product/<?php echo $row_items['main_image']; ?>" alt="product">
                                        </a>
                                        <a href="javascript:void(0);"><?php echo $row_items['product_name']; ?></a>
                                        </td>
                                        <td class="text-wrap"><?php echo $qtt; ?></td>
                                        <td class="text-wrap"><?php echo $prix; ?></td>
                                        <!-- <td class="text-wrap">0</td> -->
                                        <!-- <td class="text-wrap">0</td> -->
                                        <td class="text-wrap"><?php echo $subtotal; ?></td>
                                        <td class="text-wrap"><?php echo $order_date; ?></td>
                                        <td class="text-wrap <?php echo $color; ?>"><?php echo $status; ?></td>
                                        <td class="text-wrap">
                                            <form action="./action.php" method="post">
                                                <input type="hidden" value="<?php echo $cart_id; ?>" name="cart_id">
                                                <input type="hidden" value="<?php echo $product_id; ?>" name="product_id">
                                                <input type="hidden" value="<?php echo $grand_total; ?>" name="grand_total">
                                                <input type="hidden" value="<?php echo $subtotal; ?>" name="subtotal">
                                                <?php
                                                    $cancelStatus = ($row_items['item_status'] == 'Cancelling' || $row_items['item_status'] == 'Completed') ? 'Cancelled' : 'Completed';
                                                ?>
                                                <input type="hidden" value="<?php echo $cancelStatus; ?>" name="status">
                                                <?php
                                                    $achatDate = strtotime($row['order_date']);
                                                    $cinqJoursApresAchat = strtotime('+5 days', $achatDate);
                                                    $aujourdHui = strtotime('today');
                                                    if ($aujourdHui > $cinqJoursApresAchat OR $status == 'Cancelled') {
                                                        echo "<button disabled type='submit' class='btn btn-sm btn-primary'>Cancel</button>";
                                                    } else {
                                                        echo "<button type='submit' name='item_cancel' class='btn btn-sm btn-primary'>Cancel</button>";
                                                    }
                                                ?>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                    <form action="action.php" method="post" enctype="multipart/form-data">
                    <div class="row">
                    <div class="col-lg-3 col-sm-6 col-12">
                    <div class="form-group">
                    <label>Order Tax</label>
                    <input type="text">
                    </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                    <div class="form-group">
                    <label>Discount</label>
                    <input type="text">
                    </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                    <div class="form-group">
                    <label>Shipping</label>
                    <input type="text">
                    </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-12">
                    <div class="form-group">
                    <label>Order Status</label>
                    <select class="select" name="status" required>
                    <option value="">Choose Status</option>
                    <option value="Pending">Pending</option>
                    <option value="Processing">Processing</option>
                    <option value="Completed">Completed</option>
                    <option value="Cancelled">Cancelled</option>
                    </select>
                    </div>
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
                    <h4>Discount	</h4>
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
                    <div class="col-lg-12">
                    <input type="hidden" value="<?php echo $cart_id; ?>" name="cart_id">
                    <?php
                        $achatDate = strtotime($row['order_date']);
                        $cinqJoursApresAchat = strtotime('+5 days', $achatDate);
                        $aujourdHui = strtotime('today');

                        if ($aujourdHui > $cinqJoursApresAchat OR $status == 'Cancelled') {
                            echo "<a type='submit' class='btn btn-submit me-2 disabled'>Update</a>";
                        } else {
                            echo "<a class='btn btn-submit me-2' href='#' data-bs-toggle='modal' data-bs-target='#cancel_order'>Update</a>";
                        }
                    ?>
                    <a href="javascript:void(0);" class="btn btn-cancel">Cancel</a>
                    <div class="modal custom-modal fade" id="cancel_order" role="dialog">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content text-center">
                                <div class="modal-body">
                                    <div class="form-header">
                                        <h3>SUR DE VOULOIR ANNULER ?</h3>
                                    </div>
                                    <div class="modal-btn delete-action">
                                        <div class="row">
                                            <div class="col-6">
                                                <?php
                                                    $achatDate = strtotime($row['order_date']);
                                                    $cinqJoursApresAchat = strtotime('+5 days', $achatDate);
                                                    $aujourdHui = strtotime('today');

                                                    if ($aujourdHui > $cinqJoursApresAchat OR $status == 'Cancelled') {
                                                        echo "<button disabled type='submit' class='btn btn-danger w-100'>Update</button>";
                                                    } else {
                                                        echo "<button type='submit' name='order_cancel' class='btn btn-danger w-100'>Update</button>";
                                                    }
                                                ?>
                                            </div>
                                            <div class="col-6">
                                                <a href="javascript:void(0);" data-bs-dismiss="modal" class="btn btn-primary w-100">Cancel</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    </div>
                    </form>
                    </div>
    </div>
    </div>
</div>


<script src="assets/js/jquery-3.6.0.min.js"></script>

<script src="assets/js/feather.min.js"></script>

<script src="assets/js/jquery.slimscroll.min.js"></script>

<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/dataTables.bootstrap4.min.js"></script>

<script src="assets/js/bootstrap.bundle.min.js"></script>

<script src="assets/plugins/select2/js/select2.min.js"></script>

<script src="assets/js/moment.min.js"></script> 
<script src="assets/js/bootstrap-datetimepicker.min.js"></script>

<script src="assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
<script src="assets/plugins/sweetalert/sweetalerts.min.js"></script>

<script src="assets/js/script.js"></script>
</body>
</html>