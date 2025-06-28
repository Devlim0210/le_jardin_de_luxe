<?php
// On inclut la connexion à la base de données
require_once 'includes/db_connection.php';

// Vérifie si un ID est passé en paramètre dans l'URL et si c'est un nombre
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "ID invalide.";
    exit;
}

// On sécurise l'ID en le convertissant en entier
//Récupération de l'id
$id = intval($_GET['id']);

// Requête pour récupérer le produit avec cet ID
$stmt = $pdo->prepare("SELECT * FROM produits WHERE id = ?");
$stmt->execute([$id]);

// On stocke le résultat dans un tableau associatif
$produit = $stmt->fetch(PDO::FETCH_ASSOC);

// Si le produit n’existe pas, on affiche une erreur
if (!$produit) {
    echo "Produit introuvable.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Modifier le produit</title>
  <!-- Lien vers le fichier CSS -->
  <link rel="stylesheet" href="styles.css">
</head>
<body>

<!-- Inclusion du header (menu de navigation) -->
<?php include 'header.php'; ?>

<main class="modifier-produit">
  <h1>Modifier le produit</h1>

  <!-- Formulaire de modification du produit -->
  <form action="traitement_modifier_produit.php" method="post" enctype="multipart/form-data">

    <!-- Champ caché pour transmettre l'ID du produit -->
    <input type="hidden" name="id" value="<?php echo $produit['id']; ?>">

    <!-- Champ pour le nom du produit -->
    <label for="nom">Nom :</label>
    <input type="text" name="nom" id="nom" value="<?php echo htmlspecialchars($produit['nom']); ?>" required>

    <!-- Champ pour la description -->
    <label for="description">Description :</label>
    <textarea name="description" id="description" required><?php echo htmlspecialchars($produit['description']); ?></textarea>

    <!-- Champ pour le prix -->
    <label for="prix">Prix (€) :</label>
    <input type="number" name="prix" id="prix" step="0.01" value="<?php echo $produit['prix']; ?>" required>

    <!-- Affichage de l'image actuelle -->
    <p>Image actuelle :</p>
    <img src="images/<?php echo htmlspecialchars($produit['image']); ?>" alt="" width="120">

    <!-- Champ pour changer l'image -->
    <label for="image">Changer l’image (optionnel) :</label>
    <input type="file" name="image" id="image">

    <!-- Bouton pour soumettre le formulaire -->
    <button type="submit" class="admin-button">Mettre à jour</button>
  </form>
</main>

<!-- Inclusion du footer -->
<?php include 'footer.php'; ?>

</body>
</html>