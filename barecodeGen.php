<?php
// // Include the library
// require_once('barcode.inc.php');

// // Data to be encoded in the barcode
// $data = "123456";

// // Barcode format (You can change this as needed)
// $format = 'code128';

// // Barcode image type
// $imageType = 'png';

// // Barcode width and height
// $barcodeWidth = 300;
// $barcodeHeight = 100;

// // Create a Barcode object
// $barcode = new Barcode();

// // Generate barcode
// $barcode->generateBarcode($data, $format, $barcodeWidth, $barcodeHeight, $imageType);




// // Function to generate barcode
// function generateBarcode($text) {
//     // Define barcode dimensions
//     $barcodeWidth = 300;
//     $barcodeHeight = 100;

//     // Create an image resource
//     $image = imagecreate($barcodeWidth, $barcodeHeight);

//     // Set background and foreground colors
//     $white = imagecolorallocate($image, 255, 255, 255);
//     $black = imagecolorallocate($image, 0, 0, 0);

//     $innerImage =(image)'barrecode.png'

//     // Fill the background with white color
//     imagefilledrectangle($image, 0, 0, $barcodeWidth, $barcodeHeight, $white);

//     // Calculate text position
//     $textWidth = imagefontwidth(5) * strlen($text);
//     $textX = ($barcodeWidth - $textWidth) / 2;
//     $textY = $barcodeHeight / 2;

//     // Add text to the barcode
//     imagestring($image, 5, $textX, $textY, $text, $black);

//     // Output the image to the browser
//     header('Content-Type: image/png');
//     imagepng($image);

//     // Free up memory
//     imagedestroy($image);
// }

// // Usage example
// $text = '123456789';
// generateBarcode($text);



// function generateBarcode($text) {
//     // Define barcode dimensions
//     $barcodeWidth = 300;
//     $barcodeHeight = 100;

//     // Load the inner barcode image
//     $innerImage = imagecreatefrompng('barrecode.png');

//     // Calculate the new height while maintaining aspect ratio
//     $newHeight = ($barcodeWidth / imagesx($innerImage)) * imagesy($innerImage);

//     // Create an image resource with alpha transparency
//     $image = imagecreatetruecolor($barcodeWidth, $barcodeHeight);
//     imagesavealpha($image, true);
//     $transparentColor = imagecolorallocatealpha($image, 0, 0, 0, 127);
//     imagefill($image, 0, 0, $transparentColor);

//     // Copy the inner barcode image onto the main image with the adjusted height
//     imagecopyresampled($image, $innerImage, 0, 0, 0, 0, $barcodeWidth, $barcodeHeight, imagesx($innerImage), $newHeight);

//     // Calculate text position
//     $textWidth = imagefontwidth(5) * strlen($text);
//     $textX = ($barcodeWidth - $textWidth) / 2;
//     $textY = $barcodeHeight - 10; // Adjust this value for vertical positioning

//     // Add text to the barcode
//     $black = imagecolorallocate($image, 0, 0, 0);
//     imagestring($image, 5, $textX, $textY, $text, $black);

//     // Output the image to the browser
//     header('Content-Type: image/png');
//     imagepng($image);

//     // Free up memory
//     imagedestroy($image);
//     imagedestroy($innerImage);
// }

// // Usage example
// $text = '123456789';
// generateBarcode($text);


// Function to generate barcode
function generateBarcode($text) {
    // Define barcode dimensions
    $barcodeWidth = 300;
    $barcodeHeight = 100;

    // Create an image resource
    $image = imagecreate($barcodeWidth, $barcodeHeight);
    $innerImage = imagecreatefrompng('barrecode.png'); // Load inner image

    // Set background and foreground colors
    $white = imagecolorallocate($image, 255, 255, 255);
    $black = imagecolorallocate($image, 0, 0, 0);

    // Fill the background with white color
    // Calculate position for inner image
    $innerImageWidth = imagesx($innerImage);
    $innerImageHeight = imagesy($innerImage);
    $innerImageX = ($barcodeWidth - $innerImageWidth) / 2;
    $innerImageY = ($barcodeHeight - $innerImageHeight) / 2;

    // Copy inner image onto the barcode
    imagecopy($image, $innerImage, $innerImageX, $innerImageY, 0, 0, $innerImageWidth, $innerImageHeight);

    // Calculate position for text
    $textWidth = imagefontwidth(5) * strlen($text);
    $textX = ($barcodeWidth - $textWidth) / 2;
    $textY = $innerImageY + $innerImageHeight + (0.2 * 37.795); // Convert 2 cm to pixels

    // Add text to the barcode
    imagestring($image, 5, $textX, $textY, $text, $black);

    // Output the image to a file
    $destination = "assets/img/code-barre/codebarre8.png";
    imagepng($image, $destination);

    // Free up memory
    imagedestroy($image);

    // Return the path to the saved image
    return $destination;
}

// Usage example
$text = '123456789';
$imagePath = generateBarcode($text);
echo "L'image a été enregistrée sous : " . $imagePath;

?>


