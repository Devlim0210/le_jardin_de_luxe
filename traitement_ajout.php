<?php
// Connexion à la base
require_once 'includes/db_connection.php';//Cela garantit que $pdo est disponible pour faire des requêtes SQL.

// Vérifie que le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération et sécurisation des données
    $nom = htmlspecialchars($_POST['nom']);
    $description = htmlspecialchars($_POST['description']);
    $prix = floatval($_POST['prix']);

    // Vérifie que le fichier a bien été envoyé
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $imageTmp = $_FILES['image']['tmp_name'];
        //$imageName = basename($_FILES['image']['name']);
        $imageName = preg_replace('/[^a-zA-Z0-9._-]/', '_', basename($_FILES['image']['name']));
        $uploadDir = 'images/';
        $uploadPath = $uploadDir . $imageName;

        echo "Chemin d'upload : " . $uploadPath . "<br>";
        var_dump(is_dir($uploadDir));
var_dump(is_writable($uploadDir));
var_dump($imageTmp);
        // Déplace l’image vers le dossier "images/"
        if (move_uploaded_file($imageTmp, $uploadPath)) {
            try {
                // Prépare et exécute l’insertion en base
                $stmt = $pdo->prepare("INSERT INTO produits (nom, description, prix, image) VALUES (:nom, :description, :prix, :image)");
                $stmt->bindValue(':nom', $nom);
                $stmt->bindValue(':description', $description);
                $stmt->bindValue(':prix', $prix);
                $stmt->bindValue(':image', $imageName);
                $stmt->execute();

                // Redirection ou message de succès
                header("Location: produits.php?ajout=success");
                exit;
            } catch (PDOException $e) {
                echo "Erreur lors de l’ajout : " . $e->getMessage();
            }
        } else {
            var_dump($_FILES['image']['error']);
            echo "Erreur lors de l’upload de l’image.";
        }
    } else {
        echo "Aucune image valide reçue.";
    }
} else {
    echo "Formulaire non envoyé.";
}
?>