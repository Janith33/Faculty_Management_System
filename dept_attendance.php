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
    <title>Department Attendance - Faculty Management System</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .view-toggle {
            display: flex;
            background: #e5e7eb;
            border-radius: 50px;
            padding: 5px;
            width: fit-content;
            margin: 0 auto 30px auto;
        }
        .view-btn {
            padding: 8px 25px;
            border-radius: 50px;
            cursor: pointer;
            font-weight: 600;
            transition: 0.3s;
            border: none;
            background: transparent;
            color: var(--text-secondary);
        }
        .view-btn.active {
            background: white;
            color: var(--primary-color);
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .data-card {
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            text-align: center;
        }
        .data-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }
        .percentage {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-color);
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <?php include 'includes/sidebar.php'; ?>

    <div class="main-content">
        <?php include 'includes/header.php'; ?>

        <div class="dashboard-container">
            <div style="display: flex; gap: 15px; align-items: center; margin-bottom: 24px; border-bottom: 2px solid var(--border-color); padding-bottom: 15px;">
                <a href="attendance.php" style="color: var(--text-secondary); font-size: 1.2rem;"><i class="fas fa-arrow-left"></i></a>
                <h1 class="page-title" style="margin-bottom: 0;">
                    <?php 
                        $dept = isset($_GET['dept']) ? $_GET['dept'] : 'Department of ICT';
                        echo strtoupper(htmlspecialchars($dept)) . " ATTENDANCE";
                    ?>
                </h1>
            </div>

            <!-- View Toggle -->
            <div class="view-toggle">
                <button class="view-btn active" onclick="switchView('year')">Year Wise</button>
                <button class="view-btn" onclick="switchView('batch')">Batch Wise</button>
            </div>

            <!-- Year Wise Content -->
            <div id="year-view" class="data-grid">
                <div class="data-card">
                    <h3>1st Year</h3>
                    <div class="percentage">92%</div>
                    <p style="color: var(--text-secondary);">Avg. Attendance</p>
                </div>
                <div class="data-card">
                    <h3>2nd Year</h3>
                    <div class="percentage">88%</div>
                    <p style="color: var(--text-secondary);">Avg. Attendance</p>
                </div>
                <div class="data-card">
                    <h3>3rd Year</h3>
                    <div class="percentage">95%</div>
                    <p style="color: var(--text-secondary);">Avg. Attendance</p>
                </div>
                <div class="data-card">
                    <h3>4th Year</h3>
                    <div class="percentage">91%</div>
                    <p style="color: var(--text-secondary);">Avg. Attendance</p>
                </div>
            </div>

            <!-- Batch Wise Content (Hidden by default) -->
            <div id="batch-view" class="data-grid" style="display: none;">
                <div class="data-card">
                    <h3>Batch 2021/22</h3>
                    <div class="percentage">94%</div>
                    <p style="color: var(--text-secondary);">Avg. Attendance</p>
                </div>
                <div class="data-card">
                    <h3>Batch 2020/21</h3>
                    <div class="percentage">89%</div>
                    <p style="color: var(--text-secondary);">Avg. Attendance</p>
                </div>
                <div class="data-card">
                    <h3>Batch 2019/20</h3>
                    <div class="percentage">91%</div>
                    <p style="color: var(--text-secondary);">Avg. Attendance</p>
                </div>
            </div>

        </div>

        <?php include 'includes/footer.php'; ?>
    </div>

    <script>
        function switchView(view) {
            const yearBtn = document.querySelectorAll('.view-btn')[0];
            const batchBtn = document.querySelectorAll('.view-btn')[1];
            const yearView = document.getElementById('year-view');
            const batchView = document.getElementById('batch-view');

            if (view === 'year') {
                yearBtn.classList.add('active');
                batchBtn.classList.remove('active');
                yearView.style.display = 'grid';
                batchView.style.display = 'none';
            } else {
                yearBtn.classList.remove('active');
                batchBtn.classList.add('active');
                yearView.style.display = 'none';
                batchView.style.display = 'grid';
            }
        }
    </script>
</body>
</html>
