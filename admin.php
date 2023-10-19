<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "fullstack";
?>

<!DOCTYPE html>
<html>
<head>
    <title>fullstack</title>
</head>
<body>
    <h1>Band Informatie</h1>
    <form action="process_form.php?type=0" method="POST">
        <label for="band_naam">Band Naam:</label>
        <input type="text" name="band_naam" required><br><br>
        <label for="genre">Genre:</label>
        <select name="genre" required>
            <option value="Rock">Rock</option>
            <option value="Pop">Pop</option>
            <option value="Hip-Hop">Hip-Hop</option>
            <option value="Electronic">Electronic</option>
            <!-- Add more genre options here -->
        </select><br><br>
        <input type="submit" value="Submit">
    </form>
</body>

<head>
    <title>Event Form</title>
</head>
<body>
    <h1>Event Form</h1>
    <form method="post" action="process_form.php?type=1">
        <label for="datum">Datum:</label>
        <input type="date" name="datum" required><br><br>

        <label for="aanvangstijd">Aanvangstijd:</label>
        <input type="time" name="aanvangstijd" required><br><br>

        <label for="naam_event">Naam event:</label>
        <input type="text" name="naam_event" required><br><br>

        <label for="entreeprijs">Entreeprijs:</label>
        <input type="number" step="0.01" name="entreeprijs" required><br><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>




