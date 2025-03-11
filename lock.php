<?php
session_start(); // Start the session

// Unset all of the session variables
$_SESSION['lock'] = "true";

// Redirect to the login page
header("Location: lock-screen.php");
exit();
?>