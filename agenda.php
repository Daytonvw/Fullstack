<!DOCTYPE html>
<html>
<head>
    <title>Agenda</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Agenda Casus-Cafe</h1>

    <table>
        <tr>
            <th>Band Naam</th>
            <th>Event Naam</th>
            <th>Genre</th>
            <th>Datum</th>
            <th>Aanvangstijd</th>
            <th>Entreeprijs</th>
        </tr>
        <?php
        // Replace with your database connection code
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "fullstack";

        $conn = new mysqli($servername, $username, $password, $database);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Query to fetch data from the 'band_event' table along with additional data from 'band' and 'event' tables
        $query = "SELECT be.naam_band, be.naam_event, b.genre, e.datum, e.aanvangstijd, e.entreeprijs
                  FROM band_event be
                  INNER JOIN band b ON be.naam_band = b.band_naam
                  INNER JOIN event e ON be.naam_event = e.naam_event";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["naam_band"] . "</td>";
                echo "<td>" . $row["naam_event"] . "</td>";
                echo "<td>" . $row["genre"] . "</td>";
                echo "<td>" . $row["datum"] . "</td>";
                echo "<td>" . $row["aanvangstijd"] . "</td>";
                echo "<td>" . $row["entreeprijs"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No data available.</td></tr>";
        }

        $conn->close();
        ?>
    </table>
</body>
</html>
