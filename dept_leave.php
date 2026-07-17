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
    <title>Department Leave - Faculty Management System</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .status-select {
            padding: 5px 10px;
            border-radius: 6px;
            border: 1px solid var(--border-color);
            background: white;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            outline: none;
            transition: 0.2s;
        }
        .status-select.pending { color: var(--status-warning); border-color: var(--status-warning); }
        .status-select.approved { color: var(--status-success); border-color: var(--status-success); }
        .status-select.rejected { color: var(--status-error); border-color: var(--status-error); }
        
        table tr:hover { background-color: #f9fafb; }
    </style>
</head>
<body>
    <?php include 'includes/sidebar.php'; ?>

    <div class="main-content">
        <?php include 'includes/header.php'; ?>

        <div class="dashboard-container">
            <div style="display: flex; gap: 15px; align-items: center; margin-bottom: 24px; border-bottom: 2px solid var(--border-color); padding-bottom: 15px;">
                <a href="leave.php" style="color: var(--text-secondary); font-size: 1.2rem;"><i class="fas fa-arrow-left"></i></a>
                <h1 class="page-title" style="margin-bottom: 0;">
                    <?php 
                        $dept = isset($_GET['dept']) ? $_GET['dept'] : 'Department of ICT';
                        echo strtoupper(htmlspecialchars($dept)) . " LEAVE REQUESTS";
                    ?>
                </h1>
            </div>

            <div class="panel" style="padding: 0; min-height: auto;">
                <table style="width: 100%; border-collapse: collapse; text-align: left;">
                    <thead>
                        <tr style="background-color: #f3f4f6; border-bottom: 1px solid var(--border-color);">
                            <th style="padding: 15px 24px; font-weight: 600; width: 80px;">No</th>
                            <th style="padding: 15px 24px; font-weight: 600;">Staff Name</th>
                            <th style="padding: 15px 24px; font-weight: 600;">Leave Date</th>
                            <th style="padding: 15px 24px; font-weight: 600;">Type</th>
                            <th style="padding: 15px 24px; font-weight: 600;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="border-bottom: 1px solid var(--border-color);">
                            <td style="padding: 15px 24px;">01</td>
                            <td style="padding: 15px 24px;">Dr. Wickramasinghe</td>
                            <td style="padding: 15px 24px;">2026-02-10</td>
                            <td style="padding: 15px 24px;">Medical</td>
                            <td style="padding: 15px 24px;">
                                <select class="status-select pending" onchange="updateStatus(this)">
                                    <option value="pending" selected>Pending</option>
                                    <option value="approved">Approved</option>
                                    <option value="rejected">Rejected</option>
                                </select>
                            </td>
                        </tr>
                        <tr style="border-bottom: 1px solid var(--border-color);">
                            <td style="padding: 15px 24px;">02</td>
                            <td style="padding: 15px 24px;">Prof. Gunawardana</td>
                            <td style="padding: 15px 24px;">2026-02-15</td>
                            <td style="padding: 15px 24px;">Annual</td>
                            <td style="padding: 15px 24px;">
                                <select class="status-select pending" onchange="updateStatus(this)">
                                    <option value="pending" selected>Pending</option>
                                    <option value="approved">Approved</option>
                                    <option value="rejected">Rejected</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 15px 24px;">03</td>
                            <td style="padding: 15px 24px;">Dr. Fernando</td>
                            <td style="padding: 15px 24px;">2026-02-20</td>
                            <td style="padding: 15px 24px;">Casual</td>
                            <td style="padding: 15px 24px;">
                                <select class="status-select approved" onchange="updateStatus(this)">
                                    <option value="pending">Pending</option>
                                    <option value="approved" selected>Approved</option>
                                    <option value="rejected">Rejected</option>
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <?php include 'includes/footer.php'; ?>
    </div>

    <script>
        function updateStatus(select) {
            const status = select.value;
            const staffName = select.closest('tr').cells[1].innerText;
            
            // Remove all standard status classes
            select.classList.remove('pending', 'approved', 'rejected');
            
            // Add the new class based on value
            select.classList.add(status);
        }
    </script>
</body>
</html>
