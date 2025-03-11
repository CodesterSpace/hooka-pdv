<?php include('config.php');
// Formulaire de Orders
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["order_cancel"])) {
    // Récupère les valeurs du formulaire
    $cart_id = mysqli_real_escape_string($con, $_POST['cart_id']);
    $status = mysqli_real_escape_string($con, $_POST['status']);

    if ($status == 'Completed') {
            // SQL update statement
    $sql = "UPDATE orders SET
            status = '$status',
            approuve_date = NOW()
            WHERE cart_id = '$cart_id'";
    if (mysqli_query($con, $sql)) {
    echo "Commande Valider Avec Succes.";
    // Delay the redirect for 5 seconds
    sleep(5);
    // Redirect to another page
    echo '<meta http-equiv="refresh" content="1;url=' . $_SERVER['HTTP_REFERER'] . '">';
    exit;
        } else {
            echo "Erreur: " . $sql . "<br>" . mysqli_error($con);
        }

    }elseif ($status == 'Cancelled') {
                    // SQL update statement
            $sql = "UPDATE orders SET
                    status = '$status',
                    grand_total = '0',
                    updated_at = NOW()
                    WHERE cart_id = '$cart_id'";

            if (mysqli_query($con, $sql)) {
                if (mysqli_query($con, $sql)) {
                    // SQL update statement
                    $sql_order_items = "UPDATE order_items SET
                    item_status = '$status',
                    updated_at = NOW()
                    WHERE cart_id = '$cart_id'";
                        if (mysqli_query($con, $sql_order_items)) {
                            echo "Commande Annulée Avec Succès.";
                            // Retarder la redirection pendant 5 secondes
                            sleep(5);
                        } else {
                            echo "Erreur: " . $sql_order_items . "<br>" . mysqli_error($con);
                        }
                    } else {
                        echo "Erreur: " . $sql . "<br>" . mysqli_error($con);
                    }
            } else {
                echo "Erreur: " . $sql . "<br>" . mysqli_error($con);
            }

            }else{
            // SQL update statement
            $sql = "UPDATE orders SET
                    status = '$status',
                    updated_at = NOW()
                    WHERE cart_id = '$cart_id'";

            if (mysqli_query($con, $sql)) {
            echo "Commande appliquée Avec Succes.";
            // Delay the redirect for 5 seconds
            sleep(5);

            } else {
                echo "Erreur: " . $sql . "<br>" . mysqli_error($con);
            }
        // Redirect to another page
        echo '<meta http-equiv="refresh" content="1;url=' . $_SERVER['HTTP_REFERER'] . '">';
        exit;
        }

}elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["item_cancel"])) {
    // Formulaire de Order_items
    // Récupère les valeurs du formulaire
    $cart_id = mysqli_real_escape_string($con, $_POST['cart_id']);
    $product_id = mysqli_real_escape_string($con, $_POST['product_id']);
    $status = mysqli_real_escape_string($con, $_POST['status']);
    $subtotal = mysqli_real_escape_string($con, $_POST['subtotal']);
    $grand_total = mysqli_real_escape_string($con, $_POST['grand_total']);

    if ($status == 'Cancelled') {
        $TotalPrice = $grand_total-$subtotal;
    // SQL update statement
        $sql = "UPDATE order_items SET
                item_status = '$status',
                updated_at = NOW()
                WHERE cart_id = '$cart_id' AND product_id = '$product_id'";

        if (mysqli_query($con, $sql)) {
                    // SQL update statement
                    $sql_order = "UPDATE orders SET
                    grand_total = '$TotalPrice',
                    updated_at = NOW()
                    WHERE cart_id = '$cart_id'";

                    if (mysqli_query($con, $sql_order)) {
                        echo "Commande Annulée Avec Succès.";
                        echo "$TotalPrice";
                        // Retarder la redirection pendant 5 secondes
                        sleep(5);
                    } else {
                        echo "Erreur: " . $sql_order . "<br>" . mysqli_error($con);
                    }
        } else {
            echo "Erreur: " . $sql . "<br>" . mysqli_error($con);
        }

        // Redirect to another page
        echo '<meta http-equiv="refresh" content="1;url=' . $_SERVER['HTTP_REFERER'] . '">';
        exit;
    }else{
        $TotalPrice = $grand_total+$subtotal;
        // SQL update statement
        $sql = "UPDATE order_items SET
            item_status = '$status',
            updated_at = NOW()
            WHERE cart_id = '$cart_id' AND product_id = '$product_id'";

            if (mysqli_query($con, $sql)) {

                    // SQL update statement
                $sql_order = "UPDATE orders SET
                    grand_total = '$TotalPrice',
                    updated_at = NOW()
                    WHERE cart_id = '$cart_id'";

                    if (mysqli_query($con, $sql_order)) {
                        echo "Commande Appliquée Avec Succès.";
                        echo "$TotalPrice";
                        // Retarder la redirection pendant 5 secondes
                        sleep(5);
                    } else {
                        echo "Erreur: " . $sql_order . "<br>" . mysqli_error($con);
                    }
            } else {
                echo "Erreur: " . $sql . "<br>" . mysqli_error($con);
            }
            

            // Redirect to another page
        echo '<meta http-equiv="refresh" content="1;url=' . $_SERVER['HTTP_REFERER'] . '">';
            exit;
    }
}elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["refund"])) {
    // Récupère les valeurs du formulaire
    $cart_id = mysqli_real_escape_string($con, $_POST['cart_id']);
    $product_id = mysqli_real_escape_string($con, $_POST['product_id']);
    $status = mysqli_real_escape_string($con, $_POST['status']);

            // SQL update statement
    $sql = "UPDATE order_items SET
            refund = '$status',
            updated_at = NOW()
            WHERE cart_id = '$cart_id' AND product_id = '$product_id'";

    if (mysqli_query($con, $sql)) {
    echo "Produit Remboursé Avec Succes.";
    // Delay the redirect for 5 seconds
    sleep(5);
    // Redirect to another page
    echo '<meta http-equiv="refresh" content="1;url=' . $_SERVER['HTTP_REFERER'] . '">';
    exit;
        } else {
            echo "Erreur: " . $sql . "<br>" . mysqli_error($con);
        }
}

mysqli_close($con);
?>