CREATE SCHEMA `moderntech_db` ;
CREATE TABLE Position (
    position_id INT PRIMARY KEY AUTO_INCREMENT,
    position_name VARCHAR(100) UNIQUE NOT NULL,
    salary DECIMAL(10,2) NOT NULL
);

INSERT INTO Position (position_name, salary) VALUES
('Software Engineer', 70000),
('HR Manager', 80000),
('Quality Analyst', 55000),
('Sales Representative', 60000),
('Marketing Specialist', 58000),
('UI/UX Designer', 65000),
('DevOps Engineer', 72000),
('Content Strategist', 56000),
('Accountant', 62000),
('Customer Support Lead', 58000);

CREATE TABLE Department (
    department_id INT PRIMARY KEY AUTO_INCREMENT,
    department_name VARCHAR(100) UNIQUE NOT NULL
);

INSERT INTO Department (department_name) VALUES
('Development'),
('HR'),
('QA'),
('Sales'),
('Marketing'),
('Design'),
('IT'),
('Finance'),
('Support');

CREATE TABLE Employees (
    employee_id INT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    department_id INT,
    position_id INT,
    email VARCHAR(255) UNIQUE NOT NULL,
    FOREIGN KEY (department_id) REFERENCES Department(department_id),
    FOREIGN KEY (position_id) REFERENCES Position (position_id)
);

INSERT INTO Employees (employee_id, name, department_id, position_id, email) VALUES
(1, 'Sibongile Nkosi', 1, 1, 'sibongile.nkosi@moderntech.com'),
(2, 'Lungile Moyo', 2, 2, 'lungile.moyo@moderntech.com'),
(3, 'Thabo Molefe', 3, 3, 'thabo.molefe@moderntech.com'),
(4, 'Keshav Naidoo', 4, 4, 'keshav.naidoo@moderntech.com'),
(5, 'Zanele Khumalo', 5, 5, 'zanele.khumalo@moderntech.com'),
(6, 'Sipho Zulu', 6, 6, 'sipho.zulu@moderntech.com'),
(7, 'Naledi Moeketsi', 7, 7, 'naledi.moeketsi@moderntech.com'),
(8, 'Farai Gumbo', 5, 8, 'farai.gumbo@moderntech.com'),
(9, 'Karabo Dlamini', 8, 9, 'karabo.dlamini@moderntech.com'),
(10, 'Fatima Patel', 9, 10, 'fatima.patel@moderntech.com');

CREATE TABLE Employment_History (
    employee_id INT,
    start_date YEAR NOT NULL,
    details TEXT NOT NULL,
    FOREIGN KEY (employee_id) REFERENCES Employees(employee_id) ON DELETE CASCADE
);

INSERT INTO Employment_History (employee_id, start_date, details) VALUES
(1, 2015, 'Joined in 2015, promoted to Senior in 2018'),
(2, 2013, 'Joined in 2013, promoted to Manager in 2017'),
(3, 2018, 'Joined in 2018'),
(4, 2020, 'Joined in 2020'),
(5, 2019, 'Joined in 2019'),
(6, 2016, 'Joined in 2016'),
(7, 2017, 'Joined in 2017'),
(8, 2021, 'Joined in 2021'),
(9, 2018, 'Joined in 2018'),
(10, 2016, 'Joined in 2016');

CREATE TABLE Payroll (
    payroll_id INT PRIMARY KEY AUTO_INCREMENT,
    employee_id INT,
    hours_worked INT NOT NULL,
    leave_deductions INT NOT NULL,
    final_salary DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (employee_id) REFERENCES Employees(employee_id) ON DELETE CASCADE
);

INSERT INTO Payroll (employee_id, hours_worked, leave_deductions, final_salary) VALUES
(1, 160, 8, 69500),
(2, 150, 10, 79000),
(3, 170, 4, 54800),
(4, 165, 6, 59700),
(5, 158, 5, 57850),
(6, 168, 2, 64800),
(7, 175, 3, 71800),
(8, 160, 0, 56000),
(9, 155, 5, 61500),
(10, 162, 4, 57750);

