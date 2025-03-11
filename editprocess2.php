<?php require 'config.php';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["editprod"])) {
    // Fonction pour générer un slug à partir d'une chaîne
    function generateSlug($str) {
        // Generate a random number of 6 digits
        $randomNumber = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        
        // Convert the string to lowercase
        $slug = strtolower($str);
        
        // Replace special characters with '-'
        $slug = preg_replace('/[^a-z0-9-]+/', '-', $slug);
        
        // Remove leading and trailing '-'
        $slug = trim($slug, '-');
        
        // Append the random number and '.html'
        $slug = $randomNumber . '-' . $slug . '.html';
        
        return $slug;
    }
    function genererNumeroPR() {
        $prefixe = "PR0";
        $chiffresAleatoires = mt_rand(10000000, 99999999); // Génère un nombre aléatoire de 8 chiffres
        return $prefixe . $chiffresAleatoires;
    }
    // Récupère les valeurs du formulaire
    $product_id = mysqli_real_escape_string($con, $_POST['product_id']);
    $image_actuel = mysqli_real_escape_string($con, $_POST['image_actuel']);
    $product_name = mysqli_real_escape_string($con, $_POST['product_name']);
    $old_product_name = mysqli_real_escape_string($con, $_POST['old_product_name']);
    $category_id = mysqli_real_escape_string($con, $_POST['category_id']);
    $subcategory_id = mysqli_real_escape_string($con, $_POST['subcategory_id']);
    $brand_id = mysqli_real_escape_string($con, $_POST['brand_id']);
    $product_featured = mysqli_real_escape_string($con, $_POST['product_featured']);
    $discount_start = mysqli_real_escape_string($con, $_POST['discount_start']);
    $discount_ends = mysqli_real_escape_string($con, $_POST['discount_ends']);
    $product_quantity = mysqli_real_escape_string($con, $_POST['product_quantity']);
    $product_details = mysqli_real_escape_string($con, $_POST['product_details']);
    $product_tags = mysqli_real_escape_string($con, $_POST['product_tags']);
    $product_price = mysqli_real_escape_string($con, $_POST['product_price']);

    if ($product_name !== $old_product_name) {
        $slug = generateSlug("$product_name");
        $sku = genererNumeroPR();
    } else {
        // Use the existing slug
        $slug = mysqli_real_escape_string($con, $_POST['slug']);
        $sku = mysqli_real_escape_string($con, $_POST['sku']);
    }
    
    // Image upload
    if (!empty($_FILES["image"]["name"])) {
        $image = $_FILES["image"]["name"];
        $imagePath = 'assets/img/product/' . $image;
        move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath);
    } else {
        // Set default image filename
        $image = $image_actuel;
    }
    echo '
    <div style="display: flex; justify-content: center;">
        <div id="myDiv">
            <img src="assets/img/barcode2.png" alt="barcode">
            <p style="text-align:center;">' . $sku . '</p>
        </div>
    </div><hr/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.min.js"></script>
    <script>
        window.onload = function () {
            convertToImage();
        };
        function convertToImage() {
            var node = document.getElementById("myDiv");
            domtoimage.toPng(node)
                .then(function (dataUrl) {
                    var xhr = new XMLHttpRequest();
                    xhr.open("GET", dataUrl, true);
                    xhr.responseType = "blob";
        
                    xhr.onload = function () {
                        if (this.status === 200) {
                            var blob = this.response;
                            var formData = new FormData();
                            formData.append("image", blob, "' . $sku . '.png");
        
                            var xhr2 = new XMLHttpRequest();
                            xhr2.open("POST", "save_image.php", true);
                            xhr2.onreadystatechange = function () {
                                if (xhr2.readyState === 4 && xhr2.status === 200) {
                                    console.log("Image saved successfully.");
                                }
                            };
                            xhr2.send(formData);
                        }
                    };
        
                    xhr.send();
                })
                .catch(function (error) {
                    console.error("Error converting div to image:", error);
                });
        }        
    </script>';

    //set it to writable location, a place for temp generated PNG files
    $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'assets/img/qrcode'.DIRECTORY_SEPARATOR;

    //html PNG location prefix
    $PNG_WEB_DIR = 'assets/img/qrcode/';

    include "phpqrcode/qrlib.php";
    //ofcourse we need rights to create temp dir
    if (!file_exists($PNG_TEMP_DIR))
        mkdir($PNG_TEMP_DIR);
    
    $filename = $PNG_TEMP_DIR.'test.png';
    
    //processing form input
    //remember to sanitize user input in real-life solution !!!
    $errorCorrectionLevel = 'L';
    if (isset($_REQUEST['level']) && in_array($_REQUEST['level'], array('L','M','Q','H')))
        $errorCorrectionLevel = $_REQUEST['level'];    

    $matrixPointSize = 4;
    if (isset($_REQUEST['size']))
        $matrixPointSize = min(max((int)$_REQUEST['size'], 1), 10);

    $_REQUEST['data'] = $_POST["product_name"];
    if (isset($_REQUEST['data'])) {
    
        //it's very important!
        if (trim($_REQUEST['data']) == '')
            die('data cannot be empty! <a href="?">back</a>');

        // user data
        $filename = $PNG_TEMP_DIR.'qr-'.$sku.'.png';
        QRcode::png($_REQUEST['data'], $filename, $errorCorrectionLevel, $matrixPointSize, 2);
    } else {
    
        //default data
        echo 'You can provide data in GET parameter: <a href="?data=like_that">like that</a><hr/>';   
        QRcode::png('PHP QR Code :)', $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
        
    }
        
    //display generated file
    echo '  <div style="display: flex; justify-content: center;">
                <div>
                    <img src="'.$PNG_WEB_DIR.basename($filename).'" />
                </div>
            </div>';

    
    $qrcode = 'qr-'.$sku.'.png';
    $barcode = $sku.'.png';
    // benchmark
    // QRtools::timeBenchmark();

    // Prépare la requête SQL
    $stmt = mysqli_prepare($con, "UPDATE products SET
            product_name = ?,
            sku = ?,
            category_id = ?,
            subcategory_id = ?,
            brand_id = ?,
            product_featured = ?,
            discount_start = ?,
            discount_ends = ?,
            product_quantity = ?,
            main_image = ?,
            product_details = ?,
            product_tags = ?,
            product_price = ?,
            product_slug = ?,
            barcode = ?,
            qrcode = ?,
            updated_at = NOW()
            WHERE product_id = ?");
    mysqli_stmt_bind_param($stmt, "ssiiiissississssi", $product_name, $sku, $category_id, $subcategory_id, $brand_id, $product_featured, $discount_start, $discount_ends, $product_quantity, $image, $product_details, $product_tags, $product_price, $slug, $barcode, $qrcode, $product_id);

    if (mysqli_stmt_execute($stmt)) {
        echo "Produit Modifer Avec Succes.";
        // Retarder la redirection de 5 secondes
        sleep(5);
        // Rediriger vers une autre page
        echo '<meta http-equiv="refresh" content="1;url=' . $_SERVER['HTTP_REFERER'] . '">';
        exit;
    } else {
        echo "Erreur: " . mysqli_error($con);
    }

    mysqli_stmt_close($stmt);
}elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["editbrand"])) {
    // Fonction pour générer un slug à partir d'une chaîne
    function generateSlug($str) {
        $slug = strtolower($str);
        $slug = preg_replace('/[^a-z0-9-]+/', '-', $slug);
        $slug = trim($slug, '-');
        return 'br-' . $slug; // Add 'cat-' prefix to the slug
    }  
    // Récupère les valeurs du formulaire
    $brand_id = mysqli_real_escape_string($con, $_POST['brand_id']);

    // Récupère les autres valeurs du formulaire
    $brand_name = mysqli_real_escape_string($con, $_POST['brand_name']);
    $old_brand_name = mysqli_real_escape_string($con, $_POST['old_brand_name']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $brand_img = mysqli_real_escape_string($con, $_POST['brand_img']);


    if ($brand_name !== $old_brand_name) {
        $slug = generateSlug("$brand_name");
    } else {
        // Use the existing slug
        $slug = mysqli_real_escape_string($con, $_POST['slug']);
    }
    
    // Image upload
    if (!empty($_FILES["image"]["name"])) {
        $image = $_FILES["image"]["name"];
        $imagePath = 'assets/img/brand/' . $image;
        move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath);
    } else {
        // Set default image filename
        $image = $brand_img;
    }

    // Prépare la requête SQL
    $stmt = mysqli_prepare($con, "UPDATE brands SET
            brand_name = ?,
            description = ?,
            brand_slug = ?,
            brand_img = ?,
            brand_updated_at = NOW()
            WHERE brand_id = ?");
    mysqli_stmt_bind_param($stmt, "ssssi", $brand_name, $description, $slug, $image, $brand_id);

    if (mysqli_stmt_execute($stmt)) {
        echo "Brand Modifer Avec Succes.";
        // Retarder la redirection de 5 secondes
        sleep(5);
        // Rediriger vers une autre page
        echo '<meta http-equiv="refresh" content="1;url=' . $_SERVER['HTTP_REFERER'] . '">';
        exit;
    } else {
        echo "Erreur: " . mysqli_error($con);
    }
    mysqli_stmt_close($stmt);
}elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["editcategory"])) {
    // Fonction pour générer un slug à partir d'une chaîne
    function generateSlug($str) {
        $slug = strtolower($str);
        $slug = preg_replace('/[^a-z0-9-]+/', '-', $slug);
        $slug = trim($slug, '-');
        return 'cat-' . $slug; // Add 'cat-' prefix to the slug
    }
       
    // Récupère les valeurs du formulaire
    $category_id = mysqli_real_escape_string($con, $_POST['category_id']);

    // Récupère les autres valeurs du formulaire
    $category_name = mysqli_real_escape_string($con, $_POST['category_name']);
    $old_category_name = mysqli_real_escape_string($con, $_POST['old_category_name']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $cat_img = mysqli_real_escape_string($con, $_POST['cat_img']);


    if ($category_name !== $old_category_name) {
        $slug = generateSlug("$category_name");
    } else {
        // Use the existing slug
        $slug = mysqli_real_escape_string($con, $_POST['slug']);
    }
    
    // Image upload
    if (!empty($_FILES["image"]["name"])) {
        $image = $_FILES["image"]["name"];
        $imagePath = 'assets/img/category/' . $image;
        move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath);
    } else {
        // Set default image filename
        $image = $cat_img;
    }

    // Prépare la requête SQL
    $stmt = mysqli_prepare($con, "UPDATE categories SET
            category_name = ?,
            description = ?,
            cat_slug = ?,
            cat_img = ?,
            cat_updated_at = NOW()
            WHERE category_id = ?");
    mysqli_stmt_bind_param($stmt, "ssssi", $category_name, $description, $slug, $image, $category_id);

    if (mysqli_stmt_execute($stmt)) {
        echo "Produit Modifer Avec Succes.";
        // Retarder la redirection de 5 secondes
        sleep(5);
        // Rediriger vers une autre page
        echo '<meta http-equiv="refresh" content="1;url=' . $_SERVER['HTTP_REFERER'] . '">';
        exit;
    } else {
        echo "Erreur: " . mysqli_error($con);
    }

    mysqli_stmt_close($stmt);
}elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["editsubcategory"])) {
    // Fonction pour générer un slug à partir d'une chaîne
    function generateSlug($str) {
        $slug = strtolower($str);
        $slug = preg_replace('/[^a-z0-9-]+/', '-', $slug);
        $slug = trim($slug, '-');
        return 'subcat-' . $slug; // Add 'cat-' prefix to the slug
    }
    // Récupère les valeurs du formulaire
    $subcategory_id = mysqli_real_escape_string($con, $_POST['subcategory_id']);
    $category_id = mysqli_real_escape_string($con, $_POST['category_id']);

    // Récupère les autres valeurs du formulaire
    $subcategory_name = mysqli_real_escape_string($con, $_POST['subcategory_name']);
    $old_subcategory_name = mysqli_real_escape_string($con, $_POST['old_subcategory_name']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $subcat_img = mysqli_real_escape_string($con, $_POST['subcat_img']);


    if ($subcategory_name !== $old_subcategory_name) {
        $slug = generateSlug("$subcategory_name");
    } else {
        // Use the existing slug
        $slug = mysqli_real_escape_string($con, $_POST['slug']);
    }
    
    // Image upload
    if (!empty($_FILES["image"]["name"])) {
        $image = $_FILES["image"]["name"];
        $imagePath = 'assets/img/subcategory/' . $image;
        move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath);
    } else {
        // Set default image filename
        $image = $subcat_img;
    }

    // Prépare la requête SQL
    $stmt = mysqli_prepare($con, "UPDATE subcategories SET
            category_id = ?,
            subcategory_name = ?,
            description = ?,
            subcat_slug = ?,
            subcat_img = ?,
            subcat_updated_at = NOW()
            WHERE subcategory_id = ?");
    mysqli_stmt_bind_param($stmt, "issssi", $category_id, $subcategory_name, $description, $slug, $image, $subcategory_id);

    if (mysqli_stmt_execute($stmt)) {
        echo "Subcategorie Modifer Avec Succes.";
        // Retarder la redirection de 5 secondes
        sleep(5);
        // Rediriger vers une autre page
        echo '<meta http-equiv="refresh" content="1;url=' . $_SERVER['HTTP_REFERER'] . '">';
        exit;
    } else {
        echo "Erreur: " . mysqli_error($con);
    }

    mysqli_stmt_close($stmt);
}
?>