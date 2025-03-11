<?php require 'config.php'; require 'session.php';
    $randomNumber = rand(100000, 999999);
    // echo $randomNumber;

    if (!isset($_SESSION['transaction_id']) || $_SESSION['transaction_id'] === 0) {
        $_SESSION['transaction_id'] = rand(100000, 999999);
    }
    $transaction_id = $_SESSION['transaction_id'];
 ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="POS - Bootstrap Admin Template">
    <meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern,  html5, responsive">
    <meta name="author" content="Dreamguys - Bootstrap Admin Template">
    <meta name="robots" content="noindex, nofollow">
    <title>Woodex /ADMIN</title>

    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="assets/css/animate.css">

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
            <div class="row">
                <div class="col-12 ">
                    <div class="order-list">
                        <div class="orderid">
                            <h4>Order List</h4>
                            <h5>Transaction id : #<?php echo $transaction_id; ?></h5>
                        </div>
                        <div class="actionproducts">
                            <ul>
                                <li>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#clear_all" class="deletebg"><img src="assets/img/icons/delete-2.svg" alt="img"></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card card-order">
                        <!-- <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <a href="javascript:void(0);" class="btn btn-adds" data-bs-toggle="modal" data-bs-target="#create"><i class="fa fa-plus me-2"></i>Add Customer</a>
                                </div>
                                <div class="col-lg-12">
                                    <div class="select-split ">
                                        <div class="select-group w-100">
                                            <select class="select">
                                                <option>Walk-in Customer</option>
                                                <option>Chris Moris</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="select-split">
                                        <div class="select-group w-100">
                                        <select class="select" id="productSelect">
                                            <option value="">Product</option>
                                        </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="text-end">
                                        <a class="btn btn-scanner-set"><img src="assets/img/icons/scanner1.svg" alt="img" class="me-2">Scan bardcode</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="split-card">
                        </div> -->
                        <div class="col-12">
                            <div class="col-12 tabs_wrapper">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="page-header ">
                                            <div class="page-title">
                                                <h4>Categories</h4>
                                                <h6>Manage your purchases</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="col-6 text-end">
                                        <div class="actionproducts">
                                        <ul>
                                            <li>
                                                <button id="all-product" class="btn btn-outline-primary">All</button>
                                            </li>
                                        </ul>
                                        </div>
                                    </div> -->
                                </div>
                                <div class="row text-center">
                                    <div class="col-10">
                                        <input type="text" id="" class="form-control mb-3 searchInput" placeholder="Search by ID ; Search by Name ; Search by Genre...">
                                    </div>
                                    <div class="col-2">
                                        <button id="" class="btn btn-primary all-product"><img src="assets/img/icons/closes.svg" alt="img"></button>
                                    </div>
                                </div>
                                <div class="row" id="tableBody">
                                    <?php
                                        // Construct the SQL query
                                        $sql = "SELECT p.*, c.category_id, c.category_name, c.cat_created_at
                                            FROM products p
                                            INNER JOIN categories c ON c.category_id = p.category_id
                                            ORDER BY p.created_at DESC";                         
                                    
                                    $result = mysqli_query($con, $sql) or die(mysqli_error($con));
                                    while ($product = mysqli_fetch_assoc($result)) {
                                        $category_id = $product['category_id'];
                                        $product_id = $product['product_id'];
                                        $category_name = $product['category_name'];
                                        $product_name = $product['product_name'];
                                        $product_price = $product['product_price'];
                                        $product_quantity = $product['product_quantity'];
                                        $main_image = $product['main_image'];
                                        $sku = $product['sku'];
                                    ?>
                                        <div class="col-6 col-md-6 col-lg-3 product-add">
                                            <div id="category" class="card flex-fill" data-tab="<?php echo $category_id; ?>">
                                                <div class="productsetimg">
                                                    <img src="assets/img/product/<?php echo $main_image; ?>" alt="img">
                                                </div>
                                                <div class="productsetcontent">
                                                    <h5><?php echo $category_name; ?></h5>
                                                    <h4><?php echo $product_name; ?></h4>
                                                    <h6><?php echo $product_price; ?></h6>
                                                    <?php if ($product_quantity == "0") echo '<h6 class="text-danger">Out of Stock<h6>'; else echo '<h6 class="text-success">Qty:' .$product_quantity. '</h6>'?>
                                                    <div class="card-body text-center">
                                                        <form action="pos_process.php" method="post">
                                                            <input type="hidden" name="customer_id" value="1">
                                                            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                                                            <input type="hidden" name="cat_id" value="<?php echo $category_id; ?>">
                                                            <input type="hidden" name="qtt" value="0">
                                                            <input type="hidden" name="transaction_id" value="<?php echo $transaction_id; ?>">
                                                            <button class="btn btn-primary" name="add_to_cart"><i class="fas fa-shopping-cart"></i></button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="row text-center">
                                    <div class="col-10">
                                        <input type="text" id="" class="form-control mb-3 searchInput" placeholder="Search by ID ; Search by Name ; Search by Genre...">
                                    </div>
                                    <div class="col-2">
                                        <button id="" class="btn btn-primary all-product"><img src="assets/img/icons/closes.svg" alt="img"></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="split-card">
                        </div>
                        <div class="card-body">
                            <div class="totalitem">
                                <?php
                                    $sql_count = "SELECT COUNT(*) AS total FROM cart WHERE transaction_id = '$transaction_id'";
                                    $result_count = mysqli_query($con, $sql_count) or die(mysqli_error($con));
                                    $row_count = mysqli_fetch_assoc($result_count);
                                    $totalCart = $row_count['total'];
                                ?>
                                <h4>Total items : <?php echo $totalCart?></h4>
                                <form action="pos_process.php" method="post">
                                    <input type="hidden" name="transaction_id" value="<?php echo $transaction_id?>">
                                    <a class="btn btn-outline-danger" href="#" data-bs-toggle="modal" data-bs-target="#clear_all">Clear all</a>
                                    <div class="modal custom-modal fade" id="clear_all" role="dialog">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content text-center">
                                                <div class="modal-body">
                                                    <div class="form-header">
                                                        <h3>SUR DE VOULOIR TOUT SUPPRIMER ?</h3>
                                                    </div>
                                                    <div class="modal-btn delete-action">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <button name="del" type="submit" class="btn btn-danger w-100">Delete</button>
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
                                </form>
                            </div>
                            <div class="product-table" id="produits">
                                    <?php
                                        $sql = "SELECT p.*,c.*
                                        FROM products p
                                        INNER JOIN cart c ON c.product_id = p.product_id
                                        WHERE c.transaction_id = $transaction_id
                                        ORDER BY created_at DESC
                                        ";
                                        $result = mysqli_query($con, $sql) or die(mysqli_error($con));
                                        $TotalPrice = 0; // Variable to store the total price
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $product_id = $row['product_id'];
                                            $product_name = $row['product_name'];
                                            $product_quantity = $row['product_quantity'];
                                            $main_image = $row['main_image'];
                                            $sku = $row['sku'];
                                            $qtt = $row['qtt'];
                                            $prix = $row['product_price'];
                                            $total_price = $prix * $qtt;
                                            $restant = $product_quantity - $qtt;
                                            // Add the current item's total price to the totalPrice variable
                                            $TotalPrice += $total_price;
                                        ?>
                                <form action="pos_process.php" method="post">
                                <ul class="product-lists">
                                    <li>
                                        <div class="productimg">
                                            <div class="productimgs">
                                                <img src="assets/img/product/<?php echo $main_image; ?>" alt="img">
                                            </div>
                                            <div class="productcontet">
                                                <h4><?php echo $product_name; ?>
                                                    <a href="javascript:void(0);" class="ms-2" data-bs-toggle="modal" data-bs-target="#edit"><img src="assets/img/icons/edit-5.svg" alt="img"></a>
                                                </h4>
                                                <div class="productlinkset">
                                                    <h5><?php echo $sku; ?></h5>
                                                </div>
                                                <?php if ($restant == "0") { echo '<small class="text-danger">Out of Stock</small>'; } else { echo '<small class="text-success">Restant: ' . $restant . '</small>'; }?>
                                        
                                                <div class="increment-decrement">
                                                    <div class="input-groups">
                                                        <input type="submit" name="reduce" value="-" class="button-minus dec button">
                                                        <input class="quantity-field" type="text" name="qtt" value="<?php echo $qtt; ?>" min="1" readonly>
                                                        <input type="submit" name="add_to_cart" value="+" class="button-plus inc button">
                                                        <input type="hidden" name="customer_id" value="0">
                                                        <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                                                        <input type="hidden" name="transaction_id" value="<?php echo $transaction_id; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li><a class="text-nowrap btn btn-sm btn-primary"><?php echo $prix; ?> * <?php echo $qtt; ?> = <?php echo $total_price; ?></a></li>
                                    <li><a class=""  href="#" data-bs-toggle="modal" data-bs-target="#delete_produit_<?php echo $product_id; ?>"><img src="assets/img/icons/delete-2.svg" alt="img"></a></li>
                                    <div class="modal custom-modal fade" id="delete_produit_<?php echo $product_id; ?>" role="dialog">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content text-center">
                                                <div class="modal-body">
                                                    <div class="form-header">
                                                        <h3>SUR DE VOULOIR SUPPRIMER ?</h3>
                                                        <small><?php echo $product_name; ?></small>
                                                        <p>Sûr de vouloir supprimer ?</p>
                                                    </div>
                                                    <div class="modal-btn delete-action">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <button name="supp" type="submit" class="btn btn-danger w-100">Delete</button>
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
                                </ul>
                                </form>
                                <?php }?>
                            </div>
                        </div>
                        <div class="split-card">
                        </div>
                        <div class="card-body pt-0 pb-2">
                            <div class="setvalue">
                                <ul>
                                    <!-- <li>
                                        <h5>Subtotal </h5>
                                        <h6>55.00$</h6>
                                    </li>
                                    <li>
                                        <h5>Tax </h5>
                                        <h6>5.00$</h6>
                                    </li> -->
                                    <li class="total-value">
                                        <h5>Total</h5>
                                        <h6><?php echo $TotalPrice ?></h6>
                                    </li>
                                </ul>
                            </div>
                            <!-- <div class="setvaluecash">
                                <ul>
                                    <li>
                                    <a href="javascript:void(0);" class="paymentmethod">
                                    <img src="assets/img/icons/cash.svg" alt="img" class="me-2">
                                    Cash
                                    </a>
                                    </li>
                                    <li>
                                    <a href="javascript:void(0);" class="paymentmethod">
                                    <img src="assets/img/icons/debitcard.svg" alt="img" class="me-2">
                                    Debit
                                    </a>
                                    </li>
                                    <li>
                                    <a href="javascript:void(0);" class="paymentmethod">
                                    <img src="assets/img/icons/scan.svg" alt="img" class="me-2">
                                    Scan
                                    </a>
                                    </li>
                                </ul>
                            </div> -->
                            <div class="d-flex justify-content-center">
                                <form action="pos_process.php" method="post">
                                    <input type="hidden" name="transaction_id" value="<?php echo $transaction_id?>">
                                    <input type="hidden" name="seller" value="<?php echo $_SESSION['ad_id'];?>">
                                    <button type="submit" class="btn btn-primary btn-block" name="place_order">Valider</button>
                                </form>
                            </div>

                            <!-- <div class="btn-pos">
                                <ul>
                                    <li>
                                    <a class="btn"><img src="assets/img/icons/pause1.svg" alt="img" class="me-1">Hold</a>
                                    </li>
                                    <li>
                                    <a class="btn"><img src="assets/img/icons/edit-6.svg" alt="img" class="me-1">Quotation</a>
                                    </li>
                                    <li>
                                    <a class="btn"><img src="assets/img/icons/trash12.svg" alt="img" class="me-1">Void</a>
                                    </li>
                                    <li>
                                    <a class="btn"><img src="assets/img/icons/wallet1.svg" alt="img" class="me-1">Payment</a>
                                    </li>
                                    <li>
                                    <a class="btn" data-bs-toggle="modal" data-bs-target="#recents"><img src="assets/img/icons/transcation.svg" alt="img" class="me-1"> Transaction</a>
                                    </li>
                                </ul>
                            </div> -->
                        </div>
                    </div>
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

