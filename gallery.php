<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery | Omni Festival</title>
    <link rel="stylesheet" href="style/gallery.css">
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
        <section class="gallery-header">
            <h1>Gallery</h1>
            <p>Captured pictures during Omni Festival's previous editions.</p>
        </section>

        <section class="gallery-grid">
            <div class="card">
                <img src="images/crowdpicture.webp" alt="Gallery Image">
                <p>It features a wide range of musical genres, ensuring there is something for everyone.</p>
            </div>
            <div class="card">
                <img src="images/crowdpicture2.webp" alt="Gallery Image">
                <p>The Omni Festival is set to be the biggest festival in the region, attracting a diverse audience</p>
            </div>
            <div class="card">
                <img src="images/crowdpicture3.jpg" alt="Gallery Image">
                <p>The festival showcases both local and international artists, promoting cultural exchange.</p>
            </div>
            <div class="card">
                <img src="images/crowdpicture4.jpg" alt="Gallery Image">
                <p>Attendees can enjoy various activities, including workshops, food stalls, and art installations</p>
            </div>
            <div class="card">
                <img src="images/people.jpg" alt="Gallery Image">
                <p>The festival aims to create a vibrant community atmosphere, encouraging social interaction</p>
            </div>
            <div class="card">
                <img src="images/crowdpicture6.jpg" alt="Gallery Image">
                <p>It is held annually, drawing larger crowds each year as its reputation grows.</p>
            </div>
            <div class="card">
                <img src="images/crowdpicture7.jpg" alt="Gallery Image">
                <p>The Omni Festival also emphasizes sustainability and eco-friendly practices.</p>
            </div>
            <div class="card">
                <img src="images/crowdpicture8.jpg" alt="Gallery Image">
                <p>Overall, the Omni Festival promises an unforgettable experience filled with music, culture, and fun.</p>
            </div>
            <div class="card">
                <img src="images/food.jpg" alt="Gallery Image">
                <p>The Omni Festival offers a diverse array of food options, showcasing local and international cuisines.</p>
            </div>
        </section>
    </main>
</body>
</html>
