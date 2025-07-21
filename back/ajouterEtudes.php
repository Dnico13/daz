<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: /");
    exit;
}
require_once '../pdo.php';

if (isset($_POST['submit'])) {
    $fileName = '';
    if (isset($_FILES['illustration']) && $_FILES['illustration']['error'] === UPLOAD_ERR_OK) {
        $fileTmp = $_FILES['illustration']['tmp_name'];
        $fileName = basename($_FILES['illustration']['name']);
        $destination = '../illustrations/etudes/' . $fileName;
        move_uploaded_file($fileTmp, $destination);
    }

    $stmt = $pdo->prepare("INSERT INTO etudes (titre_principal, text1, titre2, text2, titre3, text3, titre4, text4, illustration) 
                           VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $_POST['titre_principal'],
        $_POST['text1'],
        $_POST['titre2'],
        $_POST['text2'],
        $_POST['titre3'],
        $_POST['text3'],
        $_POST['titre4'],
        $_POST['text4'],
        $fileName
    ]);
    header("Location: etudes-admin.php");
    exit;
}
?>


<?php require_once './partials/head.php'; ?>


<?php
require_once './partials/header.php';
?>

<body class="bg-light">
    <div class="container py-5">
        <h2 class="mb-4 text-center">📝 Ajouter une nouvelle étude</h2>
        <form method="post" enctype="multipart/form-data">
            <div class="row g-3">
                <?php
                $fields = [
                    'titre_principal' => 'Titre principal',
                    'text1' => 'Texte 1',
                    'titre2' => 'Titre 2',
                    'text2' => 'Texte 2',
                    'titre3' => 'Titre 3',
                    'text3' => 'Texte 3',
                    'titre4' => 'Titre 4',
                    'text4' => 'Texte 4'
                ];
                foreach ($fields as $name => $label) : ?>
                    <div class="col-md-6">
                        <label class="form-label"><?= $label ?></label>
                        <input type="text" name="<?= $name ?>" class="form-control">
                    </div>
                <?php endforeach; ?>

                <div class="col-md-6">
                    <label class="form-label">Illustration</label>
                    <input type="file" name="illustration" class="form-control" required>
                </div>

                <div class="col-12 text-center mt-4">
                    <button type="submit" name="submit" class="btn btn-success px-5">Ajouter l’étude</button>
                </div>
            </div>
        </form>
    </div>
    <?php
    require_once './partials/footer.php';
    require_once './partials/js.php';
    ?>
</body>

</html>