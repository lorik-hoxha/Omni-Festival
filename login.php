<?php

session_start();
require_once 'classes/User.php';

$error = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = $_POST['email'];
    $password = $_POST['password'];

    try {

        $user = new User();
        if ($user->login($email, $password)) {

            if ($_SESSION['user_type'] === 'ADMIN') {
                echo "<script>
                        alert('Login successful');
                        window.location.href = 'admin_dashboard.php';
                    </script>";
            } else {
                echo "<script>
                        alert('Login successful');
                        window.location.href = 'index.php';
                    </script>";
            }
            exit();
        } else {
 
            $error = "Invalid email or password";
        }
    } catch (Exception $e) {

        $error = $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/login.css">
    <title>Login | Omni Festival</title>
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
                <li><a href="login.php">Login</a></li>
                <li><a href="signup.php">Sign Up</a></li>
            </ul>
        </nav>
    </header>  
    <main>
        <div class="banner-content">
            <h1>Login</h1>
            <?php if ($error): ?>
                <div class="error"><?php echo $error; ?></div>
            <?php endif; ?>
            <form method="POST" action="">
                <div class="input-group">
                    <input type="email" name="email" id="email" placeholder="Email" required>
                    <div class="error-message" id="emailError"></div>
                </div>
                <div class="input-group">
                    <input type="password" name="password" id="password" placeholder="Password" required>
                    <div class="error-message" id="passwordError"></div>
                </div>
                <button type="submit">Login</button>
            </form>
            <p>Don't have an account? <a href="signup.php">Sign up here</a></p>
        </div>
    </main>
    <script src="/js/login.js"></script>
</body>
</html>