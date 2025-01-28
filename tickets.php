<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tickets | Omni Festival</title>
    <link rel="stylesheet" href="tickets.css">
</head>
<body>
    <header>
        <div class="logo">Omni Festival</div>
        <nav>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="tickets.html">Tickets</a></li>
                <li><a href="lineup.html">Line-Up</a></li>
                <li><a href="gallery.html">Gallery</a></li>
                <li><a href="faq.html">FAQ</a></li>
                <li><a href="contact.html">Contact</a></li>
                <li><a href="login.html">Login</a></li>
                <li><a href="signup.html">Sign Up</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section id="tickets">
            <div class="container">
                <div class="card">
                    <div class="card-header">Believer</div>
                    <div class="card-body">
                        <h1 class="card-title">50€</h1>
                        <ul>
                            <li>Staging entrance</li>
                            <li>Festival fees</li>
                            <li>Basic help and guidance</li>
                            <li><b>Limitations:</b> Access to general areas only</li>
                        </ul>
                        <button onclick="redirectToLogin()">Purchase Ticket</button>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">Early-Bird</div>
                    <div class="card-body">
                        <h1 class="card-title">70€</h1>
                        <ul>
                            <li>Staging entrance</li>
                            <li>Festival fees</li>
                            <li>Priority help and guidance</li>
                            <li><b>Limitations:</b> Limited access to premium areas</li>
                        </ul>
                        <button onclick="redirectToLogin()">Purchase Ticket</button>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">Regular</div>
                    <div class="card-body">
                        <h1 class="card-title">100€</h1>
                        <ul>                   
                            <li>Staging entrance</li>
                            <li>Festival fees</li>
                            <li>Enhanced help and guidance</li>
                            <li><b>Limitations:</b> Access to most areas, but no VIP access</li>
                        </ul>
                        <button onclick="redirectToLogin()">Purchase Ticket</button>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">VIP</div>
                    <div class="card-body">
                        <h1 class="card-title">200€</h1>
                        <ul>
                            <li>Exclusive staging entrance</li>
                            <li>Festival fees</li>
                            <li>Personalized help and guidance</li>
                            <li><b>Limitations:</b> Unlimited access to all areas, including VIP zones</li>
                        </ul>
                        <button onclick="redirectToLogin()">Purchase Ticket</button>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script>
        function redirectToLogin() {
            window.location.href = "login.html";
        }
    </script>
</body>
</html>