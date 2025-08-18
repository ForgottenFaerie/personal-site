<?php

// src/admin-login.php
// This file is part of the nonbinarybyte.com project.
// It serves as the admin login page for the website.
// This page allows authorized users to log in to the admin dashboard.

// Ensure that the session is started
session_start();
// Check if the user is already logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // Redirect to the admin dashboard if already logged in
    header("Location: admin-dashboard.php");
    exit;
}

// Include necessary files for database connection or authentication
include_once '/db.sql'; // Adjust the path as necessary
include_once '/functions.php'; // Include any necessary functions for authentication
// This file should handle the login logic, such as checking credentials
// and setting session variables upon successful login.

?>

<!DOCTYPE HTML>
<html>
    <head>
        <title>Home.</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="styles.css" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta charset="utf-8" />
        <meta lang="en" />
        <meta name="description" content="Welcome to nonbinarybyte.com, the personal website of Forgotten Faerie, a nonbinary software developer and artist. Explore my portfolio, blog, and more." />
        <meta name="keywords" content="nonbinary, software developer, artist, personal website, portfolio, blog" />
        <meta name="author" content="Forgotten Faerie" />
        <link rel="icon" href="/favicon/favicon.ico" type="image/x-icon" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cal+Sans&family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Inconsolata:wght@200..900&family=Lexend+Deca:wght@100..900&family=Spectral:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    </head>
    <body>
        <header>
            <div class="HDR-Col-1">
                <h1>nonbinarybyte.com</h1>
            </div>
            <div class="HDR-Col-2">
                <nav>
                    <button>
                        <a href="index.php">Home.</a>
                    </button>
                    <button>
                        <a href="blog.php">Blog.</a>
                    </button>
                    <button>
                        <a href="portfolio.php">Portfolio.</a>
                    </button>
                    <button>
                        <a href="https://shop.nonbinarybyte.com">My Store.</a>
                    </button>
                    <button>
                        <a href="admin-login.php">Admin.</a>
                    </button>
                </nav>
            </div>
        </header>
        <main>
            <article class="admin-login">
                <h2>Admin Login</h2>
                <p>Welcome to the admin login page. Please enter your credentials to access the admin dashboard.</p>
                <form action="admin-dashboard.php" method="post">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                    <br>
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                    <br>
                    <button type="submit">Login</button>
                </form>
                <p>If you do not have an account, please contact the site administrator.</p>
                <p>For security reasons, please ensure you are on a secure network when accessing the admin dashboard.</p>
                <p>Note: This page is for authorized personnel only. Unauthorized access is prohibited.</p>
            </article>
        </main>
            <br />
        <footer>
            <p>&copy; 2025 nonbinarybyte.com & Kenny Thomas-Moore. All rights reserved.</p>
            <p>Last updated: August 2025</p>
        </footer>
    </body>
</html>