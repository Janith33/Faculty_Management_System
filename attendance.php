<?php
require 'includes/db_config.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Get all faculty with attendance records
$query = "SELECT f.*, u.full_name, 
          (SELECT status FROM attendance WHERE faculty_id = f.id AND attendance_date = CURDATE()) as today_status
          FROM faculty f 
          JOIN users u ON f.user_id = u.id
          WHERE f.faculty_type = 'Academic'
          ORDER BY u.full_name";
$result = mysqli_query($conn, $query);
$faculty_list = array();
while($row = mysqli_fetch_assoc($result)) {
    $faculty_list[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance - Faculty Management System</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .attendance-table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .attendance-table th, .attendance-table td { padding: 12px; text-align: left; border-bottom: 1px solid var(--border-color); }
        .attendance-table th { background: var(--primary-color); color: white; font-weight: 600; }
        .status-badge { padding: 5px 12px; border-radius: 20px; font-size: 0.85rem; font-weight: 600; }
        .status-present { background: #d1fae5; color: #065f46; }
        .status-absent { background: #fee2e2; color: #991b1b; }
        .status-late { background: #fef3c7; color: #b45309; }
        .status-none { background: #f3f4f6; color: #6b7280; }
    </style>
</head>
<body>
    <?php include 'includes/sidebar.php'; ?>
    
    <div class="main-content">
        <?php include 'includes/header.php'; ?>
        
        <div class="dashboard-container">
            <h1 class="page-title">ATTENDANCE</h1>
            
            <div style="background: white; padding: 20px; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
                <table class="attendance-table">
                    <thead>
                        <tr>
                            <th>Faculty Name</th>
                            <th>Department</th>
                            <th>Today's Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($faculty_list as $faculty): ?>
                            <tr>
                                <td><?php echo $faculty['full_name']; ?></td>
                                <td><?php echo $faculty['department']; ?></td>
                                <td>
                                    <span class="status-badge status-<?php echo strtolower($faculty['today_status'] ?? 'none'); ?>">
                                        <?php echo $faculty['today_status'] ?? 'Not Marked'; ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="mark_attendance.php?id=<?php echo $faculty['id']; ?>" class="btn btn-sm" style="padding: 5px 12px; font-size: 0.85rem;">
                                        <i class="fas fa-edit"></i> Mark
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <?php include 'includes/footer.php'; ?>
    </div>
</body>
</html>
