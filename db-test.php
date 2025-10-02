<?php
$host = "localhost"; // adres serwera MySQL
$user = "moj_user"; // użytkownik bazy
$pass = "MojeSuperHaslo123"; // hasło do bazy
$db   = "moja_baza"; // nazwa bazy danych

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("❌ Błąd połączenia: " . $conn->connect_error);
}
echo "✅ Połączenie z bazą działa poprawnie!";
$conn->close();
