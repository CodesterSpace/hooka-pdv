<?php
// Chemin d'accès au dossier où sauvegarder les images
$uploadDirectory = 'assets/img/code-barre/';

// Vérifier si des données ont été envoyées
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["image"])) {
    $image = $_FILES["image"];

    // Vérifier s'il n'y a pas d'erreur lors de l'upload
    if ($image["error"] === UPLOAD_ERR_OK) {
        // Utiliser le nom de fichier envoyé depuis le client
        $fileName = $image["name"];

        // Déplacer le fichier vers le dossier de destination
        $destination = $uploadDirectory . $fileName;
        if (move_uploaded_file($image["tmp_name"], $destination)) {
            // Envoyer une réponse JSON indiquant le succès
            echo json_encode(array('success' => true, 'fileName' => $fileName));
            exit;
        }
    }
}

// Envoyer une réponse JSON en cas d'erreur
echo json_encode(array('success' => false));
