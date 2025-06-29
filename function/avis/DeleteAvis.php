<?php
require_once '../pdo.php';

function deleteTemoignage($pdo){
    
        $user_Temoignage = htmlspecialchars($_GET['id']);
        
        
        $query  = $pdo->prepare("DELETE FROM Temoignage WHERE id_temoignage= :id");
        $query->bindParam(':id', $user_Temoignage);
        
        $query->execute();
        
        
        header('Location: ../admin.php');
            

    }
        
     

deleteTemoignage($pdo)