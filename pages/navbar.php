<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <!-- Dodajte ikone Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <div class="custom-header">
        <div class="container d-flex justify-content-between align-items-center">
            <img src="../images/logo-kraj.png" alt="Logo" class="logo">
            <nav class="navbar navbar-expand-lg navbar-light">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="nav-home" role="button" aria-haspopup="true" aria-expanded="false">NASLOVNICA</a>
                        <div class="dropdown-menu" aria-labelledby="nav-home">
                            <a class="dropdown-item" href="index.php">SVE KATEGORIJE</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="kategorija.php?kategorija=Portreti">PORTRETI</a>
                            <a class="dropdown-item" href="kategorija.php?kategorija=Karikature">KARIKATURE</a>
                            <a class="dropdown-item" href="kategorija.php?kategorija=Personalizirani%20sadržaj">PERSONALIZIRANI SADRŽAJ</a>

                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about_us.php" id="nav-about">O NAMA</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="faq.php" id="nav-faq">ČESTA PITANJA</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="send_offer.php" id="nav-offer">ZATRAŽI PONUDU</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php" id="nav-offer">ADMINISTRACIJA</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script>
        // JavaScript za otvaranje dropdown-a na hover
        $(document).ready(function() {
            $('.dropdown').hover(function() {
                $(this).find('.dropdown-menu').stop(true, true).delay(100).fadeIn(300);
            }, function() {
                $(this).find('.dropdown-menu').stop(true, true).delay(100).fadeOut(300);
            });
        });
    </script>
</body>