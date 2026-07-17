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
    <title>Project Details - Faculty Management System</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <?php include 'includes/sidebar.php'; ?>

    <div class="main-content">
        <?php include 'includes/header.php'; ?>

        <div class="dashboard-container">
            <div style="display: flex; gap: 15px; align-items: center; margin-bottom: 24px; border-bottom: 2px solid var(--border-color); padding-bottom: 15px;">
                <a href="projects.php" style="color: var(--text-secondary); font-size: 1.2rem;"><i class="fas fa-arrow-left"></i></a>
                <h1 class="page-title" style="margin-bottom: 0;">PROJECT DETAILS</h1>
            </div>

            <div class="panel" style="padding: 40px;">
                <h2 style="color: var(--primary-color); margin-bottom: 10px;">
                    <?php 
                        $title = isset($_GET['title']) ? $_GET['title'] : 'Unknown Project';
                        echo htmlspecialchars($title);
                    ?>
                </h2>
                <div style="display: flex; gap: 10px; margin-bottom: 30px;">
                    <span id="project-status-tag" style="background: rgba(59, 130, 246, 0.1); color: #3b82f6; padding: 4px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 700;">ONGOING</span>
                    <span style="color: var(--text-secondary); font-size: 0.9rem;">Ref: PRJ-2024-001</span>
                </div>

                <div class="content-grid" style="margin-top: 30px; text-align: left;">
                    <div style="background: #f9fafb; padding: 25px; border-radius: 12px; border: 1px solid var(--border-color);">
                        <h3 style="margin-bottom: 15px; font-size: 1rem; color: var(--text-primary);">Summary</h3>
                        <p style="color: var(--text-secondary); line-height: 1.6;">This project aims to implement advanced technological solutions within the department. It involves collaboration between faculty members and senior students to achieve strategic goals defined in the annual research plan.</p>
                        
                        <div style="margin-top: 25px; display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px;">
                            <div>
                                <span style="display: block; font-size: 0.8rem; color: var(--text-secondary);">Project Lead</span>
                                <span style="font-weight: 600;">Dr. Silva</span>
                            </div>
                            <div>
                                <span style="display: block; font-size: 0.8rem; color: var(--text-secondary);">Estimated Completion</span>
                                <span style="font-weight: 600;">November 2024</span>
                            </div>
                            <div>
                                <span style="display: block; font-size: 0.8rem; color: var(--text-secondary);">Fund Allocation</span>
                                <span style="font-weight: 600;">Rs. 250,000</span>
                            </div>
                            <div>
                                <span style="display: block; font-size: 0.8rem; color: var(--text-secondary);">Team Size</span>
                                <span style="font-weight: 600;">5 Members</span>
                            </div>
                        </div>
                    </div>

                    <div style="background: white; padding: 25px; border-radius: 12px; border: 1px solid var(--border-color);">
                        <h3 style="margin-bottom: 15px; font-size: 1rem; color: var(--text-primary);">Key Milestones</h3>
                        <ul style="list-style: none; padding: 0; color: var(--text-secondary);">
                            <li style="margin-bottom: 12px; display: flex; align-items: center; gap: 10px;">
                                <i class="fas fa-check-circle" style="color: #10b981;"></i> Requirement Analysis
                            </li>
                            <li style="margin-bottom: 12px; display: flex; align-items: center; gap: 10px;">
                                <i class="fas fa-check-circle" style="color: #10b981;"></i> Design & Planning
                            </li>
                            <li id="implementation-milestone" style="margin-bottom: 12px; display: flex; align-items: center; gap: 10px;">
                                <i class="fas fa-circle-notch fa-spin" style="color: var(--primary-color);"></i> Implementation Phase
                            </li>
                            <li style="display: flex; align-items: center; gap: 10px; opacity: 0.5;">
                                <i class="far fa-circle"></i> Final Evaluation
                            </li>
                        </ul>
                    </div>
                </div>

                <div style="margin-top: 40px; border-top: 1px solid var(--border-color); padding-top: 25px; display: flex; gap: 15px;">
                    <button class="btn" style="background: var(--primary-color); color: white;">Edit Project</button>
                    <button id="download-btn" class="btn btn-white" style="border: 1px solid var(--border-color);" onclick="simulateDownload()">
                        <i class="fas fa-file-pdf"></i> Download Abstract
                    </button>
                    <button id="archive-btn" class="btn btn-white" style="border: 1px solid var(--border-color); color: #ef4444;" onclick="archiveProject()">
                        <i class="fas fa-archive"></i> Archive
                    </button>
                </div>
            </div>
        </div>

        <?php include 'includes/footer.php'; ?>
    </div>

    <script>
        function simulateDownload() {
            const btn = document.getElementById('download-btn');
            const originalHTML = btn.innerHTML;
            
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Preparing...';
            btn.disabled = true;

            setTimeout(() => {
                btn.innerHTML = '<i class="fas fa-check"></i> Downloaded';
                alert('Project Abstract "<?php echo htmlspecialchars($title); ?>.pdf" has been generated and downloaded successfully!');
                setTimeout(() => {
                    btn.innerHTML = originalHTML;
                    btn.disabled = false;
                }, 2000);
            }, 1500);
        }

        function archiveProject() {
            if (confirm('Are you sure you want to archive this project? It will be moved to the historical records.')) {
                const statusTag = document.getElementById('project-status-tag');
                const milestone = document.getElementById('implementation-milestone');
                const archiveBtn = document.getElementById('archive-btn');

                statusTag.innerText = 'ARCHIVED';
                statusTag.style.background = 'rgba(107, 114, 128, 0.1)';
                statusTag.style.color = '#6b7280';

                milestone.innerHTML = '<i class="fas fa-info-circle"></i> Project Stalled (Archived)';
                milestone.style.opacity = '0.7';

                archiveBtn.innerHTML = '<i class="fas fa-undo"></i> Restore Project';
                archiveBtn.style.color = 'var(--primary-color)';
                archiveBtn.onclick = () => window.location.reload();

                alert('Project has been successfully archived.');
            }
        }
    </script>
</body>
</html>
