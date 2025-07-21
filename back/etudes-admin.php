<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: /");
    exit;
}
require_once '../pdo.php';
require_once './partials/head.php';
?>

<body class="d-flex flex-column vh-100">

    <?php require_once './partials/header.php'; ?>

    <div class="container-fluid flex-grow-1 d-flex flex-column">
        <h1 class="text-center">Gestion des Études</h1>
        <div class="row mt-4">
            <?php require_once './partials/nav-admin.php'; ?>

            <div class="col-md-10 d-flex flex-column">
                <?php $req = $pdo->query("SELECT * FROM etudes ORDER BY id DESC"); ?>

                <div class="container py-5 bg-light">
                    <h2 class="mb-4">Liste des études</h2>
                    <a href="ajouterEtudes.php" class="btn btn-primary mb-4">Ajouter une étude</a>

                    <table class="table table-responsive table-bordered bg-white align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Titre principal</th>
                                <th>Texte 1</th>
                                <th>Titre 2</th>
                                <th>Texte 2</th>
                                <th>Titre 3</th>
                                <th>Texte 3</th>
                                <th>Titre 4</th>
                                <th>Texte 4</th>
                                <th>Illustration</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $req->fetch(PDO::FETCH_ASSOC)) : ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['Titre_principal']) ?></td>
                                    <td><?= htmlspecialchars($row['text1']) ?></td>
                                    <td><?= htmlspecialchars($row['titre2']) ?></td>
                                    <td><?= nl2br(htmlspecialchars($row['text2'])) ?></td>
                                    <td><?= htmlspecialchars($row['titre3']) ?></td>
                                    <td><?= nl2br(htmlspecialchars($row['text3'])) ?></td>
                                    <td><?= htmlspecialchars($row['titre4']) ?></td>
                                    <td><?= nl2br(htmlspecialchars($row['text4'])) ?></td>
                                    <td>
                                        <?php if (!empty($row['illustration'])) : ?>
                                            <img src="../illustrations/etudes/<?= htmlspecialchars($row['illustration']) ?>" alt="Illustration de <?= htmlspecialchars($row['Titre_principal']) ?> " style="width: 100px;">
                                        <?php else : ?>
                                            <em>Pas d’image</em>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="modifierEtudes.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning px-3 mb-2">Modifier</a>
                                        <a href="supprimerEtudes.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer cette étude ?');">Supprimer</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <?php
    require_once './partials/footer.php';
    require_once './partials/js.php';
    ?>
</body>
</html>
