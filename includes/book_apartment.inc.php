<?php
// book_apartment.inc.php - Handles apartment bookings

// Start session and check authentication
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION['user_id'])) {
        header("Location: ../login.php");
        exit();
    }
    
    $apartment_id = $_POST['apartment_id'];
    $tenant_id = $_SESSION['user_id'];

    try {
        // Include database connection
        require_once "dbh.inc.php";

        // 1. Check if apartment is still available
        $query = "SELECT status FROM apartments WHERE id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$apartment_id]);
        $apartment = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$apartment || $apartment['status'] !== 'available') {
            header("Location: ../apartments.php?error=apartment_unavailable");
            exit();
        }

        // 2. Check if user already has a booking for this apartment
        $query = "SELECT id FROM bookings WHERE apartment_id = ? AND tenant_id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$apartment_id, $tenant_id]);
        
        if ($stmt->rowCount() > 0) {
            if ($_SESSION['user_role'] == 'tenant') {
                header("Location: ../tenant/apartments.php?error=already_booked");
            } elseif ($_SESSION['user_role'] == 'owner') {
                header("Location: ../owner/apartments.php?error=already_booked");
            }
            exit();
        }

        // 3. Create booking if checks pass
        $query = "INSERT INTO bookings (apartment_id, tenant_id, status) VALUES (?, ?, 'pending')";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$apartment_id, $tenant_id]);

        // Redirect to appropriate bookings page based on role
        if ($_SESSION['user_role'] == 'tenant') {
            header("Location: ../tenant/my_bookings.php?booking=success");
        } elseif ($_SESSION['user_role'] == 'owner') {
            header("Location: ../owner/owner_bookings.php?booking=success");
        }
        exit();

    } catch (PDOException $e) {
        die("Database error: " . $e->getMessage());
    }
} else {
    header("Location: ../apartments.php");
    exit();
}