<?php
session_start();

// Spajanje na bazu podataka
$servername = "localhost"; // Promijenite ovo prema vašem MySQL serveru
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

// Provjera prijave i administratorskih prava
if (!isset($_SESSION['korisnicko_ime'])) {
    header("Location: login.php?error=Morate se prijaviti.");
    exit();
}

if ($_SESSION['administratorska_prava'] != 1) {
    $ime = $_SESSION['ime'];
    die("<p>$ime, nemate pravo pristupa ovoj stranici. <a href='index.php'>Povratak na početnu stranicu</a></p>");
}

// Brisanje ilustracije ako je zahtjev poslan
if (isset($_GET['delete_id'])) {
  $stmt = $conn->prepare("DELETE FROM ilustracije WHERE id = ?");
  $stmt->bind_param("i", $_GET['delete_id']); // "i" označava integer
  $stmt->execute();
  $stmt->close();
}

// Dohvat svih ilustracija iz baze podataka
$sql = "SELECT * FROM ilustracije";
$result = $conn->query($sql);
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

<body>

    <?php include('navbar.php'); ?>

    <div class="about-us-section second-section">
        <div class="container">


            <div class="section-header o-nama">
                <h2 class="title-about-us">ADMINISTRATORSKA STRANICA</h2>
            </div>
            <p>Popis ilustracija u našoj bazi podataka:</p>
            <div class="chat-container-admin">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Naslov</th>
                            <th>Kratki opis</th>
                            <th>Kategorija</th>
                            <th>Slika</th>
                            <th>Akcije</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()) : ?>
                            <tr id="row_<?php echo $row['id']; ?>">
                                <td class="editable" onclick="editField(this, 'naslov', <?php echo $row['id']; ?>)"><?php echo $row['naslov']; ?></td>
                                <td class="editable" onclick="editField(this, 'kratki_opis', <?php echo $row['id']; ?>)"><?php echo $row['kratki_opis']; ?></td>
                                <td class="editable" onclick="editField(this, 'kategorija', <?php echo $row['id']; ?>)"><?php echo $row['kategorija']; ?></td>
                                <td><img src="<?php echo $row['slika']; ?>" alt="Ilustracija" style="max-width: 100px;"></td>
                                <td>
                                    <div>
                                    <a class="btn-primary-admin" href="administrator.php?delete_id=<?php echo $row['id']; ?>">Izbriši</a>
                                    </div>
                                    <div>
                                        <button class="btn-primary-admin" href="#" onclick="editRow(<?php echo $row['id']; ?>)">Uredi</button>
                                    </div>
                                    <div>
                                        <button class="btn-primary-admin" onclick="saveRow(<?php echo $row['id']; ?>)">Spremi</button>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="edit-illustration-form" style="display: none;"></div>

    <script>
        function saveRow(id) {
            var row = document.getElementById('row_' + id);
            var cells = row.getElementsByTagName('td');

            for (var i = 0; i < cells.length - 2; i++) {
                var cell = cells[i];
                var input = cell.querySelector('input[type="text"]');
                if (input) {
                    var value = input.value.trim();
                    var field = input.getAttribute('data-field');

                    // AJAX poziv za spremanje promjena u bazi podataka
                    var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            // Ažurirajte prikaz u ćeliji tablice
                            cell.innerText = value;
                        }
                    };
                    xhttp.open("GET", "update_field.php?id=" + id + "&field=" + field + "&value=" + value, true);
                    xhttp.send();
                }
            }

            // Završi uređivanje nakon što su promjene spremljene
            exitEditMode(row);
        }

        function exitEditMode(row) {
            var cells = row.getElementsByTagName('td');
            for (var i = 0; i < cells.length - 2; i++) {
                var cell = cells[i];
                var input = cell.querySelector('input[type="text"]');
                if (input) {
                    var value = input.value.trim();
                    cell.innerText = value;
                }
            }
        }

        function editRow(id) {
            var row = document.getElementById('row_' + id);
            var cells = row.getElementsByTagName('td');

            for (var i = 0; i < cells.length - 2; i++) {
                var cell = cells[i];
                var value = cell.innerText.trim();
                var input = document.createElement('input');
                input.setAttribute('type', 'text');
                input.setAttribute('value', value);
                input.setAttribute('data-field', cell.className.includes('editable') ? cell.className.split(' ')[0] : '');
                input.setAttribute('data-id', id);
                input.setAttribute('onblur', 'saveField(this)');
                cell.innerHTML = '';
                cell.appendChild(input);
            }
        }

        function editField(element, field, id) {
            var value = element.innerText.trim();
            var input = document.createElement('input');
            input.setAttribute('type', 'text');
            input.setAttribute('value', value);
            input.setAttribute('data-field', field);
            input.setAttribute('data-id', id);
            input.setAttribute('onblur', 'saveField(this)');
            element.innerHTML = '';
            element.appendChild(input);
            input.focus();
        }

        function saveField(input) {
            var field = input.getAttribute('data-field');
            var id = input.getAttribute('data-id');
            var value = input.value.trim();

            // AJAX poziv za ažuriranje polja u bazi podataka
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    input.parentNode.innerText = value;
                }
            };
            xhttp.open("GET", "update_field.php?id=" + id + "&field=" + field + "&value=" + value, true);
            xhttp.send();
        }
    </script>

