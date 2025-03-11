<?php require 'config.php'; require 'session.php';
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the product ID and quantity to add
    $customer_id= $_POST['customer_id'];
    $product_id = $_POST['product_id'];
    $transaction_id = $_POST['transaction_id'];
    $quantity_to_add = 1; // Specify the quantity to add (e.g., 1)

    // Prepare the SQL statement to check if the product already exists in the cart
    $select_sql = "SELECT * FROM cart WHERE product_id = ?";
    $select_stmt = mysqli_prepare($con, $select_sql);
    if ($select_stmt) {
        // Bind the parameter to the prepared statement
        mysqli_stmt_bind_param($select_stmt, "i", $product_id);
        
        // Execute the prepared statement
        mysqli_stmt_execute($select_stmt);
        
        // Get the result of the executed statement
        $result = mysqli_stmt_get_result($select_stmt);
        
        if (mysqli_num_rows($result) > 0) {
            // If the product exists, update its quantity
            $row = mysqli_fetch_assoc($result);
            $current_quantity = $row['qtt'];

            $current_quantity += $quantity_to_add;

            // Prepare the SQL statement to update the quantity
            $update_sql = "UPDATE cart SET qtt = ? WHERE product_id = ? AND transaction_id= ?";
            $update_stmt = mysqli_prepare($con, $update_sql);
            if ($update_stmt) {
                // Bind the parameters to the prepared statement
                mysqli_stmt_bind_param($update_stmt, "iii", $current_quantity, $product_id, $transaction_id);
                
                // Execute the prepared statement
                if (mysqli_stmt_execute($update_stmt)) {
                    echo "Quantity updated in the cart.";
                } else {
                    echo "An error occurred while updating the quantity in the cart.";
                }

                // Close the prepared statement
                mysqli_stmt_close($update_stmt);
            }
        } else {
            // If the product doesn't exist in the cart, insert it with the specified quantity
            $insert_sql = "INSERT INTO cart (customer_id, product_id, transaction_id) VALUES (?, ?, ?)";
            $insert_stmt = mysqli_prepare($con, $insert_sql);
            if ($insert_stmt) {
                // Bind the parameters to the prepared statement
                mysqli_stmt_bind_param($insert_stmt, "iii",$customer_id, $product_id, $transaction_id);
                
                // Execute the prepared statement
                if (mysqli_stmt_execute($insert_stmt)) {
                    echo "Product added to the cart.";
                } else {
                    echo "An error occurred while adding the product to the cart.";
                }

                // Close the prepared statement
                mysqli_stmt_close($insert_stmt);
            }
        }

        // Close the prepared statement
        mysqli_stmt_close($select_stmt);
    }
}