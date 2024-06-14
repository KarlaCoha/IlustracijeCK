<?php
// Povezivanje s bazom podataka
$servername = "localhost"; 
$username = "root";
$password = "";
$database = "ilustracije";
$port = 3307;

// Stvaranje veze
$conn = new mysqli($servername, $username, $password, $database, $port);

// Provjera veze
if ($conn->connect_error) {
  die("Neuspješno povezivanje s bazom podataka: " . $conn->connect_error);
}

// Provjera je li forma poslana
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Priprema podataka za unos
  $naslov = $_POST['title'];
  $kratki_opis = $_POST['about'];
  $kategorija = $_POST['category'];
  $vidljivo = isset($_POST['archive']) ? 1 : 0; // Provjera je li checkbox označen
  $slika = $_FILES['pphoto']['name'];

  // Upload slike
  $target_dir = "../images/"; 
  $target_file = $target_dir . basename($_FILES["pphoto"]["name"]);
  move_uploaded_file($_FILES["pphoto"]["tmp_name"], $target_file);

  $result = $conn->query("SELECT MAX(id) AS max_id FROM ilustracije");
  $row = $result->fetch_assoc();
  $max_id = $row["max_id"];
  $new_id = $max_id + 1;

  // Upit za unos podataka s automatski generiranim ID-om
  $stmt = $conn->prepare("INSERT INTO ilustracije (id, naslov, kratki_opis, kategorija, vidljivo, slika) 
                          VALUES (?, ?, ?, ?, ?, ?)");
  
  $stmt->bind_param("isssis", $new_id, $naslov, $kratki_opis, $kategorija, $vidljivo, $target_file);
  
  if ($stmt->execute()) {
    //echo "Novi zapis je uspješno dodan u bazu podataka.";
  } else {
    echo "Greška prilikom unosa zapisa: " . $stmt->error;
  }
}

// Zatvaranje veze s bazom podataka
$conn->close();

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
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>

<body class="custom-body">
  <?php include('navbar.php'); ?>

  <div class="full-width-bg first-section">
    <div class="container">
      <div class="hr-container">
        <span class="hr-title">UNOS ILUSTRACIJE</span>
        <hr class="custom-hr">
      </div>
      <div class="section-content">
        <div class="paragraph-ispis">
          <p>Ovdje možete vidjeti podatke koje ste unijeli prilikom administracijskog dodavanja ilustracije u bazu podataka:</p>
        </div>
      </div>

      <div class="full-width-bg first-section-offer">
        <div class="container">
          <section role="main">
            <div class="script-row">
              <p>NASLOV ILUSTRACIJE : </p>
              <p class="title"><?php echo $_POST['title']; ?></p>
            </div>
            <div>
              <div class="script-row">
                <p>TIP ILUSTRACIJE : </p>
                <p class="category"><?php echo $_POST['category']; ?></p>
              </div>
            </div>
            <div class="script-row">
              <div>
                <p>SLIKA : </p>
                <section class="slika">
                  <img class="custom-img-skripta" src="../images/<?php echo $_FILES["pphoto"]["name"]; ?>">
                </section>
              </div>
            </div>
            <div class="script-row">
              <div>
                <p>KRATKI OPIS :</p>
                <section class="about">
                  <p><?php echo $_POST['about']; ?></p>
                </section>
              </div>
            </div>
          </section>
        </div>
      </div>

      <?php include('footer.php'); ?>

      <script type="text/javascript">
        function validateForm() {
          var slanjeForme = true;

          // Naslov vijesti (5-30 znakova)
          var poljeTitle = document.getElementById("title");
          var title = document.getElementById("title").value;
          if (title.length < 5 || title.length > 30) {
            slanjeForme = false;
            poljeTitle.style.border = "1px solid red";
            document.getElementById("porukaTitle").innerHTML = "Naslov ilustracije mora imati između 5 i 30 znakova!<br>";
          } else {
            poljeTitle.style.border = "1px solid green";
            document.getElementById("porukaTitle").innerHTML = "";
          }

          // Kratki sadržaj (10-100 znakova)
          var poljeAbout = document.getElementById("about");
          var about = document.getElementById("about").value;
          if (about.length < 10 || about.length > 100) {
            slanjeForme = false;
            poljeAbout.style.border = "1px solid red";
            document.getElementById("porukaAbout").innerHTML = "Kratki opis mora imati između 10 i 100 znakova!<br>";
          } else {
            poljeAbout.style.border = "1px solid green";
            document.getElementById("porukaAbout").innerHTML = "";
          }

          // Slika mora biti unesena
          var poljeSlika = document.getElementById("pphoto");
          var pphoto = document.getElementById("pphoto").value;
          if (pphoto.length == 0) {
            slanjeForme = false;
            poljeSlika.style.border = "1px solid red";
            document.getElementById("porukaSlika").innerHTML = "Slika mora biti unesena!<br>";
          } else {
            poljeSlika.style.border = "1px solid green";
            document.getElementById("porukaSlika").innerHTML = "";
          }

          // Kategorija mora biti odabrana
          var poljeCategory = document.getElementById("category");
          if (document.getElementById("category").selectedIndex == 0) {
            slanjeForme = false;
            poljeCategory.style.border = "1px solid red";
            document.getElementById("porukaKategorija").innerHTML = "Kategorija mora biti odabrana!<br>";
          } else {
            poljeCategory.style.border = "1px solid green";
            document.getElementById("porukaKategorija").innerHTML = "";
          }

          // Ako forma nije ok, ne šalji
          if (!slanjeForme) {
            event.preventDefault();
          }

          return slanjeForme;
        }
      </script>
</body>

</html>