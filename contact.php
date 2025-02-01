<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us | Omni Festival</title>
  <link rel="stylesheet" href="./style/contact.css">
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
                    <li><a href="logout.php" id="logout-btn-contact">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="signup.php">Sign Up</a></li>
                <?php endif; ?>
      </ul>
    </nav>
  </header>
  <main>
    <section id="contactSection">
      <h3 class="heading">Contact Us</h3>
      <div id="logos">
        <img src="style/socials.png" alt="Socials Logo" class="logo-img">
      </div>
      <div class="contact-container">
        <div class="contact-info">
          <h4>Address</h4>
          <p>1200, Germia, Prishtina, Kosovo.</p>
          <h4>Phone</h4>
          <p>+383 (0) 46 120 960</p>
          <p>+383 (0) 44 309 953</p>
          <h4>Email</h4>
          <p>Omnifestival@kosovo.com</p>
          <p>lorikhoxha@Omnifest.com</p>
          <p>adeasadiku@Omnifest.com</p>
        </div>
        <div class="contact-form">
          <h4>Send Us A Message</h4>
          <form action="post" id="form" name="form">
            <div class="form-control">
              <input id="email" name="email" type="email" placeholder="Email" required>
            </div>
            <div class="form-control">
              <textarea id="message" name="message" placeholder="Your Message" required></textarea>
            </div>
            <button type="submit" class="submit-button">Send Now</button>
          </form>
        </div>
      </div>
    </section>
  </main>
  <footer>
    <p class="text-center">© Omni Festival 2025. All Rights Reserved</p>
  </footer>
</body>
</html>
