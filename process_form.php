<?php
// Establish a database connection
$mysqli = new mysqli("localhost", "root", "", "fullstack");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Retrieve form data
$band_naam = $_POST["band_naam"];
$genre = $_POST["genre"];

// Prepare and execute the SQL insert statement
$query = "INSERT INTO band (band_naam, genre) VALUES (?, ?)";
if ($stmt = $mysqli->prepare($query)) {
    $stmt->bind_param("ss", $band_naam, $genre);
    if ($stmt->execute()) {
        echo "Band information has been successfully added to the database.";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

// Close the database connection
$mysqli->close();
?>
