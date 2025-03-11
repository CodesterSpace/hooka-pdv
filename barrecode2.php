<?php
require_once __DIR__ . '/vendor/autoload.php';

use TCPDFBarcode;

// The data to encode
$text = '123456';

// Create a new TCPDFBarcode object
$barcode = new TCPDFBarcode($text, 'C128');

// Set the barcode dimensions
$barcode_width = 180;
$barcode_height = 130;

// Set the barcode image path
$barcode_image = 'barcode.png';

// Draw the barcode on a PNG image
$barcode->getBarcodePNG($barcode_width, $barcode_height, array(0,0,0), $barcode_image);

// Output the image
header('Content-Type: image/png');
readfile($barcode_image);
