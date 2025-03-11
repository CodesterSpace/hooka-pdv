<?php
session_start();

// Vérifie si la variable per_page est définie dans la requête POST
if (isset($_POST['condition'])) {
    // Convertit la valeur de per_page en entier
    $condition = (int)$_POST['condition'];

    // Vérifie si la valeur de per_page est valide (par exemple, supérieure à zéro)
    if ($condition >= 0) {
        // Stocke la valeur de per_page dans la session
        $_SESSION['condition'] = $condition;

        // Envoie une réponse JSON indiquant que la mise à jour a réussi
        echo json_encode(['success' => true]);
    } else {
        // Envoie une réponse JSON indiquant que la valeur de per_page n'est pas valide
        echo json_encode(['success' => false, 'message' => 'Invalid per_page value']);
    }
}