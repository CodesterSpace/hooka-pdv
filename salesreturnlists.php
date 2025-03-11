<?php require 'config.php'; require 'session.php';?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="POS - Bootstrap Admin Template">
    <meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, invoice, html5, responsive, Projects">
    <meta name="author" content="Dreamguys - Bootstrap Admin Template">
    <meta name="robots" content="noindex, nofollow">
    <title>Dreams Pos admin template</title>

    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="assets/css/animate.css">

    <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">

    <link rel="stylesheet" href="assets/css/bootstrap-datetimepicker.min.css">

    <link rel="stylesheet" href="assets/css/dataTables.bootstrap4.min.css">

    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

    <link rel="stylesheet" href="assets/css/style.css">
    <style>
    .sales-parent > a {
        background-color:#1b2850;
        color: white;
        border-radius: 5px;
    }

    .sidebar .sidebar-menu>ul>li.sales-parent ul li a.sales-return-list:after {
        background: #092c4c;
        border: 1px solid #092c4c;
    }
    </style>
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
                        <h4>Sales List</h4>
                        <h6>Manage your sales</h6>
                    </div>
                    <div class="page-btn">
                        <a href="add-sales.html" class="btn btn-added"><img src="assets/img/icons/plus.svg" alt="img" class="me-1">Add Sales</a>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="table-top">
                            <div class="search-set">
                                <div class="search-path">
                                    <a class="btn btn-filter" id="filter_search">
                                        <img src="assets/img/icons/filter.svg" alt="img">
                                        <span><img src="assets/img/icons/closes.svg" alt="img"></span>
                                    </a>
                                </div>
                                <div class="search-input">
                                    <a class="btn btn-searchset"><img src="assets/img/icons/search-white.svg" alt="img"></a>
                                </div>
                            </div>
                            <div class="wordset">
                                <ul>
                                    <li>
                                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img src="assets/img/icons/pdf.svg" alt="img"></a>
                                    </li>
                                    <li>
                                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img src="assets/img/icons/excel.svg" alt="img"></a>
                                    </li>
                                    <li>
                                        <button class="btn" id="print"><img src="assets/img/icons/printer.svg" alt="img"></button>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="card" id="filter_inputs">
                            <div class="card-body pb-0">
                                <div class="row">
                                    <div class="col-lg-3 col-sm-6 col-12">
                                        <div class="form-group">
                                            <input type="text" placeholder="Enter Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-6 col-12">
                                        <div class="form-group">
                                            <input type="text" placeholder="Enter Reference No">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-6 col-12">
                                        <div class="form-group">
                                            <select class="select">
                                                <option>Completed</option>
                                                <option>Paid</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-6 col-12">
                                        <div class="form-group">
                                            <a class="btn btn-filters ms-auto"><img src="assets/img/icons/search-whites.svg" alt="img"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="divToPrint" class="table-responsive">
                            <table class="table text-center datanew">
                                <thead>
                                    <tr>
                                        <th>
                                        <label class="checkboxs">
                                        <input type="checkbox" id="select-all">
                                        <span class="checkmarks"></span>
                                        </label>
                                        </th>
                                        <th><small>O. Date</th>
                                        <th>R. Date</th>
                                        <th>Product Name</th>
                                        <th>Customer</th>
                                        <th>Status</th>
                                        <th>Product Price</th>
                                        <th>Refund Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <?php
                                        $sql = "SELECT o.*, c.customer_id, c.customer_name, oi.cart_id, oi.product_id, oi.item_status, oi.refund, oi.product_price, oi.item_quantity, p.product_name, p.product_id, p.main_image, p.sku
                                        FROM orders o
                                        INNER JOIN order_items oi ON oi.cart_id = o.cart_id
                                        INNER JOIN customers c ON c.customer_id = o.customer_id
                                        INNER JOIN products p ON p.product_id = oi.product_id
                                        WHERE oi.item_status = 'Cancelled'";
                                        $result = mysqli_query($con, $sql) or die(mysqli_error($con));

                                        while ($row = mysqli_fetch_assoc($result)) {
                                        $cart_id = $row['cart_id'];
                                        $product_id = $row['product_id'];
                                        $p_price = $row['product_price'];
                                        $qtt = $row['item_quantity'];
                                        $total = $p_price * $qtt;
                                        ?>
                                    <tr>
                                        <td>
                                        <label class="checkboxs">
                                        <input type="checkbox">
                                        <span class="checkmarks"></span>
                                        </label>
                                        </td>
                                        <td><?php $order_date = date("d/m/Y", strtotime($row['order_date']));echo $order_date;?></td>
                                        <td><?php $updated_at = date("d/m/Y", strtotime($row['updated_at']));echo $updated_at;?></td>
                                        <td class="productimgname text-wrap">
                                        <a href="javascript:void(0);" class="product-img">
                                        <img src="assets/img/product/<?php echo $row['main_image']; ?>" alt="product">
                                        </a>
                                        <a href="javascript:void(0);"><?php echo $row['product_name']; ?></a>
                                        </td>
                                        <td><?php echo $row['customer_name']; ?></td>
                                        <td><span class="badges bg-lightgreen">Received</span></td>
                                        <td><?php echo $row['product_price']; ?></td>
                                        <td><span class="badges <?php if ($row['refund'] == 'Paid') {echo ' bg-lightgreen';}else{echo ' bg-lightred';} ?>"><?php echo $row['refund']; ?></span></td>
                                        <td>
                                        <form action="./action.php" method="post">
                                            <div class="col-lg-12">
                                                <input type="hidden" value="<?php echo $cart_id; ?>" name="cart_id">
                                                <input type="hidden" value="<?php echo $product_id; ?>" name="product_id">
                                                <?php
                                                if ($row['refund'] == 'Unpaid') 
                                                { echo'<input type="hidden" value="Paid" name="status">
                                                <button name="refund" class="btn btn-success badges bg-lightsuccess">Pay</button>';
                                                }elseif ($row['refund'] == 'Paid')
                                                { echo'<input type="hidden" value="Unpaid" name="status">
                                                <button name="refund" class="btn btn-danger badges bg-lightdanger" disabled>Cancel</button>';
                                                }
                                                ?>
                                            </div>
                                        </form>
                                        </td>
                                    </tr>
                                <?php }?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<script>
    // Function to generate PDF
    function generatePDF() {
        // Create a new jsPDF instance
        var doc = new jsPDF();

        // Define the HTML element containing the content you want to print
        var element = document.getElementById("divToPrint");

        // Use html2canvas to convert the HTML element to a canvas
        html2canvas(element).then(function(canvas) {
            // Get the data URL of the canvas
            var imgData = canvas.toDataURL('image/png');

            // Add the image data to the PDF document
            doc.addImage(imgData, 'PNG', 10, 10, 180, 180);

            // Save the PDF document
            doc.save('table.pdf');
        });
    }

    // Add click event listener to the print button
    document.getElementById("print").addEventListener("click", generatePDF);
</script>
<script src="assets/js/jquery-3.6.0.min.js"></script>

<script src="assets/js/feather.min.js"></script>

<script src="assets/js/jquery.slimscroll.min.js"></script>

<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/dataTables.bootstrap4.min.js"></script>

<script src="assets/js/bootstrap.bundle.min.js"></script>

<script src="assets/js/moment.min.js"></script>
<script src="assets/js/bootstrap-datetimepicker.min.js"></script>

<script src="assets/plugins/select2/js/select2.min.js"></script>

<script src="assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
<script src="assets/plugins/sweetalert/sweetalerts.min.js"></script>

<script src="assets/js/script.js"></script>
</body>
</html>