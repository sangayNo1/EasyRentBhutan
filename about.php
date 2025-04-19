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
    <img src="images/logo.png" alt="Logo" class="logo-img">
        <a href="index.php" class="logo">EasyRent Bhutan</a>
        <div class="nav-links">
        <div class="nav-links">
      <a href="about.php">About us</a>
      <a href="login.php">Login</a>
      <a href="signup.php" class="signup-button">Sign Up</a>
    </div>
        </div>
    </nav>
    
    <!-- About Us Section -->
<section style="padding: 4rem 2rem; background-color: white;">
    <h2 style="text-align: center; font-size: 2rem; margin-bottom: 3rem;">About us</h2>
    <div style="display: flex; flex-wrap: wrap; justify-content: center; align-items: center; gap: 2rem; max-width: 1100px; margin: 0 auto;">
        <img src="images/about.png" alt="Traditional Bhutanese Building" style="max-width: 500px; width: 100%; border-radius: 15px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
        <p style="flex: 1; font-size: 1.1rem; line-height: 1.8; max-width: 500px;">
            Welcome to <strong>EasyRent Bhutan</strong> – Simplifying Rentals in Bhutan!<br><br>
            At <strong>EasyRent Bhutan</strong>, we believe that finding and renting an apartment should be easy, transparent, and hassle-free. 
            Our platform connects tenants and apartment owners through an efficient booking system that eliminates unnecessary phone calls and confusion.
        </p>
    </div>
</section>

<!-- Team Section -->
<section style="padding: 4rem 2rem; background-color: #f8f9fa;">
    <h2 style="text-align: center; font-size: 2rem; margin-bottom: 3rem;">Meet the Team</h2>
    <p style="text-align: center; max-width: 800px; margin: 0 auto; font-size: 1.1rem;">
        We are a group of passionate students, working together to create meaningful digital solutions that solve real-life problems in our communities. EasyRent Bhutan is a product of our dedication, teamwork, and vision to modernize the housing experience in our beautiful country.
    </p>
</section>

    
    <!-- Footer -->
    <footer>
        <p>&copy; 2023 EasyRent Bhutan. All rights reserved.</p>
    </footer>
</body>
</html>