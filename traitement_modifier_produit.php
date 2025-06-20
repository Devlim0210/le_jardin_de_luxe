<?php
//  Connexion à la base de données
require_once 'includes/db_connection.php';

// Vérifier si l’ID est bien présent
if (isset($_POST['id']) && is_numeric($_POST['id'])) {
    $id = intval($_POST['id']);
    $nom = $_POST['nom'] ?? '';
    $description = $_POST['description'] ?? '';
    $prix = $_POST['prix'] ?? 0;

    // Préparer l’image si elle a été changée
    $image_nom = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image_nom = basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], 'images/' . $image_nom);
    }

    try {
        // Construire la requête SQL selon si une image est changée ou pas
        if ($image_nom) {
            $stmt = $pdo->prepare("UPDATE produits SET nom = ?, description = ?, prix = ?, image = ? WHERE id = ?");
            $stmt->execute([$nom, $description, $prix, $image_nom, $id]);
        } else {
            $stmt = $pdo->prepare("UPDATE produits SET nom = ?, description = ?, prix = ? WHERE id = ?");
            $stmt->execute([$nom, $description, $prix, $id]);
        }

        // Redirection après succès
        header('Location: voir_produits.php');
        exit;
    } catch (PDOException $e) {
        echo "Erreur lors de la mise à jour : " . $e->getMessage();
    }
} else {
    echo "ID de produit invalide.";
}
