<?php
session_start();
require_once 'config/database.php';

$db = getDatabaseConnection();

$stmt = $db->query("SELECT * FROM tickets ORDER BY price ASC");
$tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tickets | Omni Festival</title>
    <link rel="stylesheet" href="style/tickets.css">
</head>
<body>
    <header>
        <div class="logo">Omni Festival</div>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="tickets.php">Tickets</a></li>
                <li><a href="lineup.php">Line-Up</a></li>
                <li><a href="gallery.php">Gallery</a></li>
                <li><a href="faq.php">FAQ</a></li>
                <li><a href="contact.php">Contact</a></li>
                <?php 
                if(isset($_SESSION['user_id'])): ?>
                    <li><a href="#"><?php echo htmlspecialchars($_SESSION['user_name']); ?></a></li>
                    <li><a href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="signup.php">Sign Up</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <main>
        <section id="tickets">
            <div class="container">
                <?php foreach($tickets as $ticket): ?>
                <div class="card">
                    <div class="card-header"><?php echo htmlspecialchars($ticket['type']); ?></div>
                    <div class="card-body">
                        <h1 class="card-title"><?php echo htmlspecialchars($ticket['price']); ?>€</h1>
                        <ul>
                            <li><?php echo $ticket['type'] === 'VIP' ? 'Exclusive staging entrance' : 'Staging entrance'; ?></li>
                            <li><?php echo $ticket['type'] === 'VIP' ? 'Festival fees and Drinks' : 'Festival fees'; ?></li>
                            <?php
                            $helpLevel = '';
                            switch($ticket['type']) {
                                case 'Beliver':
                                    $helpLevel = 'Basic help and guidance';
                                    $limitations = 'Access to general areas only';
                                    break;
                                case 'Early-Bird':
                                    $helpLevel = 'Priority help and guidance';
                                    $limitations = 'Limited access to premium areas';
                                    break;
                                case 'Regular':
                                    $helpLevel = 'Enhanced help and guidance';
                                    $limitations = 'Access to most areas, but no VIP access';
                                    break;
                                case 'VIP':
                                    $helpLevel = 'Personalized help and guidance';
                                    $limitations = 'Unlimited access to all areas, including VIP zones';
                                    break;
                            }
                            ?>
                            <li><?php echo htmlspecialchars($helpLevel); ?></li>
                            <li><b>Limitations:</b> <?php echo htmlspecialchars($limitations); ?></li>
                        </ul>
                        <button onclick="handlePurchase('<?php echo htmlspecialchars($ticket['type']); ?>', <?php echo htmlspecialchars($ticket['price']); ?>)">Purchase Ticket</button>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
    </main>
    <script>

        function handlePurchase(ticketType, price) {
            <?php 
           
            if(isset($_SESSION['user_id'])): ?>
         
                const quantity = prompt(`How many ${ticketType} tickets would you like to purchase? (Price: ${price}€ each)`);

                if (quantity === null) {
                    return;
                }
   
                const numTickets = parseInt(quantity);
                if (isNaN(numTickets) || numTickets <= 0) {
                    alert('Please enter a valid number of tickets.');
                    return;
                }

                const totalPrice = price * numTickets;
                alert(`Purchase Confirmed!\n\nTicket Type: ${ticketType}\nQuantity: ${numTickets}\nTotal Price: ${totalPrice}€\n\nThank you for your purchase!`);
            <?php else: ?>
                window.location.href = "login.php";
            <?php endif; ?>
        }
    </script>
</body>
</html>
