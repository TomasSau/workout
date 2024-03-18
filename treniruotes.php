<?php
// Įtraukti duomenų bazės konfigūracijos failą ar prisijungimo kodą
include('db_config.php');

// Pradėti sesiją
session_start();

// Tikrinti, ar vartotojas prisijungęs
if (!isset($_SESSION['user_id'])) {
    // Jei vartotojas nėra prisijungęs, nukreipti jį į prisijungimo puslapį arba rodyti klaidos pranešimą
    header("Location: login.php");
    exit;
}

// Gauti vartotojo ID iš sesijos
$user_id = $_SESSION['user_id'];

// Sukurti SQL užklausą, kad gautumėte visus vartotojo treniruočių įrašus
$sql = "SELECT * FROM treniruotes WHERE user_id = '$user_id' ORDER BY data DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mano treniruotės</title>
    <!-- Įtraukti stilių failą pagal poreikį -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Mano treniruotės</h1>
    
    <!-- Rodyti treniruočių suvestinę -->
    <table>
        <thead>
            <tr>
                <th>Data</th>
                <th>Laikas</th>
                <th>Įvykis</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Tikrinti, ar yra rezultatų
            if ($result->num_rows > 0) {
                // Išspausdinti kiekvieną įrašą į lentelę
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['data'] . "</td>";
                    echo "<td>" . $row['laikas'] . "</td>";
                    echo "<td>" . $row['ivykis'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>Nėra suvestų treniruočių</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <a href="add_training.php">Pridėti naują treniruotę</a>
    <br>
    <a href="logout.php">Atsijungti</a>
</body>
</html>

<?php
// Uždaryti duomenų bazės ryšį
$conn->close();
?>
