<?php
require_once '../function/avis/readAvis.php';
require_once '../pdo.php';
$readAvis1 = readAvis1($pdo);
?>

<div class="container mt-3 mt-sm-5 pt-sm-5">
    <div class="d-flex  justify-content-center justify-content-lg-end">
        <a href="avis.php" class="btn btn-primary  py-3 px-5 ">Laissez-moi un avis</a>
    </div>
</div>


<!-- Facts Start -->
<div class="container-xxl py-5">
    <div class="container pt-5">
        <div class="row g-4">
            <?php
            foreach ($readAvis1 as  $readAvis) { ?>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">

                    <div class="fact-item text-center bg-light h-100 p-5 pt-0">
                        <div class="fact-icon star">
                            <?= match ((int)$readAvis['notation']) {
                                    1=> "★",
                                    2=> "★★",    
                                    3=> "★★★",
                                    4=> "★★★★",    
                                    5=> "★★★★★",
                                    default=> "echo 'Pas de notation'"
                                };
                         ?>
                                     
                                                                     
                        
                        
                        
                        </div>
                        
                        <p class="mb-0"><?=  $readAvis["avis"] ?></p>
                        <h3 class="mb-3"><?= $readAvis["prenom"] ?></h3>
                        <p class="mb-3"> <?= $readAvis["ville"] ?></p>
                    </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>



<!-- Facts End -->