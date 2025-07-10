<?php

function readPartenaire($pdo){
    try{
        $query= $pdo-> prepare("SELECT * FROM partenaire ORDER BY id ASC");

        $query -> execute();

        $readPartenaire = $query-> fetchAll(PDO::FETCH_ASSOC);
        return $readPartenaire;
    } catch (Exception $e){
        echo 'lecture des partenaires est impossible';
    }

}
