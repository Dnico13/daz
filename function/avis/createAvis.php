<?php
session_start();

require_once './template/top.php';
require_once 'pdo.php';

?>

<body>
    <header>
        <?php
        require_once './template/admin_header.php';
        ?>


    </header>
    <main>

        <div class="container d-flex flex-column justify-content-center">

            <div class="row">
                <h3 class="text-center  text-primary  mt-3 mb-4"> Enregistrement d'un témoignage recueuilli </h3>
            </div>



            <div class="row">

                <form class="w-50 mx-auto mb-4" action="createTemoignage.php" method="POST" target="_self">
                    <div class="row mb-3">
                        <label for="nom_temoignage" class="col-sm-2 col-form-label">Prénom:</label>
                        <div class="col-sm-10 ">
                            <input type="text" class="form-control" name="nom_temoignage" id="nom_temoignage" pattern="[a-zA-Z0-9]+">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="note" class="col-sm-2 col-form-label">Note sur 5:</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="note" id="note"  min="0" max="5">
                        </div>
                    </div>
                    <div>
                        <label class="form-label" for="avis">Message:</label>
                        <textarea class="form-control" name="avis" id="avis" cols="30" rows="7" placeholder="Laissez votre temoignage ici" pattern="[a-zA-Z0-9]+"></textarea>
                    </div>
                    <div>
                        <input type="hidden" class="form-control" name="Validate" value="1">
                    </div>
                    <div class="text-end">
                        
                        <button type="submit" class="btn btn-primary" name="submit">Envoi</button>
                    </div>
                </form>
            </div>
<?php
function createTemoignage($pdo){;

IF (isset($_POST['submit'])){

        


    try{
        $nom= htmlspecialchars($_POST['nom_temoignage']);
        $note= htmlspecialchars($_POST['note']);
        $avis= htmlspecialchars($_POST['avis']);
        $Validate= htmlspecialchars($_POST['Validate']);

        $query = $pdo -> prepare("INSERT INTO Temoignage ( nom_temoignage, note, avis, Validate) values (:nom, :note, :avis, :Validate)");

        $query-> BindParam(':nom', $nom);
        $query-> BindParam(':note', $note);
        $query-> BindParam(':avis', $avis);
        $query-> BindParam(':Validate', $Validate);

        $query -> execute();

        header('location: admin.php');



    } catch (PDOException $e) {
        echo'la saisie des informations n ont pas ete envoyes correctement';
    }
}
}
createTemoignage($pdo);

?>


    </main>
    <footer>
        <?php
        require_once './template/admin_footer.php';
        ?>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>