<?php
require 'includes/db_config.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Get all departments
$query = "SELECT d.*, 
          (SELECT COUNT(*) FROM faculty WHERE department = d.name AND status = 'Active') as faculty_count
          FROM departments d
          ORDER BY d.name";
$result = mysqli_query($conn, $query);
$departments = array();
while($row = mysqli_fetch_assoc($result)) {
    $departments[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Departments - Faculty Management System</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .dept-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px; margin-top: 20px; }
        .dept-card { background: white; padding: 20px; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.08); border-left: 4px solid var(--primary-color); }
        .dept-card h3 { color: var(--primary-color); margin-bottom: 10px; }
        .dept-info { font-size: 0.9rem; color: var(--text-secondary); margin: 8px 0; }
        .dept-card a { margin-top: 15px; display: inline-block; }
    </style>
</head>
<body>
    <?php include 'includes/sidebar.php'; ?>
    
    <div class="main-content">
        <?php include 'includes/header.php'; ?>
        
        <div class="dashboard-container">
            <h1 class="page-title">DEPARTMENTS</h1>
            
            <div class="dept-grid">
                <?php foreach($departments as $dept): ?>
                    <div class="dept-card">
                        <h3><i class="fas fa-building"></i> <?php echo $dept['name']; ?></h3>
                        <p class="dept-info"><strong>Code:</strong> <?php echo $dept['code']; ?></p>
                        <p class="dept-info"><strong>Type:</strong> <?php echo $dept['type']; ?></p>
                        <p class="dept-info"><strong>Staff:</strong> <?php echo $dept['faculty_count']; ?> faculty members</p>
                        <p class="dept-info" style="color: #666;"><?php echo $dept['description']; ?></p>
                        <a href="department_details.php?id=<?php echo $dept['id']; ?>" class="btn">
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
