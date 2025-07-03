<?php
require_once '../function/article/readActu.php';
require_once '../pdo.php';
$readActu = readActu($pdo);
?>

<h1 class="visually-hidden">
    Actualités et conseils en expertise immobilière – Suivez les tendances du marché et les évolutions de la valeur vénale
</h1>



<div class="container w-75 w-lg-50 text-break text-center h2 pt-5 mt-5">
    Experts de référence, je vous propose ici un regard éclairé sur l’actualité en lien avec l’évaluation des biens immobiliers : réformes, indices, méthodologies et études de marché.
</div>




<!-- Feature Start -->
<div class="container-xxl mt-3 mt-sm-5 pt-sm-5">
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 justify-content-center align-items-stretch g-4 py-5">
        <?php foreach ($readActu as $index => $actu) { ?>
            <div class="col">
                <div class="card h-100 d-flex flex-column mx-auto wow fadeInUp" data-wow-delay="0.1s">
                    <img src="./illustrations/<?= $actu["illustration_principale"]; ?>" class="card-img-top" alt="Illustration de l'article intitulé :<?= $actu["titre_principal"]; ?>  ">
                    <div class="card-body flex-grow-1 bg-light">
                        <h5 class="card-title"><?= $actu["titre_principal"]; ?></h5>
                        <p class="card-text"><?= $actu["titre2"]; ?></p>
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
                            <h5 class="modal-title" id="modalLabel<?= $index ?>"><?= $actu["titre_principal"]; ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                        </div>
                        <div class="modal-body">
                            <p><?= $actu["titre2"]; ?></p>
                            <p><?= $actu["text2"]; ?> </p>
                            <p><?= $actu["titre3"]; ?> </p>
                            <p><?= $actu["text3"]; ?> </p>
                            <p><?= $actu["titre4"]; ?> </p>
                            <p><?= $actu["text4"]; ?> </p>
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