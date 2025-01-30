<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Line-Up | Omni Festival</title>
    <link rel="stylesheet" href="style/lineup.css">
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
        <section class="lineup-header">
            <h1>Line-Up</h1>
            <p>Omni Festival returns in 2025 with the coolest line-up in the region. Full Line-Up listed below.</p>
        </section>
        <section class="lineup-date">
            <h2>5 August, 2025.</h2>
            <div class="artists">
                <div class="artist">
                    <img src="Artists/CalvinHarris.png" alt="Calvin Harris">
                    <p>Calvin Harris</p>
                </div>
                <div class="artist">
                    <img src="Artists/CapitalT.png" alt="Capital T">
                    <p>Capital T</p>
                </div>
                <div class="artist">
                    <img src="Artists/DafinaZeqiri.png" alt="Dafina Zeqiri">
                    <p>Dafina Zeqiri</p>
                </div>
                <div class="artist">
                    <img src="Artists/YllLimani.jpg" alt="Yll Limani">
                    <p>Yll Limani</p>
                </div>
                <div class="artist">
                    <img src="Artists/DuaLipa.png" alt="Dua Lipa">
                    <p>Dua Lipa</p>
                </div>
                <div class="artist">
                    <img src="Artists/ElvanaGjata.png" alt="Elvana Gjata">
                    <p>Elvana Gjata</p>
                </div>
                <div class="artist">
                    <img src="Artists/MartinGarrix.png" alt="Martin Garrix">
                    <p>Martin Garrix</p>
                </div>
                <div class="artist">
                    <img src="Artists/TaylorSwift.png" alt="Taylor Swift">
                    <p>Taylor Swift</p>
                </div>
                <section class="lineup-date">
                    <h2>6 August, 2025.</h2>
                    <div class="artists">
                        <div class="artist">
                            <img src="Artists/BebeRexha.jpg" alt="Bebe Rexha">
                            <p>Bebe Rexha</p>
                        </div>
                        <div class="artist">
                            <img src="Artists/Azet.jpg" alt="Azet">
                            <p>Azet</p>
                        </div>
                        <div class="artist">
                            <img src="Artists/EdSheeran.webp" alt="Ed Sheeran">
                            <p>Ed Sheeran</p>
                        </div>
                        <div class="artist">
                            <img src="Artists/DjgimiO.jpg" alt="Dj Gimi-O">
                            <p>Dj Gimi-O</p>
                        </div>
                        <div class="artist">
                            <img src="Artists/Gashi.jpg" alt="Gashi">
                            <p>Gashi</p>
                        </div>
                        <div class="artist">
                            <img src="Artists/LedriVula.jpg" alt="Ledri Vula">
                            <p>Ledri Vula</p>
                        </div>
                        <div class="artist">
                            <img src="Artists/Kida.png" alt="Kida">
                            <p>Kida</p>
                        </div>
                        <div class="artist">
                            <img src="Artists/MileyCyrus.jpg" alt="Miley Cyrus">
                            <p>Miley Cyrus</p>
                        </div>
                        <section class="lineup-date">
                            <h2>7 August, 2025.</h2>
                            <div class="artists">
                                <div class="artist">
                                    <img src="Artists/RitaOra.webp" alt="Rita Ora">
                                    <p>Rita Ora</p>
                                </div>
                                <div class="artist">
                                    <img src="Artists/ButrintImeri.jpg" alt="Butrint Imeri">
                                    <p>Butrint Imeri</p>
                                </div>
                                <div class="artist">
                                    <img src="Artists/DjPm&Dagz.jpg" alt="Dj PM & Dagz">
                                    <p>Dj PM & Dagz</p>
                                </div>
                                <div class="artist">
                                    <img src="Artists/McKresha.jpg" alt="McKresha">
                                    <p>McKresha</p>
                                </div>
                                <div class="artist">
                                    <img src="Artists/LyricalSon.jpg" alt="Lyrical Son">
                                    <p>Lyrical Son</p>
                                </div>
                                <div class="artist">
                                    <img src="Artists/Tayna.jpg" alt="Tayna">
                                    <p>Tayna</p>
                                </div>
                                <div class="artist">
                                    <img src="Artists/Lluni.webp" alt="Lluni">
                                    <p>Lluni</p>
                                </div>
                                <div class="artist">
                                    <img src="Artists/DonXhoni.jpg" alt="Don Xhoni">
                                    <p>Don Xhoni</p>
                                </div>
            </div>
        </section>
    </main>
</body>
</html>
