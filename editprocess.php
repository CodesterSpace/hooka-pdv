<?php
require 'config.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = mysqli_real_escape_string($con, $_POST['action']);
    if ($action == "editprod") {
        // Function to generate a slug from a string
        function generateSlug($str) {
            $randomNumber = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
            $slug = strtolower($str);
            $slug = preg_replace('/[^a-z0-9-]+/', '-', $slug);
            $slug = trim($slug, '-');
            $slug = $randomNumber . '-' . $slug . '.html';
            return $slug;
        }

        // Function to generate a random SKU number
        function genererNumeroPR() {
            $prefixe = "PR0";
            $chiffresAleatoires = mt_rand(10000000, 99999999);
            return $prefixe . $chiffresAleatoires;
        }


        // Retrieve form values
        $product_id = mysqli_real_escape_string($con, $_POST['product_id']);
        $image_actuel = mysqli_real_escape_string($con, $_POST['image_actuel']);
        $image_actuel = mysqli_real_escape_string($con, $_POST['image_actuel']);
        $product_name = mysqli_real_escape_string($con, $_POST['product_name']);
        $old_product_name = mysqli_real_escape_string($con, $_POST['old_product_name']);
        $category_id = mysqli_real_escape_string($con, $_POST['category_id']);
        $subcategory_id = mysqli_real_escape_string($con, $_POST['subcategory_id']);
        $brand_id = mysqli_real_escape_string($con, $_POST['brand_id']);
        $product_quantity = mysqli_real_escape_string($con, $_POST['product_quantity']);
        $product_price = mysqli_real_escape_string($con, $_POST['product_price']);

        // Generate slug and SKU if product name has changed
        if ($product_name !== $old_product_name) {
            $slug = generateSlug($product_name);
            $sku = genererNumeroPR();
        } else {
            $slug = mysqli_real_escape_string($con, $_POST['slug']);
            $sku = mysqli_real_escape_string($con, $_POST['sku']);
        }

        // Handle image upload
        if (!empty($_FILES["image"]["name"])) {
            $image = $_FILES["image"]["name"];
            $imagePath = 'assets/img/product/' . $image;
            move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath);
        } else {
            $image = $image_actuel;
        }
        
        // Prepare the SQL query
        $stmt = mysqli_prepare($con, "UPDATE products SET
            product_name = ?,
            sku = ?,
            category_id = ?,
            subcategory_id = ?,
            brand_id = ?,
            product_quantity = ?,
            main_image = ?,
            product_price = ?,
            product_slug = ?,
            updated_at = NOW()
            WHERE product_id = ?");
        mysqli_stmt_bind_param($stmt, "ssiiiisisi", $product_name, $sku, $category_id, $subcategory_id, $brand_id, $product_quantity, $image, $product_price, $slug, $product_id);

        // Execute the query and handle the result
        if (mysqli_stmt_execute($stmt)) {
            $response = array("success" => "Product updated successfully.");
        } else {
            $response = array("error" => "Failed to updated Product .");
        }
        echo json_encode($response);
        exit();	
        mysqli_stmt_close($stmt);
    }
    elseif ($action == "editbrand") {
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
            $response = array("success" => "Brand updated successfully.");
        } else {
            $response = array("error" => "Failed to updated Brand .");
        }
        echo json_encode($response);
        exit();	
        mysqli_stmt_close($stmt);
    }
    elseif ($action == "editcategory") {
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
            $response = array("success" => "Category updated successfully.");
        } else {
            $response = array("error" => "Failed to updated Category .");
        }
        echo json_encode($response);
        exit();	
        mysqli_stmt_close($stmt);
    }
    elseif ($action == "editsubcategory") {
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
            $response = array("success" => "Subcategory updated successfully.");
        } else {
            $response = array("error" => "Failed to updated Subcategory .");
        }
        echo json_encode($response);
        exit();	
        mysqli_stmt_close($stmt);
    }
}
?>
