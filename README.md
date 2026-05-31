# FeedOne – Donation Management Web Application

## Overview

FeedOne is a web-based donation management platform developed to streamline the process of donating essential resources such as food, clothing, and other necessities. The application serves as a centralized system that connects donors with NGOs, making donation management more efficient, transparent, and organized.

The project is built using PHP and MySQL for backend development and HTML, CSS, Bootstrap, and JavaScript for the frontend, providing a responsive and user-friendly experience across devices.

---

## Live Demo

**Application URL:** https://feedone.free.nf

**Note:** The live version is hosted on a free PHP hosting service. Performance and availability may vary compared to a local or premium hosting environment.

---

## Project Objectives

The primary objectives of FeedOne are:

* Provide a digital platform for donation management
* Connect donors and NGOs through a centralized system
* Enable administrators to monitor and manage donation activities
* Maintain donation records efficiently
* Demonstrate practical implementation of PHP and MySQL in a real-world project

---

## Key Features

### User Module

* Submit donation requests
* Donate food, clothes, and essential items
* Simple and intuitive user interface
* Access donation-related information

### NGO Module

* View received donations
* Manage donation records
* Track donation activities

### Admin Module

* Manage NGO registrations
* View all donations
* Monitor system activities
* Maintain overall platform control

### System Features

* Responsive user interface
* Database-driven architecture
* Secure backend processing
* Structured donation management workflow
* Cross-device compatibility

---

## Technology Stack

### Frontend

* HTML5
* CSS3
* Bootstrap
* JavaScript

### Backend

* PHP

### Database

* MySQL

### Development Tools

* XAMPP
* Apache Server
* phpMyAdmin

---

## System Architecture

```text
+-------------+
|    Donor    |
+-------------+
       |
       v
+----------------------+
|  FeedOne Platform    |
+----------------------+
       |
       +------------------+
       |                  |
       v                  v
+-------------+    +-------------+
|     NGO     |    |    Admin    |
+-------------+    +-------------+
       |                  |
       v                  v
+-------------------------------+
|      MySQL Database           |
+-------------------------------+
```

---

## Application Workflow

```text
Donor
   |
   v
Submit Donation
   |
   v
Donation Stored in Database
   |
   v
NGO Views Available Donations
   |
   v
Admin Monitors Activities
   |
   v
Donation Management Completed
```

---

## Project Structure

```text
feedone/
│
├── admin/
│   ├── dashboard.php
│   └── manage_ngo.php
│
├── assets/
│   ├── css/
│   └── js/
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
```

---

## Database Information

| Property      | Value      |
| ------------- | ---------- |
| Database Name | feedone_db |
| Database Type | MySQL      |
| Database Tool | phpMyAdmin |

---

## Installation Guide

### Prerequisites

* XAMPP
* PHP 8.x or above
* MySQL
* Apache Server

### Step 1: Clone the Repository

```bash
git clone https://github.com/your-username/feedone.git
```

### Step 2: Move Project

Copy the project folder into:

```text
xampp/htdocs/
```

### Step 3: Start Services

Open XAMPP Control Panel and start:

* Apache
* MySQL

### Step 4: Create Database

Open:

```text
http://localhost/phpmyadmin
```

Create a database named:

```text
feedone_db
```

### Step 5: Import Database

Import the SQL file:

```text
database/feedone.sql
```

### Step 6: Configure Database Connection

```php
$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "feedone_db"
);
```

### Step 7: Run Application

Open:

```text
http://localhost/feedone
```

---

## Functional Modules

### Donation Management

Allows users to submit donation information and maintain donation records.

### NGO Management

Enables NGOs to access and manage donated resources.

### Administrative Management

Provides centralized control over NGOs and donations.

### Database Management

Stores all application data securely using MySQL.

---

## Future Enhancements

* User Authentication System
* Login and Registration Module
* Email Notification Service
* Online Payment Integration
* Donation History Tracking
* Analytics Dashboard
* Report Generation
* Role-Based Access Control
* Real-Time Donation Updates

---

## Limitations

* No payment gateway integration
* No user authentication module
* Manual NGO management process
* Limited analytics and reporting

---

## Learning Outcomes

This project demonstrates:

* PHP Backend Development
* CRUD Operations
* MySQL Database Integration
* Form Handling and Validation
* Responsive Web Design
* MVC-Oriented Development Concepts
* Real-World Donation Management Workflow

---

## Developer Information

**Project Name:** FeedOne

**Developer:** Ravneet Sawhney

**Role:** Web Developer

**Technologies Used:** PHP, MySQL, HTML5, CSS3, Bootstrap, JavaScript

---

## Conclusion

FeedOne is a practical donation management application designed to bridge the gap between donors and NGOs through a centralized digital platform. The project demonstrates full-stack web development concepts including frontend design, backend processing, database management, and system administration.

The application serves as a strong academic and portfolio project while showcasing real-world problem-solving using PHP and MySQL technologies.
