<?php
require 'includes/db_config.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Get statistics from database
$academic_staff = 0;
$present_today = 0;
$leave_balance = 0;

// Get total academic staff
$result = mysqli_query($conn, "SELECT COUNT(*) as count FROM faculty WHERE faculty_type = 'Academic' AND status = 'Active'");
$row = mysqli_fetch_assoc($result);
$academic_staff = $row['count'] ?? 0;

// Get today's attendance
$today = date('Y-m-d');
$result = mysqli_query($conn, "SELECT COUNT(DISTINCT faculty_id) as count FROM attendance WHERE attendance_date = '$today' AND status = 'Present'");
$row = mysqli_fetch_assoc($result);
$present_today = $row['count'] ?? 0;

// Get pending leave requests
$result = mysqli_query($conn, "SELECT COUNT(*) as count FROM leaves WHERE status = 'Pending'");
$row = mysqli_fetch_assoc($result);
$pending_leaves = $row['count'] ?? 0;

// Get recent activities (approved leaves)
$result = mysqli_query($conn, "SELECT l.*, f.designation FROM leaves l JOIN faculty f ON l.faculty_id = f.id WHERE l.status = 'Approved' ORDER BY l.approved_at DESC LIMIT 5");
$recent_activities = array();
while($row = mysqli_fetch_assoc($result)) {
    $recent_activities[] = $row;
}

// Get pending approval (pending leaves)
$result = mysqli_query($conn, "SELECT l.*, u.full_name FROM leaves l JOIN faculty f ON l.faculty_id = f.id JOIN users u ON f.user_id = u.id WHERE l.status = 'Pending' ORDER BY l.applied_at DESC LIMIT 1");
$pending_approval = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Faculty Management System</title>
    
    <!-- CSS -->
    <link rel="stylesheet" href="style.css">
    
    <!-- Icons (Font Awesome) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        .category-switcher {
            display: flex;
            gap: 15px;
            margin-bottom: 25px;
            padding: 10px;
            background: rgba(109, 40, 217, 0.05);
            border-radius: 12px;
            border: 1px solid var(--border-color);
        }
        .cat-btn {
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
            border: 1px solid transparent;
            background: white;
            color: var(--text-secondary);
        }
        .cat-btn.active {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
            box-shadow: 0 4px 10px rgba(109, 40, 217, 0.2);
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <?php include 'includes/sidebar.php'; ?>

    <!-- Main Content -->
    <div class="main-content">
        
        <!-- Header -->
        <?php include 'includes/header.php'; ?>

        <!-- Content Body -->
        <div class="dashboard-container">
            
            <h1 class="page-title">DASHBOARD</h1>
            
            <!-- Category Switcher -->
            <div class="category-switcher">
                <button class="cat-btn active" onclick="switchCategory('academic', this)">Academic</button>
                <button class="cat-btn" onclick="switchCategory('non-academic', this)">Non-Academic</button>
                <button class="cat-btn" onclick="switchCategory('students', this)">Students</button>
            </div>

            <!-- Stats Row -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-title">Total Academic Staff</div>
                    <div class="stat-value"><?php echo $academic_staff; ?></div>
                </div>
                <div class="stat-card">
                    <div class="stat-title">Present Today</div>
                    <div class="stat-value"><?php echo $present_today; ?></div>
                </div>
                <div class="stat-card">
                    <div class="stat-title">Pending Approvals</div>
                    <div class="stat-value"><?php echo $pending_leaves; ?></div>
                </div>
            </div>

            <!-- Content Grid / Panels -->
            <div class="content-grid">
                
                <!-- Recently Approved Leaves Section -->
                <div class="section-wrapper">
                    <h3 class="panel-title" style="margin-bottom: 15px;">Recently Approved Leaves</h3>
                    <div class="panel panel-dark">
                        <?php if (count($recent_activities) > 0): ?>
                            <?php foreach($recent_activities as $activity): ?>
                                <div style="padding: 10px 0; border-bottom: 1px solid rgba(255,255,255,0.1);">
                                    <p style="margin: 5px 0; color: #fff;"><i class="fas fa-check-circle" style="color: #4ade80;"></i> <?php echo $activity['full_name'] ?? 'Staff Member'; ?></p>
                                    <p style="font-size: 0.85rem; color: #ccc; margin: 5px 0;"><?php echo $activity['start_date']; ?> to <?php echo $activity['end_date']; ?></p>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p style="color: #999;">No recent approvals</p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Pending Approval Section -->
                <div class="section-wrapper">
                    <h3 class="panel-title" style="margin-bottom: 15px;">Pending Approval</h3>
                    <div class="panel panel-dark">
                        <?php if ($pending_approval): ?>
                            <h3><?php echo $pending_approval['full_name']; ?></h3>
                            <p style="font-size: 0.9rem; color: #ccc; margin: 10px 0;">Leave Type: <?php echo $pending_approval['leave_type']; ?></p>
                            <p style="font-size: 0.9rem; color: #ccc; margin: 10px 0;">Duration: <?php echo $pending_approval['total_days']; ?> days</p>
                            <div class="action-buttons" style="margin-top: 15px;">
                                <button class="btn btn-white" style="padding: 8px 15px; font-size: 0.9rem;">Approve</button>
                                <button class="btn btn-white" style="padding: 8px 15px; font-size: 0.9rem;">Reject</button>
                            </div>
                        <?php else: ?>
                            <p style="color: #999;">No pending approvals</p>
                        <?php endif; ?>
                    </div>
                </div>

            </div>

        </div>

        <!-- Footer -->
        <?php include 'includes/footer.php'; ?>

    </div>

    <script>
        function switchCategory(cat, btn) {
            document.querySelectorAll('.cat-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            // Future: Load data for selected category
        }
    </script>
</body>
</html>
