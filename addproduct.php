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
<link rel="stylesheet" href="assets/css/editor.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet"/>

</head>
<body>
<div id="global-loader">
<div class="whirly-loader"></div>
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
                    <h4>Product Add</h4>
                    <h6>Create new product</h6>
                </div>
            </div>

            <form method="post" enctype="multipart/form-data" id="addForm">
                <div class="card">
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                <label>Product Name</label>
                                <input type="text" name="product_name" required>
                                </div>
                            </div>

                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                <label>Category or <a href="#" data-bs-toggle="modal" data-bs-target="#add_category"><i class="fas fa-plus"></i> Category</a></label>
                                <select class="select" id="category_id" name="category_id" required>
                                    <option value="">-- Sélectionner une catégorie --</option>
                                    <?php
                                    $sql = "SELECT * FROM categories";
                                    $result = mysqli_query($con, $sql) or die(mysqli_error($con));
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $category_id = $row['category_id'];
                                        $category_name = $row['category_name'];
                                        ?>
                                        <option value="<?php echo $category_id; ?>" required><?php echo $category_name; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                </div>
                            </div>

                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Sub Category or <a href="#" data-bs-toggle="modal" data-bs-target="#add_subcategory"><i class="fas fa-plus"></i> Subcategory</a></label>
                                    <select class="select" id="subcategory_select" name="subcategory_id" required>
                                    <option value="">-- Sélectionner sous-catégorie --</option>
                                    </select>
                                </div>
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

                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Brand or <a href="#" data-bs-toggle="modal" data-bs-target="#add_brand"><i class="fas fa-plus"></i> Brand</a></label>
                                    <select class="select" id="brand_id" name="brand_id" required>
                                        <option value="">-- Sélectionner une marque --</option>
                                        <?php
                                        $sql_brands = "SELECT * FROM brands";
                                        $result_brands = mysqli_query($con, $sql_brands) or die(mysqli_error($con));
                                        while ($row_brands = mysqli_fetch_assoc($result_brands)) {
                                            $brand_id = $row_brands['brand_id'];
                                            $brand_name = $row_brands['brand_name'];
                                            ?>
                                            <option value="<?php echo $brand_id; ?>"><?php echo $brand_name; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>


                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                <label>Quantity</label>
                                <input type="text" name="product_quantity" required>
                                </div>
                            </div>
                            

                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                <label>Price</label>
                                <input type="text" name="product_price" required>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label>Main Image</label>
                                    <div class="image-upload">
                                        <input type="file" name="image" required>
                                        <div class="image-uploads">
                                            <img src="assets/img/icons/upload.svg" alt="img">
                                            <h4>Drop a file to upload Main Image</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <input type="hidden" name="action" value="addproduct">
                                <button type="submit" name="addproduct" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<script src="assets/js/jquery-3.6.0.min.js"></script>
<script src="assets/js/add.js"></script>

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