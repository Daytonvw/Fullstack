<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "fullstack";
?>

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
    <h2>Welkom bij de band en event pagina</h2>
    <a href="logout.php">Logout</a> <!-- Add a logout link to log out the user -->
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <title>Fullstack</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        h1 {
            background-color: #333;
            color: #fff;
            padding: 10px;
        }

        .form-container {
            background-color: #fff;
            padding: 20px;
            margin: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        label {
            display: block;
            margin-top: 10px;
        }

        input[type="text"],
        input[type="date"],
        input[type="time"],
        select,
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .submit-button {
            background-color: #333;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .submit-button:hover {
            background-color: #555;
        }

        .agenda-button {
            background-color: #333;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
        }

        .agenda-button:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <h1>Band Informatie</h1>
    <div class="form-container">
        <form action="process_form.php?type=0" method="POST">
            <label for="band_naam">Band Naam:</label>
            <input type="text" name="band_naam" required>

            <label for="genre">Genre:</label>
            <select name="genre" required>
                <option value="Rock">Rock</option>
                <option value="Pop">Pop</option>
                <option value="Hip-Hop">Hip-Hop</option>
                <option value="Electronic">Electronic</option>
                <!-- Add more genre options here -->
            </select>

            <input type="submit" class="submit-button" value="Submit">
        </form>
    </div>

    <h1>Event informatie</h1>
    <div class="form-container">
        <form method="post" action="process_form.php?type=1">
            <label for="datum">Datum:</label>
            <input type="date" name="datum" required>

            <label for="aanvangstijd">Aanvangstijd:</label>
            <input type="time" name="aanvangstijd" required>

            <label for="naam_event">Naam event:</label>
            <input type="text" name="naam_event" required>

            <label for="entreeprijs">Entreeprijs:</label>
            <input type="number" step="0.01" name="entreeprijs" required>

            <input type="submit" class="submit-button" value="Submit">
        </form>
    </div>

    <h1>Combineer band en event</h1>
    <form method="post" action="process_form.php?type=2">
        <h2>Koppel band aan event</h2>
        <?php
        $con = mysqli_connect("localhost", "root", "", "fullstack");
        $eventQuery = mysqli_query($con, "SELECT * FROM event");
        $bandQuery = mysqli_query($con, "SELECT * FROM band");
        ?>
        <select name="band">
            <?php
            while ($band = mysqli_fetch_array($bandQuery)) {
            ?>
                <option value="<?php echo $band['band_naam']; ?>"><?php echo $band['band_naam']; ?></option>
            <?php
            }
            ?>
        </select>
        <select name="event">
            <?php
            while ($event = mysqli_fetch_array($eventQuery)) {
            ?>
                <option value="<?php echo $event['naam_event']; ?>"><?php echo $event['naam_event']; ?></option>
            <?php
            }
            ?>
        </select>
        <input type="submit" value="Submit">
    </form>

    <!-- Add a button to view the agenda.php page -->
    <button class="agenda-button" type="button" onclick="window.location.href='agenda.php'">Agenda</button>
</body>
</html>