CREATE TABLE Attendance (
    employee_id INT,
    date DATE NOT NULL,
    status ENUM('Present', 'Absent') NOT NULL,
    FOREIGN KEY (employee_id) REFERENCES Employees(employee_id) ON DELETE CASCADE
);

INSERT INTO Attendance (employee_id, date, status) VALUES
(1, '2024-11-25', 'Present'),
(1, '2024-11-26', 'Absent'),
(1, '2024-11-27', 'Present'),
(1, '2024-11-28', 'Present'),
(1, '2024-11-29', 'Present'),
(2, '2024-11-25', 'Present'),
(2, '2024-11-26', 'Present'),
(2, '2024-11-27', 'Absent'),
(2, '2024-11-28', 'Present'),
(2, '2024-11-29', 'Present'),
(3, '2024-11-25', 'Present'),
(3, '2024-11-26', 'Present'),
(3, '2024-11-27', 'Present'),
(3, '2024-11-28', 'Absent'),
(3, '2024-11-29', 'Present'),
(4, '2024-11-25', 'Absent'),
(4, '2024-11-26', 'Present'),
(4, '2024-11-27', 'Present'),
(4, '2024-11-28', 'Present'),
(4, '2024-11-29', 'Present'),
(5, '2024-11-25', 'Present'),
(5, '2024-11-26', 'Present'),
(5, '2024-11-27', 'Absent'),
(5, '2024-11-28', 'Present'),
(5, '2024-11-29', 'Present'),
(6, '2024-11-25', 'Present'),
(6, '2024-11-26', 'Present'),
(6, '2024-11-27', 'Absent'),
(6, '2024-11-28', 'Present'),
(6, '2024-11-29', 'Present'),
(7, '2024-11-25', 'Present'),
(7, '2024-11-26', 'Present'),
(7, '2024-11-27', 'Present'),
(7, '2024-11-28', 'Absent'),
(7, '2024-11-29', 'Present'),
(8, '2024-11-25', 'Present'),
(8, '2024-11-26', 'Absent'),
(8, '2024-11-27', 'Present'),
(8, '2024-11-28', 'Present'),
(8, '2024-11-29', 'Present'),
(9, '2024-11-25', 'Present'),
(9, '2024-11-26', 'Present'),
(9, '2024-11-27', 'Present'),
(9, '2024-11-28', 'Absent'),
(9, '2024-11-29', 'Present'),
(10, '2024-11-25', 'Present'),
(10, '2024-11-26', 'Present'),
(10, '2024-11-27', 'Absent'),
(10, '2024-11-28', 'Present'),
(10, '2024-11-29', 'Present');


CREATE TABLE Leave_Requests (
    employee_id INT,
    date DATE NOT NULL,
    reason VARCHAR(255) NOT NULL,
    status ENUM('Approved', 'Pending', 'Denied') NOT NULL,
    FOREIGN KEY (employee_id) REFERENCES Employees(employee_id) ON DELETE CASCADE
);

INSERT INTO Leave_Requests (employee_id, date, reason, status) VALUES
(1, '2024-11-22', 'Sick Leave', 'Approved'),
(1, '2024-12-01', 'Personal', 'Pending'),
(2, '2024-11-15', 'Family Responsibility', 'Denied'),
(2, '2024-12-02', 'Vacation', 'Approved'),
(3, '2024-11-10', 'Medical Appointment', 'Approved'),
(3, '2024-12-05', 'Personal', 'Pending'),
(4, '2024-11-20', 'Bereavement', 'Approved'),
(5, '2024-12-01', 'Childcare', 'Pending'),
(6, '2024-11-18', 'Sick Leave', 'Approved'),
(7, '2024-11-22', 'Vacation', 'Pending'),
(8, '2024-12-02', 'Medical Appointment', 'Approved'),
(9, '2024-11-19', 'Childcare', 'Denied'),
(10, '2024-12-03', 'Vacation', 'Pending');