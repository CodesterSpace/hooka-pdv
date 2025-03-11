<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'pos');
define('DB_USER', 'root');
define('DB_PASS', '');

// Informations de connexion à la base de données
$host = DB_HOST;
$db = DB_NAME;
$user = DB_USER;
$pass = DB_PASS;
$port = 3306; // Le port par défaut pour MySQL est 3306

// Connexion à la base de données MySQL
$con = mysqli_connect($host, $user, $pass, $db, $port) or die(mysqli_error($con));
?>