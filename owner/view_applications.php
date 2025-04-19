<?php
// Start session and check authentication
session_start();
require_once '../includes/dbh.inc.php';

// Check if user is logged in and is an owner
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'owner') {
    header("Location: ../login.php");
    exit();
}

// Get apartment ID from URL parameter
if (!isset($_GET['apartment_id'])) {
    header("Location: owner_apartments.php");
    exit();
}

$apartment_id = $_GET['apartment_id'];
$owner_id = $_SESSION['user_id'];

// Verify the apartment belongs to this owner
$query = "SELECT id FROM apartments WHERE id = ? AND owner_id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$apartment_id, $owner_id]);

if ($stmt->rowCount() === 0) {
    // Apartment doesn't exist or doesn't belong to this owner
    header("Location: owner_apartments.php?error=invalid_apartment");
    exit();
}

// Get apartment details
$query = "SELECT title FROM apartments WHERE id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$apartment_id]);
$apartment = $stmt->fetch(PDO::FETCH_ASSOC);

// Get all bookings for this apartment
$query = "SELECT b.*, u.full_name, u.email, u.phone 
          FROM bookings b
          JOIN users u ON b.tenant_id = u.id
          WHERE b.apartment_id = ?
          ORDER BY b.created_at DESC";
$stmt = $pdo->prepare($query);
$stmt->execute([$apartment_id]);
$bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applications for <?php echo htmlspecialchars($apartment['title']); ?> - EasyRent Bhutan</title>
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
        
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }
        
        .page-title {
            font-size: 2rem;
            color: #2c3e50;
        }
        
        .back-link {
            color: #3498db;
            text-decoration: none;
        }
        
        /* Applications Table */
        .applications-table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border-radius: 8px;
            overflow: hidden;
        }
        
        .applications-table th, 
        .applications-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #eee;
        }
        
        .applications-table th {
            background-color: #2c3e50;
            color: white;
        }
        
        .applications-table tr:hover {
            background-color: #f5f5f5;
        }
        
        .status-pending {
            color: #856404;
            background-color: #fff3cd;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-weight: bold;
        }
        
        .status-approved {
            color: #155724;
            background-color: #d4edda;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-weight: bold;
        }
        
        .status-rejected {
            color: #721c24;
            background-color: #f8d7da;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-weight: bold;
        }
        
        .action-btn {
            padding: 0.5rem 1rem;
            border-radius: 4px;
            text-decoration: none;
            font-weight: bold;
            margin-right: 0.5rem;
            display: inline-block;
            cursor: pointer;
        }
        
        .approve-btn {
            background-color: #28a745;
            color: white;
            border: none;
        }
        
        .reject-btn {
            background-color: #dc3545;
            color: white;
            border: none;
        }
        
        .no-applications {
            text-align: center;
            padding: 2rem;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        /* Confirmation Modal */
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
        
        .modal-title {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: #2c3e50;
        }
        
        .modal-message {
            margin-bottom: 1.5rem;
        }
        
        .modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
        }
        
        .modal-confirm {
            background-color: #28a745;
            color: white;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        
        .modal-cancel {
            background-color: #6c757d;
            color: white;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            
            .applications-table {
                display: block;
                overflow-x: auto;
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
            <a href="owner_apartments.php"><i class="fas fa-calendar-check"></i> My Apartments</a>
            <a href="owner_bookings.php"><i class="fas fa-calendar-check"></i> My Documents</a>
            <a href="about.php"><i class="fas fa-info-circle"></i> About Us</a>
            <a href="contact.php"><i class="fas fa-envelope"></i> Contact</a>
            <a href="../login.php" class="logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </nav>
    
    <!-- Main Content -->
    <div class="container">
        <div class="page-header">
            <h1 class="page-title">Applications for: <?php echo htmlspecialchars($apartment['title']); ?></h1>
            <a href="owner_apartments.php" class="back-link"><i class="fas fa-arrow-left"></i> Back to My Apartments</a>
        </div>
        
        <?php if (count($bookings) > 0): ?>
            <table class="applications-table">
                <thead>
                    <tr>
                        <th>Applicant</th>
                        <th>Contact</th>
                        <th>Applied On</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($bookings as $booking): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($booking['full_name']); ?></td>
                        <td>
                            <?php echo htmlspecialchars($booking['email']); ?><br>
                            <?php echo htmlspecialchars($booking['phone']); ?>
                        </td>
                        <td><?php echo date('M j, Y', strtotime($booking['created_at'])); ?></td>
                        <td>
                            <span class="status-<?php echo strtolower($booking['status']); ?>">
                                <?php echo htmlspecialchars($booking['status']); ?>
                            </span>
                        </td>
                        <td>
                            <?php if ($booking['status'] === 'pending'): ?>
                                <button class="action-btn approve-btn" 
                                        onclick="showConfirmationModal('approve', <?php echo $booking['id']; ?>, <?php echo $apartment_id; ?>)">
                                    <i class="fas fa-check"></i> Approve
                                </button>
                                <button class="action-btn reject-btn" 
                                        onclick="showConfirmationModal('reject', <?php echo $booking['id']; ?>, <?php echo $apartment_id; ?>)">
                                    <i class="fas fa-times"></i> Reject
                                </button>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="no-applications">
                <h3>No applications yet for this apartment</h3>
                <p>Applications will appear here when tenants apply for your apartment.</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Confirmation Modal -->
    <div id="confirmationModal" class="modal">
        <div class="modal-content">
            <h3 class="modal-title" id="modalTitle">Confirm Action</h3>
            <p class="modal-message" id="modalMessage">Are you sure you want to perform this action?</p>
            <div class="modal-actions">
                <button class="modal-cancel" onclick="hideConfirmationModal()">Cancel</button>
                <button class="modal-confirm" id="modalConfirmBtn">Confirm</button>
            </div>
        </div>
    </div>

    <script>
        let currentBookingId = null;
        let currentApartmentId = null;
        let currentAction = null;
        
        function showConfirmationModal(action, bookingId, apartmentId) {
            currentBookingId = bookingId;
            currentApartmentId = apartmentId;
            currentAction = action;
            
            const modal = document.getElementById('confirmationModal');
            const title = document.getElementById('modalTitle');
            const message = document.getElementById('modalMessage');
            const confirmBtn = document.getElementById('modalConfirmBtn');
            
            if (action === 'approve') {
                title.textContent = 'Confirm Approval';
                message.textContent = 'Are you sure you want to approve this application? This will mark the apartment as rented.';
                confirmBtn.textContent = 'Approve';
                confirmBtn.style.backgroundColor = '#28a745';
            } else {
                title.textContent = 'Confirm Rejection';
                message.textContent = 'Are you sure you want to reject this application?';
                confirmBtn.textContent = 'Reject';
                confirmBtn.style.backgroundColor = '#dc3545';
            }
            
            modal.style.display = 'flex';
        }
        
        function hideConfirmationModal() {
            document.getElementById('confirmationModal').style.display = 'none';
            currentBookingId = null;
            currentApartmentId = null;
            currentAction = null;
        }
        
        document.getElementById('modalConfirmBtn').addEventListener('click', function() {
            if (currentBookingId && currentApartmentId && currentAction) {
                // Redirect to update script
                window.location.href = `../includes/update_booking.inc.php?booking_id=${currentBookingId}&status=${currentAction === 'approve' ? 'approved' : 'rejected'}&apartment_id=${currentApartmentId}`;
            }
        });
    </script>
</body>
</html>