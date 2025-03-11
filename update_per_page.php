<?php
session_start();

// Vérifie si la variable per_page est définie dans la requête POST
if (isset($_POST['per_page'])) {
    // Convertit la valeur de per_page en entier
    $per_page = (int)$_POST['per_page'];

    // Vérifie si la valeur de per_page est valide (par exemple, supérieure à zéro)
    if ($per_page > 0) {
        // Stocke la valeur de per_page dans la session
        $_SESSION['per_page'] = $per_page;
        $_SESSION['page'] = 1;

        // Envoie une réponse JSON indiquant que la mise à jour a réussi
        echo json_encode(['success' => true]);
    } else {
        // Envoie une réponse JSON indiquant que la valeur de per_page n'est pas valide
        echo json_encode(['success' => false, 'message' => 'Invalid per_page value']);
    }
}
elseif (isset($_POST['page'])) {
    // Convertit la valeur de per_page en entier
    $page = (int)$_POST['page'];

    // Vérifie si la valeur de per_page est valide (par exemple, supérieure à zéro)
    if ($page > 0) {
        // Stocke la valeur de per_page dans la session
        $_SESSION['page'] = $page;
        // Envoie une réponse JSON indiquant que la mise à jour a réussi
        echo json_encode(['success' => true]);
    } else {
        // Envoie une réponse JSON indiquant que la valeur de per_page n'est pas valide
        echo json_encode(['success' => false, 'message' => 'Invalid per_page value']);
    }
} else {
    // Envoie une réponse JSON indiquant que la variable per_page n'est pas définie dans la requête POST
    echo json_encode(['success' => false, 'message' => 'per_page not set in POST request']);
}
