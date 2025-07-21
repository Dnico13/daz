<?php

session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: /");
    exit;
}
require_once '../pdo.php';



$id = $_GET['id'] ?? null;
if (!$id) exit;

$stmt = $pdo->prepare("SELECT logo FROM partenaire WHERE id = ?");
$stmt->execute([$id]);
$data = $stmt->fetch();

if ($data && !empty($data['logo'])) {
    $fichier = '../illustrations/partenaires/' . $data['logo'];
    if (file_exists($fichier)) unlink($fichier);
}

$delete = $pdo->prepare("DELETE FROM partenaire WHERE id = ?");
$delete->execute([$id]);

header("Location: partenaires-admin.php");
exit;
