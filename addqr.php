<?php require 'config.php'; require 'session.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['addqr'])) {

    require 'vendor/autoload.php';

    use Endroid\QrCode\QrCode;
    use Endroid\QrCode\ErrorCorrectionLevel;
    use Endroid\QrCode\LabelAlignment;
    use Endroid\QrCode\Response\QrCodeResponse;
    
    // Récupérer les données du formulaire
    $product_name = $_POST['product_name'];
    $product_details = $_POST['product_details'];
    $product_price = $_POST['product_price'];
    
    // Combiner les données dans une chaîne de caractères
    $data = "Product Name: $product_name\nProduct Details: $product_details\nProduct Price: $product_price";
    
    // Créer un objet QrCode
    $qrCode = new QrCode($data);
    $qrCode->setSize(300);
    
    // Définir les options du code QR
    $qrCode->setWriterByName('png');
    $qrCode->setMargin(10);
    $qrCode->setEncoding('UTF-8');
    $qrCode->setErrorCorrectionLevel(ErrorCorrectionLevel::HIGH);
    $qrCode->setLabel('Scan the code', 16, null, LabelAlignment::CENTER);
    $qrCode->setLogoPath(__DIR__.'/path/to/logo.png');
    $qrCode->setLogoSize(100, 100);
    $qrCode->setRoundBlockSize(true);
    $qrCode->setValidateResult(false);
    
    // Sauvegarder le code QR en tant qu'image
    $filePath = 'qrcodes/';
    $fileName = 'product_qr.png';
    $fileFullPath = $filePath . $fileName;
    
    // Vérifier si le répertoire existe, sinon le créer
    if (!file_exists($filePath)) {
        mkdir($filePath, 0777, true);
    }
    
    $qrCode->writeFile($fileFullPath);
    
    // Afficher l'image du code QR sur la page
    echo '<img src="' . $fileFullPath . '" alt="QR Code">';
}