<?php

session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: /");
    exit;
}
require_once '../pdo.php';



$id = $_GET['id'] ?? null;
if (!$id) exit('ID manquant');

$stmt = $pdo->prepare("SELECT * FROM Actualite WHERE id = ?");
$stmt->execute([$id]);
$data = $stmt->fetch();

if (!$data) exit('Article non trouvé');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre1 = $_POST['titre_principal'] ?? '';
    $titre2 = $_POST['titre2'] ?? '';
    $text2 = $_POST['text2'] ?? '';
    $titre3 = $_POST['titre3'] ?? '';
    $text3 = $_POST['text3'] ?? '';
    $titre4 = $_POST['titre4'] ?? '';
    $text4 = $_POST['text4'] ?? '';
    $illustration = $data['illustration_principale'];

    if (!empty($_FILES['illustration']['name'])) {
        $illustration = time() . '_' . basename($_FILES['illustration']['name']);
        move_uploaded_file($_FILES['illustration']['tmp_name'], '../illustrations/' . $illustration);
    }

    $stmt = $pdo->prepare("UPDATE Actualite SET titre_principal=?, titre2=?, text2=?, titre3=?, text3=?, titre4=?, text4=?, illustration_principale=? WHERE id=?");
    $stmt->execute([$titre1, $titre2, $text2, $titre3, $text3, $titre4, $text4, $illustration, $id]);

    header("Location: contenu-admin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Modifier l’actualité</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container py-5">
    <h1 class="mb-4">Modifier l’article</h1>
    <form method="post" enctype="multipart/form-data">
      <div class="mb-3"><label>Titre principal</label><input type="text" name="titre_principal" value="<?= htmlspecialchars($data['titre_principal']) ?>" class="form-control" required></div>
      <div class="mb-3"><label>Sous-titre 2</label><input type="text" name="titre2" value="<?= htmlspecialchars($data['titre2']) ?>" class="form-control"></div>
      <div class="mb-3"><label>Texte 2</label><textarea name="text2" class="form-control"><?= htmlspecialchars($data['text2']) ?></textarea></div>
      <div class="mb-3"><label>Sous-titre 3</label><input type="text" name="titre3" value="<?= htmlspecialchars($data['titre3']) ?>" class="form-control"></div>
      <div class="mb-3"><label>Texte 3</label><textarea name="text3" class="form-control"><?= htmlspecialchars($data['text3']) ?></textarea></div>
      <div class="mb-3"><label>Sous-titre 4</label><input type="text" name="titre4" value="<?= htmlspecialchars($data['titre4']) ?>" class="form-control"></div>
      <div class="mb-3"><label>Texte 4</label><textarea name="text4" class="form-control"><?= htmlspecialchars($data['text4']) ?></textarea></div>
      <div class="mb-3">
        <label>Illustration actuelle :</label><br>
        <?php if ($data['illustration_principale']) : ?>
          <img src="illustrations/<?= $data['illustration_principale'] ?>" width="120" class="mb-2"><br>
        <?php endif; ?>
        <input type="file" name="illustration" class="form-control">
      </div>
      <button type="submit" class="btn btn-primary">Mettre à jour</button>
      <a href="contenu-admin.php" class="btn btn-secondary">Annuler</a>
    </form>
  </div>
</body>
</html>
