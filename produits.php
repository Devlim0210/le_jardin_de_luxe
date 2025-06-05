<?php
// Inclure le fichier de connexion à la base de données
require_once 'includes/db_connection.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Produits - Le Jardin de Luxe</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>

<?php include 'header.php'; ?>

<main class="produits">
  <section>
    <h1>Nos produits de luxe</h1>
    <p>Découvrez notre collection d'articles d'exception.</p>
    <div class="cards">
      <?php
      try {
          // Exécuter une requête SQL pour récupérer tous les produits
          $stmt = $pdo->query("SELECT * FROM produits ORDER BY date_ajout DESC");

          // Récupérer tous les résultats sous forme de tableau associatif
          $produits = $stmt->fetchAll(PDO::FETCH_ASSOC);

          // Vérifier s'il y a des produits à afficher
          if ($produits) {
              // Boucler sur chaque produit
              foreach ($produits as $produit) {
                  // Afficher la carte produit en HTML
                  echo '<div class="card">';
                  echo '<img src="images/' . htmlspecialchars($produit['image']) . '" alt="' . htmlspecialchars($produit['nom']) . '">';
                  echo '<h2>' . htmlspecialchars($produit['nom']) . '</h2>';
                  echo '<p>' . htmlspecialchars($produit['description']) . '</p>';
                  echo '<span class="price">' . number_format($produit['prix'], 2, ',', ' ') . ' €</span>';
                  echo '</div>';
              }
          } else {
              // Message si aucun produit trouvé
              echo '<p>Aucun produit disponible pour le moment.</p>';
          }
      } catch (PDOException $e) {
          // Afficher une erreur si la requête échoue
          echo '<p>Erreur lors de la récupération des produits : ' . $e->getMessage() . '</p>';
      }
      ?>
    </div>
  </section>
</main>

<?php include 'footer.php'; ?>

</body>
</html>

