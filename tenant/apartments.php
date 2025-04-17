<?php
// Start session and check authentication
session_start();
require_once '../includes/dbh.inc.php';

// Check if user is logged in and is a tenant
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'tenant') {
    header("Location: ../login.php");
    exit();
}

// Get all available apartments
$query = "SELECT * FROM apartments WHERE status = 'available' ORDER BY created_at DESC";
$stmt = $pdo->query($query);
$apartments = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Apartments - EasyRent Bhutan</title>
    <style>
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
        
        /* Main Content */
        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 2rem;
        }
        
        .page-title {
            font-size: 2rem;
            color: #2c3e50;
            margin-bottom: 2rem;
        }
        
        /* Apartments List */
        .apartments-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 2rem;
        }
        
        .apartment-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 1.5rem;
            position: relative;
        }
        
        .apartment-title {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
            color: #2c3e50;
        }
        
        .apartment-meta {
            display: flex;
            gap: 1rem;
            margin-bottom: 1rem;
            color: #7f8c8d;
        }
        
        .apartment-description {
            margin-bottom: 1.5rem;
        }
        
        .apartment-status {
            display: inline-block;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-weight: bold;
            margin-bottom: 1rem;
        }
        
        .status-available {
            background-color: #d4edda;
            color: #155724;
        }
        
        .status-booked {
            background-color: #f8d7da;
            color: #721c24;
        }
        
        .book-btn {
            display: inline-block;
            background-color: #3498db;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.3s;
            width: 100%;
            text-align: center;
        }
        
        .book-btn:hover {
            background-color: #2980b9;
        }
        
        /* Modal/Dialog */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }
        
        .modal-content {
            background-color: white;
            padding: 2rem;
            border-radius: 8px;
            width: 90%;
            max-width: 500px;
        }
        
        .modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            margin-top: 1.5rem;
        }
        
        .confirm-btn {
            background-color: #2ecc71;
            color: white;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        
        .cancel-btn {
            background-color: #e74c3c;
            color: white;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            nav {
                flex-direction: column;
                padding: 1rem;
            }
            
            .nav-links {
                margin-top: 1rem;
                flex-wrap: wrap;
                justify-content: center;
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
        <a href="tenant_dashboard.php" class="logo">EasyRent Bhutan</a>
        <div class="nav-links">
        <a href="tenant_dashboard.php"><i class="fas fa-building"></i> Home</a>
            <a href="apartments.php"><i class="fas fa-building"></i> Apartments</a>
            <a href="my_bookings.php"><i class="fas fa-calendar-check"></i> My Bookings</a>
            <a href="about.php"><i class="fas fa-info-circle"></i> About Us</a>
            <a href="contact.php"><i class="fas fa-envelope"></i> Contact</a>
            <a href="../login.php" class="logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </nav>
    
    <!-- Main Content -->
    <div class="container">
        <h1 class="page-title">Available Apartments</h1>
        <?php if (isset($_GET['error']) && $_GET['error'] === 'already_booked'): ?>
    <div style="background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: 1rem; margin-bottom: 2rem; border-radius: 5px;">
        This apartment is already booked. Please choose another one.
    </div>
<?php endif; ?>
        
<div class="apartments-list">
            <?php if (count($apartments) > 0): ?>
                <?php foreach ($apartments as $apartment): ?>
                    <div class="apartment-card">
                        <h2 class="apartment-title"><?php echo htmlspecialchars($apartment['title']); ?></h2>
                        <div class="apartment-meta">
                            <span><i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($apartment['location']); ?></span>
                            <span><i class="fas fa-money-bill-wave"></i> Nu. <?php echo number_format($apartment['rent_amount'], 2); ?>/month</span>
                        </div>
                        <div class="apartment-meta">
                            <span><i class="fas fa-bed"></i> <?php echo htmlspecialchars($apartment['rooms']); ?> Bedrooms</span>
                            <span><i class="fas fa-bath"></i> 1 Bathroom</span>
                        </div>
                        <p class="apartment-description"><?php echo htmlspecialchars($apartment['additional_description']); ?></p>
                        
                        <div class="apartment-status status-<?php echo strtolower($apartment['status']); ?>">
                            Status: <?php echo htmlspecialchars($apartment['status']); ?>
                        </div>
                        <button class="book-btn" onclick="showBookingDialog(<?php echo $apartment['id']; ?>)">
                        <i class="fas fa-calendar-check"></i> Book Now
                    </button>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="no-apartments" style="grid-column: 1/-1; text-align: center; padding: 2rem;">
                    <h3>No available apartments at the moment</h3>
                    <p>Check back later for new listings</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
    
    <!-- Booking Confirmation Modal -->
    <div id="bookingModal" class="modal">
        <div class="modal-content">
            <h2>Confirm Booking</h2>
            <p>Are you sure you want to book this apartment?</p>
            <div class="modal-actions">
                <button class="cancel-btn" onclick="hideBookingDialog()">Cancel</button>
                <button class="confirm-btn" id="confirmBookingBtn">Confirm</button>
            </div>
        </div>
    </div>
    
    <script>
        let currentApartmentId = null;
        
        function showBookingDialog(apartmentId) {
            currentApartmentId = apartmentId;
            document.getElementById('bookingModal').style.display = 'flex';
        }
        
        function hideBookingDialog() {
            document.getElementById('bookingModal').style.display = 'none';
            currentApartmentId = null;
        }
        
        document.getElementById('confirmBookingBtn').addEventListener('click', function() {
            if (currentApartmentId) {
                // Submit booking form
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '../includes/book_apartment.inc.php';
                
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'apartment_id';
                input.value = currentApartmentId;
                
                form.appendChild(input);
                document.body.appendChild(form);
                form.submit();
            }
        });
    </script>
</body>
</html>