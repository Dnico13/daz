<?php

function readAvis1($pdo){
    try{
        $query= $pdo-> prepare("SELECT * FROM Temoignage where Valid = 1 ORDER BY id DESC");

        $query -> execute();

        $readAvis1 = $query-> fetchAll(PDO::FETCH_ASSOC);
        return $readAvis1;
    } catch (Exception $e){
        echo 'lecture des avis est impossible';
    }

}



