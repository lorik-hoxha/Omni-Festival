<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ | Omni Festival</title>
    <link rel="stylesheet" href="style/faq.css">
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
    <div class="container">
        <h2>FAQ</h2>
        <div class="faq-item">
            <div class="faq-title">How do I get to the festival?</div>
            <div class="faq-content">Germia national park is 20 minutes from the city center if you decide to walk. you can also use the city busses with numbers 4 and 5, and that will cost only 0.50 cents to take you to the location. Also local taxis will cost you up to 3 euros max from any part of the city</div>
        </div>
        <div class="faq-item">
            <div class="faq-title">What is the age limit to attend the festival?</div>
            <div class="faq-content">A person of 16 years or older is classified as an adult and is eligible to enter the venue on their own. Children at the age of 15 and under must be accompanied by an adult over the age of 18.</div>
        </div>
        <div class="faq-item">
            <div class="faq-title">Recommended Hotels and Hostels to stay during the festival?</div>
            <div class="faq-content">Suggestions for accommodations...</div>
        </div>
        <div class="faq-item">
            <div class="faq-title">Question Number 4</div>
            <div class="faq-content">Answer to question number 4...</div>
        </div>
        <div class="faq-item">
            <div class="faq-title">Question Number 5</div>
            <div class="faq-content">Answer to question number 5...</div>
        </div>
        <div class="faq-item">
            <div class="faq-title">Question Number 6</div>
            <div class="faq-content">Answer to question number 6...</div>
        </div>
        <div class="faq-item">
            <div class="faq-title">Question Number 7</div>
            <div class="faq-content">Answer to question number 7...</div>
        </div>
        <div class="faq-item">
            <div class="faq-title">Question Number 8</div>
            <div class="faq-content">Answer to question number 8...</div>
        </div>
    </div>
    <script>
        const faqTitles = document.querySelectorAll('.faq-title');
        faqTitles.forEach(title => {
            title.addEventListener('click', () => {
                const content = title.nextElementSibling;
                content.style.display = content.style.display === 'block' ? 'none' : 'block';
            });
        });
    </script>
    
</body>
</html>