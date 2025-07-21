<?php

session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  header("Location: /");
  exit;
}
require_once '../pdo.php';


// Récupérer tous les témoignages
$req = $pdo->query("SELECT * FROM Temoignage ORDER BY id DESC");
?>

<?php
require_once './partials/head.php';
?>

<body class="d-flex flex-column vh-100">

  <?php
  require_once './partials/header.php';
  ?>


  <div class="container-fluid flex-grow-1 d-flex flex-column">
    <h1 class="text-center">Gestion des avis clients</h1>
    <div class="row mt-4">
      <?php
      require_once './partials/nav-admin.php';
      ?>

      <div class="col-md-10 d-flex flex-column">
        <h2>Liste des avis clients</h2>
        <a href="ajouterAvis.php" class="btn btn-primary mb-3">Ajouter un témoignage</a>

        <table class="table table-bordered bg-white">
          <thead class="table-light">
            <tr>
              <th>Prénom</th>
              <th>Ville</th>
              <th>Note</th>
              <th>Validation</th>
              <th>Avis</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($row = $req->fetch(PDO::FETCH_ASSOC)) : ?>
              <tr>
                <td><?= htmlspecialchars($row['prenom']) ?></td>
                <td><?= htmlspecialchars($row['ville']) ?></td>
                <td><?= str_repeat('⭐', $row['notation']) ?> (<?= $row['notation'] ?>/5)</td>
                <td>
                  <?php if ($row['Valid']) : ?>
                    <span class="badge bg-success">Validé</span><br>
                    <a href="toggleValid.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-outline-secondary mt-1">Dévalider</a>
                  <?php else : ?>
                    <span class="badge bg-secondary">Non validé</span><br>
                    <a href="toggleValid.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-outline-success mt-1">Valider</a>
                  <?php endif; ?>
                </td>
                <td><?= nl2br(htmlspecialchars($row['avis'])) ?></td>
                <td>
                  <a href="modifierAvis.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning  mb-2 px-3">Modifier</a>
                  <a href="supprimerAvis.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ce témoignage ?');">Supprimer</a>
                </td>
              </tr>
            <?php endwhile ?>
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