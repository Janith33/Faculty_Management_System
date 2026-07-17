<?php
require 'includes/db_config.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Department Details - Faculty Management System</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <?php include 'includes/sidebar.php'; ?>

    <div class="main-content">
        <?php include 'includes/header.php'; ?>

        <div class="dashboard-container">
            <div style="display: flex; gap: 15px; align-items: center; margin-bottom: 24px; border-bottom: 2px solid var(--border-color); padding-bottom: 15px;">
                <a href="department.php" style="color: var(--text-secondary); font-size: 1.2rem;"><i class="fas fa-arrow-left"></i></a>
                <h1 class="page-title" style="margin-bottom: 0;">DEPARTMENT DETAILS</h1>
            </div>

            <div class="panel" style="padding: 30px;">
                <h2 style="color: var(--primary-color); margin-bottom: 20px;">
                    <?php 
                        $dept = isset($_GET['dept']) ? $_GET['dept'] : 'General';
                        $type = isset($_GET['type']) ? $_GET['type'] : 'Academic';
                        $batch = isset($_GET['batch']) ? " (Batch " . $_GET['batch'] . ")" : "";
                        echo htmlspecialchars(strtoupper($type)) . " Overview: " . htmlspecialchars($dept) . $batch;
                    ?>
                </h2>
                <div class="stats-grid" style="margin-top: 20px;">
                    <div class="stat-card" style="padding: 15px;">
                        <div class="stat-title"><?php echo ucfirst(htmlspecialchars($type)); ?> Count</div>
                        <div class="stat-value" style="font-size: 1.5rem;">24</div>
                    </div>
                    <div class="stat-card" style="padding: 15px;">
                        <div class="stat-title">Active Projects</div>
                        <div class="stat-value" style="font-size: 1.5rem;">12</div>
                    </div>
                </div>
                <p style="margin-top: 30px; color: var(--text-secondary);">This is a detailed view for the selected department. Further analytics and staff lists can be added here.</p>
                <button class="btn" style="background-color: var(--primary-color); color: white; margin-top: 20px;" onclick="window.location.href='department.php'">Back to List</button>
            </div>
        </div>

        <?php include 'includes/footer.php'; ?>
    </div>
</body>
</html>
