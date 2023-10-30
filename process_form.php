<?php
// Establish a database connection
$mysqli = new mysqli("localhost", "root", "", "fullstack");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$connection = $mysqli; // Initialize $connection with $mysqli

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['type'])) {
    $type = intval($_GET['type']); // Ensure $type is an integer

    if ($type == 0) {
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
    } elseif ($type == 1) {
        $datum = $_POST["datum"];
        $aanvangstijd = $_POST["aanvangstijd"];
        $naam_event = $_POST["naam_event"];
        $entreeprijs = $_POST["entreeprijs"];

        // Prepare and execute the SQL insert statement using prepared statement
        $query = "INSERT INTO event (datum, aanvangstijd, naam_event, entreeprijs) VALUES (?, ?, ?, ?)";
        if ($stmt = $mysqli->prepare($query)) {
            $stmt->bind_param("sssd", $datum, $aanvangstijd, $naam_event, $entreeprijs);
            if ($stmt->execute()) {
                echo "Event data inserted successfully.";
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
        }
        
    } elseif ($type == 2) {
        // Retrieve form data
        $band_naam = $_POST["band_naam"];
        $naam_event = $_POST["naam_event"];

        // Prepare and execute the SQL insert statement
        $query = "INSERT INTO band_event (naam_band, naam_event) VALUES (?, ?)";
        if ($stmt = $mysqli->prepare($query)) {
            $stmt->bind_param("ss", $band_naam, $naam_event);
            if ($stmt->execute()) {
                echo "Band and event information has been successfully added to the database.";
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
        }
    } else {
        echo "Invalid type specified.";
    }
}

// Close the database connection
$mysqli->close();
?>