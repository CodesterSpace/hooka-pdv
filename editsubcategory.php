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
        $sql = "SELECT * FROM subcategories WHERE subcategory_id =$id
        ";
        $result = mysqli_query($con, $sql) or die(mysqli_error($con));
        $row = mysqli_fetch_assoc($result);{
        $s_category_id = $row['category_id'];
        ?>
        <div class="page-wrapper">
            <div class="content">
                <div class="page-header">
                    <div class="page-title">
                        <h4>Subcategory Edit</h4>
                        <h6>Update your Subcategory</h6>
                    </div>
                    <div class="view-product">
                        <a class="btn btn-submit me-2" href="<?php echo $row['subcat_slug']; ?>">
                            <img src="assets/img/icons/eye.svg" width="18" alt="img">
                        </a>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <form id="updateForm" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>Subcategory Name</label>
                                        <input type="text" value="<?php echo $row['subcategory_name']; ?>" name="subcategory_name" required>
                                        <input type="hidden" name="old_subcategory_name" value="<?php echo $row['subcategory_name']; ?>">
                                        <input type="hidden" name="slug" value="<?php echo $row['subcat_slug']; ?>"><br>
                                        <input type="hidden" name="subcat_img" value="<?php echo $row['subcat_img']; ?>"><br>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-12">
                                    <div class="form-group">
                                    <label>Parent Category</label>
                                    <select class="select" id="category_id" name="category_id" required>
                                    <?php
                                    $sql_categories = "SELECT * FROM categories";
                                    $result_categories = mysqli_query($con, $sql_categories) or die(mysqli_error($con));
                                    while ($row_categories = mysqli_fetch_assoc($result_categories)) {
                                        $category_id = $row_categories['category_id'];
                                        $category_name = $row_categories['category_name'];
                                        ?>
                                        <option value="<?php echo $category_id; ?>" <?php if ($category_id == $s_category_id) echo "selected"; ?> required><?php echo $category_name; ?></option>
                                        <?php
                                    }
                                    ?>
                                    </select>
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
                                    <input type="hidden" value="<?php echo $row['subcategory_id']; ?>" name="subcategory_id">
                                    <input type="hidden" value="editsubcategory" name="action">
                                    <button type="submit" name="editsubcategory" class="btn btn-submit me-2">Update</button>
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