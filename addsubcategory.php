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
    <title>Add New Subcategory</title>

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

    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Product Add sub Category</h4>
                    <h6>Create new product Category</h6>
                </div>
            </div>
            <form method="post" enctype="multipart/form-data" id="addForm">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Parent Category</label>
                                    <select class="select" id="category_id" name="category_id" required>
                                    <option value="">-- Sélectionner une catégorie --</option>
                                    <?php
                                    $sql_categories = "SELECT * FROM categories";
                                    $result_categories = mysqli_query($con, $sql_categories) or die(mysqli_error($con));
                                    while ($row_categories = mysqli_fetch_assoc($result_categories)) {
                                        $category_id = $row_categories['category_id'];
                                        $category_name = $row_categories['category_name'];
                                        ?>
                                        <option value="<?php echo $category_id; ?>" required><?php echo $category_name; ?></option>
                                        <?php
                                    }
                                    ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label>Subcategory Name</label>
                                    <input type="text" name="subcategory_name" required>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" name="description"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input class="form-control" type="file" name="image"><br>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <input type="hidden" name="action" value="addsubcategory">
                                <button type="submit" name="addsubcategory" class="btn btn-submit me-2">Submit</button>
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