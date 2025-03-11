<?php
    if (isset($_SESSION['ad_id'])) {
        $ad_id = $_SESSION['ad_id'];
        $sql_main = "SELECT * FROM admin WHERE ad_id = '$ad_id'";
        $result_main = mysqli_query($con, $sql_main) or die(mysqli_error($con));
        $row_main = mysqli_fetch_assoc($result_main);
        $ad_name = $row_main['ad_name'];
        $role = $row_main['role'];
        $image = $row_main['ad_img'];
    }else{
        $ad_name = 'Biro';
        $role = 'Admin';
        $image = 'noimage.png';
    }
    ?>
<div class="header no-print">
    <div class="header-left sama-header active">
        <a href="./" class="logo">
            <img class="img-logo" src="assets/img/lastlogo.png" alt="">
        </a>
        <a href="./" class="logo-small">
            <img src="assets/img/lastlogo.png" alt="">
        </a>
        <a id="toggle_btn" href="javascript:void(0);">
        </a>
    </div>

    <a id="mobile_btn" class="mobile_btn" href="#sidebar">
        <span class="bar-icon">
        <span></span>
        <span></span>
        <span></span>
        </span>
    </a>

    <ul class="nav user-menu">

        <li class="nav-item">
            <div class="top-nav-search">
                <a href="javascript:void(0);" class="responsive-search">
                    <i class="fa fa-search"></i>
                </a>
                <form action="#">
                    <div class="searchinputs">
                        <input type="text" placeholder="Search Here ...">
                        <div class="search-addon">
                            <span><img src="assets/img/icons/closes.svg" alt="img"></span>
                        </div>
                    </div>
                    <a class="btn" id="searchdiv"><img src="assets/img/icons/search.svg" alt="img"></a>
                </form>
            </div>
        </li>

        <li class="nav-item dropdown has-arrow main-drop">
            <a href="javascript:void(0);" class="dropdown-toggle nav-link userset" data-bs-toggle="dropdown">
            <span class="user-img"><img src="assets/img/profiles/avator1.jpg" alt="">
            <span class="status online"></span></span>
            </a>
            <div class="dropdown-menu menu-drop-user">
                <div class="profilename">
                    <div class="profileset">
                        <span class="user-img"><img src="assets/img/profiles/<?php echo $ad_img;?>" alt=""></span>
                        <div class="profilesets">
                            <h6><?php echo $ad_name;?></h6>
                            <h5><?php echo $role;?></h5>
                        </div>
                    </div>
                    <hr class="m-0">
                    <?php
                        if (isset($_SESSION['ad_id'])) { ?>
                        <a class="dropdown-item" href="profile.php"> <i class="me-2" data-feather="user"></i> My Profile</a>
                        <a class="dropdown-item" href="generalsettings.html"><i class="me-2" data-feather="settings"></i>Settings</a>
                        <hr class="m-0">
                        <a class="dropdown-item logout pb-0" href="lock.php"><img src="assets/img/icons/lock.svg" class="me-2" alt="img">Lock</a>
                        <a class="dropdown-item logout pb-0" href="logout.php"><img src="assets/img/icons/log-out.svg" class="me-2" alt="img">Logout</a>
                    <?php }else{
                        echo'<a class="dropdown-item" href="signin.php"> <i class="me-2" data-feather="user"></i> Login</a>';
                    }?>
                </div>
            </div>
        </li>
    </ul>

    <?php
        if (isset($_SESSION['ad_id'])) { ?>
        <div class="dropdown mobile-user-menu">
            <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="profile.php">My Profile</a>
                <a class="dropdown-item" href="generalsettings.html">Settings</a>
                <a class="dropdown-item" href="lock.php">Lock</a>
                <a class="dropdown-item" href="logout.php">Logout</a>
            </div>
        </div>
    <?php }?>

</div>