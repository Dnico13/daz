

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

    <?php
    require_once './partials/header.php';
    ?>

    <div class="container-fluid flex-grow-1 d-flex flex-column">
        <h1 class="text-center">Gestion du contenu</h1>
        <div class="row mt-4">
            <?php
            require_once './partials/nav-admin.php';
            ?>

            <div class="col-md-8 d-flex flex-column">
                
                <?php

                $req = $pdo->query("SELECT * FROM Actualite ORDER BY id DESC");
                ?>

                <!DOCTYPE html>
                <html lang="fr">

                <head>
                    <meta charset="UTF-8">
                    <title>Gestion des actualités</title>
                    
                </head>

                <body class="bg-light">
                    <div class="container py-5">
                        <h1 class="mb-4">Actualités</h1>
                        <a href="ajouterArticle.php" class="btn btn-primary mb-4">Ajouter une actualité</a>

                        <table class="table table-bordered bg-white align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Titre principal</th>
                                    <th>Illustration</th>
                                    <th>Sous-titre 2</th>
                                    <th>Texte 2</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $req->fetch(PDO::FETCH_ASSOC)) : ?>
                                    <tr>
                                        <td><?= htmlspecialchars($row['titre_principal']) ?></td>
                                        <td>
                                            <?php if (!empty($row['illustration_principale'])) : ?>
                                                <img src="../illustrations/<?= htmlspecialchars($row['illustration_principale']) ?>" alt="" style="width: 100px; height: auto;">
                                            <?php else : ?>
                                                <em>Pas d’image</em>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= htmlspecialchars($row['titre2']) ?></td>
                                        <td><?= nl2br(htmlspecialchars($row['text2'])) ?></td>
                                        <td>
                                            <a href="modifierArticle.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning mb-2 px-3">Modifier</a>
                                            <a href="supprimerArticle.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer cette actualité ?');">Supprimer</a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </body>

                </html>

            </div>
        </div>
    </div>


    <?php
    require_once './partials/footer.php';
    require_once './partials/js.php';
    ?>

</body>

</html>