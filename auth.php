<?php
session_start();

// Define your valid username and password.
$validUsername = "dayton";
$validPassword = "dayton2005"; // You should store this securely in a real application.

// Get user input from the login form.
$username = $_POST['username'];
$password = $_POST['password'];

// Check if the provided credentials are valid.
if ($username === $validUsername && $password === $validPassword) {
    // Authentication successful.
    $_SESSION['authenticated'] = true;
    header("Location: admin.php"); // Redirect to the admin page upon successful login.
    exit();
} else {
    // Authentication failed. Redirect back to the login page.
    header("Location: login.php");
    exit();
}
?>
