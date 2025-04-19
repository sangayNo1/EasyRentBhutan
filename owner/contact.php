<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EasyRent Bhutan - Home</title>
    <style>
        /* Global Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }
        
        body {
            background-color: #f8f9fa;
            color: #333;
            line-height: 1.6;
        }
        
        /* Navigation Bar */
nav {
    background-color: white;
    padding: 1rem 2rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 2px solid black;
}

.logo-container {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.logo-img {
    width: 40px;
    height: 40px;
    object-fit: cover;
}

.logo {
    color: black;
    font-size: 1.5rem;
    font-weight: bold;
    text-decoration: none;
}

.nav-links {
    display: flex;
    gap: 1rem;
}

.nav-links a {
    color: black;
    text-decoration: none;
    padding: 0.5rem 1rem;
    border-radius: 4px;
    transition: background-color 0.3s;
}

.nav-links a:hover {
    background-color: #f0f0f0;
}

.nav-links .post-btn {
    background-color: #f39c12;
    color: white;
}

.nav-links .post-btn:hover {
    background-color: #e67e22;
}

.nav-links .logout {
    background-color: #e74c3c;
    color: white;
}

.nav-links .logout:hover {
    background-color: #c0392b;
}
        
        /* Hero Section */
        .hero {
    background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)),
                url('https://images.unsplash.com/photo-1560518883-ce09059eeffa?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
    background-size: cover;
    background-position: center;
    height: 80vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    color: white;
    padding: 0 2rem;
}

        
        .hero h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
        }
        
        .hero p {
            font-size: 1.2rem;
            max-width: 800px;
            margin-bottom: 2rem;
        }
        
        .cta-button {
            display: inline-block;
            background-color: #2ecc71;
            color: white;
            padding: 0.8rem 2rem;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        
        .cta-button:hover {
            background-color: #27ae60;
        }
        
        /* Features Section */
        .features {
            padding: 4rem 2rem;
            text-align: center;
            background-color: white;
        }
        
        .features h2 {
            font-size: 2rem;
            margin-bottom: 2rem;
            color: #2c3e50;
        }
        
        .features-container {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .feature-card {
            flex: 1;
            min-width: 300px;
            padding: 2rem;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .feature-card i {
            font-size: 2.5rem;
            color: #3498db;
            margin-bottom: 1rem;
        }
        
        .feature-card h3 {
            margin-bottom: 1rem;
            color: #2c3e50;
        }
        
        /* Footer */
        footer {
            background-color: #2c3e50;
            color: white;
            text-align: center;
            padding: 2rem;
            margin-top: 2rem;
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            nav {
                flex-direction: column;
                padding: 1rem;
            }
            
            .nav-links {
                margin-top: 1rem;
                width: 100%;
                flex-wrap: wrap;
                justify-content: center;
            }
            
            .hero h1 {
                font-size: 2rem;
            }
            
            .hero p {
                font-size: 1rem;
            }
        }
    </style>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <!-- Navigation Bar -->
    <nav>
    <img src="../images/logo.png" alt="Logo" class="logo-img">
        <a href="index.php" class="logo">EasyRent Bhutan</a>
        <div class="nav-links">
        <a href="owner_dashboard.php"><i class="fas fa-building"></i> Home</a>
            <a href="apartments.php"><i class="fas fa-building"></i> Apartments</a>
            <a href="owner_appartments.php"><i class="fas fa-calendar-check"></i> My Apartments</a>
            <a href="owner_bookings.php"><i class="fas fa-calendar-check"></i> My Bookings</a>
            <a href="about.php"><i class="fas fa-info-circle"></i> About Us</a>
            <a href="contact.php"><i class="fas fa-envelope"></i> Contact</a>
            <a href="../login.php" class="logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </nav>
    
    <!-- Contact Us Section -->
<section style="padding: 4rem 2rem; background-color: white;">
    <h2 style="text-align: center; font-size: 2rem; margin-bottom: 2rem;">Contact Us</h2>
    <div style="display: flex; flex-wrap: wrap; gap: 2rem; justify-content: center; align-items: stretch; max-width: 1100px; margin: 0 auto;">
        <!-- Left Box -->
        <div style="flex: 1; min-width: 300px; background-color: #3f51b5; color: white; padding: 2rem; border-radius: 10px;">
            <h3 style="margin-bottom: 1rem;">Contact Information</h3>
            <p style="margin-bottom: 2rem;">Say something to start a live chat!</p>
            <p style="margin-bottom: 1rem;"><i class="fas fa-phone-alt"></i> +1012 3456 789</p>
            <p style="margin-bottom: 1rem;"><i class="fas fa-envelope"></i> demo@gmail.com</p>
            <p style="margin-bottom: 2rem;"><i class="fas fa-map-marker-alt"></i> 132 Dartmouth Street Boston, Massachusetts 02156 United States</p>
            <div style="display: flex; gap: 1rem;">
                <a href="#"><i class="fab fa-twitter" style="color: white;"></i></a>
                <a href="#"><i class="fab fa-instagram" style="color: white;"></i></a>
                <a href="#"><i class="fab fa-discord" style="color: white;"></i></a>
            </div>
        </div>

        <!-- Right Form -->
        <form style="flex: 2; min-width: 300px; background-color: #f9f9f9; padding: 2rem; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
            <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                <div style="flex: 1;">
                    <label>First Name</label>
                    <input type="text" style="width: 100%; padding: 0.5rem; margin-top: 0.3rem; margin-bottom: 1rem;">
                </div>
                <div style="flex: 1;">
                    <label>Last Name</label>
                    <input type="text" value="Doe" style="width: 100%; padding: 0.5rem; margin-top: 0.3rem; margin-bottom: 1rem;">
                </div>
            </div>
            <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                <div style="flex: 1;">
                    <label>Email</label>
                    <input type="email" style="width: 100%; padding: 0.5rem; margin-top: 0.3rem; margin-bottom: 1rem;">
                </div>
                <div style="flex: 1;">
                    <label>Phone Number</label>
                    <input type="text" value="+1 012 3456 789" style="width: 100%; padding: 0.5rem; margin-top: 0.3rem; margin-bottom: 1rem;">
                </div>
            </div>
            <div style="margin-bottom: 1rem;">
                <label>Select Subject?</label><br>
                <label><input type="radio" name="subject" checked> General Inquiry</label>
                <label><input type="radio" name="subject"> General Inquiry</label>
                <label><input type="radio" name="subject"> General Inquiry</label>
                <label><input type="radio" name="subject"> General Inquiry</label>
            </div>
            <div style="margin-bottom: 1rem;">
                <label>Message</label><br>
                <textarea style="width: 100%; padding: 0.5rem; height: 100px;" placeholder="Write your message.."></textarea>
            </div>
            <button type="submit" style="background-color: #3f51b5; color: white; padding: 0.8rem 2rem; border: none; border-radius: 5px; cursor: pointer;">Send Message</button>
        </form>
    </div>
</section>


    
    <!-- Footer -->
    <footer>
        <p>&copy; 2023 EasyRent Bhutan. All rights reserved.</p>
    </footer>
</body>
</html>