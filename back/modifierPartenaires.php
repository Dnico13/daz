<?php

session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  header("Location: /");
  exit;
}
require_once '../pdo.php';
require_once './partials/head.php';



$id = $_GET['id'] ?? null;
if (!$id) exit('ID manquant');

$stmt = $pdo->prepare("SELECT * FROM partenaire WHERE id = ?");
$stmt->execute([$id]);
$data = $stmt->fetch();

if (!$data) exit('Partenaire non trouvé');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $nom = $_POST['nom'] ?? '';
  $lien = $_POST['lien'] ?? '';

  $logo = $data['logo'];

  if (!empty($_FILES['logo']['name'])) {
    $illustration = time() . '_' . basename($_FILES['illustration']['name']);
    move_uploaded_file($_FILES['logo']['tmp_name'], '../illustrations/partenaires/' . $logo);
  }

  $stmt = $pdo->prepare("UPDATE partenaire SET nom =?, lien =?,  logo =? WHERE id=?");
  $stmt->execute([$nom, $lien, $logo, $id]);

  header("Location: partenaires-admin.php");
  exit;
}
?>




 <?php require_once './partials/head.php'; ?>


<body class="bg-light">
   <?php require_once './partials/header.php'; ?>
  <div class="container py-5">
    <h1 class="mb-4">Modifier l’article</h1>
    <form method="post" enctype="multipart/form-data">
      <div class="mb-3"><label>Nom</label><input type="text" name="nom" value="<?= htmlspecialchars($data['nom']) ?>" class="form-control" required></div>

      <div class="mb-3"><label>Lien</label><input name="lien" class="form-control"><?= htmlspecialchars($data['lien']) ?> </input></div>

      <label>Logo actuelle :</label><br>
      <?php if ($data['logo']) : ?>
        <img src="../illustrations/partenaires/<?= $data['logo'] ?>" width="120" class="mb-2"><br>
      <?php endif; ?>
      <input type="file" name="logo" class="form-control">
  </div>
  <button type="submit" class="btn btn-primary">Mettre à jour</button>
  <a href="partenaires-admin.php" class="btn btn-secondary">Annuler</a>
  </form>
  </div>
  <?php
  require_once './partials/footer.php';
  require_once './partials/js.php';
  ?>
</body>

</html>