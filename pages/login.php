<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prijava</title>
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
                <h2 class="title-about-us">PRIJAVA</h2>
            </div>
            <div class="section-content">
                <p>Prijavite se kako biste pristupili administratorskim funkcijama ili drugim korisničkim opcijama.</p>
            </div>
            <form method="post" action="login_process.php">
                <div class="form-group">
                    <label for="korisnicko_ime">Korisničko ime:</label>
                    <input type="text" class="form-control" id="korisnicko_ime" name="korisnicko_ime">
                </div>
                <div class="form-group-login">
                    <label for="lozinka">Lozinka:</label>
                    <input type="password" class="form-control" id="lozinka" name="lozinka">
                </div>
                <button type="submit" class="btn btn-primary">Prijavi se</button>
            </form>
            <p class="register">Nemate račun? <a href="registracija.php">Registrirajte se.</a></p>
        </div>
    </div>
    <?php include('footer.php'); ?>

</body>

</html>