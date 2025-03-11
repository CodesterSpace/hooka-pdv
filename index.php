<?php require 'config.php';
session_start();
 if (isset($_SESSION['ad_id'])) {
    $_SESSION['ad_id'] = $_SESSION['ad_id'];
 };?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="Découvrez notre sélection de chichas de qualité à prix attractifs. Biro Hooka Chicha, votre spécialiste de la chicha.">
    <meta name="keywords" content="Biro, chicha, hooka, narguilé, tabac à chicha">
    <meta name="author" content="Khalil">
    <title>Biro Hooka Chicha - Votre boutique de chicha en ligne</title>

    <meta name="robots" content="max-image-preview:large" />
    <link rel="canonical" href="http://birohookachicha.byethost33.com/Biro-Hooka/" />
    <meta name="generator" content="All in One SEO (AIOSEO) 4.4.8" />
    <meta property="og:locale" content="fr_FR" />
    <meta property="og:site_name" content="Biro Hooka Chicha: Découvrez notre sélection de chichas de qualité à prix attractifs. Biro Hooka Chicha, votre spécialiste de la chicha." />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Home - Biro Hooka Chicha - Votre boutique de chicha en ligne" />
    <meta property="og:url" content="http://birohookachicha.byethost33.com/Biro-Hooka/" />
    <meta property="og:image" content="http://birohookachicha.byethost33.com/Biro-Hooka/assets/img/lastlogo.PNG" />
    <meta property="og:image:secure_url" content="http://birohookachicha.byethost33.com/Biro-Hooka/assets/img/lastlogo.PNG" />
    <meta property="og:image:width" content="517" />
    <meta property="og:image:height" content="455" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="Home - Biro Hooka Chicha" />
    <meta name="twitter:image" content="http://birohookachicha.byethost33.com/Biro-Hooka/assets/img/lastlogo.PNG" />



    <meta name="robots" content="noindex, nofollow">

    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="assets/css/animate.css">

    <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">

    <link rel="stylesheet" href="assets/css/bootstrap-datetimepicker.min.css">

    <link rel="stylesheet" href="assets/css/dataTables.bootstrap4.min.css">

    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">

    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div id="global-loader">
        <div class="whirly-loader">
        </div>
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
                    <div class="col-6">
                        <div class="dash-widget dash2">
                            <!--<div class="dash-widgetimg">
                                <span><img src="assets/img/icons/dash4.svg" alt="img"></span>
                            </div>-->
                            <div class="dash-widgetcontent">
                                <h5>
                                    <?php
                                        $sql_completed_count = "SELECT SUM(product_price * item_quantity) AS total_price FROM order_items WHERE cat_id = 1;";
                                        $result_completed_count = mysqli_query($con, $sql_completed_count) or die(mysqli_error($con));
                                        $completed = mysqli_fetch_assoc($result_completed_count);
                                        $total_price = $completed['total_price'];
                                    ?>
                                    <span class="counters" data-count="<?php echo $total_price;?>"></span> <sup>CFA</sup>
                                </h5>
                                <h6>Cartouches Vendues</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="dash-widget dash3">
                            <!--<div class="dash-widgetimg">
                                <span><img src="assets/img/icons/dash4.svg" alt="img"></span>
                            </div>-->
                            <div class="dash-widgetcontent">
                                <h5>
                                    <?php
                                        $sql_cancelled_count = "SELECT SUM(product_price * item_quantity) AS total_price FROM order_items WHERE cat_id = 2;";
                                        $result_cancelled_count = mysqli_query($con, $sql_cancelled_count) or die(mysqli_error($con));
                                        $cancelled = mysqli_fetch_assoc($result_cancelled_count);
                                        $total_price = $cancelled['total_price'];
                                    ?>
                                    <span class="counters" data-count="<?php echo $total_price;?>"></span> <sup>CFA</sup>
                                </h5>
                                <h6>Charbons Vendues</h6>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card" id="invoice-content">
                    <div class="card-body">
                        <div class="table-top no-print">
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
                            <div class="wordset no-print">
                                <ul>
                                    <li>
                                    <button class="btn" onclick="printInvoiceAsPDF()"><img src="assets/img/icons/pdf.svg" alt="img"></button>
                                    </li>
                                    <li>
                                    <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img src="assets/img/icons/excel.svg" alt="img"></a>
                                    </li>
                                    <li>
                                    <button class="btn" onclick="printInvoice()"><img src="assets/img/icons/printer.svg" alt="img"></button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div id="invoice-content-print">
                            <div id="search-div" class="filmlane-group-form no-print">
                                <div class="row text-center">
                                    <div class="col-10">
                                        <input type="text" id="searchInput" class="form-control mb-3" placeholder="Search by ID ; Search by Name ; Search by Genre...">
                                    </div>
                                    <div class="col-2">
                                        <button id="all-product" class="btn btn-primary"><img src="assets/img/icons/closes.svg" alt="img"></button>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center"><h4>Liste Produits</h4></div>
                            <div class="table-responsive">
                                <table class="table border-0 table-center table-striped">
                                    <thead class="filmlane-thread">
                                        <tr>
                                            <th>Total:</th>
                                            <th class="text-end">
                                                <?php
                                                    $sql_count = "SELECT COUNT(*) AS total FROM products";
                                                    $result_count = mysqli_query($con, $sql_count) or die(mysqli_error($con));

                                                    // Vérifier si la requête s'est exécutée avec succès
                                                    if ($result_count) {
                                                    // Récupérer le nombre de films
                                                    $row_count = mysqli_fetch_assoc($result_count);
                                                    $totalProducts = $row_count['total'];
                                                            echo $totalProducts;
                                                    } else {
                                                    echo "Erreur lors de l'exécution de la requête : " . mysqli_error($con);
                                                    }
                                                ?>
                                            </th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>

                            <div class="table-responsive" size="A4" id="print-area">
                                <table class="table text-center">
                                    <thead>
                                        <tr>
                                        <th>#</th>
                                        <th>Produit</th>
                                        <!-- <th>Category</th>
                                        <th>Brand</th> -->
                                        <th>price</th>
                                        <th>Qty</th>
                                        <!-- <th>Created By</th> -->
                                        <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tableBody">
                                        <?php

                                        if (isset($_SESSION['per_page'])) {
                                            $per_page = ($_SESSION['per_page']);
                                        } else {
                                            $per_page = 10;
                                        }

                                        if (isset($_SESSION['page'])) {
                                            $page = ($_SESSION['page']);
                                        } else {
                                            $page = 1;
                                        }
                                                                    
                                        $offset = ($page - 1) * $per_page;

                                        $sql = "SELECT p.*,c.category_id,c.category_name,c.cat_slug,b.brand_id,b.brand_name,b.brand_slug
                                        FROM products p
                                        INNER JOIN categories c ON c.category_id = p.category_id
                                        LEFT JOIN brands b ON p.brand_id = b.brand_id
                                        ORDER BY p.created_at DESC LIMIT $per_page OFFSET $offset
                                        ";
                                        $result = mysqli_query($con, $sql) or die(mysqli_error($con));
                                        $total_pages = ceil($totalProducts / $per_page);
                                        $iteration = 0;
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $iteration++;
                                            $date = date("d/m/Y", strtotime($row['created_at']));
                                            $brand_id = $row['brand_id'];
                                            $details = $row['product_details'];
                                            // Vérifier si la longueur du nom du film est supérieure à 15 caractères
                                            if(strlen($details) > 15) {
                                                $details = substr($details, 0, 15) . '...'; // Limiter le nom à 15 caractères et ajouter "..."
                                            }
                                            if (empty($brand_id)) {
                                                $brand_name = "N/D";
                                            }else {
                                                $brand_name = $row['brand_name'];
                                            }
                                        ?>
                                        <tr class="product-list">
                                        <td><?php echo $iteration; ?></td>
                                        <td class="productimgname text-wrap text-wrap">
                                        <a href="" class="product-img">
                                        <img src="assets/img/product/<?php echo $row['main_image']; ?>" alt="product">
                                        </a>
                                        <a href=""><?php echo $row['product_name']; ?></a>
                                        </td>
                                        <td class="text-wrap text-wrap"><?php echo $row['product_price']; ?></td>
                                        <td><?php echo $row['product_quantity']; ?></td>
                                        <td class="text-wrap text-wrap"><?php echo $date; ?></td>
                                        </tr>
                                        <?php }?>

                                    </tbody>
                                </table>
                            </div>

                            <div class="card">
                                <div class="card-body">
                                    <div class="row text-center">
                                        <div class="col-12">
                                            <div class="">
                                                <?php
                                                    // Calculate start and end entries
                                                    $start_entry = ($page - 1) * $per_page + 1;
                                                    $end_entry = min($start_entry + $per_page - 1, $totalProducts);
                                                ?>
                                                Affichage de <?php echo $start_entry; ?> à <?php echo $end_entry; ?> sur <?php echo $totalProducts; ?> entrées
                                            </div>
                                        </div>
                                        <div class="col-6 text-start">
                                            <div>
                                                <ul class="pagination pagination-sm">
                                                    <li class="page-item <?php echo ($page == 1) ? 'disabled' : ''; ?>">
                                                        <button class="page-link" name="page" value="<?php echo ($page > 1) ? ($page - 1) : 1; ?>">Prev</button>
                                                    </li>
                                                    <?php for ($i = 1; $i <= $total_pages; $i++) { 
                                                        $active = ($i == $page) ? 'active' : '';
                                                    ?>
                                                    <li class="page-item <?php echo $active; ?>">
                                                        <button class="page-link" name="page" value="<?php echo $i; ?>"><?php echo $i; ?></button>
                                                    </li>
                                                    <?php } ?>
                                                    <li class="page-item <?php echo ($page == $total_pages) ? 'disabled' : ''; ?>">
                                                        <button class="page-link" name="page" value="<?php echo ($page < $total_pages) ? ($page + 1) : $total_pages; ?>">Next</button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-6 text-end">
                                            <div class="sama-drop">
                                                <div class="btn-group ml-2">
                                                    <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-bs-toggle="dropdown">Showing</button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <button class="dropdown-item per-page" name="per_page" value="<?php echo $totalProducts; ?>">All</button>
                                                        <button class="dropdown-item per-page" name="per_page" value="10">10</button>
                                                        <button class="dropdown-item per-page" name="per_page" value="20">20</button>
                                                        <button class="dropdown-item per-page" name="per_page" value="50">50</button>
                                                        <button class="dropdown-item per-page" name="per_page" value="100">100</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="card">
                    <div class="card-body">
                        <div class="text-center"><h4>Liste De Vente</h4></div>
                        <div class="table-responsive">
                            <table class="table border-0 table-center table-striped">
                                <thead class="filmlane-thread">
                                    <tr>
                                        <th>Total:</th>
                                        <th class="text-end">
                                            <?php
                                                $sql_count = "SELECT COUNT(*) AS total FROM order_items";
                                                $result_count = mysqli_query($con, $sql_count) or die(mysqli_error($con));

                                                // Vérifier si la requête s'est exécutée avec succès
                                                if ($result_count) {
                                                // Récupérer le nombre de films
                                                $row_count = mysqli_fetch_assoc($result_count);
                                                $totalItems = $row_count['total'];
                                                        echo $totalItems;
                                                } else {
                                                echo "Erreur lors de l'exécution de la requête : " . mysqli_error($con);
                                                }
                                            ?>
                                        </th>
                                    </tr>
                                </thead>
                            </table>
                        </div>

                        <div class="table-responsive">
                            <table class="table text-center">
                                <thead>
                                    <tr class="">
                                    <th>#</th>
                                    <th class="text-wrap">Date <small>(DDMMYY)</small></th>
                                    <th>Product</th>
                                    <!-- <th>Customer Name</th> -->
                                    <!-- <th>Seller</th> -->
                                    <!-- <th>Status</th> -->
                                    <th>QTT</th>
                                    <th>Total</th>
                                    <!-- <th>Paid</th> -->
                                    <!-- <th>Due</th> -->
                                    <!-- <th class="text-center">Action</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($_SESSION['per_page'])) {
                                        $per_page = ($_SESSION['per_page']);
                                    } else {
                                        $per_page = 10;
                                    }

                                    if (isset($_SESSION['page'])) {
                                        $page = ($_SESSION['page']);
                                    } else {
                                        $page = 1;
                                    }
                                                                
                                    $offset = ($page - 1) * $per_page;
                                    $sql = "SELECT oi.*, c.customer_id, c.customer_name, o.cart_id, o.seller, a.ad_id, a.ad_name,p.product_id,p.sku,main_image,p.product_name
                                    FROM order_items oi
                                    INNER JOIN orders o ON oi.cart_id = o.cart_id
                                    INNER JOIN customers c ON c.customer_id = o.customer_id
                                    INNER JOIN admin a ON a.ad_id = o.seller
                                    INNER JOIN products p ON p.product_id = oi.product_id
                                    ORDER BY oi.created_at DESC LIMIT $per_page OFFSET $offset";
                                    $result = mysqli_query($con, $sql) or die(mysqli_error($con));
                                    $total_pages = ceil($totalItems / $per_page);
                                    $iteration = 0;
                                    while ($row = mysqli_fetch_assoc($result)) {
                                    $iteration++;
                                    $cart_id = $row['cart_id'];
                                    $date = date("d/m/Y h:m:s", strtotime($row['created_at']));
                                    $p_price = $row['product_price'];
                                    $qtt = $row['item_quantity'];
                                    $total = $p_price * $qtt;
                                    ?>
                                    <tr class="text-center">
                                        <td class=""><?php echo $iteration;?></td>
                                        <td class="text-wrap"><?php echo $date;?></td>
                                        <td class="productimgname text-wrap">
                                        <a href="" class="product-img">
                                        <img src="assets/img/product/<?php echo $row['main_image']; ?>" alt="product">
                                        </a>
                                        <a href=""><?php echo $row['product_name']; ?></a>
                                        </td>
                                        <td><?php echo $qtt; ?></td>
                                        <td><?php echo $total; ?></td>
                                        <!-- <td>0.00</td> -->
                                        <!-- <td class="text-red">100.00</td> -->
                                    </tr>
                                    <?php }?>
                                </tbody>
                            </table>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="row text-center">
                                    <div class="col-12">
                                        <div class="">
                                            <?php
                                                // Calculate start and end entries
                                                $start_entry = ($page - 1) * $per_page + 1;
                                                $end_entry = min($start_entry + $per_page - 1, $totalItems);
                                            ?>
                                            Affichage de <?php echo $start_entry; ?> à <?php echo $end_entry; ?> sur <?php echo $totalItems; ?> entrées
                                        </div>
                                    </div>
                                    <div class="col-6 text-start">
                                        <div>
                                            <ul class="pagination pagination-sm">
                                                <li class="page-item <?php echo ($page == 1) ? 'disabled' : ''; ?>">
                                                    <button class="page-link" name="page" value="<?php echo ($page > 1) ? ($page - 1) : 1; ?>">Prev</button>
                                                </li>
                                                <?php for ($i = 1; $i <= $total_pages; $i++) { 
                                                    $active = ($i == $page) ? 'active' : '';
                                                ?>
                                                <li class="page-item <?php echo $active; ?>">
                                                    <button class="page-link" name="page" value="<?php echo $i; ?>"><?php echo $i; ?></button>
                                                </li>
                                                <?php } ?>
                                                <li class="page-item <?php echo ($page == $total_pages) ? 'disabled' : ''; ?>">
                                                    <button class="page-link" name="page" value="<?php echo ($page < $total_pages) ? ($page + 1) : $total_pages; ?>">Next</button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-6 text-end">
                                        <div class="sama-drop">
                                            <div class="btn-group ml-2">
                                                <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-bs-toggle="dropdown">Showing</button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <button class="dropdown-item per-page" name="per_page" value="<?php echo $totalItems; ?>">All</button>
                                                    <button class="dropdown-item per-page" name="per_page" value="10">10</button>
                                                    <button class="dropdown-item per-page" name="per_page" value="20">20</button>
                                                    <button class="dropdown-item per-page" name="per_page" value="50">50</button>
                                                    <button class="dropdown-item per-page" name="per_page" value="100">100</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const buttons = document.querySelectorAll(".page-link");
        buttons.forEach(button => {
            button.addEventListener("click", function(event) {
                event.preventDefault();
                const Page = this.value;
                const formData = new FormData();
                formData.append("page", Page);
                
                fetch("update_per_page.php", {
                    method: "POST",
                    body: formData
                })
                .then(response => {
                    if (response.ok) {
                        location.reload(); // Rafraîchir la page si la requête est réussie
                    } else {
                        throw new Error("Erreur lors de la mise à jour");
                    }
                })
                .catch(error => {
                    console.error("Erreur:", error);
                });
            });
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const buttons = document.querySelectorAll(".per-page");
        buttons.forEach(button => {
            button.addEventListener("click", function(event) {
                event.preventDefault();
                const perPage = this.value;
                const formData = new FormData();
                formData.append("per_page", perPage);
                
                fetch("update_per_page.php", {
                    method: "POST",
                    body: formData
                })
                .then(response => {
                    if (response.ok) {
                        location.reload(); // Rafraîchir la page si la requête est réussie
                    } else {
                        throw new Error("Erreur lors de la mise à jour");
                    }
                })
                .catch(error => {
                    console.error("Erreur:", error);
                });
            });
        });
    });
</script>

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