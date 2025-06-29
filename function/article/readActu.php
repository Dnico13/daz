<?php



function readActu($pdo){
    try{
        $query= $pdo-> prepare("SELECT * FROM Actualite ORDER BY id DESC");
        $query -> execute();

        $readReparations = $query-> fetchAll(PDO::FETCH_ASSOC);
        return $readReparations;
    } catch (Exception $e){
        echo 'lecture de la liste des actualites impossibles';
    }

}