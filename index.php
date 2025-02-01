<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Omni Festival</title>
    <link rel="stylesheet" href="index.css">
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
                <?php if(isset($_SESSION['user_id'])): ?>
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
  
        <section class="banner">
            <div class="banner-content">
                <h1>5/6/7 August, 2025</h1>
                <p>Prishtina, Kosovo</p>
            </div>
        </section>

        <footer>
            <a href="tickets.php" class="ticket-sale">Tickets on Sale! Tickets on Sale! Tickets on Sale!</a>
        </footer>

        <div class="slider">
    <div class="slides">
        <div class="slide">
            <img src="Images/crowdpicture.webp" alt="Slider Image 1">
        </div>
        <div class="slide">
            <img src="Images/crowdpicture2.webp" alt="Slider Image 2">
        </div>
        <div class="slide">
            <img src="Images/crowdpicture3.jpg" alt="Slider Image 3">
        </div>
        <div class="slide">
            <img src="Images/crowdpicture4.jpg "alt="Slider Image 3">
        </div>
    </div>
    <button class="prev">‹</button>
    <button class="next">›</button>
</div>

    </main>

    <script src="slider.js"></script>
</body>
</html>
