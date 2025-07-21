<?php

session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: /");
    exit;
}
require_once '../pdo.php';

?>


<?php
require_once './partials/head.php';
?>

<body class="d-flex flex-column vh-100">

    <?php
    require_once './partials/header.php';
    ?>

    <div class="container-fluid flex-grow-1 d-flex flex-column">
        <h1 class="text-center">Interface d'administration</h1>
        <div class="row mt-4">
            <?php
            require_once './partials/nav-admin.php';
            ?>
            
            <div class="col-md-10 d-flex flex-column">
                <h2>Bienvenue, <?php echo $_SESSION['prenom']; ?>!</h2>
                <p>Utilisez le menu à gauche pour naviguer dans les différentes sections d'administration du site.</p>
            </div>
        </div>
    </div>

    <?php
    require_once './partials/footer.php';
    require_once './partials/js.php';
    ?>

</body>

</html>