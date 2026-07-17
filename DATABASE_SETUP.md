# Database Setup Instructions

## Step 1: Create the Database

1. Open phpMyAdmin (http://localhost/phpmyadmin)
2. Copy the entire content of `Faculty.sql`
3. Go to the SQL tab and paste the entire content
4. Click "Go" to execute all queries

## Step 2: Update Default Passwords (IMPORTANT)

After the database is created, you need to hash the passwords. Run these queries in phpMyAdmin SQL tab:

```sql
-- Update admin user password (hash of 'admin123')
UPDATE users SET password = '$2y$10$N9qo8uLOickgx2ZMRZoMyeIjZAgcg7b3XeKeUxWdeS86E36DvMvFm'
WHERE username = 'admin';

-- Update handuwala password (hash of 'pass123')
UPDATE users SET password = '$2y$10$OIJ3SK1HW1Ch7d2w2qKNy.t0qN6Hf/0QvJqMVqKHLLaF0pXDMZxSi'
WHERE username = 'handuwala';
```

## Step 3: Test Login

1. Open `http://localhost/FMS%20NEW/login.php` in your browser
2. Login with:
   - **Username:** admin
   - **Password:** admin123

OR

- **Username:** handuwala
- **Password:** pass123

## Default Users

| Username  | Email               | Password | Role    |
| --------- | ------------------- | -------- | ------- |
| admin     | admin@uov.ac.lk     | admin123 | Admin   |
| handuwala | handuwala@uov.ac.lk | pass123  | Faculty |

## Database Connection

The system is configured to connect to:

- **Host:** localhost
- **Username:** root
- **Password:** (empty)
- **Database:** faculty_management

If your database credentials are different, update the file: `includes/db_config.php`

## Features Connected

✅ Login authentication
✅ Session management
✅ Auto-logout on session expire
✅ Role-based access control
✅ User profile tracking
✅ Last login timestamp
