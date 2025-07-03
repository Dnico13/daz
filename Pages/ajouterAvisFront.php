<?php
require_once '../pdo.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $prenom = $_POST['prenom'] ?? '';
  $ville = $_POST['ville'] ?? '';
  $notation = (int)($_POST['notation'] ?? 0);
  $avis = $_POST['avis'] ?? '';
  $valid = 0;

  if ($prenom && $ville && $notation > 0 && $avis) {
    $stmt = $pdo->prepare("INSERT INTO Temoignage (prenom, ville, notation, avis, Valid) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$prenom, $ville, $notation, $avis, $valid]);
    header("Location: /");
    exit;
  }
}
?>

<div class="bg-light">
  <div class="container py-5">
    <h1 class="mb-4">Ajouter un témoignage</h1>
    <form method="post">
      <div class="mb-3">
        <label for="prenom">Prénom</label>
        <input type="text" name="prenom" class="form-control" id="prenom" required>
      </div>
      <div class="mb-3">
        <label for="ville">Ville</label>
        <input type="text" name="ville" class="form-control" id="ville" required>
      </div>
      <div class="mb-3">
        <label for="notation">Note (1 à 5)</label>
        <input type="number" name="notation" min="1" max="5" class="form-control" id="notation" required>
      </div>
      <div class="mb-3">
        <label for="avis">Avis</label>
        <textarea name="avis" class="form-control" rows="5" id="avis" required></textarea>
      </div>

      
      <button type="submit" class="btn btn-primary  py-3 px-5">Enregistrer</button>
      <a href="/avis-client" class="btn btn-secondary  py-3 px-5">Annuler</a>
    </form>
  </div>
</div>