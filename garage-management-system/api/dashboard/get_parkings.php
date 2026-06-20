<?php

require_once '../../config/database.php';

header('Content-Type: application/json');

$stmt = $pdo->query("
    SELECT *
    FROM repair_orders
");

$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($orders);