<script src="assets/plugins/apexchart/apexcharts.min.js"></script>
<script src="assets/plugins/apexchart/chart-data.js"></script>

<script src="assets/js/script.js"></script>

<script>
    // Utilisez querySelectorAll pour sélectionner tous les éléments avec la classe 'searchInput'
    let searchInputs = document.querySelectorAll('.searchInput');
    let allProducts = document.querySelectorAll('.all-product'); // Sélectionner tous les éléments avec la classe 'all-product'
    let elementsToFilter = document.querySelectorAll('.product-add');

    // Parcourir tous les éléments de produit
    for (var i = 0; i < elementsToFilter.length; i++) {
        if (i >= 8) {
            elementsToFilter[i].style.display = 'none'; // Masquer les éléments après le 8ème
        }
    }

    // Iterer sur chaque élément 'allProduct' et ajouter un écouteur d'événements
    allProducts.forEach(function(allProduct) {
        allProduct.addEventListener('click', function() {
            elementsToFilter.forEach(function(element) {
                element.style.display = ''; // Afficher tous les éléments
            });

            // Réinitialiser le champ de saisie
            searchInputs.forEach(function(input) {
                input.value = ''; // Effacer chaque champ de saisie
            });
        });
    });

    // Iterer sur chaque élément 'searchInput' et ajouter un écouteur d'événements
    searchInputs.forEach(function(input) {
        input.addEventListener('input', function() {
            let filter = input.value.toLowerCase();

            // Parcourir tous les éléments à filtrer
            elementsToFilter.forEach(function(element) {
                let textContent = element.textContent.toLowerCase();

                // Vérifier si la saisie de l'utilisateur correspond à l'élément
                if (textContent.includes(filter)) {
                    element.style.display = ''; // Afficher l'élément si la correspondance est trouvée
                } else {
                    element.style.display = 'none'; // Masquer l'élément si aucune correspondance n'est trouvée
                }
            });

            // Si le filtre est vide, réinitialiser l'affichage des éléments
            if (filter === '') {
                for (var i = 0; i < elementsToFilter.length; i++) {
                    if (i >= 8) {
                        elementsToFilter[i].style.display = 'none'; // Masquer les éléments après le 8ème
                    } else {
                        elementsToFilter[i].style.display = ''; // Afficher les premiers éléments
                    }
                }
            }
        });
    });
</script>


</body>
</html>