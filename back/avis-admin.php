<?php

session_start();
require_once '../pdo.php';




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

            <div class="col-md-8 d-flex flex-column">
                <h2>Liste des avis clients</h2>
                <!-- Code pour afficher et gérer les avis clients -->
            </div>
        </div>
    </div>


    <?php
    require_once './partials/footer.php';
    require_once './partials/js.php';
    ?>

</body>

</html>