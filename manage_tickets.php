<?php
// Start session and include required files
session_start();
require_once 'config/database.php';
require_once 'classes/User.php';
require_once 'classes/Ticket.php';

// Create database connection and initialize objects
$db = getDatabaseConnection();
$user = new User($db);
$ticket = new Ticket($db);

// Check if user is logged in and has admin rights
if (!$user->isLoggedIn() || !$user->isAdmin()) {
    header('Location: login.php');
    exit();
}

// Handle different form actions (add, update, delete tickets)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'add':
                // Add a new ticket with form data
                $ticket->addTicket(
                    $_POST['type'],
                    $_POST['price'],
                    $_POST['help'],
                    $_POST['limitations'], 
                    $_POST['remaining'],
                    $_POST['expiry_date']
                );
                break;
            case 'update':
                // Update existing ticket details
                $ticket->updateTicket(
                    $_POST['id'],
                    $_POST['type'],
                    $_POST['price'],
                    $_POST['help'],
                    $_POST['limitations'],
                    $_POST['remaining'],
                    $_POST['expiry_date']
                );
                break;
            case 'delete':
                // Delete a ticket by ID
                $ticket->deleteTicket($_POST['id']);
                break;
        }
    }
}


$tickets = $ticket->getAllTickets();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Tickets | Omni Festival</title>
    <link rel="stylesheet" href="./style/admin/manage_tickets.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"> -->
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
                <div class="nav-item" onclick="window.location.href='manage_users.php'">
                    <i class="fas fa-users"></i>
                    Manage Users
                </div>
                <div class="nav-item active" onclick="window.location.href='manage_tickets.php'">
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
            <div class="tickets-header">
                <h1>Manage Tickets</h1>
                <button class="add-ticket-btn" onclick="showModal()">
                    <i class="fas fa-plus"></i> Add New Ticket
                </button>
            </div>

            <div class="tickets-table">
                <table>
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Price</th>
                            <th>Remaining</th>
                            <th>Expiry Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tickets as $ticket): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($ticket['type']); ?></td>
                            <td>$<?php echo htmlspecialchars($ticket['price']); ?></td>
                            <td><?php echo htmlspecialchars($ticket['remaining']); ?></td>
                            <td><?php echo $ticket['expiry_date'] ? htmlspecialchars($ticket['expiry_date']) : 'N/A'; ?></td>
                            <td class="action-buttons">
                                <button class="edit-btn" onclick="editTicket(<?php echo htmlspecialchars(json_encode($ticket)); ?>)">
                                    <i class="fas fa-edit"></i> Edit
                                </button>
                                <form method="POST" style="display: inline;">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="id" value="<?php echo $ticket['id']; ?>">
                                    <button type="submit" class="delete-btn" onclick="return confirm('Are you sure you want to delete this ticket?')">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="ticketModal" class="modal">
        <div class="modal-content">
            <h2 id="modalTitle">Add New Ticket</h2>
            <form id="ticketForm" method="POST">
                <input type="hidden" id="actionInput" name="action" value="add">
                <input type="hidden" id="ticketId" name="id" value="">
                
                <div class="form-group">
                    <label for="type">Type</label>
                    <select name="type" required>
                        <option value="Beliver">Believer</option>
                        <option value="Early-Bird">Early Bird</option>
                        <option value="Regular">Regular</option>
                        <option value="VIP">VIP</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" name="price" step="0.01" required>
                </div>

                <div class="form-group">
                    <label for="help">Help Text</label>
                    <textarea name="help" rows="3"></textarea>
                </div>

                <div class="form-group">
                    <label for="limitations">Limitations</label>
                    <textarea name="limitations" rows="3"></textarea>
                </div>

                <div class="form-group">
                    <label for="remaining">Remaining Tickets</label>
                    <input type="number" name="remaining" required>
                </div>

                <div class="form-group">
                    <label for="expiry_date">Expiry Date</label>
                    <input type="date" name="expiry_date">
                </div>

                <div class="modal-buttons">
                    <button type="button" class="cancel-btn" onclick="hideModal()">Cancel</button>
                    <button type="submit" class="save-btn">Save Ticket</button>
                </div>
            </form>
        </div>
    </div>

    <script>
 
    function showModal() {
        document.getElementById('ticketModal').style.display = 'block';
        document.getElementById('modalTitle').textContent = 'Add New Ticket';
        document.getElementById('ticketForm').reset();
        document.getElementById('actionInput').value = 'add';
        document.getElementById('ticketId').value = '';
    }

    function hideModal() {
        document.getElementById('ticketModal').style.display = 'none';
    }

    function editTicket(ticket) {
        document.getElementById('ticketModal').style.display = 'block';
        document.getElementById('modalTitle').textContent = 'Edit Ticket';
        document.getElementById('actionInput').value = 'update';
        document.getElementById('ticketId').value = ticket.id;
        
        // Set all form values
        const form = document.getElementById('ticketForm');
        form.querySelector('[name="type"]').value = ticket.type;
        form.querySelector('[name="price"]').value = ticket.price;
        form.querySelector('[name="help"]').value = ticket.help || '';
        form.querySelector('[name="limitations"]').value = ticket.limitations || '';
        form.querySelector('[name="remaining"]').value = ticket.remaining;
        form.querySelector('[name="expiry_date"]').value = ticket.expiry_date || '';
    }

    window.onclick = function(event) {
        if (event.target == document.getElementById('ticketModal')) {
            hideModal();
        }
    }
    </script>
</body>
</html>