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

        // Query to fetch data from the 'band_event' table
        $query = "SELECT naam_band, naam_event FROM band_event";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["naam_band"] . "</td>";
                echo "<td>" . $row["naam_event"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='2'>No data available.</td></tr>";
        }

        $conn->close();
        ?>
    </table>
</body>
</html>
