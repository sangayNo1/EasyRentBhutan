<?php
// login_process.php - Handles user authentication

// Start session to store user data
session_start();

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    try {
        // Include database connection
        require_once "dbh.inc.php"; // Make sure this path is correct

        // Prepare SQL query to get user by email
        $query = "SELECT * FROM users WHERE email = :email;";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        // Check if user exists
        if ($stmt->rowCount() === 0) {
            // User not found
            header("Location: ../login.php?error=invalid_credentials");
            exit();
        }

        // Fetch user data
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verify password (Note: You should switch to password_hash() in your signup)
        // For now using plain text comparison as your current system stores plain text
        if ($password === $user["pwd"]) {
            // Password is correct - start user session
            
            // Store user data in session
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["user_email"] = $user["email"];
            $_SESSION["user_role"] = $user["role"];
            $_SESSION["user_fullname"] = $user["full_name"];

            // Redirect based on user role
            if ($user["role"] === "owner") {
                header("Location: ../owner/owner_dashboard.php");
            } else {
                header("Location: ../tenant/tenant_dashboard.php");
            }
            exit();
        } else {
            // Invalid password
            header("Location: ../login.php?error=invalid_credentials");
            exit();
        }

    } catch (PDOException $e) {
        // Database error
        die("Login failed: " . $e->getMessage());
    }
} else {
    // If not a POST request, redirect to login
    header("Location: ../login.php");
    exit();
}