<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: ../admin_login.php');
    exit();
}

$admin_username = $_SESSION['admin_username'] ?? 'Admin';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Restaurantly</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .dashboard-container {
            max-width: 1200px;
            margin: 8rem auto 4rem;
            padding: 2rem;
        }
        
        .dashboard-header {
            background: var(--primary-gradient);
            color: white;
            padding: 2rem;
            border-radius: var(--border-radius);
            margin-bottom: 2rem;
        }
        
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }
        
        .dashboard-card {
            background: white;
            padding: 2rem;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            transition: var(--transition);
        }
        
        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-hover);
        }
        
        .dashboard-card h3 {
            font-family: 'Poppins', sans-serif;
            margin-bottom: 1rem;
            color: var(--text-primary);
        }
        
        .dashboard-card p {
            color: var(--text-secondary);
            margin-bottom: 1.5rem;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }
        
        .stat-item {
            text-align: center;
            padding: 1rem;
            background: var(--light-bg);
            border-radius: 8px;
        }
        
        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-primary);
        }
        
        .stat-label {
            font-size: 0.9rem;
            color: var(--text-secondary);
        }
    </style>
</head>
<body>

<header>
    <nav>
        <div class="logo">
            <a href="../index.php">Restaurantly</a>
        </div>
        <div class="nav-links">
            <a href="../index.php">View Website</a>
            <a href="logout.php" class="logout-link">Logout</a>
        </div>
    </nav>
</header>

<div class="dashboard-container">
    <div class="dashboard-header">
        <h1>Welcome, <?= htmlspecialchars($admin_username) ?>!</h1>
        <p>Manage your restaurant's online presence and operations</p>
    </div>
    
    <div class="dashboard-grid">
        <div class="dashboard-card">
            <h3>📊 Quick Stats</h3>
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="stat-number">25</div>
                    <div class="stat-label">Today's Orders</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">12</div>
                    <div class="stat-label">Reservations</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">$1,250</div>
                    <div class="stat-label">Today's Revenue</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">4.8</div>
                    <div class="stat-label">Avg Rating</div>
                </div>
            </div>
        </div>
        
        <div class="dashboard-card">
            <h3>🍽️ Manage Specials</h3>
            <p>Update today's special dish and featured items</p>
            <a href="update_specials.php" class="btn btn-primary">Update Specials</a>
        </div>
        
        <div class="dashboard-card">
            <h3>📋 View Orders</h3>
            <p>Check and manage incoming online orders</p>
            <a href="orders.php" class="btn btn-primary">View Orders</a>
        </div>
        
        <div class="dashboard-card">
            <h3>📅 Reservations</h3>
            <p>Manage table reservations and bookings</p>
            <a href="reservations.php" class="btn btn-primary">View Reservations</a>
        </div>
        
        <div class="dashboard-card">
            <h3>👥 Manage Staff</h3>
            <p>Add or remove admin users and staff members</p>
            <a href="add_admin.php" class="btn btn-primary">Add Admin</a>
        </div>
        
        <div class="dashboard-card">
            <h3>⚙️ Settings</h3>
            <p>Update restaurant information and website settings</p>
            <a href="settings.php" class="btn btn-primary">Manage Settings</a>
        </div>
    </div>
    
    <div class="dashboard-card">
        <h3>📈 Recent Activity</h3>
        <div style="background: var(--light-bg); padding: 1rem; border-radius: 8px;">
            <p><strong>2:30 PM</strong> - New order received: #ORD-2024-001</p>
            <p><strong>1:45 PM</strong> - Table reservation confirmed for 7:00 PM</p>
            <p><strong>12:20 PM</strong> - Special of the day updated</p>
            <p><strong>11:15 AM</strong> - New customer review received</p>
        </div>
    </div>
</div>

<script>
// Add some interactivity
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.dashboard-card');
    cards.forEach((card, index) => {
        card.style.animation = `fadeInUp 0.5s ease-out ${index * 0.1}s both`;
    });
});
</script>

</body>
</html>
