-- Create Database
CREATE DATABASE IF NOT EXISTS if0_42435112_faculty_management;
USE if0_42435112_faculty_management;

-- Users table for authentication
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    role ENUM('Admin', 'Faculty', 'Staff', 'Student') DEFAULT 'Faculty',
    department VARCHAR(100),
    position VARCHAR(100),

    service_no VARCHAR(50),
    nic VARCHAR(20),
    address TEXT,
    phone VARCHAR(20),
    profile_image VARCHAR(255),
    status ENUM('Active', 'Inactive', 'Suspended') DEFAULT 'Active',
    last_login DATETIME,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Faculty table
CREATE TABLE faculty (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    faculty_type ENUM('Academic', 'Non-Academic') DEFAULT 'Academic',
    department VARCHAR(100),
    designation VARCHAR(100),
    joining_date DATE,
    qualification TEXT,
    specialization VARCHAR(100),
    status ENUM('Active', 'On Leave', 'Resigned') DEFAULT 'Active',
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Departments table
CREATE TABLE departments (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    code VARCHAR(20) UNIQUE,
    type ENUM('Academic', 'Non-Academic', 'Student') DEFAULT 'Academic',
    head_id INT,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (head_id) REFERENCES faculty(id)
);

-- Attendance table
CREATE TABLE attendance (
    id INT PRIMARY KEY AUTO_INCREMENT,
    faculty_id INT,
    attendance_date DATE NOT NULL,
    check_in TIME,
    check_out TIME,
    status ENUM('Present', 'Absent', 'Late', 'On Leave') DEFAULT 'Present',
    working_hours DECIMAL(5,2),
    notes TEXT,
    marked_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY unique_attendance (faculty_id, attendance_date),
    FOREIGN KEY (faculty_id) REFERENCES faculty(id),
    FOREIGN KEY (marked_by) REFERENCES users(id)
);

-- Leaves table
CREATE TABLE leaves (
    id INT PRIMARY KEY AUTO_INCREMENT,
    faculty_id INT NOT NULL,
    leave_type ENUM('Annual', 'Medical', 'Casual', 'Other') DEFAULT 'Annual',
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    total_days INT,
    reason TEXT,
    status ENUM('Pending', 'Approved', 'Rejected', 'Cancelled') DEFAULT 'Pending',
    approved_by INT,
    approved_at DATETIME,
    rejection_reason TEXT,
    applied_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (faculty_id) REFERENCES faculty(id),
    FOREIGN KEY (approved_by) REFERENCES users(id)
);

-- Projects table
CREATE TABLE projects (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(200) NOT NULL,
    description TEXT,
    project_type ENUM('Academic', 'Operational', 'Student') DEFAULT 'Academic',
    lead_id INT,
    start_date DATE,
    end_date DATE,
    budget DECIMAL(12,2),
    status ENUM('Planning', 'Ongoing', 'Completed', 'Archived') DEFAULT 'Planning',
    progress INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (lead_id) REFERENCES faculty(id)
);

-- Students table
CREATE TABLE students (
    id INT PRIMARY KEY AUTO_INCREMENT,
    student_id VARCHAR(50) UNIQUE NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    phone VARCHAR(20),
    batch VARCHAR(20),
    department VARCHAR(100),
    enrollment_date DATE,
    status ENUM('Active', 'Graduated', 'Suspended', 'Dropout') DEFAULT 'Active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Student attendance table
CREATE TABLE student_attendance (
    id INT PRIMARY KEY AUTO_INCREMENT,
    student_id INT,
    attendance_date DATE NOT NULL,
    status ENUM('Present', 'Absent', 'Late') DEFAULT 'Present',
    subject VARCHAR(100),
    batch VARCHAR(20),
    marked_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (student_id) REFERENCES students(id),
    FOREIGN KEY (marked_by) REFERENCES users(id)
);

-- Reports table
CREATE TABLE reports (
    id INT PRIMARY KEY AUTO_INCREMENT,
    report_type ENUM('Attendance', 'Leave', 'Performance', 'Academic') NOT NULL,
    title VARCHAR(200) NOT NULL,
    description TEXT,
    period_start DATE,
    period_end DATE,
    generated_by INT,
    file_path VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (generated_by) REFERENCES users(id)
);

-- Insert default admin user (password: admin123)
INSERT INTO users (username, email, password, full_name, role, department, position, status) 
VALUES ('admin', 'admin@uov.ac.lk', '$2y$10$YourHashedPasswordHere', 'System Administrator', 'Admin', 'Administration', 'Admin', 'Active');

-- Insert sample faculty
INSERT INTO users (username, email, password, full_name, role, department, position, service_no) 
VALUES ('handuwala', 'handuwala@uov.ac.lk', '$2y$10$YourHashedPasswordHere', 'Mr. H D J C Handuwala', 'Faculty', 'Department of ICT', 'Assistant Lecturer', 'UOV3456');

-- Insert sample departments
INSERT INTO departments (name, code, type) VALUES 
('Department of ICT', 'DICT', 'Academic'),
('Department of Engineering Technology', 'DET', 'Academic'),
('Department of Bio Engineering Technology', 'DBET', 'Academic');
