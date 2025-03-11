<?php require 'config.php'; require 'session.php';
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $action = mysqli_real_escape_string($con, $_POST['action']);
    if ($action == "addproduct") {
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

        $product_name = $_POST["product_name"];
        $slug = generateSlug($product_name);
        $category_id = $_POST["category_id"];
        $subcategory_id = $_POST["subcategory_id"];
        $brand_id = $_POST["brand_id"];
        $product_quantity = $_POST["product_quantity"];
        $product_price = $_POST["product_price"];
        if (!empty($_FILES["image"]["name"])) {
            $image = $_FILES["image"]["name"];
            $imagePath = 'assets/img/product/' . $image;
            if (!move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath)) {
                echo "Erreur lors du téléchargement de l'image.";
                exit;
            }
        }

        $sql = "INSERT INTO products (sku, product_name, category_id, subcategory_id, brand_id, product_quantity, product_price, product_slug, main_image)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "ssiiissss", $sku, $product_name, $category_id, $subcategory_id, $brand_id, $product_quantity, $product_price, $slug, $image);

        if (mysqli_stmt_execute($stmt)) {
            // Get the product_slug
            $get_slug = $slug;
            $response = array("success" => "Product added successfully.", "slug" => $get_slug); // Include product_slug in the response
        } else {
            $response = array("error" => "Failed to add Product .");
        }
        echo json_encode($response);
        exit();
        mysqli_stmt_close($stmt);
    }elseif ($action == "addbrand") {
        function generateSlug($str) {
            $slug = strtolower($str);
            $slug = preg_replace('/[^a-z0-9-]+/', '-', $slug);
            $slug = trim($slug, '-');
            return 'br-' . $slug; // Add 'cat-' prefix to the slug
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

        if (mysqli_stmt_execute($stmt)) {
            // Get the product_slug
            $get_slug = $slug;
            $response = array("success" => "Brand added successfully.", "slug" => $get_slug); // Include slug in the response
        } else {
            $response = array("error" => "Failed to add Brand .");
        }
        echo json_encode($response);
        exit();
        mysqli_stmt_close($stmt);
    }elseif ($action == "addcategory") {
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
            // Get the product_slug
            $get_slug = $slug;
            $response = array("success" => "Category added successfully.", "slug" => $get_slug); // Include slug in the response
        } else {
            $response = array("error" => "Failed to add Category .");
        }
        echo json_encode($response);
        exit();
        mysqli_stmt_close($stmt);
    }elseif ($action == "addsubcategory") {
        function generateSlug($str) {
            $slug = strtolower($str);
            $slug = preg_replace('/[^a-z0-9-]+/', '-', $slug);
            $slug = trim($slug, '-');
            return 'subcat-' . $slug; // Add 'cat-' prefix to the slug
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
            // Get the product_slug
            $get_slug = $slug;
            $response = array("success" => "Subcategory added successfully.", "slug" => $get_slug); // Include slug in the response
        } else {
            $response = array("error" => "Failed to add Subcategory .");
        }
        echo json_encode($response);
        exit();
        mysqli_stmt_close($stmt);
    }
}
?>