<?php include('config.php');
    session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_to_cart"])) {
    // Retrieve the product ID and quantity to add
    $customer_id= $_POST['customer_id'];
    $product_id = $_POST['product_id'];
    $transaction_id = $_POST['transaction_id'];
    $quantity_to_add = 1; // Specify the quantity to add (e.g., 1)

    // Prepare the SQL statement to check if the product already exists in the cart
    $main_sql = "SELECT * FROM products WHERE product_id = ?";
    $main_select_stmt = mysqli_prepare($con, $main_sql);
    if ($main_select_stmt) {
        // Bind the parameter to the prepared statement
        mysqli_stmt_bind_param($main_select_stmt, "i", $product_id);
        
        // Execute the prepared statement
        mysqli_stmt_execute($main_select_stmt);
        
        // Get the result of the executed statement
        $main_result = mysqli_stmt_get_result($main_select_stmt);
        
        if (mysqli_num_rows($main_result) > 0) {
            $main_row = mysqli_fetch_assoc($main_result);
            $product_quantity = $main_row['product_quantity'];

            // Prepare the SQL statement to check if the product already exists in the cart
            $select_sql = "SELECT * FROM cart WHERE product_id = ? AND transaction_id = ?";
            $select_stmt = mysqli_prepare($con, $select_sql);
            if ($select_stmt) {
                // Bind the parameter to the prepared statement
                mysqli_stmt_bind_param($select_stmt, "ii", $product_id, $transaction_id);
                
                // Execute the prepared statement
                mysqli_stmt_execute($select_stmt);
                
                // Get the result of the executed statement
                $result = mysqli_stmt_get_result($select_stmt);
                
                if (mysqli_num_rows($result) > 0) {
                    // If the product exists, update its quantity
                    $row = mysqli_fetch_assoc($result);
                    $current_quantity = $row['qtt'];

                    $current_quantity += $quantity_to_add;

                    if($product_quantity >= $current_quantity){

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
                    }else{
                        echo "Out of Stock.";
                    }
                }else {

                    if($product_quantity >= 1){
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
                    }else{
                        echo "Out of Stock.";
                    }
                }

                // Close the prepared statement
                mysqli_stmt_close($select_stmt);
            }

        }
    }

    echo '<meta http-equiv="refresh" content="0;url=pos.php#produits">';
    exit;
}
elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["reduce"])) {
    // Retrieve the product ID and quantity to reduce
    $customer_id = $_POST['customer_id'];
    $product_id = $_POST['product_id'];
    $transaction_id = $_POST['transaction_id'];
    $quantity_to_reduce = 1; // Specify the quantity to reduce (e.g., 1)

    // Prepare the SQL statement to check if the product already exists in the cart
    $select_sql = "SELECT * FROM cart WHERE product_id = ? AND transaction_id = ?";
    $select_stmt = mysqli_prepare($con, $select_sql);
    if ($select_stmt) {
        // Bind the parameter to the prepared statement
        mysqli_stmt_bind_param($select_stmt, "ii", $product_id, $transaction_id);

        // Execute the prepared statement
        mysqli_stmt_execute($select_stmt);

        // Get the result of the executed statement
        $result = mysqli_stmt_get_result($select_stmt);

        if (mysqli_num_rows($result) > 0) {
            // If the product exists, update its quantity
            $row = mysqli_fetch_assoc($result);
            $current_quantity = $row['qtt'];

            if ($current_quantity > 1) {

                // Prepare the SQL statement to update the quantity
                $update_sql = "UPDATE cart SET qtt = qtt - ? WHERE product_id = ? AND transaction_id = ?";
                $update_stmt = mysqli_prepare($con, $update_sql);
                if ($update_stmt) {
                    // Bind the parameters to the prepared statement
                    mysqli_stmt_bind_param($update_stmt, "iii", $quantity_to_reduce, $product_id, $transaction_id);

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
                // If the quantity becomes zero or less, remove the item from the cart
                $delete_sql = "DELETE FROM cart WHERE product_id = ? AND transaction_id = ?";
                $delete_stmt = mysqli_prepare($con, $delete_sql);
                if ($delete_stmt) {
                    // Bind the parameter to the prepared statement
                    mysqli_stmt_bind_param($delete_stmt, "ii", $product_id, $transaction_id);

                    // Execute the prepared statement
                    if (mysqli_stmt_execute($delete_stmt)) {
                        echo "Product removed from the cart.";
                    } else {
                        echo "An error occurred while updating the quantity in the cart.";
                    }

                    // Close the prepared statement
                    mysqli_stmt_close($delete_stmt);
                }
            }
        } else {
            echo "An error occurred while retrieving the product from the cart.";
        }
        // Close the prepared statement
        mysqli_stmt_close($select_stmt);
    }
    echo '<meta http-equiv="refresh" content="0;url=pos.php#produits">';
    exit;
}elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["supp"])) {
    // Retrieve the product ID to delete
    $product_id = $_POST['product_id'];
    $transaction_id = $_POST['transaction_id'];
    
    // Prepare the SQL statement
    $sql = "DELETE FROM cart WHERE product_id = ? AND transaction_id = ?";
    $stmt = mysqli_prepare($con, $sql);
    if ($stmt) {
        // Bind the parameter to the prepared statement
        mysqli_stmt_bind_param($stmt, "ii", $product_id, $transaction_id);
        
        // Execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            echo "Produit supprimé du panier.";
        } else {
            echo "Une erreur s'est produite lors de la suppression du produit du panier.";
        }

        // Close the prepared statement
        mysqli_stmt_close($stmt);
    }
    
    echo '<meta http-equiv="refresh" content="0;url=pos.php#produits">';
    exit;
}elseif ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["del"])) {
    $transaction_id = mysqli_real_escape_string($con, $_POST["transaction_id"]);

    // Requête préparée pour mettre à jour les données dans la table
    $sql = "DELETE FROM cart WHERE transaction_id = ?";

    // Préparation de la requête
    $stmt = mysqli_prepare($con, $sql);

    // Liaison des paramètres
    mysqli_stmt_bind_param($stmt, "i", $transaction_id);

    // Exécution de la requête
    if (mysqli_stmt_execute($stmt)) {
        echo "Cart Supprimé avec succès.";
        // Wait for 2 seconds
            // Clear the transaction_id from session
        unset($_SESSION['transaction_id']);
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    } else {
        echo "Erreur lors de la mise à jour de la réservation.";
    }

    // Fermeture de la déclaration
    mysqli_stmt_close($stmt);
}elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['place_order'])) {
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
            $sql_price = "SELECT product_price, product_quantity, category_id FROM products WHERE product_id = '$product_id'"; 
            $result_price = mysqli_query($con, $sql_price); 
            $row_price = mysqli_fetch_assoc($result_price); 
            $prix = $row_price['product_price'];
            $cat_id = $row_price['category_id'];
            $product_quantity = $row_price['product_quantity'];
            $item_total_price = $prix * $qtt; 
            $total_price += $item_total_price; 
            $new_qtt = $product_quantity - $qtt;

            // Insert order items
            $sql = "INSERT INTO order_items (cart_id, customer_id, product_id, cat_id, item_quantity, product_price, transaction_id, item_status, seller) 
                VALUES ('$cart_id', '$customer_id', '$product_id', '$cat_id', '$qtt', '$prix', '$transaction_id', 'Completed', '$seller')";
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