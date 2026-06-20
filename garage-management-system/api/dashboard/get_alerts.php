<?php

require_once '../../config/database.php';

header('Content-Type: application/json');

$stmt = $pdo->query("
    SELECT *
    FROM alerts
    ORDER BY created_at DESC
");

$alerts = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($alerts);