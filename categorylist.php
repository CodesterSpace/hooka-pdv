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
    <title>Category Liste</title>

    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <link rel="stylesheet" href="assets/css/animate.css">

    <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">

    <link rel="stylesheet" href="assets/css/dataTables.bootstrap4.min.css">

    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
    @media print{
        .no-print{
            display: none;
        }
        body {
            background: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            transform: scale(1);
        }
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
                <div class="page-header no-print">
                    <div class="page-title">
                        <h4>Product Category list</h4>
                        <h6>View/Search Product Category</h6>
                    </div>
                    <div class="page-btn">
                        <a href="addcategory.php" class="btn btn-added">
                            <img src="assets/img/icons/plus.svg" class="me-1" alt="img">Add Category
                        </a>
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
                                    <button class="btn" id="" onclick="printInvoice()"><img src="assets/img/icons/printer.svg" alt="img"></button>
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
                            <!-- <div class="card mb-0 no-print" id="filter_inputs">
                                <div class="card-body pb-0">
                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12">
                                            <div class="row">
                                                <div class="col-lg col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <select class="select">
                                                            <option>Choose Product</option>
                                                            <option>Macbook pro</option>
                                                            <option>Orange</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg col-sm-6 col-12">
                                                    <div class="form-group">
                                                    <select class="select">
                                                    <option>Choose Category</option>
                                                    <option>accessory</option>
                                                    <option>Fruits</option>
                                                    </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg col-sm-6 col-12">
                                                    <div class="form-group">
                                                    <select class="select">
                                                    <option>Choose Sub Category</option>
                                                    <option>Computer</option>
                                                    </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg col-sm-6 col-12">
                                                    <div class="form-group">
                                                    <select class="select">
                                                    <option>Brand</option>
                                                    <option>N/D</option>
                                                    </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg col-sm-6 col-12 ">
                                                    <div class="form-group">
                                                    <select class="select">
                                                    <option>Price</option>
                                                    <option>150.00</option>
                                                    </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-1 col-sm-6 col-12">
                                                    <div class="form-group">
                                                        <a class="btn btn-filters ms-auto"><img src="assets/img/icons/search-whites.svg" alt="img"></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <div class="text-center"><h4>Category List</h4></div>
                            <div class="table-responsive">
                                <table class="table table-center">
                                    <thead class="filmlane-thread">
                                        <tr>
                                            <th>Total:</th>
                                            <th class="text-end">
                                                <?php
                                                    $sql_count = "SELECT COUNT(*) AS total FROM categories";
                                                    $result_count = mysqli_query($con, $sql_count) or die(mysqli_error($con));
                                                    $row_count = mysqli_fetch_assoc($result_count);
                                                    $totalCategories = $row_count['total'];
                                                    echo $totalCategories;
                                                ?>
                                            </th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="table-responsive" size="A4" id="print-area">
                                <table class="table table-center">
                                    <thead>
                                        <tr>
                                        <th>#</th>
                                        <th>Category Name</th>
                                        <th>Category Code</th>
                                        <th>Description</th>
                                        <th>Created By</th>
                                        <th>Date</th>
                                        <th class="no-print">Action</th>
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
                                        $offset = ($page - 1) * $per_page; // Calcul de l'offset pour la pagination

                                        $sql = "SELECT * FROM categories ORDER BY cat_created_at DESC LIMIT $per_page OFFSET $offset";
                                        $result = mysqli_query($con, $sql) or die(mysqli_error($con));
                                        $total_pages = ceil($totalCategories / $per_page);
                                        $iteration = 0;
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $iteration++;
                                            $date = date("d/m/Y", strtotime($row['cat_created_at']));
                                            $description = $row['description'];
                                            // Vérifier si la longueur du nom du film est supérieure à 15 caractères
                                            if(strlen($description) > 90) {
                                                $description = substr($description, 0, 90) . '...'; // Limiter le nom à 15 caractères et ajouter "..."
                                            }
                                        ?>
                                        <tr class="product-list">
                                        <td><?php echo $iteration; ?></td>
                                        <td class="productimgname text-wrap">
                                        <a href="<?php echo $row['cat_slug']; ?>" class="product-img">
                                        <img src="assets/img/category/<?php echo $row['cat_img']; ?>" alt="product">
                                        </a>
                                        <a href="<?php echo $row['cat_slug']; ?>"><?php echo $row['category_name']; ?></a>
                                        </td>
                                        <td class="text-wrap"><?php echo $row['category_code']; ?></td>
                                        <td class="text-wrap"><?php echo $description; ?></td>
                                        <td class="text-wrap">Admin</td>
                                        <td class="text-wrap"><?php echo $date; ?></td>
                                        <td class="no-print">
                                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                                                <input type="hidden" name="category_id" value="<?php echo $row['category_id'];?>">

                                                <div class="btn-group">
                                                    <a class="btn btn-inline text-success" href="<?php echo $row['cat_slug']; ?>">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a class="btn btn-inline text-warning"href="editcategory.php?id=<?php echo $row['category_id']; ?>">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a class="btn btn-inline text-danger" href="#" data-bs-toggle="modal" data-bs-target="#delete_category_<?php echo $row['category_id']; ?>">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                </div>
                                                <div class="modal custom-modal fade" id="delete_category_<?php echo $row['category_id']; ?>" role="dialog">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content text-center">
                                                            <div class="modal-body">
                                                                <div class="form-header">
                                                                    <h3>SUR DE VOULOIR SUPPRIMER ?</h3>
                                                                    <small><?php echo $row['category_name']; ?></small>
                                                                    <p>Sûr de vouloir supprimer ?</p>
                                                                </div>
                                                                <div class="modal-btn delete-action">
                                                                    <div class="row">
                                                                        <div class="col-6">
                                                                            <button name="del" type="submit" class="btn btn-danger w-100 me-2">Delete</button>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <a href="javascript:void(0);" data-bs-dismiss="modal" class="btn btn-success w-100 me-2">Cancel</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </td>
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
                                                    $end_entry = min($start_entry + $per_page - 1, $totalCategories);
                                                ?>
                                                Affichage de <?php echo $start_entry; ?> à <?php echo $end_entry; ?> sur <?php echo $totalCategories; ?> entrées
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
                                                    <li class="page-item <?php echo $active; ?>"><button class="page-link" name="page" value="<?php echo $i; ?>"><?php echo $i; ?></button></li>
                                                    <?php } ?>
                                                    <li class="page-item <?php echo ($page == $total_pages) ? 'disabled' : ''; ?>"><button class="page-link" name="page" value="<?php echo ($page < $total_pages) ? ($page + 1) : $total_pages; ?>">Next</button></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-6 text-end">
                                            <div class="sama-drop">
                                                <div class="btn-group ml-2">
                                                    <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-bs-toggle="dropdown">Showing</button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <button class="dropdown-item per-page" name="per_page" value="<?php echo $totalCategories; ?>">All</button>
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
    </div>


<script src="assets/js/jquery-3.6.0.min.js"></script>

<script src="assets/js/feather.min.js"></script>

<script src="assets/js/jquery.slimscroll.min.js"></script>

<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/dataTables.bootstrap4.min.js"></script>

<script src="assets/js/bootstrap.bundle.min.js"></script>

<script src="assets/plugins/select2/js/select2.min.js"></script>

<script src="assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
<script src="assets/plugins/sweetalert/sweetalerts.min.js"></script>

<script src="assets/js/script.js"></script>
<script src="assets/js/filter.js"></script>

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
<script>
    function printInvoice(){
        window.print();
    }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
<script src="assets/js/print.js"></script>
</body>
</html>