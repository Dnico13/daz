<?php

session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: /");
    exit;
}
require_once '../pdo.php';



$id = $_GET['id'] ?? null;
if (!$id) exit;

$stmt = $pdo->prepare("SELECT illustration_principale FROM Actualite WHERE id = ?");
$stmt->execute([$id]);
$data = $stmt->fetch();

if ($data && !empty($data['illustration_principale'])) {
    $fichier = 'illustrations/' . $data['illustration_principale'];
    if (file_exists($fichier)) unlink($fichier);
}

$delete = $pdo->prepare("DELETE FROM Actualite WHERE id = ?");
$delete->execute([$id]);

header("Location: contenu-admin.php");
exit;
