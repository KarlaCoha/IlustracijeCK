<?php
// Provjeri je li postavljen GET parametar 'kategorija'
if (!isset($_GET['kategorija'])) {
    // Ako nije, preusmjeri korisnika na index.php
    header("Location: index.php");
    exit();
}

// Nastavite s ostalim dijelom koda za prikaz odabrane kategorije
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Stranica</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css?v=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
</head>

<body>

    <?php include('navbar.php'); ?>

    <!-- Main content -->
    <main>
        <?php
        // Povezivanje s bazom podataka
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "ilustracije";
        $port = 3307;

        $conn = new mysqli($servername, $username, $password, $database, $port);

        // Provjera veze s bazom podataka
        if ($conn->connect_error) {
            die("Neuspjelo spajanje na bazu podataka: " . $conn->connect_error);
        }

        
        // Provera da li je postavljen GET parametar 'kategorija'
        if (isset($_GET['kategorija'])) {
            $kategorija = $_GET['kategorija'];

            // SQL upit za dohvat ilustracija određene kategorije
            $sql = "SELECT * FROM ilustracije WHERE kategorija='$kategorija' AND vidljivo=1";
            $result = $conn->query($sql);

            // Provjera jesu li rezultati pronađeni
            if ($result->num_rows > 0) {
                echo "<div class='custom-header'>";
                echo "<div class='container'>";
                echo "<div class='hr-container'>";
                echo "<span class='hr-title'>" . strtoupper($kategorija) . "</span>";
                echo "<hr class='custom-hr'>";
                echo "</div>";
                echo "<div id='carousel_$kategorija' class='carousel slide' data-ride='carousel'>";
                echo "<div class='carousel-inner'>";

                // Inicijalizacija brojača za kontrolu prikaza slika u redu
                $counter = 0;

                while ($row = $result->fetch_assoc()) {
                    // Otvori novi red svakih 3 slike
                    if ($counter % 3 === 0) {
                        echo "<div class='carousel-item" . ($counter === 0 ? " active" : "") . "'>";
                        echo "<div class='row'>"; // Dodaj red unutar carousel-item
                    }

                    echo "<div class='col-md-4'>";
                    echo "<div class='d-flex flex-column'>";
                    echo "<a href='clanak.php?id=" . $row['id'] . "'>";
                    echo "<img src='" . $row['slika'] . "' class='d-block w-100' alt='" . $row['naslov'] . "'>";
                    echo "</a>";
                    echo "<h4 class='mt-2'>" . $row['naslov'] . "</h4>";
                    echo "<p>" . $row['kratki_opis'] . "</p>";
                    echo "</div>";
                    echo "</div>";

                    // Zatvori red nakon svake treće slike
                    if ($counter % 3 === 2) {
                        echo "</div>"; // Zatvori .row
                        echo "</div>"; // Zatvori .carousel-item
                    }

                    $counter++;
                }

                // Zatvori zadnji .carousel-item ako nije već zatvoren
                if ($counter % 3 !== 0) {
                    echo "</div>"; // Zatvori .row
                    echo "</div>"; // Zatvori .carousel-item
                }

                echo "</div>"; // Zatvori .carousel-inner
                echo "<a class='carousel-control-prev' href='#carousel_$kategorija' role='button' data-slide='prev'>";
                echo "<span class='carousel-control-prev-icon' aria-hidden='true'></span>";
                echo "<span class='sr-only'>Previous</span>";
                echo "</a>";
                echo "<a class='carousel-control-next' href='#carousel_$kategorija' role='button' data-slide='next'>";
                echo "<span class='carousel-control-next-icon' aria-hidden='true'></span>";
                echo "<span class='sr-only'>Next</span>";
                echo "</a>";
                echo "</div>"; // Zatvori #carousel_$kategorija
                echo "</div>"; // Zatvori .container
                echo "</div>"; // Zatvori .full-width-bg
            } else {
                echo "Nema rezultata za odabranu kategoriju.";
            }
        } else {
            echo "Kategorija nije odabrana.";
        }

        // Zatvaranje veze s bazom podataka
        $conn->close();
        ?>
    </main>

    <?php include('footer.php'); ?>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $('.carousel').carousel({
            interval: 3000
        });
    </script>
</body>

</html>
