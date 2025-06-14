<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'header.php'; ?>

<main class="contact">
  <section>
    <h1>Contactez-nous</h1>

    <?php
// Si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Récupérer les données et les sécuriser
    $nom = htmlspecialchars($_POST['nom']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
    echo "Message reçu : $nom, $email, $message<br>";
    // Connexion à la base
    require_once 'includes/db_connection.php';

    // Enregistrer dans la base
    $sql = "INSERT INTO contact (nom, email, message) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nom, $email, $message]);

    // Confirmation
    echo "<p class='confirmation'>Merci $nom, votre message a bien été envoyé.</p>";
}
?>

    <!-- Formulaire de contact -->
    <form action="contact.php" method="POST" class="formulaire-contact">
      <label for="nom">Nom :</label>
      <input type="text" id="nom" name="nom" required>

      <label for="email">Email :</label>
      <input type="email" id="email" name="email" required>

      <label for="message">Message :</label>
      <textarea id="message" name="message" required></textarea>

      <button type="submit">Envoyer</button>
    </form>
  </section>
</main>

<?php include 'footer.php'; ?>