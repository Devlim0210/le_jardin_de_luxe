<?php
// On inclut le fichier de connexion à la base de données (avec PDO)
require_once 'includes/db_connection.php';

// Vérifie si l'ID du produit est présent dans l'URL et que c’est bien un nombre
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    // On récupère l’ID et on le convertit en entier par sécurité
    $id = intval($_GET['id']);

    try {
        // On prépare une requête SQL pour récupérer les infos du produit correspondant à l’ID
        $stmt = $pdo->prepare("SELECT * FROM produits WHERE id = ?");
        $stmt->execute([$id]);

        // On stocke le produit récupéré sous forme de tableau associatif
        $produit = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // Si une erreur survient pendant la requête, on affiche un message d’erreur
        echo "Erreur : " . $e->getMessage();
        exit;
    }
} else {
    // Si aucun ID n'est fourni ou que ce n’est pas un nombre valide
    echo "Produit introuvable.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo htmlspecialchars($produit['nom']); ?> - Le Jardin de Luxe</title>
  <!-- On relie la feuille de style CSS -->
  <link rel="stylesheet" href="styles.css">
</head>
<body>

<!-- Inclusion du header (menu de navigation) -->
<?php include 'header.php'; ?>

<main class="fiche-produit">
  <section>
    <!-- Titre du produit -->
    <h1><?php echo htmlspecialchars($produit['nom']); ?></h1>

    <!-- Image du produit avec le bon chemin et texte alternatif -->
    <img src="images/<?php echo htmlspecialchars($produit['image']); ?>" alt="<?php echo htmlspecialchars($produit['nom']); ?>" />

    <!-- Description du produit -->
    <p><?php echo htmlspecialchars($produit['description']); ?></p>

    <!-- Prix du produit, bien formaté -->
    <p class="prix"><?php echo number_format($produit['prix'], 2, ',', ' '); ?> €</p>

    <!-- Lien pour revenir à la liste des produits -->
    <a href="produits.php">← Retour aux produits</a>
  </section>
</main>

<!-- Inclusion du pied de page -->
<?php include 'footer.php'; ?>

</body>
</html>