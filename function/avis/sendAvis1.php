<?php


require_once '../../pdo.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST' || empty($_POST)) {
   
  
  try {
    // Récupérer les données depuis $_POST
    $nom = htmlentities($_POST['prenom'] ?? '');
    $ville = htmlentities($_POST['ville'] ?? '');
    $note = intval($_POST['notation'] ?? 0);
    $avis = htmlentities($_POST['avis'] ?? '');
    $validate = 0; // Valeur par défaut pour 'Valid'
    
    
  if ($nom && $ville && $note > 0 && $avis) {
    $query = $pdo->prepare("INSERT INTO Temoignage (prenom, notation, avis, Valid, ville) VALUES (:nom, :note, :avis, :validate, :ville)");
    $query->bindParam(':nom', $nom);
    $query->bindParam(':note', $note);
    $query->bindParam(':avis', $avis);
    $query->bindParam(':validate', $validate);
    $query->bindParam(':ville', $ville);
    $query->execute();

    echo "<script>
      alert('Merci pour votre avis !');
      window.location.href = '/';
          </script> ";
    exit; 
  } else {
    echo json_encode(["success" => false, "message" => "Champs manquants."]);
  }
  
} catch (PDOException $e) {
  echo json_encode(["success" => false, "message" => "Erreur de base de données."]);
}

}