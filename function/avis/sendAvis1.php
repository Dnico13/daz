<?php
require_once '../pdo.php';

$rawData = file_get_contents("php://input");
$data = json_decode($rawData, true);

if (!$data) {
  echo json_encode(["success" => false, "message" => "Données JSON invalides."]);
  exit;
}

try {
  $nom = htmlentities($data['prenom'] ?? '');
  $ville = htmlentities($data['ville'] ?? '');
  $note = intval($data['notation'] ?? 0);
  $avis = htmlentities($data['avis'] ?? '');
  $validate = 0;

  if ($nom && $ville && $note > 0 && $avis) {
    $query = $pdo->prepare("INSERT INTO Temoignage (prenom, notation, avis, Valid, ville) VALUES (:nom, :note, :avis, :validate, :ville)");
    $query->bindParam(':nom', $nom);
    $query->bindParam(':note', $note);
    $query->bindParam(':avis', $avis);
    $query->bindParam(':validate', $validate);
    $query->bindParam(':ville', $ville);
    $query->execute();

    echo json_encode(["success" => true]);
  } else {
    echo json_encode(["success" => false, "message" => "Champs manquants."]);
  }

} catch (PDOException $e) {
  echo json_encode(["success" => false, "message" => "Erreur de base de données."]);
}
