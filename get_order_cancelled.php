<?php 
require 'config.php';

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

    // Query to get product quantities
    $query = "SELECT p.product_name, SUM(oi.item_quantity) as total_quantity, oi.item_status
        FROM products p
        INNER JOIN order_items oi ON p.product_id = oi.product_id
        WHERE oi.item_status = 'Cancelled'
        GROUP BY p.product_id ORDER BY oi.item_quantity DESC";
    $result = mysqli_query($con, $query);

    // Fetch data as an associative array
    $data = array();
    $Grand_Total = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        // Définir l'encodage interne pour la manipulation des chaînes
        mb_internal_encoding("UTF-8");

        $product_name = $row['product_name'];

        // Raccourcir le nom du produit si nécessaire
        $title = mb_substr($product_name, 0, 53);
        if (mb_strlen($product_name) > 53) {
            $title .= "...";
        }

        // Ajouter les données à la variable $data
        $data[] = array(
            'label' => $title, // Utiliser $title au lieu de $row['title']
            'data' => $row['total_quantity'],
            'total' => $Grand_Total + $row['total_quantity']
        );

    }

    // Return data as JSON
    echo json_encode($data);

    // Close connection
    mysqli_close($con);
?>
