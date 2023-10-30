<?php
session_start();

// Check if the user is authenticated. If not, redirect to the login page.
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Page</title>
</head>
<body>
    <h2>Welcome to the Admin Page</h2>
    <p>This page is protected and can only be accessed by authenticated users.</p>
    <a href="logout.php">Logout</a> <!-- Add a logout link to log out the user -->
</body>
</html>
