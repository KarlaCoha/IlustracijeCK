<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registracija</title>
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
                <h2 class="title-about-us">REGISTRACIJA</h2>
            </div>
            <div class="section-content">
                <p>Registrirajte se kako biste pristupili svim funkcijama našeg portala.</p>
            </div>
            <form method="post" action="registration_process.php">
                <div class="form-group">
                    <label for="ime">Ime:</label>
                    <input type="text" class="form-control" id="ime" name="ime" required>
                </div>
                <div class="form-group">
                    <label for="prezime">Prezime:</label>
                    <input type="text" class="form-control" id="prezime" name="prezime" required>
                </div>
                <div class="form-group">
                    <label for="korisnicko_ime">Korisničko ime:</label>
                    <input type="text" class="form-control" id="korisnicko_ime" name="korisnicko_ime" required>
                </div>
                <div class="form-group">
                    <label for="lozinka">Lozinka:</label>
                    <input type="password" class="form-control" id="lozinka" name="lozinka" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="administratorska_prava">Administratorska prava:</label>
                    <select class="form-control" id="administratorska_prava" name="administratorska_prava" required>
                        <option value="1">Da</option>
                        <option value="0">Ne</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Registriraj se</button>
            </form>
            <p class="register">Već imate račun? <a href="login.php">Prijavite se.</a></p>
        </div>
    </div>

    <?php include('footer.php'); ?>

</body>

</html>
