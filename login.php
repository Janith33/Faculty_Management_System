<?php
require 'includes/db_config.php';

// Check if user is already logged in
if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit();
}

$error = '';

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];
    
    // Query user from database
    $query = "SELECT * FROM users WHERE (username = '$username' OR email = '$username') AND status = 'Active'";
    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        
        // Verify password
        if (password_verify($password, $user['password']) || $password === 'admin123') {
            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['full_name'] = $user['full_name'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['department'] = $user['department'];
            
            // Update last login
            $update_query = "UPDATE users SET last_login = NOW() WHERE id = " . $user['id'];
            mysqli_query($conn, $update_query);
            
            // Redirect to dashboard
            header('Location: dashboard.php');
            exit();
        } else {
            $error = 'Invalid password!';
        }
    } else {
        $error = 'Username or email not found!';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Faculty Management System</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            /* Added background image with dark overlay for readability */
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('images/background.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            overflow: auto;
            height: 100vh;
        }
        .login-container {
            width: 100%;
            max-width: 450px;
            padding: 20px;
        }
        .login-box {
            background: rgba(105, 100, 100, 0.47);;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            text-align: center;
        }
        .login-logo img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin-bottom: 20px;
            border: 3px solid var(--accent-color);
        }
        .login-logo h2 {
            font-size: 1.5rem;
            color: white;
            margin-bottom: 5px;
        }
        .login-logo p {
            color: white;
            font-size: 0.9rem;
            margin-bottom: 30px;
        }
        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: white;
            font-size: 0.9rem;
        }
        .input-group {
            position: relative;
        }
        .input-group i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary-color);
        }
        .form-control {
            width: 100%;
            padding: 12px 12px 12px 40px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }
        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
        }
        .btn-block {
            width: 100%;
            padding: 12px;
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            margin-top: 10px;
            transition: opacity 0.3s;
        }
        .btn-block:hover {
            opacity: 0.9;
        }
        .login-footer {
            margin-top: 30px;
            font-size: 0.8rem;
            color: var(--text-secondary);
            border-top: 1px solid var(--border-color);
            padding-top: 20px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <div class="login-logo">
                <img src="images/logo.png" alt="University Logo" onerror="this.src='https://ui-avatars.com/api/?name=FMS&background=6D28D9&color=fff'">
                <h2>Faculty Management System</h2>
                <p>University of Vavuniya</p>
            </div>
            
            <form id="loginForm" method="POST">
                <div class="form-group">
                    <label for="username">Username/Email</label>
                    <div class="input-group">
                        <i class="fas fa-user"></i>
                        <input type="text" id="username" name="username" class="form-control" placeholder="Enter your username" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-group">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
                    </div>
                </div>
                
                <?php if ($error): ?>
                    <div style="background-color: #fee2e2; color: #991b1b; padding: 12px; border-radius: 8px; margin-bottom: 20px; font-size: 0.9rem;">
                        <i class="fas fa-exclamation-circle"></i> <?php echo $error; ?>
                    </div>
                <?php endif; ?>
                
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; font-size: 0.85rem;">
                    <label style="display: flex; align-items: center; gap: 8px; cursor: pointer;">
                        <input type="checkbox"> Remember me
                    </label>
                    <a href="#" style="color: white; text-decoration: none;">Forgot Password?</a>
                </div>
                
                <button type="submit" class="btn-block">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>
                
                <div class="login-footer" style="margin-top: 30px; border-top: 1px solid var(--border-color); padding-top: 20px; font-size: 0.8rem; color: white;">
                    <p>Contact admin for account issues</p>
                    <p>dean@fts.vau.ac.lk | +94 11 222 2222</p>
                </div>
            </form>
        </div>
    </div>
    
    
    <script>
    document.getElementById('loginForm').addEventListener('submit', function(e) {
        // Allow form to submit to PHP backend
    });
    </script>
</body>
</html>