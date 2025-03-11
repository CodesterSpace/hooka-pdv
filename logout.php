<?php
session_start(); // Start the session

// Unset all of the session variables
unset($_SESSION['ad_id']);

// Redirect to the login page
header("Location: ./");
exit();
?>