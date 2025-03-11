<?php require 'config.php'; require 'session.php';?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="POS - Bootstrap Admin Template">
    <meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern,  html5, responsive">
    <meta name="author" content="Dreamguys - Bootstrap Admin Template">
    <meta name="robots" content="noindex, nofollow">
    <title>POS /Profile</title>

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
                <div class="page-header">
                    <div class="page-title">
                        <h4>Profile</h4>
                        <h6>Admin Profile</h6>
                    </div>
                    <div class="page-btn no-print">
                        <a class="btn btn-added" href="#" data-bs-toggle="modal" data-bs-target="#edit_pass">
                            <img src="assets/img/icons/edit-set.svg" alt="img" class="me-1">Password
                        </a>
                        <div class="modal custom-modal fade" id="edit_pass" role="dialog">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content text-center">
                                    <div class="modal-body">
                                        <div class="modal-btn delete-action">
                                            <div class="row">
                                                <form id="formulaire">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div id="message"></div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <label>Old Password</label>
                                                                <div class="pass-group">
                                                                    <input type="password" name="opassword" class="pass-input">
                                                                    <span class="fas toggle-password fa-eye-slash"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label>Password</label>
                                                                <div class="pass-group">
                                                                    <input type="password" name="password" class="pass-input">
                                                                    <span class="fas toggle-password fa-eye-slash"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-sm-12">
                                                            <div class="form-group">
                                                                <label>Conf Password</label>
                                                                <div class="pass-group">
                                                                    <input type="password" name="cpassword" class="pass-input">
                                                                    <span class="fas toggle-password fa-eye-slash"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 text-center">
                                                            <input type="hidden" id="ad_id" name="ad_id" value="<?php echo $row_main['ad_id'];?>" required>
                                                            <input type="hidden" name="action" value="mdp">
                                                            <button id="submit" name="mod_mdp" class="btn btn-submit me-2">Submit</button>
                                                            <a href="javascript:void(0);" data-bs-dismiss="modal" class="btn btn-cancel me-2">Cancel</a>
                                                        </div>
                                                    </div>
                                                </form>
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
                        <div class="profile-set">
                            <div class="profile-head"></div>
                            <div class="profile-top">
                                <div class="profile-content">
                                    <div class="profile-contentimg">
                                        <img src="assets/img/profiles/<?php echo $row_main['ad_img'];?>" alt="img" id="blah">
                                    </div>
                                    <div class="profile-contentname">
                                        <h2><?php echo $row_main['ad_name'];?></h2>
                                        <h4 class="text-success"><?php echo $row_main['ad_email'];?>.</h4>
                                    </div>
                                </div>
                                <div class="ms-auto">
                                    <div id="message2"></div>
                                </div>
                            </div>
                        </div>
                        <form method="post" action="profile_process.php" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <div class="form-group">
                                        <label for="image">Image</label>
                                        <input class="form-control" type="file" name="image">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="username" value="<?php echo $row_main['ad_name'];?>">
                                        <input type="hidden" name="ad_img" value="<?php echo $row_main['ad_img'];?>">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="text" name="telephone" value="<?php echo $row_main['ad_telephone'];?>">
                                    </div>
                                </div>
                                <div class="col-12 text-center">
                                    <input type="hidden" id="ad_id" name="ad_id" value="<?php echo $row_main['ad_id'];?>" required>
                                    <input type="hidden" name="action" value="profile">
                                    <button id="submit" name="mod_mdp" class="btn btn-submit me-2">Submit</button>
                                </div>
                            </div>
                        </form>
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

<script>
    // Soumission du formulaire
    $('#formulaire').submit(function(e) {
        e.preventDefault(); // Empêche la soumission normale du formulaire

        // Récupération des données du formulaire
        var formData = $(this).serialize();

        // Envoi des données via AJAX
        $.ajax({
            type: 'POST',
            url: 'profile_process.php', // L'URL de votre script PHP
            data: formData,
            dataType: 'json', // Attend une réponse JSON
            success: function(response) {
                if (response.error) {
                    $('#message').html('<div class="alert alert-danger alert-dismissible fade show" role="alert">'+response.error+'</div>');
                    $('#formulaire')[0].reset();
                } else if (response.success) {
                    $('#message').html('<div class="alert alert-success alert-dismissible fade show" role="alert">'+response.success+'</div>');
                    // Réinitialiser le formulaire si la mise à jour est réussie
                    $('#formulaire')[0].reset();
                }
            },
            error: function() {
                showMessage('Une erreur s\'est produite lors de la requête.', 'danger');
            }
        });
    });
</script>
</body>
</html>