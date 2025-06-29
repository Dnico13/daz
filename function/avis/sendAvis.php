<?php
require_once '../pdo.php';


IF (isset($_POST['submit'])) {

    try {
    $nom = htmlentities($_POST['nom_temoignage']);
    $note = htmlentities($_POST['note']);
    $avis = htmlentities($_POST['avis']);
    $Validate = htmlentities($_POST['Validate']);
    $intvalidate= intval($Validate);

    $query = $pdo -> prepare("INSERT INTO Temoignage (nom_temoignage, note, avis, Validate) VALUES 
    (:nom, :note, :avis, :validate)");

    $query -> bindParam(':nom', $nom);
    $query -> bindParam(':note',$note);
    $query -> bindParam(':avis',$avis);
    $query -> bindParam(':validate',$intvalidate);
    

    $query-> execute();


    header('location: ../accueil.php');

    } catch (PDOException $e){
        echo"les donnees n'ont pas été envoyé correctement.<br> Merci de bien vouloir ré-essayer";
    }

}