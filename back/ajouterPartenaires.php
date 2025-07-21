<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: /");
    exit;
}
require_once '../pdo.php';

if (isset($_POST['submit'])) {
    $fileName = '';
    if (isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {
        $fileTmp = $_FILES['logo']['tmp_name'];
        $fileName = basename($_FILES['logo']['name']);
        $destination = '../illustrations/partenaires/' . $fileName;
        move_uploaded_file($fileTmp, $destination);
    }

    $stmt = $pdo->prepare("INSERT INTO partenaire (nom, lien, logo) 
                           VALUES (?, ?, ?)");
    $stmt->execute([
        $_POST['nom'],
        $_POST['lien'],
        $fileName
    ]);
    header("Location: partenaires-admin.php");
    exit;
}
?>


<?php require_once './partials/head.php'; ?>

<?php
require_once './partials/header.php';
?>

<body class="bg-light">
  <div class="container py-5">
    <h2 class="mb-4 text-center">📝 Ajouter une nouveau partenaire</h2>
    <form method="post" enctype="multipart/form-data">
        <div class="row g-3">
            <?php
            $fields = [
                'nom' => 'nom',
                'lien' => 'lien',

            ];
            foreach ($fields as $name => $label) : ?>
                <div class="col-md-6">
                    <label class="form-label"><?= $label ?></label>
                    <input type="text" name="<?= $name ?>" class="form-control">
                </div>
            <?php endforeach; ?>

            <div class="col-md-6">
                <label class="form-label">logo</label>
                <input type="file" name="logo" class="form-control" required>
            </div>

            <div class="col-12 text-center mt-4">
                <button type="submit" name="submit" class="btn btn-success px-5">Ajouter le partenaire</button>
            </div>
        </div>
    </form>
    <?php
    require_once './partials/footer.php';
    require_once './partials/js.php';
    ?>
</body>

</html>