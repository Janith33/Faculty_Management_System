<?php
require 'includes/db_config.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Get user profile information
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = $user_id";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Faculty Management System</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .profile-container { display: block; width: 100%; }
        .profile-card { background: white; padding: 30px; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); text-align: center; margin-bottom: 30px; }
        .profile-avatar { width: 120px; height: 120px; margin: 0 auto 20px; background: var(--primary-color); border-radius: 50%; display: flex; align-items: center; justify-content: center; }
        .profile-avatar i { font-size: 60px; color: white; }
        .profile-card h2 { color: var(--primary-color); margin-bottom: 5px; }
        .profile-card .role { color: var(--text-secondary); font-size: 0.9rem; margin-bottom: 20px; }
        .profile-info { text-align: left; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); width: 100%; }
        .info-row { display: grid; grid-template-columns: 150px 1fr; gap: 20px; padding: 15px 0; border-bottom: 1px solid var(--border-color); }
        .info-label { font-weight: 600; color: var(--primary-color); }
        .info-value { color: var(--text-secondary); }
    </style>
</head>
<body>
    <?php include 'includes/sidebar.php'; ?>
    
    <div class="main-content">
        <?php include 'includes/header.php'; ?>
        
        <div class="dashboard-container">
            <h1 class="page-title">MY PROFILE</h1>
            
            <div class="profile-container">
                <div class="profile-card">
                    <div class="profile-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <h2><?php echo $user['full_name']; ?></h2>
                    <p class="role"><i class="fas fa-badge"></i> <?php echo $user['role']; ?></p>
                    <p style="color: #999; font-size: 0.9rem;">Status: <strong><?php echo $user['status']; ?></strong></p>
                    <a href="edit_profile.php" class="btn" style="margin-top: 20px;">
                        <i class="fas fa-edit"></i> Edit Profile
                    </a>
                </div>
                
                <div class="profile-info">
                    <h3 style="color: var(--primary-color); margin-bottom: 20px;">Account Information</h3>
                    
                    <div class="info-row">
                        <div class="info-label">Username</div>
                        <div class="info-value"><?php echo $user['username']; ?></div>
                    </div>
                    
                    <div class="info-row">
                        <div class="info-label">Email</div>
                        <div class="info-value"><?php echo $user['email']; ?></div>
                    </div>
                    
                    <div class="info-row">
                        <div class="info-label">Department</div>
                        <div class="info-value"><?php echo $user['department'] ?? 'N/A'; ?></div>
                    </div>
                    
                    <div class="info-row">
                        <div class="info-label">Position</div>
                        <div class="info-value"><?php echo $user['position'] ?? 'N/A'; ?></div>
                    </div>
                    
                    <div class="info-row">
                        <div class="info-label">Phone</div>
                        <div class="info-value"><?php echo $user['phone'] ?? 'N/A'; ?></div>
                    </div>
                    
                    <div class="info-row">
                        <div class="info-label">Address</div>
                        <div class="info-value"><?php echo $user['address'] ?? 'N/A'; ?></div>
                    </div>
                    
                    <div class="info-row" style="border-bottom: none;">
                        <div class="info-label">Member Since</div>
                        <div class="info-value"><?php echo date('d-M-Y', strtotime($user['created_at'])); ?></div>
                    </div>
                </div>
            </div>
        </div>
        
        <?php include 'includes/footer.php'; ?>
    </div>
</body>
</html>
