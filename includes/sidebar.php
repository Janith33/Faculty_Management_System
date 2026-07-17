<aside class="sidebar">
    <div class="sidebar-header">
        <a href="dashboard.php" class="brand">
            <span>FMS</span>
        </a>
        <div class="sidebar-close-btn" id="mobile-close">
            <i class="fa-solid fa-xmark"></i>
        </div>
        <div class="back-btn">
            <i class="fa-solid fa-chevron-left"></i>
        </div>
    </div>
    
    <ul class="sidebar-menu">
        <li>
            <a href="dashboard.php" id="nav-dashboard">
                <i class="fa-solid fa-gauge"></i>
                <span>DASHBOARD</span>
            </a>
        </li>
        <li>
            <a href="department.php" id="nav-department">
                <i class="fa-solid fa-building"></i>
                <span>DEPARTMENT</span>
            </a>
        </li>
        <li>
            <a href="attendance.php" id="nav-attendance">
                <i class="fa-solid fa-calendar-check"></i>
                <span>ATTENDANCE</span>
            </a>
        </li>
        <li>
            <a href="leave.php" id="nav-leave">
                <i class="fa-solid fa-envelope-open-text"></i>
                <span>LEAVE</span>
            </a>
        </li>
        <li>
            <a href="reports.php" id="nav-reports">
                <i class="fa-solid fa-file-contract"></i>
                <span>REPORTS</span>
            </a>
        </li>
        <li>
            <a href="projects.php" id="nav-projects">
                <i class="fa-solid fa-project-diagram"></i>
                <span>PROJECTS</span>
            </a>
        </li>
    </ul>

    <button type="button" id="logout-btn" class="btn-block">
        <i class="fas fa-sign-out-alt"></i> Log out
    </button>

</aside>

<!-- Overlay for Mobile -->
<div class="sidebar-overlay" id="sidebar-overlay"></div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Highlight active menu item based on current page
        const currentPage = window.location.pathname.split('/').pop() || 'dashboard.php';
        const navLinks = {
            'dashboard.php': 'nav-dashboard',
            'department.php': 'nav-department',
            'attendance.php': 'nav-attendance',
            'leave.php': 'nav-leave',
            'reports.php': 'nav-reports',
            'projects.php': 'nav-projects'
        };
        
        const activeId = navLinks[currentPage];
        const activeLink = document.getElementById(activeId);
        if (activeLink) {
            activeLink.classList.add('active');
        }

        // Unified Sidebar Toggle Logic
        const sidebar = document.querySelector('.sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        const menuToggle = document.getElementById('mobile-toggle');
        const mobileClose = document.getElementById('mobile-close');
        const desktopBack = document.querySelector('.back-btn');

        function toggleSidebar() {
            const isMobile = window.innerWidth <= 768;
            
            if (isMobile) {
                // Mobile behavior: Slide in/out
                sidebar.classList.toggle('active');
                overlay.classList.toggle('active');
                if (sidebar.classList.contains('active')) {
                    document.body.style.overflow = 'hidden';
                } else {
                    document.body.style.overflow = '';
                }
            } else {
                // Desktop behavior: Collapse/Expand
                document.body.classList.toggle('sidebar-collapsed');
            }
        }

        // Initial state for desktop (ensure sidebar can be hidden)
        if (window.innerWidth > 768) {
             // Logic to handle if we want it collapsed by default (no, usually open)
        }

        // Event Listeners
        if (menuToggle) menuToggle.addEventListener('click', (e) => {
            e.preventDefault();
            toggleSidebar();
        });

        if (mobileClose) mobileClose.addEventListener('click', (e) => {
            e.preventDefault();
            toggleSidebar();
        });

        if (desktopBack) desktopBack.addEventListener('click', (e) => {
            e.preventDefault();
            toggleSidebar();
        });

        if (overlay) overlay.addEventListener('click', toggleSidebar);
        
        // Ensure sidebar is cleaned up when resizing
        window.addEventListener('resize', () => {
            if (window.innerWidth > 768) {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
                document.body.style.overflow = '';
            }
        });

        // Logout button handler
        const logoutBtn = document.getElementById('logout-btn');
        if (logoutBtn) {
            logoutBtn.addEventListener('click', function(e) {
                e.preventDefault();
                window.location.href = 'logout.php';
            });
        }
    });
</script>
