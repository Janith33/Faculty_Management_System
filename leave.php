<?php
require 'includes/db_config.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Get leave requests
$query = "SELECT l.*, u.full_name 
          FROM leaves l 
          JOIN faculty f ON l.faculty_id = f.id
          JOIN users u ON f.user_id = u.id
          ORDER BY l.applied_at DESC";
$result = mysqli_query($conn, $query);
$leave_requests = array();
while($row = mysqli_fetch_assoc($result)) {
    $leave_requests[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Management - Faculty Management System</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .leave-table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .leave-table th, .leave-table td { padding: 12px; text-align: left; border-bottom: 1px solid var(--border-color); }
        .leave-table th { background: var(--primary-color); color: white; font-weight: 600; }
        .status-badge { padding: 5px 12px; border-radius: 20px; font-size: 0.85rem; font-weight: 600; }
        .status-pending { background: #fef3c7; color: #b45309; }
        .status-approved { background: #d1fae5; color: #065f46; }
        .status-rejected { background: #fee2e2; color: #991b1b; }
        .action-btn { padding: 5px 12px; margin: 0 3px; font-size: 0.85rem; border-radius: 6px; cursor: pointer; border: none; }
        .btn-approve { background: #d1fae5; color: #065f46; }
        .btn-reject { background: #fee2e2; color: #991b1b; }
    </style>
</head>
<body>
    <?php include 'includes/sidebar.php'; ?>
    
    <div class="main-content">
        <?php include 'includes/header.php'; ?>
        
        <div class="dashboard-container">
            <h1 class="page-title">LEAVE MANAGEMENT</h1>
            
            <div style="background: white; padding: 20px; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08);">
                <table class="leave-table">
                    <thead>
                        <tr>
                            <th>Faculty Name</th>
                            <th>Leave Type</th>
                            <th>From Date</th>
                            <th>To Date</th>
                            <th>Days</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($leave_requests as $leave): ?>
                            <tr>
                                <td><?php echo $leave['full_name']; ?></td>
                                <td><?php echo $leave['leave_type']; ?></td>
                                <td><?php echo date('d-M-Y', strtotime($leave['start_date'])); ?></td>
                                <td><?php echo date('d-M-Y', strtotime($leave['end_date'])); ?></td>
                                <td><?php echo $leave['total_days']; ?></td>
                                <td>
                                    <span class="status-badge status-<?php echo strtolower($leave['status']); ?>">
                                        <?php echo $leave['status']; ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if($leave['status'] === 'Pending'): ?>
                                        <button class="action-btn btn-approve"><i class="fas fa-check"></i> Approve</button>
                                        <button class="action-btn btn-reject"><i class="fas fa-times"></i> Reject</button>
                                    <?php else: ?>
                                        <span style="color: #999;">-</span>
                                    <?php endif; ?>
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
