# 🎮 ESL Online Games Platform

![PHP](https://img.shields.io/badge/PHP-8+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-Database-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-ES6-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)

---

## 📚 Overview

The **ESL Online Games Platform** is an interactive educational web application designed to help students learn English through engaging and interactive games.

It provides a structured learning environment where users can practice vocabulary, grammar, and language skills in a fun and motivating way.

---

## 🚀 Features

- 🔐 Secure user authentication system (Login / Logout)
- 🧑‍🏫 Admin dashboard for managing content
- 🎮 Interactive ESL learning games
- 🗄️ MySQL database integration
- 📊 User progress tracking system
- 📱 Fully responsive design (mobile & desktop)
- ⚙️ Easy configuration and modular structure
- 🔒 Session-based access control

---

## 🛠️ Technologies Used

- 💻 PHP (Backend logic)
- 🗄️ MySQL (Database)
- 🌐 HTML5
- 🎨 CSS3
- ⚡ JavaScript
- 🎯 Bootstrap 5

---

## 📦 Installation

### 1. Clone the repository
```bash id="clone1" 
git clone https://github.com/Hamzaattar99/esl-online-games.git
```
### 2. Move project to local server
#### htdocs (XAMPP) or www (WAMP)

### 3. Import database
#### Open phpMyAdmin
#### Create a new database (e.g. esl_db)
#### Import the file:
esl_games.sql

### 4. Configure database connection
#### Edit:
/config/db.php
#### Example:
$host = "localhost";
$user = "root";
$password = "";
$dbname = "esl_db";


### 5. Run the project
#### Open in browser:
http://localhost/esl-online-games   OR  http://localhost/esl-online-games/admin/index.php


## 🗄️ Database Structure

### The project uses MySQL with tables for:
#### Users
#### Admins
#### Games
#### Progress tracking
#### You can find full schema in:
esl_games.sql


## 📁 Project Structure

esl-online-games/
│
├── admin/              # Admin pages
  ├── admin_header.php/           # Header include
  ├── admin_footer.php/           # Footer include
  ├── login.php/                  # Login admin page
  ├── login_op.php/               # Login operation file
  ├── logout.php/                 # Logout admin file
  ├── content.php/                # Content admin page
  ├── create.php/                 # Create content admin page
  ├── edit.php/                   # Edit content admin page
  ├── settings.php/               # Settings admin page
  ├── auth_check.php/             # Secruity session check include file
├── assets/             # CSS, JS, images
├── api/                # Core PHP files
  ├── create-content.php              # Create content operation file
  ├── get-content.php                 # Get content operation file
  ├── save-result.php                 # Save content operation in DB file
  ├── upload.php                      # Upload media operation file
├── templates/          # Games templates
├── uploads/            # Files uploaded
├── index.php           # Main page
├── join.php            # Joing the game page
├── play.php            # Playing the game page
├── result.php          # Showing the results of a game page
├── config/db.php       # Database connection
└── database.sql        # Database export



## 🧑‍🏫 Admin Panel

### The admin panel allows:
#### Managing users
#### Adding and editing games
#### Monitoring user activity
#### Controlling platform content
### Access is restricted via session authentication.



## 🔐 Security Features
### Password hashing for secure authentication
### Session-based login system
### Protected admin routes
### Input validation to prevent basic attacks



## 🚀 Future Improvements
### 🎯 Add more interactive ESL games
### 📊 Advanced analytics dashboard
### 🌍 Multi-language support
### 🔔 Notification system
### 📱 Convert into Progressive Web App (PWA)



## 👨‍💻 Author
### Developed by Hamza Al-Attar
#### GitHub: 
```https://github.com/Hamzaattar99⁠```
### X (Twitter):
```https://x.com/ha_z933⁠```
### Instagram: 
```https://www.instagram.com/7amza.alattar⁠```


## 📄 License
### This project is licensed under the MIT License.


## ⭐ Note
### If you like this project, consider giving it a star ⭐ on GitHub.
