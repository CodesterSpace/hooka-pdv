<?php require 'config.php'; require 'session.php';?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="POS - Bootstrap Admin Template">
    <meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, invoice, html5, responsive, Projects">
    <meta name="author" content="Dreamguys - Bootstrap Admin Template">
    <meta name="robots" content="noindex, nofollow">
    <title>Product details</title>

                    <div style="display: flex; justify-content: center;">
                        <div id="myDiv">
                            <img src="assets/img/barcode2.png" alt="barcode">
                            <p style="text-align:center;">00000000</p>
                        </div>
                    </div>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.min.js"></script>
                    <script>
                        window.onload = function () {
                            convertToImage();
                        };

                        function convertToImage() {
                            var node = document.getElementById('myDiv');
                            domtoimage.toPng(node)
                                .then(function (dataUrl) {
                                    var a = document.createElement('a');
                                    a.href = dataUrl;
                                    a.download = 'myDiv.png';
                                    document.body.appendChild(a);
                                    a.click();
                                    document.body.removeChild(a);
                                })
                                .catch(function (error) {
                                    console.error('Error converting div to image:', error);
                                });
                        }
                    </script>
</body>
</html>