<?php
require_once '../config/constants.php';
require_once '../config/database.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?> - Add Vehicle</title>

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
                  <!-- Header -->
             <div class="gms-step-banner">
                <div class="banner-title-area">
                   <h1 class="banner-main-title">ADD VEHICLE</h1>
                       <p class="banner-step-text">Step 1/3 - Vehicle Details </p>
                </div>

                    <div class="banner-progress-flow">
                       <div class="progress-node node-active">1</div>
                       <div class="progress-line"></div>
                      <div class="progress-node node-inactive">2</div>
                      <div class="progress-line"></div>
                      <div class="progress-node node-inactive">3</div>
                    </div>
                </div>
</div>
                   </main>

              
              <div class="gms-split-workspace">
                <div class="gms-panel-box">
                        <form action="save_vehicle.php" method="POST">
                      <section class="vehicle-details-card">
                        <h2>Vehicle Information</h2>
                       <div class="form-group">
                           <label for="chassis"> Chassis Number <span class="required">*</span>
                           </label>

                          <input type="text"
                                 id="chassis"
                                  name="chassis"
                                 maxlength="17"
                                 placeholder="e.g. 1FTFW1ED5HFA12345"
                              required
                            >
                            </div>

                            <div class="form-group">
                             <label for="make">Make</label>
                                <select id="make" name="make">
                                    <option selected>Ford</option>
                                      <option>Toyota</option>
                <option>Nissan</option>
                <option>Ford</option>
                <option>Honda</option>
                <option>Mazda</option>
                <option>Subaru</option>
                <option>Mitsubishi</option>
                <option>Suzuki</option>
                <option>Isuzu</option>
                <option>Volkswagen</option>
                <option>Mercedes-Benz</option>
                <option>BMW</option>
                <option>Audi</option>
                <option>Land Rover</option>
                <option>Jeep</option>
                <option>Peugeot</option>
                <option>Volvo</option>
                <option>Kia</option>
                <option>Hyundai</option>
                <option>Lexus</option>
                <option>Porsche</option>
                <option>Tesla</option>
                <option>Chevrolet</option>
                <option>Daihatsu</option>

                               </select>
                               </div>

                                <div class="form-group">
                               <label for="model">Model</label>
                                  <input type="text" name="model" placeholder="Hilux / Ranger / Axio / X-Trail">
                                   </div>
                                   <div class="form-group">
                                    <label for="year">Year</label>
                                <select name="year">
                                          <?php
                                     for($year = date('Y'); $year >= 1980; $year--){
                                        echo "<option>$year</option>";
                                           }
                                             ?>
                                            </select>
                                </div>

                                 <div class="form-group">
                                <label for="color">Color</label>
                                 <select id="color" name="color">
                                    <option selected>Oxford White</option>
                                    <option>White</option>
                <option>Black</option>
                <option>Silver</option>
                <option>Gray</option>
                <option>Blue</option>
                <option>Red</option>
                <option>Green</option>
                <option>Yellow</option>
                <option>Orange</option>
                <option>Brown</option>
                <option>Beige</option>
                <option>Gold</option>
                <option>Purple</option>
                <option>Maroon</option>
                <option>Pink</option>
                <option>Oxford White</option>
                <option>Metallic Silver</option>
                <option>Pearl White</option>
                <option>Champagne</option>
                <option>Other</option>
                                 </select>
                                 </div>

                                  <div class="form-group full-width">
                            <label for="license">License Plate</label>
                            <input type="text"
                                   id="license"
                                  name="license"
                                  placeholder="KDA 123A"
                                   >
                                   </div>
                           </section>
              <!-- Action Buttons -->
                        <div class="form-actions">
                            <button type="button" class="btn btn-secondary" disabled>Back</button>
                            <button type="submit" class="btn btn-primary">Next</button>
                        </div>
                   </form>
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