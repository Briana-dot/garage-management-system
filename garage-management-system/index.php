<?php
require_once 'config/constants.php';
require_once 'config/database.php';
?>
<?php

// Today's bookings
$stmt = $pdo->query("
    SELECT COUNT(*) AS total
    FROM bookings
    WHERE DATE(booking_date)=CURDATE()
");

$todayBookings = $stmt->fetch(PDO::FETCH_ASSOC)['total'];


// Today's income
$stmt = $pdo->query("
    SELECT COALESCE(SUM(amount),0) AS total
    FROM payments
    WHERE DATE(payment_date)=CURDATE()
");

$todayIncome = $stmt->fetch(PDO::FETCH_ASSOC)['total'];


// Occupied parkings
$stmt = $pdo->query("
    SELECT COUNT(*) AS occupied
    FROM workshop_parkings
    WHERE status='Occupied'
");

$occupiedparkings = $stmt->fetch(PDO::FETCH_ASSOC)['occupied'];


// Total parkings
$stmt = $pdo->query("
    SELECT COUNT(*) AS total
    FROM workshop_parkings
");

$totalparkings = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

?>
<?php

$stmt = $pdo->query("
SELECT
    parking_name,
    status,
    vehicle_name,
    plate_number,
    service_name,
    technician_name
FROM workshop_parkings
ORDER BY parking_name
");

$parkings = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $pdo->query("
    SELECT 
        DATE(payment_date) AS day,
        SUM(amount) AS total
    FROM payments
    WHERE payment_date >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)
    GROUP BY DATE(payment_date)
    ORDER BY day
");

$labels = [];
$values = [];

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $labels[] = $row['day'];
    $values[] = $row['total'];
}

$today = date('Y-m-d');

$stmt = $pdo->prepare("
    SELECT *
    FROM bookings
    WHERE DATE(booking_date) = ?
    ORDER BY booking_date ASC
");

$stmt->execute([$today]);
$appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>

<head>
    <title><?php echo APP_NAME; ?></title>
    <link rel="stylesheet" href="assets/css/variables.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/dashboard.css">
</head>

<body>
    <?php include 'includes/header.php'; ?>
    <div class="main-layout">
        <?php include 'includes/sidebar.php'; ?>
    <main class="main-content">
        <div class="dashboard-wrapper">
    <!-- Left Column Area -->
    <div class="dashboard-left">
        <h1 class="page-title">DASHBOARD SUMMARY</h1>
        
        <!-- STEP 2: Cards go here -->
        <div class="stats-grid">
    <div class="stat-card">
        <span class="stat-label">Today's Bookings</span>
        <div class="stat-value">
    <?= $todayBookings ?>
       </div>
    </div>
    
    <div class="stat-card">
        <span class="stat-label">Total Income (Today)</span>
        <div class="stat-value">
    KES <?= number_format($todayIncome, 2) ?>
   </div>
    </div>

    <div class="stat-card">
        <span class="stat-label">Vehicles in parking</span>
       <div class="stat-value">
    <?= $occupiedparkings ?>/<?= $totalparkings ?>
    </div>
    </div>
</div>
 
        
        <h2 class="section-title">LIVE PARKING STATUS</h2>
        
        <!-- STEP 3: parking status cards go here -->
        <div class="parkings-grid">
        
    <!-- Occupied parking Example -->
   <?php foreach ($parkings as $parking): ?>

<div class="parking-card">

    <div class="parking-header">

        <h3><?= htmlspecialchars($parking['parking_name']) ?></h3>

        <span class="status-badge <?= strtolower($parking['status']) ?>">
            <?= htmlspecialchars($parking['status']) ?>
        </span>

    </div>

    <div class="parking-body">

        <div class="data-row">
            <span>Vehicle</span>
            <strong><?= htmlspecialchars($parking['vehicle_name']) ?></strong>
        </div>

        <div class="data-row">
            <span>Plate</span>
            <strong><?= htmlspecialchars($parking['plate_number']) ?></strong>
        </div>

        <div class="data-row">
            <span>Service</span>
            <strong><?= htmlspecialchars($parking['service_name']) ?></strong>
        </div>

        <div class="data-row">
            <span>Technician</span>
            <strong><?= htmlspecialchars($parking['technician_name']) ?></strong>
        </div>

    </div>

</div>

<?php endforeach; ?>
</div>
</div>
</div>


<div class="dashboard-right">

    <div class="chart-card">
    <h3>Weekly Revenue Chart</h3>
    <canvas id="revenueChart"></canvas>
</div>

    <div class="appointments-card">
    <h3>Today's Bookings</h3>

    <?php if (count($appointments) > 0): ?>
        <ul class="appointment-list">
            <?php foreach ($appointments as $a): ?>
                <li>
                    <strong>
                        <?= htmlspecialchars($a['customer_name'] ?? 'N/A') ?>
                    </strong><br>

                    Service: <?= htmlspecialchars($a['service_name'] ?? 'N/A') ?><br>

                    Time: <?= htmlspecialchars($a['booking_time'] ?? 'N/A') ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No bookings today</p>
    <?php endif; ?>
</div>
</div>

</div>


</main>

</div>
    <?php include 'includes/footer.php'; ?>
    <script src="assets/js/core.js"></script>
    <script src="assets/js/dashboard.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
const ctx = document.getElementById('revenueChart');

new Chart(ctx, {
    type: 'line',
    data: {
        labels: <?= json_encode($labels) ?>,
        datasets: [{
            label: 'Revenue (KES)',
            data: <?= json_encode($values) ?>
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false
    }
});
</script>
</body>
</html>