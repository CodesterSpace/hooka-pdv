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
        $sql = "SELECT * FROM brands WHERE brand_id =$id
        ";
        $result = mysqli_query($con, $sql) or die(mysqli_error($con));
        $row = mysqli_fetch_assoc($result);{
        ?>
        <div class="page-wrapper">
            <div class="content">
                <div class="page-header">
                    <div class="page-title">
                        <h4>Category Edit</h4>
                        <h6>Update your category</h6>
                    </div>
                    <div class="view-product">
                        <a class="btn btn-submit me-2" href="<?php echo $row['brand_slug']; ?>">
                            <img src="assets/img/icons/eye.svg" width="18" alt="img">
                        </a>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <form id="updateForm" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Brand Name</label>
                                        <input type="text" value="<?php echo $row['brand_name']; ?>" name="brand_name" required>
                                        <input type="hidden" name="brand_id" value="<?php echo $row['brand_id']; ?>">
                                        <input type="hidden" name="old_brand_name" value="<?php echo $row['brand_name']; ?>">
                                        <input type="hidden" name="slug" value="<?php echo $row['brand_slug']; ?>"><br>
                                        <input type="hidden" name="brand_img" value="<?php echo $row['brand_img']; ?>"><br>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" name="description"><?php echo $row['description']; ?></textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                    <label for="image">Image</label>
                                    <input class="form-control" type="file" name="image"><br>
                                    </div>
                                </div>

                                <div class="col-12 text-center">
                                    <input type="hidden" name="editbrand" value="<?php echo $row['brand_id']; ?>" name="brand_id">
                                    <input type="hidden" name="action" value="editbrand">
                                    <button type="submit" class="btn btn-submit me-2">Update</button>
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