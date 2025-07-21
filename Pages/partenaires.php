<?php
require_once '../function/partenaires/readPartenaires.php';
require_once '../pdo.php';
$readPartenaires = readPartenaire($pdo);
?>
<h1 class="visually-hidden">
Partenaires de confiance de DAZ Expertise Immobilière – Réseau d’experts en droit, fiscalité, urbanisme et estimation en valeur vénale
</h1>


<div class="container   w-75 w-lg-50 text-break text-center h2 pt-5 mt-5">
    Derrière chaque collaboration, il y a une rencontre, une confiance mutuelle, un objectif commun:
     servir au mieux vos intérêts.<br><hr><span class="text-primary"> Découvrez ceux qui avancent à mes côtés.</span>
    
</div>





<!-- Facts Start -->
<div class="container-xxl py-5">
    <div class="container pt-5">
        <div class="row g-4">
            <?php
            foreach ($readPartenaires as  $readPartenaire) { ?>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="fact-item text-center bg-light h-100 p-5 pt-0">
                        <a class="fact-icon" href="<?=$readPartenaire['lien']?>" target="_blank" rel="noopener">
                            <img src="./illustrations/partenaires/<?=$readPartenaire['logo']?>" alt="logo<?=$readPartenaire['nom']?>" title="Visitez le site <?=$readPartenaire['nom']?>" class="img-partenaire">
                        </a>
                        <h3 class="mb-3"></h3>
                        <p class="mb-0"></p>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>



<!-- Facts End -->