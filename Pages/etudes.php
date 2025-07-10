<?php
require_once '../function/etudes/readEtudes.php';
require_once '../pdo.php';
$readEtudes = readEtudes($pdo);
?>

<h1 class="visually-hidden">
    
</h1>



<div class="container w-75 w-lg-50 text-break text-center h2 pt-5 mt-5">
    Découvrez ici des exemples concrets d'expertises en valeur vénale que j'ai réalisées. Chaque cas vous offre un aperçu simplifié de ma démarche et des solutions apportées, illustrant la diversité des situations que je rencontre et la précision de mes évaluations.
</div>



<!-- Feature Start -->
<div class="container-xxl mt-3 mt-sm-5 pt-sm-5">
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 justify-content-center align-items-stretch g-4 py-5">
        <?php foreach ($readEtudes as $index => $etude) { ?>
            <div class="col">
                <div class="card h-100 d-flex flex-column mx-auto wow fadeInUp" data-wow-delay="0.1s">
                    <img src="./illustrations/etudes/<?= $etude["illustration"]; ?>" class="card-img-top" alt="Illustration de l'article intitulé :<?= $etude["Titre_principal"]; ?>  ">
                    <div class="card-body flex-grow-1 bg-light">
                        <h2 class="card-title"><?= $etude["Titre_principal"]; ?></h2>
                        <p class="card-text"><?= $etude["text1"]; ?></p>
                    </div>
                    <div class="card-footer bg-light border-0">
                        <!-- Bouton qui déclenche la modale -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalArticle<?= $index ?>">
                            Plus de détails
                        </button>
                    </div>
                </div>
            </div>
            <!-- MODALE Bootstrap -->
            <div class="modal fade" id="modalArticle<?= $index ?>" tabindex="-1" aria-labelledby="modalLabel<?= $index ?>" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabel<?= $index ?>"><?= $etude["Titre_principal"]; ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                        </div>
                        <div class="modal-body">
                            <p><?= $etude["text1"]; ?></p>
                            <p><?= $etude["titre2"]; ?> </p>
                            <p><?= $etude["text2"]; ?> </p>
                            <p><?= $etude["titre3"]; ?> </p>
                            <p><?= $etude["text3"]; ?> </p>
                            <p><?= $etude["titre4"]; ?> </p>
                            <p><?= $etude["text4"]; ?> </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        </div>
                    </div>
                </div>
            </div>

        <?php } ?>
    </div>
</div>