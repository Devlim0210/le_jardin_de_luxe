<?php
// Page permettant à un visiteur de laisser un avis.
// Les données seront envoyées à traitement_avis.php
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Laisser un avis</title>
  <link rel="stylesheet" href="../styles.css">

</head>
<body>
<?php
// Chemin absolu pour inclure le header
include_once $_SERVER['DOCUMENT_ROOT'] . '/header.php'; ?>

  <h1>Laissez votre avis</h1>

  <!-- Formulaire d'envoi d'avis -->
  <form action="traitement_avis.php" method="POST">
    <label for="nom">Nom :</label><br>
    <input type="text" name="nom" id="nom" required><br><br>

    <label for="message">Message :</label><br>
    <textarea name="message" id="message" required></textarea><br><br>

    <button type="submit">Envoyer</button>
  </form>
  <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/footer.php'; ?>
</body>
</html>
