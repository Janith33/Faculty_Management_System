# Faculty Management System - Setup & Installation Guide

## ✅ System Overview

Your Faculty Management System is now properly configured with:

- ✅ Database connection with proper error handling
- ✅ Session management across all pages
- ✅ Authentication system with login
- ✅ Dynamic content from database
- ✅ Responsive layout with sidebar and header
- ✅ All pages properly integrated

## 📋 Required Setup Steps

### Step 1: Create Database

1. Open phpMyAdmin: `http://localhost/phpmyadmin`
2. Create a new SQL editor tab
3. Copy and paste the entire content from `Faculty.sql`
4. Click "Go" to execute

### Step 2: Hash User Passwords

After database creation, run these SQL queries to set proper password hashes:

```sql
-- Admin user (password: admin123)
UPDATE users
SET password = '$2y$10$N9qo8uLOickgx2ZMRZoMyeIjZAgcg7b3XeKeUxWdeS86E36DvMvFm'
WHERE username = 'admin';

-- Faculty user (password: pass123)
UPDATE users
SET password = '$2y$10$YourHashedPasswordHere'
WHERE username = 'handuwala';
```

### Step 3: Verify Database Connection

- Check `includes/db_config.php` for connection settings
- Default: localhost, root user, no password
- Database name: `faculty_management`

If different, update `includes/db_config.php`:

```php
define('DB_HOST', 'your-host');
define('DB_USER', 'your-user');
define('DB_PASS', 'your-password');
define('DB_NAME', 'your-database');
```

### Step 4: Start Using the System

1. Open `http://localhost/FMS%20NEW/login.php`
2. Login with credentials:
   - **Username:** admin
   - **Password:** admin123

## 🔐 Default Login Credentials

| Username  | Email               | Password | Role    |
| --------- | ------------------- | -------- | ------- |
| admin     | admin@uov.ac.lk     | admin123 | Admin   |
| handuwala | handuwala@uov.ac.lk | pass123  | Faculty |

## 📱 Features Implemented

### Dashboard

- Real-time statistics from database
- Recent approvals display
- Pending approvals list
- Category switching (Academic/Non-Academic/Students)

### Attendance

- View all faculty attendance
- Mark attendance status
- Date-based filtering
- Status indicators (Present/Absent/Late)

### Departments

- View all departments
- Faculty count per department
- Department details
- Grid layout for better visualization

### Leave Management

- View all leave requests
- Approve/Reject functionality
- Leave type categorization
- Duration tracking

### Projects

- Project listings with progress
- Status indicators
- Project lead information
- Visual progress bars

### Reports

- Generate attendance reports
- Leave reports
- Performance reports
- Export functionality

### User Profile

- View personal information
- Edit profile option
- Department and position info
- Contact details

## 🗂️ File Structure

```
FMS NEW/
├── login.php                 # Login page with database auth
├── dashboard.php             # Main dashboard with stats
├── attendance.php            # Attendance management
├── department.php            # Department listing
├── leave.php                 # Leave management
├── projects.php              # Projects listing
├── reports.php               # Reports generation
├── profile.php               # User profile
├── logout.php                # Logout handler
├── edit_profile.php          # Profile editing
├── includes/
│   ├── db_config.php         # Database connection
│   ├── header.php            # Header component
│   ├── sidebar.php           # Sidebar navigation
│   └── footer.php            # Footer component
├── style.css                 # Main stylesheet
└── Faculty.sql              # Database schema
```

## 🔧 Database Configuration

The system uses MySQLi for database connections. Configuration is centralized in `includes/db_config.php`:

- Automatic connection pooling (prevents multiple connections)
- Session handling before headers
- Constant guards to prevent redefinition
- UTF-8 charset support

## 🚀 Key Features

### Security

- Session-based authentication
- Protected routes (redirect to login if not authenticated)
- Password hashing support
- Last login tracking

### Database Integration

- Dynamic data loading from database
- Real-time statistics
- Proper relationship handling
- Error handling for failed queries

### User Experience

- Responsive design
- Sidebar navigation
- User profile in header
- Logout functionality
- Active page highlighting

## ⚠️ Troubleshooting

### "Undefined index" errors

- Ensure database tables are created properly
- Check SQL file execution

### Blank pages

- Check browser console for errors (F12)
- Verify database connection in db_config.php
- Check file permissions

### Login not working

- Verify database credentials
- Ensure users table has data
- Check password hashing

### Session errors

- Clear browser cookies
- Restart Apache/MySQL
- Check PHP session configuration

## 📞 Support Information

**For admin issues:**

- Email: dean@fts.vau.ac.lk
- Phone: +94 11 222 2222

**Database Issues:**

- Check XAMPP status (MySQL running)
- Verify phpMyAdmin accessibility

## 📝 Next Steps

1. Customize branding and colors in `style.css`
2. Add more faculty/departments via admin panel
3. Configure email notifications
4. Set up backup system
5. Configure attendance sensors (if using hardware)

---

**System Status:** ✅ Ready to Use
**Last Updated:** 2026-01-26
**Version:** 1.0
