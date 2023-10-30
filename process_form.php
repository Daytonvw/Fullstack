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

        // Prepare and execute the SQL insert statement using a prepared statement
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
        // Define the missing variables based on your application's logic
        $selectedBand = $_POST["band"];
        $selectedEvent = $_POST["event"];
    
        // Check if the band and event are selected
        if (empty($selectedBand) || empty($selectedEvent)) {
            echo "<h2>Koppel band aan event mislukt</h2>";
        } else {
            // Get additional information from the events table
            $eventQuery = "SELECT datum, aanvangstijd, entreeprijs FROM event WHERE naam_event = ?";
            if ($eventStmt = $mysqli->prepare($eventQuery)) {
                $eventStmt->bind_param("s", $selectedEvent);
                $eventStmt->execute();
                $eventResult = $eventStmt->get_result();
                $eventData = $eventResult->fetch_assoc();
                $datum = $eventData['datum'];
                $aanvangstijd = $eventData['aanvangstijd'];
                $entreeprijs = $eventData['entreeprijs'];
    
                // Get the genre from the band table
                $bandQuery = "SELECT genre FROM band WHERE band_naam = ?";
                if ($bandStmt = $mysqli->prepare($bandQuery)) {
                    $bandStmt->bind_param("s", $selectedBand);
                    $bandStmt->execute();
                    $bandResult = $bandStmt->get_result();
                    $bandData = $bandResult->fetch_assoc();
                    $genre = $bandData['genre'];
    
                    // Insert the selected values into the band_events table
                    $insertQuery = "INSERT INTO band_event (naam_event, naam_band, genre, datum, aanvangstijd, entreeprijs) 
                                  VALUES (?, ?, ?, ?, ?, ?)";
                    if ($insertStmt = $mysqli->prepare($insertQuery)) {
                        $insertStmt->bind_param("ssssss", $selectedEvent, $selectedBand, $genre, $datum, $aanvangstijd, $entreeprijs);
    
                        if ($insertStmt->execute()) {
                            echo "<h2>Koppel band aan event voltooid</h2>";
                        } else {
                            echo "Error: " . $insertStmt->error;
                        }
    
                        // Close the prepared statements
                        $insertStmt->close();
                    } else {
                        echo "Error: " . $mysqli->error; // Add an error message for debugging
                    }
                } else {
                    echo "Error: " . $mysqli->error; // Add an error message for debugging
                }
    
                $bandStmt->close();
            } else {
                echo "Error: " . $mysqli->error; // Add an error message for debugging
            }
    
            $eventStmt->close();
        }
    }
}

