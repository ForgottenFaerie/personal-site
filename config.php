<?php
// Database settings
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "blog_db";

// Connect to MySQL
$conn = new mysqli($host, $user, $pass);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if not exists
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if (!$conn->query($sql)) {
    die("Database creation failed: " . $conn->error);
}

// Select the database
$conn->select_db($dbname);

// Create posts table if not exists
$sql_posts = "CREATE TABLE IF NOT EXISTS posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
if (!$conn->query($sql_posts)) {
    die("Error creating posts table: " . $conn->error);
}

// Create users table if not exists
$sql_users = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
if (!$conn->query($sql_users)) {
    die("Error creating users table: " . $conn->error);
}

// ✅ Now $conn is ready to use everywhere
?>
