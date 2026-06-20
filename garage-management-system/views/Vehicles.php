<?php
require_once '../config/constants.php';
require_once '../config/database.php';

$stmt = $pdo->query("
    SELECT *
    FROM vehicles
    ORDER BY id DESC
");

$vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?> - Vehicles</title>

    <link rel="stylesheet" href="../assets/css/variables.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>

<?php include '../includes/header.php'; ?>

<div class="main-layout">

    <?php include '../includes/sidebar.php'; ?>

    <main class="main-content">
      
        <div class="dashboard-wrapper">
          <div class="dashboard-left">
            <h1 class="page-title">Vehicle Management</h1>

           <!-- QUICK OPERATIONS ACTION CARDS STRIP ARRAY RIBBON -->
     <section class="gms-action-ribbon">
         <a href="add_vehicle.php" class="gms-action-card">
    <i class="fa-solid fa-circle-plus"></i>
    <span>Add Vehicle</span>
</a>
          <div class="gms-action-card" onclick="alert('Trigger action UI form layout context: Edit Vehicle')">
            <i class="fa-solid fa-pen-to-square"></i>
            <span>Edit Vehicle</span>
           </div>
           <div class="gms-action-card" onclick="alert('Trigger action UI form layout context: View Vehicle Details')">
            <i class="fa-solid fa-magnifying-glass"></i>
            <span>View Vehicle Details</span>
            </div>
           <div class="gms-action-card" onclick="alert('Trigger action UI form layout context: Book Service')">
            <i class="fa-solid fa-calendar-check"></i>
            <span>Book Service</span>
          </div>
          <div class="gms-action-card" onclick="alert('Trigger action UI form layout context: Record Payment')">
            <i class="fa-solid fa-credit-card"></i>
            <span>Record Payment</span>
          </div>
        </div>
     </section>
</main>
     <!-- WORKSPACE TWO-COLUMN SPLIT CONTAINER -->
     <div class="gms-split-workspace">
         <div class="gms-panel-box">
            
            <!-- Mid-section dynamic table search filter interface component layout -->
            <div class="gms-search-container">
    <input
        type="text"
        class="gms-search-field"
        placeholder="Search by Plate No, VIN, Customer Name"
    >

</div>
            
            <div class="gms-table-scroller">
                <table class="gms-data-table">
                    <thead>
                        <tr>
                           <th width="30"><input type="checkbox"></th>
                                        <th>ID</th>
                                        <th>Vehicle Name</th>
                                        <th>Plate Number</th>
                                        <th>Customer ID</th>
                     </thead>
                <tbody>
              <?php if (!empty($vehicles)): ?>

    <?php foreach ($vehicles as $vehicle): ?>
        <tr>
            <td><input type="checkbox"></td>

            <td>
                <?= htmlspecialchars($vehicle['id']) ?>
            </td>

            <td>
                <?= htmlspecialchars($vehicle['vehicle_name']) ?>
            </td>
            <td>
                <?= htmlspecialchars($vehicle['plate_number']) ?>
            </td>

            <td>
                <?= htmlspecialchars($vehicle['customer_id']) ?>
            </td>
        </tr>
    <?php endforeach; ?>

<?php else: ?>
    <tr>
        <td colspan="5" style="text-align:center; padding:20px;">
            No vehicles found
        </td>
    </tr>
<?php endif; ?>
</tbody>
                </table>
             </div>
              <div class="gms-table-footer">
             <div class="gms-footer-status">
                 Showing <span class="gms-record-count">
    <?= count($vehicles) ?>
           </span>
             </div>
            <button
    type="button"
    class="btn btn-secondary"
    onclick="history.back()">
    <i class="fa-solid fa-arrow-left"></i> Back
</button>
           <button class="gms-paginate-btn btn-next" id="nextBtn">
               Next <i class="fa-solid fa-chevron-right"></i>
            </button>
         </div>
</div>
<!-- RIGHT SEGMENT LAYER: RECENT VEHICLE ACTIVITY TIMELINE FEED (30% WIDTH CONTAINER) -->
<div class="gms-panel-box gms-activity-panel">
    
    <!-- Component Header Layout Text -->
    <h3 class="gms-activity-title">RECENT VEHICLE ACTIVITY</h3>
    
    <!-- Scrolling Activity Feed Track Box Container -->
    <div class="gms-activity-feed-container">
        
        <!-- Timeline Item 1: Record Payment Block Context -->
        <div class="gms-activity-row">
            <div class="gms-activity-icon-slot status-color-payment">
                <i class="fa-solid fa-credit-card"></i>
            </div>
            <div class="gms-activity-details-slot">
                <span class="gms-activity-badge label-payment">[Record Payment]</span>
                <p class="gms-activity-desc">Recorded payment for ABC-1234 on 2024-05-15</p>
            </div>
        </div>

        <!-- Timeline Item 2: Book Service Block Context -->
        <div class="gms-activity-row">
            <div class="gms-activity-icon-slot status-color-service">
                <i class="fa-solid fa-calendar-check"></i>
            </div>
            <div class="gms-activity-details-slot">
                <span class="gms-activity-badge label-service">[Book Service]</span>
                <p class="gms-activity-desc">Service booked for DEF-5678 on 2024-05-16</p>
            </div>
        </div>

        <!-- Timeline Item 3: Duplicate Record Payment Entry Context Layout -->
        <div class="gms-activity-row">
            <div class="gms-activity-icon-slot status-color-payment">
                <i class="fa-solid fa-credit-card"></i>
            </div>
            <div class="gms-activity-details-slot">
                <span class="gms-activity-badge label-payment">[Record Payment]</span>
                <p class="gms-activity-desc">Service booked for ABC-1234 on 2024-05-15</p>
            </div>
        </div>

        <!-- Timeline Item 4: Duplicate Book Service Entry Context Layout -->
        <div class="gms-activity-row">
            <div class="gms-activity-icon-slot status-color-service">
                <i class="fa-solid fa-calendar-check"></i>
            </div>
            <div class="gms-activity-details-slot">
                <span class="gms-activity-badge label-service">[Book Service]</span>
                <p class="gms-activity-desc">Service booked for DEF-5678 on 2024-05-16</p>
            </div>
        </div>

    </div> <!-- /.gms-activity-feed-container -->
</div> <!-- /.gms-panel-box .gms-activity-panel -->

    </div>
    </div>
</div>
<?php include '../includes/footer.php'; ?>
</body>
</html>