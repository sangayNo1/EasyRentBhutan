<?php
// Start session and check authentication
session_start();
require_once '../includes/dbh.inc.php';

// Check if user is logged in and is an owner
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'owner') {
    header("Location: ../login.php");
    exit();
}

// Get owner's apartments from database
$owner_id = $_SESSION['user_id'];
$query = "SELECT * FROM apartments WHERE owner_id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$owner_id]);
$apartments = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Apartments - EasyRent Bhutan</title>
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
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }
        
        .page-title {
            font-size: 2rem;
            color: #2c3e50;
        }
        
        .post-btn {
            background-color: #2ecc71;
            color: white;
            padding: 0.5rem 1.5rem;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        
        .post-btn:hover {
            background-color: #27ae60;
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
        
        .status-approved {
            background-color: #d4edda;
            color: #155724;
        }
        
        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }
        
        .status-rented {
            background-color: #f8d7da;
            color: #721c24;
        }
        
        .action-btn {
            display: inline-block;
            background-color: #3498db;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        
        .action-btn:hover {
            background-color: #2980b9;
        }
        
        .no-apartments {
            text-align: center;
            padding: 2rem;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
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
            
            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
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
        <a href="owner_dashboard.php" class="logo">EasyRent Bhutan</a>
        <div class="nav-links">
        <a href="owner_dashboard.php"><i class="fas fa-building"></i> Home</a>
            <a href="apartments.php"><i class="fas fa-building"></i> Apartments</a>
            <a href="owner_appartments.php"><i class="fas fa-calendar-check"></i> My Apartments</a>
            <a href="owner_bookings.php"><i class="fas fa-calendar-check"></i> My bookings</a>
            <a href="about.php"><i class="fas fa-info-circle"></i> About Us</a>
            <a href="contact.php"><i class="fas fa-envelope"></i> Contact</a>
            <a href="../login.php" class="logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </nav>
    
    <!-- Main Content -->
    <div class="container">
        <div class="header">
            <h1 class="page-title">My Apartments</h1>
            <a href="post_apartment.php" class="post-btn"><i class="fas fa-plus"></i> Post Apartment</a>
        </div>
        
        <?php if (count($apartments) > 0): ?>
            <div class="apartments-list">
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
                        
                        <a href="view_applications.php?apartment_id=<?php echo $apartment['id']; ?>" class="action-btn">
                            <i class="fas fa-users"></i> See Applications
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="no-apartments">
                <h3>You haven't posted any apartments yet</h3>
                <p>Get started by posting your first apartment listing</p>
                
            </div>
        <?php endif; ?>
    </div>
</body>
</html>