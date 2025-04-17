<?php
// Start session and check authentication
session_start();
require_once '../includes/dbh.inc.php';

// Check if user is logged in and is a tenant
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'tenant') {
    header("Location: ../login.php");
    exit();
}

// Get tenant's bookings
$tenant_id = $_SESSION['user_id'];
$query = "SELECT b.*, a.title, a.location, a.rent_amount 
          FROM bookings b
          JOIN apartments a ON b.apartment_id = a.id
          WHERE b.tenant_id = ?
          ORDER BY b.created_at DESC";
$stmt = $pdo->prepare($query);
$stmt->execute([$tenant_id]);
$bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bookings - EasyRent Bhutan</title>
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
            text-align: center;
        }
        
        /* Bookings Table */
        .bookings-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            overflow: hidden;
        }
        
        .bookings-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }
        
        .bookings-table thead {
            background-color: #3498db;
            color: white;
        }
        
        .bookings-table th {
            padding: 1.2rem 1rem;
            text-align: left;
            font-weight: 500;
            letter-spacing: 0.5px;
        }
        
        .bookings-table th:first-child {
            border-top-left-radius: 10px;
        }
        
        .bookings-table th:last-child {
            border-top-right-radius: 10px;
        }
        
        .bookings-table td {
            padding: 1rem;
            border-bottom: 1px solid #f0f0f0;
            vertical-align: middle;
        }
        
        .bookings-table tr:last-child td {
            border-bottom: none;
        }
        
        .bookings-table tr:hover td {
            background-color: #f8fafc;
        }
        
        /* Status Badges */
        .status-badge {
            display: inline-block;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: capitalize;
        }
        
        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }
        
        .status-approved {
            background-color: #d4edda;
            color: #155724;
        }
        
        .status-rejected {
            background-color: #f8d7da;
            color: #721c24;
        }
        
        /* No Bookings Message */
        .no-bookings {
            text-align: center;
            padding: 3rem 2rem;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        }
        
        .no-bookings h3 {
            font-size: 1.5rem;
            color: #2c3e50;
            margin-bottom: 1rem;
        }
        
        .no-bookings p {
            color: #7f8c8d;
            margin-bottom: 1.5rem;
        }
        
        .view-apartments-btn {
            display: inline-block;
            background-color: #3498db;
            color: white;
            padding: 0.8rem 1.8rem;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .view-apartments-btn:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
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
            
            .bookings-table {
                display: block;
                overflow-x: auto;
            }
            
            .bookings-table th, 
            .bookings-table td {
                padding: 0.8rem;
                font-size: 0.9rem;
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
        <h1 class="page-title">My Bookings</h1>
        <?php if (isset($_GET['booking']) && $_GET['booking'] === 'success'): ?>
    <div style="background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; padding: 1rem; margin-bottom: 2rem; border-radius: 5px;">
        Booking successful! Thank you for using EasyRent Bhutan.
    </div>
<?php endif; ?>
        
        <?php if (count($bookings) > 0): ?>
            <div class="bookings-container">
                <table class="bookings-table">
                    <thead>
                        <tr>
                            <th>Apartment</th>
                            <th>Location</th>
                            <th>Rent</th>
                            <th>Booking Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($bookings as $booking): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($booking['title']); ?></td>
                            <td><?php echo htmlspecialchars($booking['location']); ?></td>
                            <td>Nu. <?php echo number_format($booking['rent_amount'], 2); ?></td>
                            <td><?php echo date('M j, Y', strtotime($booking['created_at'])); ?></td>
                            <td>
                                <span class="status-badge status-<?php echo strtolower($booking['status']); ?>">
                                    <i class="fas fa-<?php 
                                        echo $booking['status'] === 'approved' ? 'check-circle' : 
                                            ($booking['status'] === 'pending' ? 'clock' : 'times-circle'); 
                                    ?>"></i>
                                    <?php echo htmlspecialchars($booking['status']); ?>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="no-bookings">
                <h3>You haven't made any bookings yet</h3>
                <p>Browse available apartments to make your first booking</p>
                <a href="apartments.php" class="view-apartments-btn">
                    <i class="fas fa-building"></i> View Apartments
                </a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>