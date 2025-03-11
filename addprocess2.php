<?php require 'config.php'; require 'session.php';
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['addbrand'])) {
    function generateSlug($str) {
        $slug = strtolower($str);
        $slug = preg_replace('/[^a-z0-9-]+/', '-', $slug);
        $slug = trim($slug, '-');
        return 'br-' . $slug; // Add 'br-' prefix to the slug
    }
    function genererNumeroBR() {
        $prefixe = "BR0";
        $chiffresAleatoires = mt_rand(10000000, 99999999); // Génère un nombre aléatoire de 8 chiffres
        return $prefixe . $chiffresAleatoires;
    }
    
    // Exemple d'utilisation
    $numeroBR = genererNumeroBR();
    
    // Retrieve form data
    $brand_name = $_POST["brand_name"];
    $description = $_POST["description"];
    $slug = generateSlug($brand_name);

    // Image upload
    if (!empty($_FILES["image"]["name"])) {
        $image = $_FILES["image"]["name"];
        $imagePath = 'assets/img/brand/' . $image;
        move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath);
    }else{
        $image = "noimage.png"; // Par défaut
    }

    // Prepare the SQL statement with placeholders
    $sql = "INSERT INTO brands (brand_name, description, brand_code, brand_slug, brand_img)
            VALUES (?, ?, ?, ?, ?)";

    // Create a prepared statement
    $stmt = mysqli_prepare($con, $sql);

    // Bind the parameters to the prepared statement
    mysqli_stmt_bind_param($stmt, "sssss", $brand_name, $description, $numeroBR, $slug, $image);

    // Execute the prepared statement
    if (mysqli_stmt_execute($stmt)) {
        echo "Marque ajoutée avec succès.";
        echo '<meta http-equiv="refresh" content="1;url=' . $_SERVER['HTTP_REFERER'] . '">';
        exit;
        // Perform any additional actions after successful insertion, such as redirecting the user or displaying a success message.
    } else {
        echo "Erreur lors de l'insertion : " . mysqli_error($con);
        // Handle the case when an error occurs during the insertion.
    }

    // Close the prepared statement
    mysqli_stmt_close($stmt);
}elseif ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['addproduct'])) {
    function genererNumeroPR() {
        $prefixe = "PR0";
        $chiffresAleatoires = mt_rand(10000000, 99999999); // Génère un nombre aléatoire de 8 chiffres
        return $prefixe . $chiffresAleatoires;
    }

    function generateSlug($str) {
        $randomNumber = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        $slug = strtolower($str);
        $slug = preg_replace('/[^a-z0-9-]+/', '-', $slug);
        $slug = trim($slug, '-');
        $slug = $randomNumber . '-' . $slug . '.html';
        return $slug;
    }

    // Exemple d'utilisation
    $sku = genererNumeroPR();
    // Function to generate a barcode image
    function generateBarcode($text, $destination) {
        $barcodeWidth = 300;
        $barcodeHeight = 100;
        $image = imagecreate($barcodeWidth, $barcodeHeight);
        $innerImage = imagecreatefrompng('barrecode.png');
        $white = imagecolorallocate($image, 255, 255, 255);
        $black = imagecolorallocate($image, 0, 0, 0);
        imagefill($image, 0, 0, $white);
        $innerImageWidth = imagesx($innerImage);
        $innerImageHeight = imagesy($innerImage);
        $innerImageX = ($barcodeWidth - $innerImageWidth) / 2;
        $innerImageY = ($barcodeHeight - $innerImageHeight) / 2;
        imagecopy($image, $innerImage, $innerImageX, $innerImageY, 0, 0, $innerImageWidth, $innerImageHeight);
        $textWidth = imagefontwidth(5) * strlen($text);
        $textX = ($barcodeWidth - $textWidth) / 2;
        $textY = $innerImageY + $innerImageHeight + (0.2 * 37.795);
        imagestring($image, 5, $textX, $textY, $text, $black);
        imagepng($image, $destination);
        imagedestroy($image);
        return $destination;
    }

    $product_name = $_POST["product_name"];
    $slug = generateSlug($product_name);
    $category_id = $_POST["category_id"];
    $subcategory_id = $_POST["subcategory_id"];
    $brand_id = $_POST["brand_id"];
    $product_details = $_POST["product_details"];
    $product_quantity = $_POST["product_quantity"];
    $product_price = $_POST["product_price"];
    $discount_start = $_POST["discount_start"];
    $discount_ends = $_POST["discount_ends"];
    $product_featured = $_POST["product_featured"];
    if (!empty($_FILES["image"]["name"])) {
        $image = $_FILES["image"]["name"];
        $imagePath = 'assets/img/product/' . $image;
        if (!move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath)) {
            echo "Erreur lors du téléchargement de l'image.";
            exit;
        }
    }

    if (!empty($_FILES["secondary_image_1"]["name"])) {
        $secondary_image_1 = $_FILES["secondary_image_1"]["name"];
        $imagePath2 = 'assets/img/product/' . $secondary_image_1;
        if (!move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath2)) {
            echo "Erreur lors du téléchargement de l'image.";
            exit;
        }
    }else{
        $secondary_image_1 = $image;
    }

    if (!empty($_FILES["secondary_image_2"]["name"])) {
        $secondary_image_2 = $_FILES["secondary_image_2"]["name"];
        $imagePath3 = 'assets/img/product/' . $secondary_image_2;
        if (!move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath3)) {
            echo "Erreur lors du téléchargement de l'image.";
            exit;
        }
    }else{
        $secondary_image_2 = $image;
    }

    // Generate barcode
    $barcodePath = 'assets/img/code-barre/cb-' . $sku . '.png';
    generateBarcode($sku, $barcodePath);

    // Generate QR code
    $PNG_TEMP_DIR = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'assets/img/qrcode' . DIRECTORY_SEPARATOR;
    $PNG_WEB_DIR = 'assets/img/qrcode/';
    include "phpqrcode/qrlib.php";
    if (!file_exists($PNG_TEMP_DIR)) {
        mkdir($PNG_TEMP_DIR);
    }
    $filename = $PNG_TEMP_DIR . 'qr-' . $sku . '.png';
    $errorCorrectionLevel = 'L';
    $matrixPointSize = 4;
    $data = $_POST["product_name"];
    if (!empty($data)) {
        QRcode::png($data, $filename, $errorCorrectionLevel, $matrixPointSize, 2);
    } else {
        QRcode::png('PHP QR Code :)', $filename, $errorCorrectionLevel, $matrixPointSize, 2);
    }

    $barcode = 'cb-' . $sku . '.png';
    $qrcode = 'qr-' . $sku . '.png';

    $sql = "INSERT INTO products (sku, product_name, category_id, subcategory_id, brand_id, product_details, product_quantity, product_price, discount_start, discount_ends, product_featured, product_slug, main_image, secondary_image_1, secondary_image_2, barcode, qrcode)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "ssiiissssssssssss", $sku, $product_name, $category_id, $subcategory_id, $brand_id, $product_details, $product_quantity, $product_price, $discount_start, $discount_ends, $product_featured, $slug, $image, $secondary_image_1, $secondary_image_2, $barcode, $qrcode);

    if (mysqli_stmt_execute($stmt)) {
        echo "Produit ajouté avec succès.";
        echo '<meta http-equiv="refresh" content="1;url=' . $_SERVER['HTTP_REFERER'] . '">';
    } else {
        echo "Erreur lors de l'insertion : " . mysqli_error($con);
    }

    mysqli_stmt_close($stmt);
}elseif ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['addcategory'])) {
    function generateSlug($str) {
        $slug = strtolower($str);
        $slug = preg_replace('/[^a-z0-9-]+/', '-', $slug);
        $slug = trim($slug, '-');
        return 'cat-' . $slug; // Add 'cat-' prefix to the slug
    }
    function genererNumeroCT() {
        $prefixe = "CT0";
        $chiffresAleatoires = mt_rand(10000000, 99999999); // Génère un nombre aléatoire de 8 chiffres
        return $prefixe . $chiffresAleatoires;
    }
    
    // Exemple d'utilisation
    $numeroCT = genererNumeroCT();

    // Retrieve form data
    $category_name = $_POST["category_name"];
    $slug = generateSlug("$category_name");
    $description = $_POST["description"];
    // Image upload
    if (!empty($_FILES["image"]["name"])) {
        $image = $_FILES["image"]["name"];
        $imagePath = 'assets/img/category/' . $image;
        move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath);
    }else{
        $image = "noimage.png"; // Par défaut
    }

    // Prepare the SQL statement with placeholders
    $sql = "INSERT INTO categories (category_name, cat_slug, description, category_code, cat_img)
            VALUES (?, ?, ?, ?, ?)";

    // Create a prepared statement
    $stmt = mysqli_prepare($con, $sql);

    // Bind the parameters to the prepared statement
    mysqli_stmt_bind_param($stmt, "sssss", $category_name, $slug, $description, $numeroCT,$image);

    // Execute the prepared statement
    if (mysqli_stmt_execute($stmt)) {
        echo "Categorie ajouté avec succès.";
        echo '<meta http-equiv="refresh" content="1;url=' . $_SERVER['HTTP_REFERER'] . '">';
        exit;
        // Perform any additional actions after successful insertion, such as redirecting the user or displaying a success message.
    } else {
        echo "Erreur lors de l'insertion : " . mysqli_error($con);
        // Handle the case when an error occurs during the insertion.
    }

    // Close the prepared statement
    mysqli_stmt_close($stmt);
}elseif ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['addsubcategory'])) {
    function generateSlug($str) {
        $slug = strtolower($str);
        $slug = preg_replace('/[^a-z0-9-]+/', '-', $slug);
        $slug = trim($slug, '-');
        return 'subcat-' . $slug; // Add 'subcat-' prefix to the slug
    }

    // Retrieve form data
    $category_id = $_POST["category_id"];
    $subcategory_name = $_POST["subcategory_name"];
    $slug = generateSlug("$subcategory_name");
    $description = $_POST["description"];
    // Image upload
    if (!empty($_FILES["image"]["name"])) {
        $image = $_FILES["image"]["name"];
        $imagePath = 'assets/img/subcategory/' . $image;
        move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath);
    }else{
        $image = "noimage.png"; // Par défaut
    }

    // Prepare the SQL statement with placeholders
    $sql = "INSERT INTO subcategories (category_id, subcategory_name, subcat_slug, description, subcat_img)
            VALUES (?, ?, ? , ? , ?)";

    // Create a prepared statement
    $stmt = mysqli_prepare($con, $sql);

    // Bind the parameters to the prepared statement
    mysqli_stmt_bind_param($stmt, "issss", $category_id, $subcategory_name,$slug, $description, $image);

    // Execute the prepared statement
    if (mysqli_stmt_execute($stmt)) {
        echo "Subcategorie ajouté avec succès.";
        echo '<meta http-equiv="refresh" content="1;url=' . $_SERVER['HTTP_REFERER'] . '">';
        exit;
        // Perform any additional actions after successful insertion, such as redirecting the user or displaying a success message.
    } else {
        echo "Erreur lors de l'insertion : " . mysqli_error($con);
        // Handle the case when an error occurs during the insertion.
    }
    // Close the prepared statement
    mysqli_stmt_close($stmt);
}
?>