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
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

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

    // Niz kategorija
    $kategorije = array("Portreti", "Karikature", "Personalizirani sadržaj");

    // Prikaz carousela za svaku kategoriju
    $section_class = array("full-width-bg first-section", "full-width-bg second-section", "full-width-bg third-section");
    $index = 0;
    foreach ($kategorije as $kategorija) {
      $section_class_name = $section_class[$index];
      // SQL upit za dohvat ilustracija određene kategorije
      $sql = "SELECT * FROM ilustracije WHERE kategorija='$kategorija' AND vidljivo=1";
      $result = $conn->query($sql);

      // Provjera jesu li rezultati pronađeni
      if ($result->num_rows > 0) {
        echo "<div class='$section_class_name'>"; // Dodan section class
        echo "<div class='container container-bg'>"; // Dodan container-bg
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
        echo "</div>"; // Zatvori .section class
        $index++;
      } else {
        echo "<div class='$section_class_name'>"; // Dodan section class
        echo "<div class='container container-bg'>"; // Dodan container-bg
        echo "Nema rezultata za odabranu kategoriju.";
        echo "</div>"; // Zatvori .container
        echo "</div>"; // Zatvori .section class
        $index++;
      }
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