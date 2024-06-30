<?php
session_start();

// Check if the user is logged in and has a role
if (!isset($_SESSION["role"])) {
    // If not, redirect to login page
    header("Location: login.php");
    exit();
} 

// Redirect based on the user role
if ($_SESSION["role"] === 'admin') {
    header("Location: admin/index.php");
    exit();
} elseif ($_SESSION["role"] === 'student') {
    header("Location: home.php");
    exit();
}

// You can add more roles and redirections if needed
?>
