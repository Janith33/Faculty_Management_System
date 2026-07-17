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
    <title>Mark Attendance - Faculty Management System</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <?php include 'includes/sidebar.php'; ?>

    <div class="main-content">
        <?php include 'includes/header.php'; ?>

        <div class="dashboard-container">
            <div style="display: flex; gap: 15px; align-items: center; margin-bottom: 24px; border-bottom: 2px solid var(--border-color); padding-bottom: 15px;">
                <a href="attendance.php" style="color: var(--text-secondary); font-size: 1.2rem;"><i class="fas fa-arrow-left"></i></a>
                <h1 class="page-title" style="margin-bottom: 0;">MARK MANUAL ATTENDANCE</h1>
            </div>

            <div class="panel" style="padding: 30px; max-width: 600px;">
                <p style="margin-bottom: 20px; color: var(--text-secondary);">Select faculty member and mark their attendance status for today.</p>
                <form onsubmit="event.preventDefault(); window.location.href='attendance.php';">
                    <div class="form-group" style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 600;">Faculty Member</label>
                        <select class="form-control" style="width: 100%; padding: 10px; border: 1px solid var(--border-color); border-radius: 8px;" required>
                            <option value="">Select Staff...</option>
                            <option>Dr. Silva</option>
                            <option>Dr. Kumara</option>
                            <option>Mr. Perera</option>
                        </select>
                    </div>
                    <div class="form-group" style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 8px; font-weight: 600;">Status</label>
                        <div style="display: flex; gap: 20px;">
                            <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                                <input type="radio" name="status" value="present" checked> Present
                            </label>
                            <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                                <input type="radio" name="status" value="absent"> Absent
                            </label>
                        </div>
                    </div>
                    <div style="margin-top: 30px; display: flex; gap: 15px;">
                        <button type="submit" class="btn" style="background-color: var(--primary-color); color: white;">Mark Attendance</button>
                        <a href="attendance.php" class="btn btn-white" style="border: 1px solid var(--border-color); display: flex; align-items: center;">Back</a>
                    </div>
                </form>
            </div>
        </div>

        <?php include 'includes/footer.php'; ?>
    </div>
</body>
</html>
