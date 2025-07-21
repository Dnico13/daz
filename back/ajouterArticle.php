<?php

session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  header("Location: /");
  exit;
}
require_once '../pdo.php';



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $titre1 = $_POST['titre_principal'] ?? '';
  $titre2 = $_POST['titre2'] ?? '';
  $text2 = $_POST['text2'] ?? '';
  $titre3 = $_POST['titre3'] ?? '';
  $text3 = $_POST['text3'] ?? '';
  $titre4 = $_POST['titre4'] ?? '';
  $text4 = $_POST['text4'] ?? '';

  $fileName = '';
  if (isset($_FILES['illustration']) && $_FILES['illustration']['error'] === 0) {
    $fileName = time() . '_' . basename($_FILES['illustration']['name']);
    move_uploaded_file($_FILES['illustration']['tmp_name'], '../illustrations/' . $fileName);
  }

  $stmt = $pdo->prepare("INSERT INTO Actualite (titre_principal, titre2, text2, titre3, text3, titre4, text4, illustration_principale) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
  $stmt->execute([$titre1, $titre2, $text2, $titre3, $text3, $titre4, $text4, $fileName]);

  header("Location: contenu-admin.php");
  exit;
}
?>

<?php require_once './partials/head.php'; ?>

<?php
  require_once './partials/header.php';
  ?>
  <body class="bg-light">
  <div class="container py-5">
    <h1 class="mb-4">Nouvel article</h1>
    <form method="post" enctype="multipart/form-data">
      <div class="mb-3"><label>Titre principal</label><input type="text" name="titre_principal" class="form-control" required></div>
      <div class="mb-3"><label>Sous-titre 2</label><input type="text" name="titre2" class="form-control"></div>
      <div class="mb-3"><label>Texte 2</label><textarea name="text2" class="form-control"></textarea></div>
      <div class="mb-3"><label>Sous-titre 3</label><input type="text" name="titre3" class="form-control"></div>
      <div class="mb-3"><label>Texte 3</label><textarea name="text3" class="form-control"></textarea></div>
      <div class="mb-3"><label>Sous-titre 4</label><input type="text" name="titre4" class="form-control"></div>
      <div class="mb-3"><label>Texte 4</label><textarea name="text4" class="form-control"></textarea></div>
      <div class="mb-3"><label>Illustration principale</label><input type="file" name="illustration" class="form-control"></div>
      <button type="submit" class="btn btn-success">Enregistrer</button>
      <a href="contenu-admin.php" class="btn btn-secondary">Annuler</a>
    </form>
  </div>
  <?php
  require_once './partials/footer.php';
  require_once './partials/js.php';
  ?>
</body>

</html>