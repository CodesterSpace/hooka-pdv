<?php
include('config.php');

if(isset($_GET['category_id']) && !empty($_GET['category_id'])) {
    $category_id = $_GET['category_id'];

    $sql = "SELECT * FROM subcategories WHERE category_id = $category_id";
    $result = mysqli_query($con, $sql) or die(mysqli_error($con));

    while ($row = mysqli_fetch_assoc($result)) {
        $subcategory_id = $row['subcategory_id'];
        $subcategory_name = $row['subcategory_name'];
        $options .= "<option value='$subcategory_id'>$subcategory_name</option>";
    }

    echo $options;
} else {
    echo "<option value=''>Aucune sous-catégorie disponible</option>";
}
?>

