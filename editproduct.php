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

    <link rel="stylesheet" href="assets/css/dataTables.bootstrap4.min.css">

    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="assets/css/editor.css">
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
        $id = $_GET['id'];
        $sql = "SELECT p.*,c.category_id,c.category_name,s.subcategory_id,s.subcategory_name
        FROM products p
        INNER JOIN categories c ON c.category_id = p.category_id
        INNER JOIN subcategories s ON s.subcategory_id = p.subcategory_id
        WHERE p.product_id=$id
        ";
        $result = mysqli_query($con, $sql) or die(mysqli_error($con));
        $row = mysqli_fetch_assoc($result);{
        $p_category_id = $row['category_id'];
        $p_brand_id = $row['brand_id'];
        ?>
        <div class="page-wrapper">
            <div class="content">
                <div class="page-header">
                    <div class="page-title">
                        <h4>Product Edit</h4>
                        <h6>Update your product</h6>
                    </div>
                    <div class="view-product">
                        <a class="btn btn-submit me-2" href="<?php echo $row['product_slug']; ?>">
                            <img src="assets/img/icons/eye.svg" width="18" alt="img">
                        </a>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <form id="updateForm" method="post" enctype="multipart/form-data">
                            <div class="row text-center">
                                <div class="col-12">
                                    <div id="message"></div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Product Name</label>
                                        <input type="text" value="<?php echo $row['product_name']; ?>" name="product_name" required>
                                        <input type="hidden" name="old_product_name" value="<?php echo $row['product_name']; ?>">
                                        <input type="hidden" name="slug" value="<?php echo $row['product_slug']; ?>">
                                        <input type="hidden" name="image_actuel" value="<?php echo $row['main_image']; ?>">
                                        <input type="hidden" name="actuel_scondary_1" value="<?php echo $row['secondary_image_1']; ?>">
                                        <input type="hidden" name="actuel_scondary_2" value="<?php echo $row['secondary_image_2']; ?>">
                                        <input type="hidden" name="sku" value="<?php echo $row['sku']; ?>">
                                    </div>
                                </div>

                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Category or <a href="#" data-bs-toggle="modal" data-bs-target="#add_category"><i class="fas fa-plus"></i> category</a></label>
                                        <select class="select" id="category_id" name="category_id" required>
                                            <option value="">-- Sélectionner une catégorie --</option>
                                            <?php
                                            $sql_categories = "SELECT * FROM categories";
                                            $result_categories = mysqli_query($con, $sql_categories) or die(mysqli_error($con));
                                            while ($row_categories = mysqli_fetch_assoc($result_categories)) {
                                                $category_id = $row_categories['category_id'];
                                                $category_name = $row_categories['category_name'];
                                                ?>
                                                <option value="<?php echo $category_id; ?>" <?php if ($category_id == $p_category_id) echo "selected"; ?>><?php echo $category_name; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                    <label>SubCategory or <a href="#" data-bs-toggle="modal" data-bs-target="#add_subcategory"><i class="fas fa-plus"></i> subcategory</a></label>
                                    <select class="select" id="subcategory_select" name="subcategory_id" required>
                                    </select>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Brand or <a href="#" data-bs-toggle="modal" data-bs-target="#add_brand"><i class="fas fa-plus"></i>Brand</a></label>
                                        <select class="select" id="brand_id" name="brand_id" required>
                                            <option value="0">-- Sélectionner une marque --</option>
                                            <?php
                                            $sql_brands = "SELECT * FROM brands";
                                            $result_brands = mysqli_query($con, $sql_brands) or die(mysqli_error($con));
                                            while ($row_brands = mysqli_fetch_assoc($result_brands)) {
                                                $brand_id = $row_brands['brand_id'];
                                                $brand_name = $row_brands['brand_name'];
                                                ?>
                                                <option value="<?php echo $brand_id; ?>" <?php if ($brand_id == $p_brand_id) echo "selected"; ?>><?php echo $brand_name; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                    <label>Fetured</label>
                                    <select class="select" name="product_featured">
                                    <option>YES</option>
                                    <option>NO</option>
                                    </select>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                    <label>Quantity</label>
                                    <input type="text" value="<?php echo $row['product_quantity']; ?>" name="product_quantity" required>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-sm-6 col-12">
                                    <div class="form-group">
                                    <label>Price</label>
                                    <input type="text" value="<?php echo $row['product_price']; ?>" name="product_price" required>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Main Image</label>
                                        <div class="image-upload">
                                            <input type="file" name="image">
                                            <div class="image-uploads">
                                                <img src="assets/img/icons/upload.svg" alt="img">
                                                <h4>Drop a file to upload Main Image</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="product-list">
                                        <ul class="row justify-content-center">
                                            <li>
                                                <div class="productviews">
                                                    <div class="productviewsimg">
                                                        <img src="assets/img/product/<?php echo $row['main_image']; ?>" alt="img">
                                                    </div>
                                                    <div class="productviewscontent">
                                                        <div class="productviewsname">
                                                            <h3>581kb</h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="productviews">
                                                    <div class="productviewsimg">
                                                        <img src="assets/img/product/<?php echo $row['secondary_image_1']; ?>" alt="img">
                                                    </div>
                                                    <div class="productviewscontent">
                                                        <div class="productviewsname">
                                                            <h3>581kb</h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="productviews">
                                                    <div class="productviewsimg">
                                                        <img src="assets/img/product/<?php echo $row['secondary_image_2']; ?>" alt="img">
                                                    </div>
                                                    <div class="productviewscontent">
                                                        <div class="productviewsname">
                                                            <h3>581kb</h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-12 text-center">
                                    <input type="hidden" value="<?php echo $row['product_id']; ?>" name="product_id">
                                    <input type="hidden" value="editprod" name="action">
                                    <button type="submit" name="editprod" class="btn btn-submit me-2">Update</button>
                                    <a href="./" class="btn btn-cancel">Cancel</a>
                                </div>
                                <div class="col-12 text-center">
                                    <div id="response"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php }?>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
    $('#category_id').change(function() {
    var category_id = $(this).val();

    $.ajax({
    type: 'GET',
    url: 'get_subcategories.php',
    data: { category_id: category_id },
    success: function(data) {
    $('#subcategory_select').html(data);
    }
    });
    });
    });
</script>

<script>
    $(document).ready(function() {
        // Obtenir category_id lors du chargement de la page
        var category_id = $('#category_id').val();

        // Si category_id est défini, exécuter la requête AJAX
        if (category_id) {
            $.ajax({
                type: 'GET',
                url: 'get_subcategories.php',
                data: { category_id: category_id },
                success: function(data) {
                    $('#subcategory_select').html(data);
                }
            });
        }

        // Écouter les changements de la sélection de catégorie
        $('#category_id').change(function() {
            var category_id = $(this).val();

            $.ajax({
                type: 'GET',
                url: 'get_subcategories.php',
                data: { category_id: category_id },
                success: function(data) {
                    $('#subcategory_select').html(data);
                }
            });
        });
    });
</script>



<script src="assets/js/jquery-3.6.0.min.js"></script>
<script src="assets/js/edit.js"></script>

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