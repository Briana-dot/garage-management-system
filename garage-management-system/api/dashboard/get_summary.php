<?php

require_once '../../config/database.php';

header('Content-Type: application/json');

$awaitingApproval = $pdo->query("
    SELECT COUNT(*)
    FROM repair_orders
    WHERE status = 'Waiting Approval'
")->fetchColumn();

$delayedParts = $pdo->query("
    SELECT COUNT(*)
    FROM repair_orders
    WHERE status = 'Awaiting Parts'
")->fetchColumn();

$readyPickup = $pdo->query("
    SELECT COUNT(*)
    FROM repair_orders
    WHERE status = 'Ready Pickup'
")->fetchColumn();

echo json_encode([
    'awaitingApproval' => $awaitingApproval,
    'delayedParts' => $delayedParts,
    'readyPickup' => $readyPickup
]);