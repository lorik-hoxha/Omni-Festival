<?php

require_once 'includes/auth_check.php';

require_once 'config/database.php';
require_once 'classes/User.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'ADMIN') {
    header('Location: login.php');
    exit();
}

$db = getDatabaseConnection();
$user = new User($db);
$currentUser = $user->getUserById($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Omni Festival</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="./style/admin/dashboard.css">

</head>
<body>
    <div class="admin-container">
        <div class="sidebar">
            <div class="sidebar-top">
                <div class="logo">Omni Festival</div>
                <div class="nav-item active" onclick="window.location.href='admin_dashboard.php'">
                    <i class="fas fa-chart-line"></i>
                    Dashboard
                </div>
                <div class="nav-item" onclick="window.location.href='manage_users.php'">
                    <i class="fas fa-users"></i>
                    Manage Users
                </div>
                <div class="nav-item" onclick="window.location.href='manage_tickets.php'">
                    <i class="fas fa-ticket-alt"></i>
                    Manage Tickets
                </div>
                <!-- <div class="nav-item" onclick="window.location.href='manage_lineup.php'">
                    <i class="fas fa-music"></i>
                    Manage Line-up
                </div> -->
            </div>
            <a href="logout.php" style="text-decoration: none; color: white;">
                <div class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </div>
            </a>
        </div>

        <div class="main-content">
            <div class="welcome-header">
                <h1>Welcome back, <?php echo htmlspecialchars($_SESSION['user_name']); ?>! 👋</h1>
                <p>Here's what's happening with your festival</p>
            </div>
            
            <div class="analytics-grid">
                <div class="analytics-card">
                    <i class="fas fa-users"></i>
                    <h2>Total Users</h2>
                    <?php 
                 
                    $stmt = $db->query("SELECT COUNT(*) as count FROM user");
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
                    ?>
                    <div class="number"><?php echo number_format($result['count']); ?></div>
                </div>

                <div class="analytics-card">
                    <i class="fas fa-ticket-alt"></i>
                    <h2>Available Tickets</h2>
                    <?php 
                   
                    $stmt = $db->query("SELECT SUM(remaining) as count FROM tickets");
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
                    ?>
                    <div class="number"><?php echo number_format($result['count'] ?? 0); ?></div>
                </div>

                <div class="analytics-card">
                    <i class="fas fa-tags"></i>
                    <h2>Ticket Types</h2>
                    <?php 
                   
                    $stmt = $db->query("SELECT COUNT(*) as count FROM tickets");
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
                    ?>
                    <div class="number"><?php echo $result['count']; ?></div>
                </div>

                <div class="analytics-card">
                    <i class="fas fa-user-shield"></i>
                    <h2>Admin Users</h2>
                    <?php 
                   
                    $stmt = $db->query("SELECT COUNT(*) as count FROM user WHERE user_type = 'ADMIN'");
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
                    ?>
                    <div class="number"><?php echo $result['count']; ?></div>
                </div>
            </div>
        </div>
    </div>

    <script>
      
        document.querySelectorAll('.nav-item').forEach(item => {
            item.addEventListener('click', function() {
                const text = this.textContent.trim();
                switch(text) {
                    case 'Manage Users':
                        window.location.href = 'manage_users.php';
                        break;
                    case 'Manage Tickets':
                        window.location.href = 'manage_tickets.php';
                        break;
                    case 'Manage Line-up':
                        window.location.href = 'manage_lineup.php';
                        break;
                    case 'Dashboard':
                        window.location.href = 'admin_dashboard.php';
                        break;
                }
            });
        });
    </script>
</body>
</html>