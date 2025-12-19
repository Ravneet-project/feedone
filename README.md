# FeedOne – Donation Based Web Application

FeedOne is a donation-based web application designed to simplify and manage the process of donating essential items such as food, clothes, and other resources.  
The platform helps connect donors with NGOs through a centralized and easy-to-use system.

This project is developed using **PHP and MySQL** for backend processing and **HTML, CSS, and Bootstrap** for a responsive and user-friendly frontend.

---

## 📌 Project Objective

The main objectives of the FeedOne project are:
- To provide a digital platform for donation management
- To connect donors and NGOs efficiently
- To help administrators manage donations and NGOs
- To gain practical experience in PHP and MySQL web development

---

## 🚀 Features

### 👤 User Features
- Submit donation details
- Simple and intuitive user interface
- View donation-related information

### 🏢 NGO Features
- View received donations
- Manage and track donation records

### 🛠️ Admin Features
- Manage NGOs
- View and control all donations
- Overall system monitoring

### 🌐 General Features
- Donation-based management system
- Responsive design using Bootstrap
- Secure backend using PHP
- Database-driven application with MySQL

---

## 🛠️ Technologies Used

### Frontend
- HTML5  
- CSS3  
- Bootstrap  

### Backend
- PHP  

### Database
- MySQL  

### Server & Tools
- Apache Server  
- XAMPP  
- phpMyAdmin  

---

## ⚙️ Installation & Setup (Localhost)

Follow the steps below to run the project on your local system:

1. Install **XAMPP**
2. Start **Apache** and **MySQL** from XAMPP Control Panel
3. Copy the project folder `feedone` into:
xampp/htdocs/

markdown
Copy code
4. Open **phpMyAdmin**:
http://localhost/phpmyadmin

sql
Copy code
5. Create a new database:
feedone_db

css
Copy code
6. Import the SQL file from the `database` folder
7. Update database connection details in your PHP configuration file:
```php
$conn = mysqli_connect("localhost", "root", "", "feedone_db");
Open browser and run:

arduino
Copy code
http://localhost/feedone
📂 Project Folder Structure
pgsql
Copy code
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
Technologies: PHP, MySQL, HTML, CSS, Bootstrap,JavaScript

⭐ Conclusion
FeedOne is a practical and academic PHP project that demonstrates:

Backend development using PHP

Database integration with MySQL

Real-world donation management workflow

Responsive UI design using Bootstrap

This project is suitable for academic submission, GitHub portfolio, and web development interviews.

yaml
Copy code







