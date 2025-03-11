    <!--Sidebar --->
    <div class="sidebar no-print" id="sidebar">
        <div class="sidebar-inner slimscroll">
            <div id="sidebar-menu" class="sidebar-menu">
                <ul>
                <?php
                if (isset($_SESSION['ad_id'])) { ?>

                    <?php
                        $current_page = basename($_SERVER['PHP_SELF']);

                        function is_active($page_name) {
                            global $current_page;
                            if ($page_name === $current_page) {
                                echo 'active';
                            }
                        }
                    ?>
                    <li class="<?php is_active('index.php'); is_active('profile.php'); ?>">
                        <a href="./"><img src="assets/img/icons/dashboard.svg" alt="img"><span> Tableau Bord</span> </a>
                    </li>
                    <li class="submenu">
                        <a href="javascript:void(0);"><img src="assets/img/icons/product.svg" alt="img"><span> Produits</span> <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a class="<?php is_active('productlist.php'); ?>" href="productlist.php">Liste Produits</a></li>
                            <?php
                                if ($current_page === 'product-details.php') {
                                    echo"<li><a class='active'>Details Produit </a></li>";}
                                elseif
                                    ($current_page === 'editproduct.php') {
                                    echo"<li><a class='active'>Modifier Product</a></li>";}
                            ?>
                            <li><a class="<?php is_active('addproduct.php');?>" href="addproduct.php">Ajouter Produit</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="javascript:void(0);"><img src="assets/img/icons/product.svg" alt="img"><span> Categories</span> <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a class="<?php is_active('categorylist.php');?>" href="categorylist.php">Liste Categorie </a></li>
                            <?php
                                if ($current_page === 'category-details.php') {
                                    echo"<li><a class='active'>Details Categorie </a></li>";}
                                elseif
                                    ($current_page === 'editcategory.php') {
                                    echo"<li><a class='active'>Modifier Categorie</a></li>";}
                            ?>
                            <li><a class="<?php is_active('addcategory.php'); ?>" href="addcategory.php">Ajouter Categorie</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="javascript:void(0);"><img src="assets/img/icons/product.svg" alt="img"><span> Subcategories</span> <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a class="<?php is_active('subcategorylist.php'); ?>" href="subcategorylist.php">Liste SubCategorie </a></li>
                            <?php
                                if ($current_page === 'subcategory-details.php') {
                                    echo"<li><a class='active'>Subcategory Details</a></li>";}
                                elseif
                                    ($current_page === 'editsubcategory.php') {
                                    echo"<li><a class='active'>Edit Subcategory</a></li>";}
                            ?>
                            <li><a class="<?php is_active('addsubcategory.php'); ?>" href="addsubcategory.php">Ajouter SubCategory</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="javascript:void(0);"><img src="assets/img/icons/product.svg" alt="img"><span> Marque</span> <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a class="<?php is_active('brandlist.php'); ?>" href="brandlist.php">Liste Marques </a></li>
                            <?php
                                if ($current_page === 'brand-details.php') {
                                    echo"<li><a class='active'>Details Marque </a></li>";}
                                elseif
                                    ($current_page === 'editbrand.php') {
                                    echo"<li><a class='active'>Modidfier Marque</a></li>";}
                            ?>
                            <li><a class="<?php is_active('addbrand.php'); ?>" href="addbrand.php">Ajouter Marque</a></li>
                        </ul>
                    </li>
                    <li class="submenu sales-parent">
                        <a href="javascript:void(0);"><img src="assets/img/icons/sales1.svg" alt="img"><span> Vente</span> <span class="menu-arrow"></span></a>
                        <ul>
                            <li><a class="<?php is_active('groupedsaleslist.php'); ?>" href="groupedsaleslist.php">Vente Groupées</a></li>
                            <li><a class="<?php is_active('saleslist.php'); ?>" href="saleslist.php">Liste Vente </a></li>
                            <?php
                                if ($current_page === 'salesdetails.php') {
                                    echo"<li><a class='active'>Sale Details</a></li>";}
                                elseif
                                    ($current_page === 'editsales.php') {
                                    echo"<li><a class='active'>Edit Sales</a></li>";}
                            ?>
                            <li><a class="<?php is_active('pos.php'); ?>" href="pos.php">PDV</a></li>
                            <li><a class="sales-add" href="pos.html">Nouvelle Vente</a></li>
                            <li><a class="<?php is_active('salesreturnlists.php'); ?>" href="salesreturnlists.php">Ventes Returnées</a></li>
                        </ul>
                    </li>
                    <?php }else{
                        echo'<li><a href="signin.php">Se connecter</a></li>';
                    }?>
                </ul>
            </div>
        </div>
    </div>
    <!--Sidebar --->