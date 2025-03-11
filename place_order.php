<?php include('config.php');
    session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['place_order'])) {
    $method = 'direct';
    $seller = $_POST['seller'];
    $transaction_id = $_POST['transaction_id'];
    $customer_id = '1';
    $cart_id = 'ORD_' . uniqid();
    $total_price = 0;

    // Retrieve cart items
    $sql_cart = "SELECT * FROM cart WHERE transaction_id = '$transaction_id'";
    $result_cart = mysqli_query($con, $sql_cart);
    if ($result_cart && mysqli_num_rows($result_cart) > 0) {
        while ($row_cart = mysqli_fetch_assoc($result_cart)) {
            $product_id = $row_cart['product_id'];
            $qtt = $row_cart['qtt'];
            $sql_price = "SELECT product_price, product_quantity FROM products WHERE product_id = '$product_id'";
            $result_price = mysqli_query($con, $sql_price);
            $row_price = mysqli_fetch_assoc($result_price);
            $prix = $row_price['product_price'];
            $product_quantity = $row_price['product_quantity'];
            $item_total_price = $prix * $qtt;
            $total_price += $item_total_price;
            $new_qtt = $product_quantity - $qtt;

            // Insert order items
            $sql = "INSERT INTO order_items (cart_id, customer_id, product_id, item_quantity, product_price, transaction_id, item_status, seller) 
                VALUES ('$cart_id', '$customer_id', '$product_id', '$qtt', '$item_total_price', '$transaction_id', 'Completed', '$seller')";
            if (!mysqli_query($con, $sql)) {
                echo "Error inserting order item: " . mysqli_error($con);
                exit; 
            }

            // Update product quantity
            $sql_update_product_qtt = "UPDATE products SET 
                product_quantity = '$new_qtt' 
                WHERE product_id = '$product_id'"; 
            if (!mysqli_query($con, $sql_update_product_qtt)) {
                echo "Error updating product quantity: " . mysqli_error($con);
                exit; 
            }
        }

        // Insert order
        $sql_order = "INSERT INTO orders (cart_id, customer_id, grand_total, payment_method, transaction_id, status, seller) 
            VALUES ('$cart_id', '$customer_id', '$total_price', '$method', '$transaction_id','Completed', '$seller')";
        if (!mysqli_query($con, $sql_order)) {
            echo "Error inserting order: " . mysqli_error($con);
            exit; 
        }

        // Clear cart
        $sql_clear_cart = "DELETE FROM cart WHERE transaction_id = '$transaction_id'"; 
        mysqli_query($con, $sql_clear_cart); 

        // Clear the transaction_id from session
        unset($_SESSION['transaction_id']);

        echo "Order placed successfully! Your order ID is: $cart_id. Total price of the order is: $total_price";
        echo '<meta http-equiv="refresh" content="1;url=invoice.php?cart_id='.$cart_id. '">';
        exit;

    } else {
        echo "The cart is empty."; 
        echo '<meta http-equiv="refresh" content="1;url=' . $_SERVER['HTTP_REFERER'] . '">';
        exit; 
    }
}
?>