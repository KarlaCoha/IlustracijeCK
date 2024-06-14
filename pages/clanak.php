<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Članak</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/style.css?v=1.0">
</head>

<body>

  <?php include('navbar.php'); ?>

  <main>
  <?php
    // Provjera postojanja ID-a u URL-u
    if (isset($_GET['id'])) {
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

      $id = $_GET['id'];

      // SQL upit za dohvat podataka o odabranoj ilustr koristeći pstmt
      $stmt = $conn->prepare("SELECT * FROM ilustracije WHERE id = ?");
      $stmt->bind_param("i", $id);
      $stmt->execute();
      $result = $stmt->get_result();

      // Provjera jesu li rezultati pronađeni
      if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    ?>

        <div class="full-width-bg first-section-offer">
          <div class="container">
            <div class="row">
              <div class="col-md-6">
                <img src="<?php echo htmlspecialchars($row['slika']); ?>" class="img-fluid" alt="<?php echo htmlspecialchars($row['naslov']); ?>">
              </div>
              <div class="col-md-6">
                <h2><?php echo htmlspecialchars($row['naslov']); ?></h2>
                <p><?php echo htmlspecialchars($row['kratki_opis']); ?></p>
              </div>
            </div>
          </div>
        </div>
    <?php
      } else {
        echo "Nema rezultata za prikaz.";
      }

      // Zatvaranje pstmt i veze s bazom podataka
      $stmt->close();
      $conn->close();
    } else {
      echo "ID nije pronađen u URL-u.";
    }
    ?>
  </main>

  <?php include('footer.php'); ?>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>