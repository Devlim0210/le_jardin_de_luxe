<?php
// admin.php
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Espace Admin - Le Jardin de Luxe</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>

<?php include 'header.php'; ?>

<main class="admin-dashboard">
  <h1>Bienvenue dans l’espace admin</h1>
  <p>Gérez ici vos produits et messages.</p>

  <section class="admin-actions">
    <a href="ajouter_produit.php" class="admin-button">Ajouter un produit</a>
    <a href="voir_produits.php" class="admin-button">Voir tous les produits</a>
    <a href="contact_admin.php" class="admin-button">Voir les messages reçus</a>
  </section>
</main>

<?php include 'footer.php'; ?>

</body>
</html>