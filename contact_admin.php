<?php
require_once 'includes/db_connection.php';
include 'header.php';
?>

<main class="admin">
  <section>
    <h1>Messages reçus</h1>

    <?php
// Récupérer les messages
$sql = "SELECT * FROM contact ORDER BY date_envoi DESC";
$stmt = $pdo->query($sql);
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($messages) > 0) {
    // Début du tableau HTML
    echo "<table border='1' cellpadding='10'>";
    echo "<tr><th>ID</th><th>Nom</th><th>Email</th><th>Message</th><th>Date</th></tr>";

    // Boucle sur chaque message pour l'afficher dans une ligne du tableau
    foreach ($messages as $msg) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($msg['id']) . "</td>";
        echo "<td>" . htmlspecialchars($msg['nom']) . "</td>";
        echo "<td>" . htmlspecialchars($msg['email']) . "</td>";
        echo "<td>" . nl2br(htmlspecialchars($msg['message'])) . "</td>";
        echo "<td>" . htmlspecialchars($msg['date_envoi']) . "</td>";
        echo "</tr>";
    }
// Fin du tableau
    echo "</table>";
} else {
    // Si aucun message n'a été trouvé
    echo "<p>Aucun message reçu pour le moment.</p>";
}
?>
  </section>
</main>

<?php include 'footer.php'; ?>