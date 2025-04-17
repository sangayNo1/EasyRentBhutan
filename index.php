<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>EasyRent Bhutan - Find Your Perfect Home</title>
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    integrity="sha512-uE5h5Jvcd6H4ChXDU1y+CxwGQ2ZzvjplH91bs5UuYpsZw4rnvL4Bmc4i3OwzTWbnP8XZyCd8JJ56b7VYVh9bXw=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
  />
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      background-color: #f4f6f9;
      color: #333;
    }

    /* NAVIGATION */
    nav {
      background-color: white;
      padding: 1rem 2rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
      position: sticky;
      top: 0;
      z-index: 1000;
    }

    .logo-container {
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .logo-img {
      width: 40px;
      height: 40px;
      object-fit: contain;
    }

    .logo {
      font-size: 1.6rem;
      font-weight: bold;
      text-decoration: none;
      color: #2c3e50;
    }

    .nav-links {
      display: flex;
      align-items: center;
      gap: 1.5rem;
    }

    .nav-links a {
      color: #2c3e50;
      text-decoration: none;
      font-weight: 500;
      transition: color 0.3s ease;
    }

    .nav-links a:hover {
      color: #0066ff;
    }

    .signup-button {
      background-color: #0066ff;
      color: white;
      padding: 0.5rem 1rem;
      border-radius: 6px;
      text-decoration: none;
      font-weight: 500;
      transition: background-color 0.3s ease;
    }

    .signup-button:hover {
      background-color: #004bb1;
    }

    /* HERO */
    .hero {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 5rem 2rem;
      background: linear-gradient(to right, #eaf1ff, #f4f6f9);
      flex-wrap: wrap;
    }

    .hero-text {
      flex: 1;
      max-width: 600px;
    }

    .hero-text h1 {
      font-size: 3rem;
      color: #1a1a1a;
      margin-bottom: 1.5rem;
    }

    .hero-text p {
      font-size: 1.1rem;
      line-height: 1.7;
      margin-bottom: 2rem;
      color: #444;
    }

    .hero-text .cta {
      padding: 0.75rem 1.8rem;
      background-color: #0066ff;
      color: white;
      border-radius: 8px;
      text-decoration: none;
      font-weight: 600;
      box-shadow: 0 4px 10px rgba(0, 102, 255, 0.2);
      transition: background-color 0.3s ease, transform 0.2s;
    }

    .hero-text .cta:hover {
      background-color: #004bb1;
      transform: translateY(-2px);
    }

    .hero-image {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
      margin-top: 2rem;
    }

    .hero-image img {
      width: 100%;
      max-width: 500px;
      border-radius: 12px;
      object-fit: cover;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    @media (max-width: 768px) {
      .hero {
        flex-direction: column;
        text-align: center;
      }

      .hero-text {
        max-width: 100%;
      }

      .hero-image {
        margin-top: 2rem;
      }

      .hero-image img {
        width: 100%;
      }
    }
  </style>
</head>
<body>
  <!-- NAVIGATION -->
  <nav>
    <div class="logo-container">
      <img src="images/logo.png" alt="Logo" class="logo-img" />
      <a href="index.html" class="logo">EasyRent Bhutan</a>
    </div>
    <div class="nav-links">
      <a href="about.php">About us</a>
      <a href="login.php">Login</a>
      <a href="signup.php" class="signup-button">Sign Up</a>
    </div>
  </nav>

  <!-- HERO -->
  <section class="hero">
    <div class="hero-text">
      <h1>EasyRent Bhutan</h1>
      <p>
        Finding a rental apartment has never been easier! EasyRent Bhutan connects owners and tenants through a simple and transparent booking system.
        Browse available apartments, apply online, and track your booking status—all in one place.
      </p>
      <a href="signup.php" class="cta">Book Now</a>
    </div>
    <div class="hero-image">
      <img src="images/thimphu.jpg" alt="Thimphu City">
    </div>
  </section>
  <!-- FOOTER -->
<footer style="background-color: #1a1a1a; color: white; padding: 2rem 2rem 1rem;">
  <div style="display: flex; flex-wrap: wrap; justify-content: space-between; align-items: start; gap: 2rem;">
    <div>
      <h2 style="font-size: 1.5rem; font-weight: bold; margin-bottom: 1rem;">EasyRent Bhutan</h2>
      <p style="max-width: 300px; line-height: 1.6; color: #ccc;">
        Simplifying rentals in Bhutan. Search, book, and move in with ease.
      </p>
    </div>
    <div>
      <h3 style="margin-bottom: 1rem;">Quick Links</h3>
      <ul style="list-style: none; padding: 0;">
        <li><a href="index.php" style="color: #ccc; text-decoration: none;">Home</a></li>
        <li><a href="about.php" style="color: #ccc; text-decoration: none;">About Us</a></li>
        <li><a href="login.php" style="color: #ccc; text-decoration: none;">Login</a></li>
        <li><a href="signup.php" style="color: #ccc; text-decoration: none;">Sign Up</a></li>
      </ul>
    </div>
    <div>
      <h3 style="margin-bottom: 1rem;">Follow Us</h3>
      <div style="display: flex; gap: 1rem;">
        <a href="#" style="color: white;"><i class="fab fa-facebook-f"></i></a>
        <a href="#" style="color: white;"><i class="fab fa-twitter"></i></a>
        <a href="#" style="color: white;"><i class="fab fa-instagram"></i></a>
        <a href="#" style="color: white;"><i class="fab fa-linkedin-in"></i></a>
      </div>
    </div>
  </div>
  <div style="text-align: center; margin-top: 2rem; color: #aaa;">
    &copy; 2025 EasyRent Bhutan. All rights reserved.
  </div>
</footer>

</body>
</html>
