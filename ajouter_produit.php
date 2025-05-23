<?php include 'header.php'; ?>

<main class="ajouter-produit">
  <h1>Ajouter un produit</h1>

  <form action="traitement_ajout.php" method="POST" enctype="multipart/form-data">
    <label for="nom">Nom du produit</label>
    <input type="text" name="nom" id="nom" required>

    <label for="description">Description</label>
    <textarea name="description" id="description" required></textarea>

    <label for="prix">Prix (€)</label>
    <input type="number" name="prix" id="prix" step="0.01" required>

    <label for="image">Image du produit</label>
    <input type="file" name="image" id="image" accept="image/*" required>

    <button type="submit">Ajouter</button>
  </form>
</main>

<?php include 'footer.php'; ?>