<?php
$host = 'localhost';
$dbname = 'le_jardin_de_luxe';
$user = 'root';
$pass = ''; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    // Active les erreurs PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Affiche une erreur claire si connexion échoue
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>