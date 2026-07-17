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
    <title>Edit Profile - Faculty Management System</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <?php include 'includes/sidebar.php'; ?>

    <div class="main-content">
        <?php include 'includes/header.php'; ?>

        <div class="dashboard-container">
            <div style="display: flex; gap: 15px; align-items: center; margin-bottom: 24px; border-bottom: 2px solid var(--border-color); padding-bottom: 15px;">
                <a href="profile.php" style="color: var(--text-secondary); font-size: 1.2rem;"><i class="fas fa-arrow-left"></i></a>
                <h1 class="page-title" style="margin-bottom: 0;">EDIT PROFILE</h1>
            </div>

            <div class="panel" style="padding: 30px; max-width: 800px;">
                <form onsubmit="event.preventDefault(); window.location.href='profile.php';">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                        <div class="form-group">
                            <label style="display: block; margin-bottom: 8px; font-weight: 600;">Full Name</label>
                            <input type="text" class="form-control" style="width: 100%; padding: 10px; border: 1px solid var(--border-color); border-radius: 8px;" value="Mr. H D J C Handuwala">
                        </div>
                        <div class="form-group">
                            <label style="display: block; margin-bottom: 8px; font-weight: 600;">Email Address</label>
                            <input type="email" class="form-control" style="width: 100%; padding: 10px; border: 1px solid var(--border-color); border-radius: 8px;" value="handuwala@uov.ac.lk">
                        </div>
                        <div class="form-group">
                            <label style="display: block; margin-bottom: 8px; font-weight: 600;">Phone Number</label>
                            <input type="text" class="form-control" style="width: 100%; padding: 10px; border: 1px solid var(--border-color); border-radius: 8px;" value="+94 77 123 4567">
                        </div>
                        <div class="form-group">
                            <label style="display: block; margin-bottom: 8px; font-weight: 600;">Department</label>
                            <select class="form-control" style="width: 100%; padding: 10px; border: 1px solid var(--border-color); border-radius: 8px;">
                                <option selected>Department of ICT</option>
                                <option>Department of Engineering Technology</option>
                                <option>Department of Bio Engineering Technology</option>
                            </select>
                        </div>
                    </div>
                    <div style="margin-top: 30px; display: flex; gap: 15px;">
                        <button type="submit" class="btn" style="background-color: var(--primary-color); color: white;">Save Changes</button>
                        <a href="profile.php" class="btn btn-white" style="border: 1px solid var(--border-color); display: flex; align-items: center;">Cancel</a>
                    </div>
                </form>
            </div>
        </div>

        <?php include 'includes/footer.php'; ?>
    </div>
</body>
</html>
