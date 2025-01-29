<?php

session_start();
require_once 'config/database.php';
require_once 'classes/User.php';

$error = null;
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    
    if ($password !== $confirmPassword) {
        $error = "Passwords do not match";
    } else {
        try {
    
            $db = getDatabaseConnection();
            
            
            $stmt = $db->prepare("SELECT email FROM user WHERE email = ?");
            $stmt->execute([$email]);
            
            if ($stmt->rowCount() > 0) {
                $error = "Email already exists";
            } else {
        
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                
               
                $stmt = $db->prepare("INSERT INTO user (first_name, last_name, email, phone_number, password) VALUES (?, ?, ?, ?, ?)");
                $stmt->execute([$firstName, $lastName, $email, $phone, $hashedPassword]);
                
         
                $user = new User();
                if ($user->login($email, $password)) {
                    $_SESSION['registration_success'] = true;
                    
                    echo "<script>
                        alert('Thank you for registering! We hope you enjoy the festival and find the perfect tickets for you');
                        window.location.href = 'index.php';
                    </script>";
                    exit();
                } else {
                    $error = "Registration successful but login failed. Please try logging in manually.";
                }
            }
        } catch (PDOException $e) {
      
            $error = "An error occurred during registration";
            error_log($e->getMessage());
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/signup.css">
    <title>SignUp | Omni Festival</title>
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
            <h1>Sign Up</h1>
            <?php if ($error): ?>
                <div class="error-message"><?php echo $error; ?></div>
            <?php endif; ?>
            <?php if ($success): ?>
                <div class="success-message"><?php echo $success; ?></div>
            <?php endif; ?>
            <form id="signupForm" method="POST" action="" onsubmit="return validateForm()">
                <div class="input-group">
                    <input type="text" id="firstName" name="first_name" placeholder="First Name" required>
                    <div class="error-message" id="firstNameError"></div>
                </div>
                <div class="input-group">
                    <input type="text" id="lastName" name="last_name" placeholder="Last Name" required>
                    <div class="error-message" id="lastNameError"></div>
                </div>
                <div class="input-group">
                    <input type="email" id="email" name="email" placeholder="Email" required>
                    <div class="error-message" id="emailError"></div>
                </div>
                <div class="input-group">
                    <input type="tel" id="phone" name="phone" placeholder="Phone Number" required>
                    <div class="error-message" id="phoneError"></div>
                </div>
                <div class="input-group">
                    <input type="password" id="password" name="password" placeholder="Password" required>
                    <div class="error-message" id="passwordError"></div>
                </div>
                <div class="input-group">
                    <input type="password" id="confirmPassword" name="confirm_password" placeholder="Confirm Password" required>
                    <div class="error-message" id="confirmPasswordError"></div>
                </div>
                <button type="submit">Sign Up</button>
            </form>
            <p>Already have an account? <a href="login.php">Log in here</a></p>
        </div>
    </main>

    <script src="/js/signup.js"></script>
</body>
</html>