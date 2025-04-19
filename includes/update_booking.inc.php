<?php
// update_booking.inc.php - Handles booking status updates

// Start session and check authentication
session_start();

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['booking_id']) && isset($_GET['status'])) {
    // Verify owner is logged in
    if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'owner') {
        header("Location: ../login.php");
        exit();
    }

    $booking_id = $_GET['booking_id'];
    $status = $_GET['status'];
    $apartment_id = $_GET['apartment_id'];
    $owner_id = $_SESSION['user_id'];

    try {
        // Include database connection
        require_once "dbh.inc.php";

        // Verify the booking belongs to an apartment owned by this user
        $query = "SELECT b.id 
                  FROM bookings b
                  JOIN apartments a ON b.apartment_id = a.id
                  WHERE b.id = ? AND a.owner_id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$booking_id, $owner_id]);

        if ($stmt->rowCount() === 0) {
            header("Location: ../owner/view_applications.php?apartment_id=" . $apartment_id . "&error=unauthorized");
            exit();
        }

        // Update booking status
        $query = "UPDATE bookings SET status = ? WHERE id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$status, $booking_id]);

        // If approving, mark apartment as rented
        if ($status === 'approved') {
            $query = "UPDATE apartments SET status = 'rented' WHERE id = ?";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$apartment_id]);
        }

        // Redirect back to owner apartments page
        header("Location: ../owner/owner_appartments.php?update=success");
        exit();

    } catch (PDOException $e) {
        die("Database error: " . $e->getMessage());
    }
} else {
    header("Location: ../owner/owner_appartments.php");
    exit();
}