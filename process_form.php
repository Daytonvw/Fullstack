<?php
// Establish a database connection
$mysqli = new mysqli("localhost", "root", "", "fullstack");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$connection = $mysqli; // Initialize $connection with $mysqli

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_GET['type'] == 0) {
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
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_GET['type'] == 1) {
    $datum = $_POST["datum"];
    $aanvangstijd = $_POST["aanvangstijd"];
    $naam_event = $_POST["naam_event"];
    $entreeprijs = $_POST["entreeprijs"];

    // Insert data into the "event" table
    $sql = "INSERT INTO event (datum, aanvangstijd, naam_event, entreeprijs) VALUES ('$datum', '$aanvangstijd', '$naam_event', $entreeprijs)";

    if ($mysqli->query($sql)) { // Use $mysqli to execute the query
        echo "Event data inserted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
}

// Close the database connection
$mysqli->close();
?>
