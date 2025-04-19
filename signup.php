<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sign Up - EasyRent Bhutan</title>
  <!-- Font Awesome for icons -->
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
      font-family: 'Arial', sans-serif;
    }

    body {
      background-color: #f5f5f5;
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
      object-fit: contain;
    }

    .logo {
      color: black;
      font-size: 1.5rem;
      font-weight: bold;
      text-decoration: none;
    }

    .nav-links {
      display: flex;
      gap: 1.5rem;
    }

    .nav-links a {
      color: black;
      text-decoration: none;
      padding: 0.5rem 1rem;
      border-radius: 4px;
      transition: background-color 0.3s;
    }

    .nav-links a:hover {
      background-color: #e0e0e0;
    }

    /* Signup Container */
    .signup-container {
      max-width: 500px;
      margin: 3rem auto;
      padding: 2rem;
      background: white;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .signup-container h2 {
      text-align: center;
      margin-bottom: 1.5rem;
      color: #2c3e50;
    }

    .form-group {
      margin-bottom: 1.5rem;
    }

    .form-group label {
      display: block;
      margin-bottom: 0.5rem;
      color: #2c3e50;
    }

    .form-group input,
    .form-group select {
      width: 100%;
      padding: 0.8rem;
      border: 1px solid #ddd;
      border-radius: 4px;
      font-size: 1rem;
    }

    .signup-button {
      width: 100%;
      padding: 0.8rem;
      background-color: #2ecc71;
      color: white;
      border: none;
      border-radius: 4px;
      font-size: 1rem;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .signup-button:hover {
      background-color: #27ae60;
    }

    .login-link {
      text-align: center;
      margin-top: 1.5rem;
    }

    .login-link a {
      color: #3498db;
      text-decoration: none;
    }

    .login-link a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <!-- Navigation Bar -->
  <nav>
    <div class="logo-container">
      <img src="images/logo.png" alt="Logo" class="logo-img" />
      <a href="index.php" class="logo">EasyRent Bhutan</a>
    </div>
    <div class="nav-links">
      <a href="login.php" class="login"><i class="fas fa-sign-in-alt"></i> Login</a>
      <a href="signup.php" class="signup"><i class="fas fa-user-plus"></i> Sign Up</a>
    </div>
  </nav>

  <!-- Signup Form -->
  <div class="signup-container">
    <h2>Create Your Account</h2>
    <form action="includes/signup.inc.php" method="POST">
      <div class="form-group">
        <label for="full_name">Full Name</label>
        <input type="text" id="full_name" name="full_name" required />
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required />
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required />
      </div>
      <div class="form-group">
        <label for="phone">Phone Number</label>
        <input type="text" id="phone" name="phone" required />
      </div>
      <div class="form-group">
        <label for="role">I am a</label>
        <select id="role" name="role" required>
          <option value="">Select Role</option>
          <option value="tenant">Tenant</option>
          <option value="owner">Property Owner</option>
        </select>
      </div>
      <button type="submit" class="signup-button">Sign Up</button>
    </form>
    <div class="login-link">
      <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
  </div>
</body>
</html>