<div class="about-us-section second-section">
    <div class="container">
      <div class="section-header o-nama">
        <h2 class="title-about-us">UNOS NOVOSTI</h2>
      </div>
      <p>Ovdje možete dodati novu vijest koja će privući pažnju posjetitelja. Vaši unosi su ključni za obogaćivanje naše ponude i omogućuju nam da predstavimo najnovije vijesti i informacije. Hvala vam na trudu i doprinosu koji čini našu stranicu posebnom.</p>

      <!-- Poruka o grešci -->
      <div id="errorMessage" class="alert alert-danger d-none" role="alert">
        Molimo ispravite sljedeće greške:
        <ul id="errorList"></ul>
      </div>

      <div class="container">
        <form enctype="multipart/form-data" action="skripta.php" method="POST" id="myForm" onsubmit="return validateForm()">
          <div class="form-item">
            <span id="porukaTitle" class="bojaPoruke"></span>
            <label for="title">NASLOV ILUSTRACIJE</label>
            <div class="form-field">
              <input type="text" name="title" id="title" class="form field-textual">
            </div>
          </div>
          <div class="form-item">
            <span id="porukaAbout" class="bojaPoruke"></span>
            <label for="about">KRATKI OPIS ILUSTRACIJE (do 50 znakova)</label>
            <div class="form-field">
              <textarea name="about" id="about" cols="30" rows="10" class="form-field-textual"></textarea>
            </div>
          </div>
          <div class="form-item">
            <span id="porukaSlika" class="bojaPoruke"></span>
            <label for="pphoto">SLIKA: </label>
            <div class="form-field">
              <input type="file" class="input-text" id="pphoto" name="pphoto" />
            </div>
          </div>
          <div class="form-item">
            <span id="porukaKategorija" class="bojaPoruke"></span>
            <label for="category">TIP ILUSTRACIJE</label>
            <div class="form-field">
              <select name="category" id="category" class="form-field textual">
                <option value="" disabled selected>ODABIR KATEGORIJE</option>
                <option value="Portreti">Portreti</option>
                <option value="Karikature">Karikature</option>
                <option value="Personalizirani sadržaj">Personalizirani sadržaj</option>
              </select>
            </div>
          </div>
          <div class="form-item">
            <label>SPREMITI KAO VIDLJIVO:
              <div class="form-field">
                <input type="checkbox" name="archive" id="archive">
              </div>
            </label>
          </div>
          <div class="form-item">
            <button type="submit" value="Prihvati" id="slanje" class="btn-primary">Spremi</button>
            <button type="reset" value="Poništi" class="btn-primary">Poništi</button>
          </div>
        </form>
      </div>
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

      // Ako forma nije ispravna, spriječi slanje
      if (!slanjeForme) {
        event.preventDefault();
      }

      return slanjeForme;
    }
  </script>
</body>

</html>

<?php
// Zatvaranje veze s bazom podataka
$conn->close();
?>