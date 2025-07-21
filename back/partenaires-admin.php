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
        <h1 class="text-center">Gestion des partenaires</h1>
        <div class="row mt-4">
            <?php
            require_once './partials/nav-admin.php';
            ?>

            <div class="col-md-10 d-flex flex-column">
                
                <?php

                $req = $pdo->query("SELECT * FROM partenaire ORDER BY id DESC");
                ?>

              

                <body class="bg-light">
                    <div class="container py-5">
                        <h2 class="mb-4">Liste des Partenaires</h2>
                        <a href="ajouterPartenaires.php" class="btn btn-primary mb-4">Ajouter un partenaire</a>

                        <table class="table table-bordered bg-white align-middle">
                            <thead class="table-light">
                                <tr>
                                    
                                    <th>Nom</th>
                                    <th>Logo</th>
                                    <th>Liens</th>
                                    <th></th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $req->fetch(PDO::FETCH_ASSOC)) : ?>
                                    <tr>
                                        <td><?= htmlspecialchars($row['nom']) ?></td>
                                        <td>
                                            <?php if (!empty($row['logo'])) : ?>
                                                <img src="../illustrations/partenaires/<?= htmlspecialchars($row['logo']) ?>" alt="logo de <?=htmlspecialchars($row['nom'])?> "  style="width: 100px; height: auto;">
                                            <?php else : ?>
                                                <em>Pas d’image</em>
                                            <?php endif; ?>
                                        </td>
                                        
                                        <td><?= nl2br(htmlspecialchars($row['lien'])) ?></td>
                                        <td class="text-center">
                                            <a href="modifierPartenaires.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning mb-2 px-3">Modifier</a>
                                            <a href="supprimerPartenaires.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer cette actualité ?');">Supprimer</a>
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