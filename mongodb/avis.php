<?php
// Ce fichier affiche les avis enregistrés dans MongoDB
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require __DIR__ . '/vendor/autoload.php';
use MongoDB\Client;

// Connexion à MongoDB
$client = new Client("mongodb://localhost:27017");

// Sélection de la base et de la collection
$collection = $client->le_jardin_de_luxe->avis;

// Récupération de tous les avis (triés du plus récent au plus ancien)
$cursor = $collection->find([], ['sort' => ['date' => -1]]);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Avis des clients</title>
  <link rel="stylesheet" href="../styles.css">
</head>
<body>
<?php include '..//header.php'; ?>
  <h1>Les avis de nos clients</h1>

  <?php foreach ($cursor as $avis): ?>
    <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">
      <strong><?=htmlspecialchars($avis['nom'])?></strong><br>
      <small>
  <?=isset($avis['date']) ? $avis['date']->toDateTime()->format('d/m/Y H:i') : 'Date inconnue'?>
</small>
      <p><?=htmlspecialchars($avis['message'])?></p>
    </div>
  <?php endforeach; ?>

<?php include '../footer.php'; ?>
</body>
</html>