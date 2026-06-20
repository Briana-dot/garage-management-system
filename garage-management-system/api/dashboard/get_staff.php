<?php

require_once '../../config/database.php';

header('Content-Type: application/json');

$stmt = $pdo->query("
    SELECT *
    FROM technicians
");

$staff = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($staff);