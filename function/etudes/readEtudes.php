<?php



function readEtudes($pdo){
    try{
        $query= $pdo-> prepare("SELECT * FROM etudes ORDER BY id DESC");
        $query -> execute();

        $readEtudes = $query-> fetchAll(PDO::FETCH_ASSOC);
        return $readEtudes;
    } catch (Exception $e){
        echo 'lecture de la liste des actualites impossibles';
    }

}