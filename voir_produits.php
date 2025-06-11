<?php
// Connexion à la base de données
require_once 'includes/db_connection.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Voir les produits - Admin</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>

<?php
// Inclusion du menu et du logo (barre de navigation)
include 'header.php';
?>

<main class="admin-produits">
  <h1>Liste des produits enregistrés</h1>

  <!-- Section contenant le tableau -->
  <section class="produits-table">
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Nom</th>
          <th>Description</th>
          <th>Prix (€)</th>
          <th>Image</th>
          <th>Actions</th> <!--  Ajouté pour aligner avec les boutons -->
        </tr>
      </thead>
      <tbody>
        <?php
        try {
          //  Requête SQL pour récupérer tous les produits
          $stmt = $pdo->query("SELECT * FROM produits ORDER BY date_ajout DESC");
          $produits = $stmt->fetchAll(PDO::FETCH_ASSOC);

          // Boucle pour afficher chaque produit dans le tableau
          foreach ($produits as $produit) {
            echo '<tr>';
            echo '<td>' . $produit['id'] . '</td>';
            echo '<td>' . htmlspecialchars($produit['nom']) . '</td>';
            echo '<td>' . htmlspecialchars($produit['description']) . '</td>';
            echo '<td>' . number_format($produit['prix'], 2, ',', ' ') . ' €</td>';
            echo '<td><img src="images/' . htmlspecialchars($produit['image']) . '" alt="' . htmlspecialchars($produit['nom']) . '" width="80"></td>';
             
            // Colonne Actions : Modifier / Supprimer
            echo '<td>';
            echo '<a href="modifier_produit.php?id=' . $produit['id'] . '" class="admin-button">Modifier</a> ';
            echo '<a href="supprimer_produit.php?id=' . $produit['id'] . '" class="admin-button" onclick="return confirm(\'Supprimer ce produit ?\')">Supprimer</a>';
            echo '</td>';
            echo '</tr>';
          }
        } catch (PDOException $e) {
          //  Gestion d'erreur si la requête échoue
          echo '<tr><td colspan="5">Erreur : ' . $e->getMessage() . '</td></tr>';
        }
        ?>
      </tbody>
    </table>
  </section>
</main>

<?php
// Footer commun à toutes les pages
include 'footer.php';
?>

</body>
</html>

