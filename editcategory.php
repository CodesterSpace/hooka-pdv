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
        $sql = "SELECT * FROM categories WHERE category_id =$id
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
                        <a class="btn btn-submit me-2" href="<?php echo $row['cat_slug']; ?>">
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
                                        <label>Category Name</label>
                                        <input type="text" value="<?php echo $row['category_name']; ?>" name="category_name" required>
                                        <input type="hidden" name="old_category_name" value="<?php echo $row['category_name']; ?>">
                                        <input type="hidden" name="slug" value="<?php echo $row['cat_slug']; ?>"><br>
                                        <input type="hidden" name="cat_img" value="<?php echo $row['cat_img']; ?>"><br>
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
                                <div class="col-12">
                                    <div class="product-list">
                                        <ul class="row">
                                            <li>
                                                <div class="productviews">
                                                    <div class="productviewsimg">
                                                        <img src="assets/img/category/<?php echo $row['cat_img']; ?>" alt="img">
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
                                    <input type="hidden" value="<?php echo $row['category_id']; ?>" name="category_id">
                                    <input type="hidden" name="action" value="editcategory">
                                    <button type="submit" name="editcategory" class="btn btn-submit me-2">Update</button>
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