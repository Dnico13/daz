<?php

session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: /");
    exit;
}
require_once '../pdo.php';



$id = $_GET['id'] ?? null;
if (!$id) exit;

$stmt = $pdo->prepare("SELECT illustration FROM etudes WHERE id = ?");
$stmt->execute([$id]);
$data = $stmt->fetch();

if ($data && !empty($data['illustration'])) {
    $fichier = '../illustrations/etudes/' . $data['illustration'];
    if (file_exists($fichier)) unlink($fichier);
}

$delete = $pdo->prepare("DELETE FROM etudes WHERE id = ?");
$delete->execute([$id]);

header("Location: etudes-admin.php");
exit;