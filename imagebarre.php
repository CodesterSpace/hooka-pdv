<?php
// Include Dompdf library
require_once 'vendor/autoload.php';

use Dompdf\Dompdf;

// HTML content to convert
$html = '
    <div id="myDiv" style="width: 200px; height: 200px; background-color: yellow;">
        This is the content of the div.
    </div>
    <button class="btn" id="downloadButton">Transform</button>
';

// Initialize Dompdf class
$dompdf = new Dompdf();

// Load HTML content
$dompdf->loadHtml($html);

// Set paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF
$dompdf->stream('output.pdf', array('Attachment' => false));
