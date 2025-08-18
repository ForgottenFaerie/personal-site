<?php

include_once '/db.sql'; // Adjust the path as necessary

// Ensure that the session is started
session_start();
// Check if the user is already logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // Redirect to the admin dashboard if already logged in
    header("Location: admin-dashboard.php");
    exit;
}

?>