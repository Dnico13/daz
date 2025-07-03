<?php

session_start();
require_once '../pdo.php';

$id = $_GET['id'] ?? null;

if ($id) {
  $stmt = $pdo->prepare("UPDATE Temoignage SET Valid = NOT Valid WHERE id = ?");
  $stmt->execute([$id]);
}

header("Location: ./admin.php");
exit;
