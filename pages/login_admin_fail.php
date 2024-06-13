<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uspješna Registracija</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css?v=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>

<body>
    <?php include('navbar.php'); ?>

    <div class="about-us-section second-section">
        <div class="container">
            <div class="section-header o-nama">
                <h2 class="title-about-us">Neuspješna prijava</h2>
            </div>
            <div class="section-content-r">
                <?php
                session_start();
                if (isset($_SESSION['ime'])) {
                    $ime = $_SESSION['ime'];
                    echo "<p>Pozdrav, $ime. Nemate pravo pristupa administratorskoj stranici.</p>";
                } else {
                    echo "<p>Nemate pravo pristupa administratorskoj stranici.</p>";
                }
                ?>
                <p><a href='index.php'>Povratak na početnu stranicu.</a></p>
            </div>
        </div>
    </div>

    <?php include('footer.php'); ?>
</body>

</html>