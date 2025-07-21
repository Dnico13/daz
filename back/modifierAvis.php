<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: /");
    exit;
}


require_once '../pdo.php';
$id = $_GET['id'] ?? null;
if (!$id) exit('ID invalide');

$stmt = $pdo->prepare("SELECT * FROM Temoignage WHERE id = ?");
$stmt->execute([$id]);
$avis = $stmt->fetch();

if (!$avis) exit('Témoignage introuvable');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $prenom = $_POST['prenom'] ?? '';
    $ville = $_POST['ville'] ?? '';
    $notation = (int)($_POST['notation'] ?? 0);
    $contenu = $_POST['avis'] ?? '';
    $valid = isset($_POST['valid']) ? 1 : 0;

    $update = $pdo->prepare("UPDATE Temoignage SET prenom = ?, ville = ?, notation = ?, avis = ?, Valid = ? WHERE id = ?");
    $update->execute([$prenom, $ville, $notation, $contenu, $valid, $id]);

    header("Location: ./avis-admin.php");
    exit;
}
?>


   <?php require_once './partials/head.php'; ?>

<body class="bg-light">
    <?php require_once './partials/header.php'; ?>
  <div class="container py-5">
    <h1 class="mb-4">Modifier le témoignage</h1>
    <form method="post">
      <div class="mb-3">
        <label>Prénom</label>
        <input type="text" name="prenom" class="form-control" value="<?= htmlspecialchars($avis['prenom']) ?>" required>
      </div>
      <div class="mb-3">
        <label>Ville</label>
        <input type="text" name="ville" class="form-control" value="<?= htmlspecialchars($avis['ville']) ?>" required>
      </div>
      <div class="mb-3">
        <label>Note</label>
        <input type="number" name="notation" min="1" max="5" class="form-control" value="<?= $avis['notation'] ?>" required>
      </div>
      <div class="mb-3">
        <label>Avis</label>
        <textarea name="avis" class="form-control" rows="5" required><?= htmlspecialchars($avis['avis']) ?></textarea>
      </div>
      <div class="form-check mb-3">
        <input type="checkbox" class="form-check-input" name="valid" id="valid" <?= $avis['Valid'] ? 'checked' : '' ?>>
        <label class="form-check-label" for="valid">Témoignage validé ?</label>
      </div>
      <button type="submit" class="btn btn-primary">Mettre à jour</button>
      <a href="avis-admin.php" class="btn btn-secondary">Annuler</a>
    </form>
  </div>
   <?php
    require_once './partials/footer.php';
    require_once './partials/js.php';
    ?>
</body>
</html>
