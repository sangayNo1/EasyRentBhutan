<?php
// post_apartment.inc.php - Handles apartment posting

// Start session and check authentication
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $title = trim($_POST["title"]);
    $location = trim($_POST["location"]);
    $rooms = trim($_POST["rooms"]);
    $rent_amount = trim($_POST["rent_amount"]);
    $additional_description = trim($_POST["additional_description"]);
    
    // Get owner ID from session
    $owner_id = $_SESSION["user_id"];
    
    try {
        // Include database connection
        require_once "dbh.inc.php";
        
        // Insert apartment into database
        $query = "INSERT INTO apartments 
                  (owner_id, title, location, rooms, rent_amount, additional_description, status) 
                  VALUES (?, ?, ?, ?, ?, ?, 'available');";
        
        $stmt = $pdo->prepare($query);
        $stmt->execute([$owner_id, $title, $location, $rooms, $rent_amount, $additional_description]);
        
        // Redirect back to owner apartments page
        header("Location: ../owner/owner_appartments.php");
        exit();
        
    } catch (PDOException $e) {
        // Handle database errors
        die("Database error: " . $e->getMessage());
    }
} else {
    // If not a POST request, redirect
    header("Location: ../post_apartment.php");
    exit();
}