<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login - EasyRent Bhutan</title>
  <!-- Font Awesome CDN for icons -->
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

    /* Login Container */
    .login-container {
      max-width: 400px;
      margin: 3rem auto;
      padding: 2rem;
      background: white;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .login-container h2 {
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

    .form-group input {
      width: 100%;
      padding: 0.8rem;
      border: 1px solid #ddd;
      border-radius: 4px;
      font-size: 1rem;
    }

    .login-button {
      width: 100%;
      padding: 0.8rem;
      background-color: #3498db;
      color: white;
      border: none;
      border-radius: 4px;
      font-size: 1rem;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .login-button:hover {
      background-color: #2980b9;
    }

    .signup-link {
      text-align: center;
      margin-top: 1.5rem;
    }

    .signup-link a {
      color: #3498db;
      text-decoration: none;
    }

    .signup-link a:hover {
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
      <a href="login.php"><i class="fas fa-sign-in-alt"></i> Login</a>
      <a href="signup.php"><i class="fas fa-user-plus"></i> Sign Up</a>
    </div>
  </nav>

  <!-- Login Form -->
  <div class="login-container">
    <h2>Login to Your Account</h2>
    <form action="includes/login_process.inc.php" method="POST">
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required />
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required />
      </div>
      <button type="submit" class="login-button">Login</button>
    </form>
    <div class="signup-link">
      <p>Don't have an account? <a href="signup.php">Sign up here</a></p>
    </div>
  </div>
</body>
</html>
