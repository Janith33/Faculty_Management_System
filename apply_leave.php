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
    <title>Apply for Leave - Faculty Management System</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <?php include 'includes/sidebar.php'; ?>

    <div class="main-content">
        <?php include 'includes/header.php'; ?>

        <div class="dashboard-container">
            <div style="display: flex; gap: 15px; align-items: center; margin-bottom: 24px; border-bottom: 2px solid var(--border-color); padding-bottom: 15px;">
                <a href="leave.php" style="color: var(--text-secondary); font-size: 1.2rem;"><i class="fas fa-arrow-left"></i></a>
                <h1 class="page-title" style="margin-bottom: 0;">APPLY FOR LEAVE</h1>
            </div>

            <div class="panel" style="padding: 30px; max-width: 600px;">
                <form onsubmit="event.preventDefault(); window.location.href='leave.php';">
                    <div class="form-group" style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 600;">Leave Type</label>
                        <select class="form-control" style="width: 100%; padding: 10px; border: 1px solid var(--border-color); border-radius: 8px;" required>
                            <option value="">Select Category...</option>
                            <option>Annual Leave</option>
                            <option>Medical Leave</option>
                            <option>Casual Leave</option>
                        </select>
                    </div>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                        <div class="form-group">
                            <label style="display: block; margin-bottom: 8px; font-weight: 600;">Start Date</label>
                            <input type="date" class="form-control" style="width: 100%; padding: 10px; border: 1px solid var(--border-color); border-radius: 8px;" required>
                        </div>
                        <div class="form-group">
                            <label style="display: block; margin-bottom: 8px; font-weight: 600;">End Date</label>
                            <input type="date" class="form-control" style="width: 100%; padding: 10px; border: 1px solid var(--border-color); border-radius: 8px;" required>
                        </div>
                    </div>
                    <div class="form-group" style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 600;">Reason</label>
                        <textarea class="form-control" style="width: 100%; padding: 10px; border: 1px solid var(--border-color); border-radius: 8px;" rows="4" placeholder="Briefly describe your reason..." required></textarea>
                    </div>
                    <div style="margin-top: 30px; display: flex; gap: 15px;">
                        <button type="submit" class="btn" style="background-color: var(--primary-color); color: white;">Submit Application</button>
                        <a href="leave.php" class="btn btn-white" style="border: 1px solid var(--border-color); display: flex; align-items: center;">Cancel</a>
                    </div>
                </form>
            </div>
        </div>

        <?php include 'includes/footer.php'; ?>
    </div>
</body>
</html>
