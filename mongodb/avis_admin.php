<?php
// Ce fichier affiche tous les avis dans l’espace admin,reservé à l'administration et qui permet d'afficher tous les avis enregistrés pour un controle rapide
//jai separé l’affichage utilisateur (avis.php) et l’administration (avis_admin.php) pour des raisons de sécurité et de clarté

require __DIR__ . '/vendor/autoload.php';
use MongoDB\Client;

// Connexion à MongoDB
$client = new Client("mongodb://localhost:27017");

// Sélection de la base et de la collection
$collection = $client->le_jardin_de_luxe->avis;

// Récupération des avis
//    jai exploiter les capacités de MongoDB avec sort() pour ordonner les avis
$avisListe = $collection->find([], ['sort' => ['date' => -1]]);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Gestion des avis - Admin</title>
  <link rel="stylesheet" href="../styles.css">
</head>
<body>
<?php include 'header.php'; ?>
  <h1>Gestion des avis</h1>

  <table border="1" cellpadding="10" cellspacing="0">
    <thead>
      <tr>
        <th>Nom</th>
        <th>Message</th>
        <th>Date</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($avisListe as $avis): ?>
        <tr>
          <td><?=htmlspecialchars($avis['nom'])?></td>
          <td><?=htmlspecialchars($avis['message'])?></td>
          <td><?=$avis['date']->toDateTime()->format('d/m/Y H:i')?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

<?php include 'footer.php'; ?>
</body>
</html>