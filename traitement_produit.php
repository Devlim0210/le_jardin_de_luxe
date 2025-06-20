<?php
// On inclut la connexion à la base de données
require_once 'includes/db_connection.php';

// Vérifie si le formulaire a bien été soumis avec les champs nécessaires
if (isset($_POST['id'], $_POST['nom'], $_POST['description'], $_POST['prix'])) {

    // Sécurisation des données reçues depuis le formulaire
    $id = intval($_POST['id']);
    $nom = htmlspecialchars(trim($_POST['nom']));
    $description = htmlspecialchars(trim($_POST['description']));
    $prix = floatval($_POST['prix']);

    // Préparation de la requête SQL de base
    $sql = "UPDATE produits SET nom = ?, description = ?, prix = ?";
    $params = [$nom, $description, $prix];

    // Vérifie si un fichier image a été envoyé
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        // Nom du fichier temporaire et nom final
        $tmpName = $_FILES['image']['tmp_name'];
        $fileName = basename($_FILES['image']['name']);

        // Chemin de destination (dossier images/)
        $destination = 'images/' . $fileName;

        // Déplacement de l'image dans le bon dossier
        if (move_uploaded_file($tmpName, $destination)) {
            // Ajout de l'image dans la requête SQL
            $sql .= ", image = ?";
            $params[] = $fileName;
        }
    }

    // Ajout de la condition WHERE pour mettre à jour le bon produit
    $sql .= " WHERE id = ?";
    $params[] = $id;

    // Exécution de la requête
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);

        // Redirection vers la page des produits après modification
        header("Location: voir_produits.php");
        exit;
    } catch (PDOException $e) {
        // Affichage d'une erreur si la mise à jour échoue
        echo "Erreur lors de la mise à jour : " . $e->getMessage();
        exit;
    }

} else {
    // Si le formulaire est incomplet, afficher une erreur
    echo "Formulaire incomplet.";
    exit;
}
