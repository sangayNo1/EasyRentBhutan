🏠 EasyRentBhutan
A Rental Management System for Bhutan

Project Banner
Connecting landlords and tenants across Bhutan

🌟 Features
User Roles: Admin, Landlord, and Tenant portals

Property Listings: Browse/Search available properties

Rental Management: Track agreements and payments

Reviews: Rate and review properties

Responsive Design: Works on mobile and desktop

🛠️ Tech Stack
Frontend	Backend	Database	Server
HTML/CSS/JS	PHP	MySQL	XAMPP
🚀 Quick Setup
1. Clone the Repository
bash
Copy
git clone https://github.com/sangayNo1/EasyRentBhutan.git
2. Set Up XAMPP
Move folder to:

Copy
C:\xampp\htdocs\EasyRentBhutan  # Windows
/opt/lampp/htdocs/EasyRentBhutan  # Linux
Start Apache and MySQL in XAMPP

3. Import Database
Access phpMyAdmin: http://localhost/phpmyadmin

Create database: easy_rent_bhutan

Import easy_rent_bhutan.sql

4. Configure
Edit includes/config.php:

php
Copy
<?php
$host = "localhost";
$user = "root"; 
$password = "";  // XAMPP default
$dbname = "easy_rent_bhutan";
?>
5. Launch
Visit:

Copy
http://localhost/EasyRentBhutan
📂 Project Structure
Copy
EasyRentBhutan/
├── images/          # Property images & UI assets
├── includes/        # Core PHP files
│   ├── config.php   # DB configuration
│   └── functions.php
├── owner/           # Landlord portal
├── tenant/          # Tenant portal
├── about.php
├── index.php        # Homepage
├── login.php
├── signup.php
└── easy_rent_bhutan.sql  # Full DB dump
🔐 Default Logins
Role	Username	Password
Admin	admin	admin123
Landlord	landlord1	pass123
Tenant	tenant1	pass123
Warning
Change passwords after first login!

📜 License
MIT License - See LICENSE (add file if needed)

📬 Contact
Sangay

GitHub: @sangayNo1

Happy Renting! 🎉
