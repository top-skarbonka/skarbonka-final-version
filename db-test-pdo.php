<?php
$host = "localhost";
$user = "moj_user";
$pass = "MojeSuperHaslo123";
$db   = "moja_baza";

try {
    $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "✅ Połączenie PDO z bazą działa poprawnie!";
} catch (PDOException $e) {
    echo "❌ Błąd PDO: " . $e->getMessage();
}
