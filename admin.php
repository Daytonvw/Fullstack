<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "fullstack";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Fullstack</title>
</head>
<body>
    <h1>Bands</h1>
    <form action="process_form.php" method="POST">
        <label for="band_naam">Band Naam:</label>
        <input type="text" name="band_naam" required><br><br>
        <label for="genre">Genre:</label>
        <input type="text" name="genre" required><br><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
