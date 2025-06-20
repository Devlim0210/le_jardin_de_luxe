<?php
// Inclusion de la connexion à la base de données
require_once 'includes/db_connection.php';

// Vérifie si un ID est passé dans l'URL (GET) et que c’est bien un nombre
if (isset($_GET['id']) && is_numeric($_GET['id'])) {

    // Récupération et sécurisation de l'ID
    $id = intval($_GET['id']);

    try {
        // Préparer une requête SQL pour supprimer le produit avec l'ID donné
        $stmt = $pdo->prepare("DELETE FROM produits WHERE id = ?");

        // Exécuter la requête avec l’ID du produit
        $stmt->execute([$id]);

        // Rediriger vers la page d’administration des produits après suppression
        header("Location: voir_produits.php");
        exit;

    } catch (PDOException $e) {
        // En cas d’erreur SQL, afficher le message
        echo "Erreur lors de la suppression : " . $e->getMessage();
        exit;
    }

} else {
    // Si aucun ID valide n’est passé, afficher un message d’erreur
    echo "ID invalide ou non fourni.";
    exit;
}
