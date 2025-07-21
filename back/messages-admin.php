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
        <h1 class="text-center my-4">Messages reçus</h1>
        <div class="row">
            <?php require_once './partials/nav-admin.php'; ?>

            <div class="col-md-10">

                <!-- 🔥 Suppression de message -->
                <?php
                if (isset($_GET['delete'])) {
                    $stmt = $pdo->prepare("DELETE FROM message WHERE id = ?");
                    $stmt->execute([$_GET['delete']]);
                    echo "<div class='alert alert-warning'>Message supprimé.</div>";
                }

                // 🔍 Lecture des messages
                $req = $pdo->query("SELECT * FROM message ORDER BY id DESC");
                ?>

                <!-- 📋 Affichage des messages -->
                <table class="table table-bordered bg-white align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Numéro</th>
                            <th>Email</th>
                            <th>Objet</th>
                            <th>Message</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $req->fetch(PDO::FETCH_ASSOC)) : ?>
                            <tr>
                                <td><?= htmlspecialchars($row['nom']) ?></td>
                                <td><?= htmlspecialchars($row['prenom']) ?></td>
                                <td><?= htmlspecialchars($row['numero']) ?></td>
                                <td><?= htmlspecialchars($row['email']) ?></td>
                                <td><?= htmlspecialchars($row['objet']) ?></td>
                                <td><?= nl2br(htmlspecialchars($row['message'])) ?></td>
                                <td>
                                    <a href="messages-admin.php?delete=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('❌ Supprimer ce message ?');">Supprimer</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <?php
    require_once './partials/footer.php';
    require_once './partials/js.php';
    ?>
</body>
</html>
