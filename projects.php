<?php
require 'includes/db_config.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Get all projects
$query = "SELECT p.*, u.full_name as lead_name
          FROM projects p
          LEFT JOIN faculty f ON p.lead_id = f.id
          LEFT JOIN users u ON f.user_id = u.id
          ORDER BY p.start_date DESC";
$result = mysqli_query($conn, $query);
$projects = array();
while($row = mysqli_fetch_assoc($result)) {
    $projects[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects - Faculty Management System</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .project-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 20px; margin-top: 20px; }
        .project-card { background: white; padding: 20px; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); }
        .project-card h3 { color: var(--primary-color); margin-bottom: 10px; }
        .progress-bar { width: 100%; height: 8px; background: #e5e7eb; border-radius: 4px; margin: 10px 0; overflow: hidden; }
        .progress-fill { height: 100%; background: var(--primary-color); }
        .project-meta { font-size: 0.9rem; color: var(--text-secondary); margin: 5px 0; }
    </style>
</head>
<body>
    <?php include 'includes/sidebar.php'; ?>
    
    <div class="main-content">
        <?php include 'includes/header.php'; ?>
        
        <div class="dashboard-container">
            <h1 class="page-title">PROJECTS</h1>
            
            <div class="project-grid">
                <?php foreach($projects as $proj): ?>
                    <div class="project-card">
                        <h3><?php echo $proj['title']; ?></h3>
                        <p class="project-meta"><i class="fas fa-flag"></i> Status: <strong><?php echo $proj['status']; ?></strong></p>
                        <p class="project-meta"><i class="fas fa-user"></i> Lead: <?php echo $proj['lead_name'] ?? 'N/A'; ?></p>
                        <p class="project-meta"><i class="fas fa-calendar"></i> <?php echo date('d-M-Y', strtotime($proj['start_date'] ?? date('Y-m-d'))); ?></p>
                        <p class="project-meta"><strong>Progress:</strong></p>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: <?php echo $proj['progress']; ?>%"></div>
                        </div>
                        <p class="project-meta" style="text-align: center; color: #666;"><?php echo $proj['progress']; ?>%</p>
                        <p style="font-size: 0.85rem; color: #666; margin-top: 10px; line-height: 1.4;"><?php echo substr($proj['description'], 0, 100); ?>...</p>
                        <a href="project_details.php?id=<?php echo $proj['id']; ?>" class="btn" style="margin-top: 15px; display: inline-block;">
                            <i class="fas fa-arrow-right"></i> View Details
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        
        <?php include 'includes/footer.php'; ?>
    </div>
</body>
</html>
