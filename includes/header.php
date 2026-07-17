<?php
require 'db_config.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit();
}

// Get user information
$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['full_name'] ?? $_SESSION['username'];
$user_role = $_SESSION['role'] ?? 'User';
?>

<header class="top-header">
    <div class="header-left">
        <div class="menu-toggle" id="mobile-toggle">
            <i class="fa-solid fa-bars"></i>
        </div>
        <span class="short-title">FMS</span>
    </div>
    
    <div class="header-title">
        <span class="full-title">FACULTY MANAGEMENT SYSTEM</span>
    </div>
    
    <div class="header-actions">
        <div class="user-profile" onclick="window.location.href='profile.php'" style="cursor: pointer;">
            <span class="user-name"><?php echo strtoupper($user_name); ?></span>
            <div class="user-avatar">
                <i class="fa-solid fa-user"></i>
            </div>
        </div>
    </div>
</header>
