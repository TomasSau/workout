<?php
// db_config.php - konfigūracijos failas
$db_host = 'localhost';
$db_user = 'vartotojas';
$db_pass = 'slaptazodis';
$db_name = 'treniruotes';

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// app.php - pagrindinis aplikacijos failas
include('db_config.php');

// kitas kodas čia

$conn->close();
?>
<!-- register.php -->
<form action="register_process.php" method="post">
    <label for="username">Vartotojo vardas:</label>
    <input type="text" name="username" required>

    <label for="password">Slaptažodis:</label>
    <input type="password" name="password" required>

    <button type="submit">Registruotis</button>
</form>

<!-- register_process.php -->
<?php
include('db_config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Registracija sėkminga!";
    } else {
        echo "Klaida: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!-- add_training.php -->
<form action="add_training_process.php" method="post">
    <label for="date">Data:</label>
    <input type="date" name="date" required>

    <label for="time">Laikas:</label>
    <input type="time" name="time" required>

    <label for="event">Įvykis:</label>
    <input type="text" name="event" required>

    <button type="submit">Įrašyti treniruotę</button>
</form>

<!-- add_training_process.php -->
<?php
include('db_config.php');

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $event = $_POST['event'];

    $sql = "INSERT INTO treniruotes (user_id, data, laikas, ivykis) VALUES ('$user_id', '$date', '$time', '$event')";

    if ($conn->query($sql) === TRUE) {
        echo "Treniruotė įrašyta sėkmingai!";
    } else {
        echo "Klaida: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
