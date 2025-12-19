FeedOne – Donation Based Web Application
FeedOne is a donation-based web application designed to simplify and manage the process of donating essential items such as food, clothes, and other resources.
The platform helps connect donors with NGOs through a centralized and easy-to-use system.
This project is developed using PHP and MySQL for backend processing and HTML, CSS, Bootstrap, and JavaScript for a responsive and user-friendly frontend.

🌍 Live Demo
👉 Live URL: https://feedone.free.nf

⚠️ Note: The live version is hosted on a free PHP hosting platform. Performance may vary compared to a local server (XAMPP).

📌 Project Objective
The main objectives of the FeedOne project are:
To provide a digital platform for donation management
To connect donors and NGOs efficiently
To help administrators manage donations and NGOs

To gain practical experience in PHP and MySQL web development
🚀 Features
👤 User Features
Submit donation details
Simple and intuitive user interface
View donation-related information

🏢 NGO Features
View received donations
Manage and track donation records

🛠️ Admin Features
Manage NGOs
View and control all donations
Overall system monitoring

🌐 General Features
Donation-based management system
Responsive design using Bootstrap
Secure backend using PHP
Database-driven application with MySQL

🛠️ Technologies Used
Frontend:HTML5,CSS3,Bootstrap,JavaScript
Backend,PHP,Database,MySQL

Server & Tools
Apache Server
XAMPP
phpMyAdmin
⚙️ Installation & Setup (Localhost)
Follow the steps below to run the project on your local system:

Install XAMPP
Start Apache and MySQL from XAMPP Control Panel
Copy the project folder feedone into:

xampp/htdocs/
Open phpMyAdmin:
http://localhost/phpmyadmin
Create a new database:
feedone_db
Import the SQL file from the database folder
Update database connection details in your PHP configuration file:
$conn = mysqli_connect("localhost", "root", "", "feedone");

Open browser and run:
http://localhost/feedone

📂 Project Folder Structure
feedone/
│
├── admin/
│   ├── dashboard.php
│   └── manage_ngo.php
│
├── assets/
│   ├── css/
│   ├── js/
│
├── images/
│
├── database/
│   └── feedone.sql
│
├── index.php
├── donate.php
├── about.php
├── contact.php
└── README.md
🔐 Database Details
Database Name: feedone_db
Database Type: MySQL
Tool Used: phpMyAdmin

⚠️ Important Note
This project requires a PHP-supported server environment
GitHub Pages does not support PHP execution
The project is intended to run on Apache (XAMPP) or any PHP hosting server

🔮 Future Enhancements
User authentication (Login & Registration)
Email notification system
Online payment integration
Donation history tracking
Advanced admin dashboard with analytics

👩‍💻 Developer Details
Project Name: FeedOne
Developed By: Ravneet Sawhney
Role: Web Developer
Technologies: PHP, MySQL, HTML, CSS, Bootstrap, JavaScript

⭐ Conclusion
FeedOne is a practical and academic PHP project that demonstrates:
Backend development using PHP
Database integration with MySQL
Real-world donation management workflow
Responsive UI design using Bootstrap

#This project is suitable for academic submission, GitHub portfolio, and web development interviews.

