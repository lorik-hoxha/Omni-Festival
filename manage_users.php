<?php

session_start();
require_once 'config/database.php';
require_once 'classes/User.php';


$db = getDatabaseConnection();
$user = new User($db);


if (!$user->isLoggedIn() || !$user->isAdmin()) {
    header('Location: login.php');
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'update':
             
                $user->updateUser(
                    $_POST['id'],
                    $_POST['first_name'],
                    $_POST['last_name'],
                    $_POST['phone_number'],
                    $_POST['user_type']
                );
                break;
            case 'delete':
        
                $user->deleteUser($_POST['id']);
                break;
        }
    }
}


$users = $user->getAllUsers();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users | Omni Festival</title>
    <link rel="stylesheet" href="./style/admin/manage_users.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="admin-container">
        <div class="sidebar">
            <div class="sidebar-top">
                <div class="logo">Omni Festival</div>
                <div class="nav-item" onclick="window.location.href='admin_dashboard.php'">
                    <i class="fas fa-chart-line"></i>
                    Dashboard
                </div>
                <div class="nav-item active" onclick="window.location.href='manage_users.php'">
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
            <div class="users-header">
                <h1>Manage Users</h1>
            </div>

            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert success" style="margin-left: 30px; margin-bottom: 20px; padding: 15px; background: #2ecc71; color: white; border-radius: 5px;">
                    <?php 
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                    ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert error" style="margin-left: 30px; margin-bottom: 20px; padding: 15px; background: #e74c3c; color: white; border-radius: 5px;">
                    <?php 
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                    ?>
                </div>
            <?php endif; ?>

            <div class="users-table">
                <table>
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>User Type</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($users)): ?>
                            <tr>
                                <td colspan="6" style="text-align: center;">No users found</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($users as $userData): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($userData['first_name']); ?></td>
                                <td><?php echo htmlspecialchars($userData['last_name']); ?></td>
                                <td><?php echo htmlspecialchars($userData['email']); ?></td>
                                <td><?php echo htmlspecialchars($userData['phone_number'] ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($userData['user_type']); ?></td>
                                <td class="action-buttons">
                                    <button class="edit-btn" onclick="editUser(<?php echo htmlspecialchars(json_encode($userData)); ?>)">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <form method="POST" style="display: inline;">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="id" value="<?php echo $userData['id']; ?>">
                                        <button type="submit" class="delete-btn" onclick="return confirm('Are you sure you want to delete this user?')">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <h2>Edit User</h2>
            <form id="editForm" method="POST">
                <input type="hidden" name="action" value="update">
                <input type="hidden" name="id" id="edit_id">
                
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" id="edit_first_name" name="first_name" required>
                </div>

                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" id="edit_last_name" name="last_name" required>
                </div>

                <div class="form-group">
                    <label for="phone_number">Phone</label>
                    <input type="text" id="edit_phone_number" name="phone_number">
                </div>

                <div class="form-group">
                    <label for="user_type">User Type</label>
                    <select id="edit_user_type" name="user_type" required>
                        <option value="REGULAR">Regular</option>
                        <option value="ADMIN">Admin</option>
                    </select>
                </div>

                <div class="modal-buttons">
                    <button type="button" class="cancel-btn" onclick="hideModal()">Cancel</button>
                    <button type="submit" class="save-btn">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    <script>
    
        function editUser(userData) {
            document.getElementById('edit_id').value = userData.id;
            document.getElementById('edit_first_name').value = userData.first_name;
            document.getElementById('edit_last_name').value = userData.last_name;
            document.getElementById('edit_phone_number').value = userData.phone_number || '';
            document.getElementById('edit_user_type').value = userData.user_type;
            
            document.getElementById('editModal').style.display = 'block';
        }

        function hideModal() {
            document.getElementById('editModal').style.display = 'none';
        }

        window.onclick = function(event) {
            if (event.target == document.getElementById('editModal')) {
                hideModal();
            }
        }
    </script>
</body>
</html> 