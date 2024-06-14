<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pošaljite Upit za Ponudu</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/style.css?v=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>

<body class="send-offer-body">

  <?php include('navbar.php'); ?>

  <main>

    <div class="full-width-bg first-section-offer">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="hr-container">
              <span class="hr-title">ZATRAŽITE PONUDU ZA SVOJU ILUSTRACIJU</span>
              <hr class="custom-hr">
            </div>
            <div class="faq-description">
              <p>Odaberite opcije za vašu ponudu i pošaljite nam zahtjev. Kontaktirat ćemo vas sa cijenom i detaljima narudžbe.</p>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="hr-container">
              <span class="hr-title">FORMAT I OKVIR</span>
              <hr class="custom-hr">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6 text-center">
            <div class="form-group">
              <img src="../images/formati2.jpg" class="img-fluid mb-3" alt="Formati" style="width: 320px;">
              <div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="format" id="formatA5" value="A5">
                  <label class="form-check-label" for="formatA5">A5</label>
                  <input class="form-check-input" type="radio" name="format" id="formatA4" value="A4">
                  <label class="form-check-label" for="formatA4">A4</label>
                  <input class="form-check-input" type="radio" name="format" id="formatA3" value="A3">
                  <label class="form-check-label" for="formatA3">A3</label>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-6 text-center">
            <div class="form-group">
              <img src="../images/okviri.jpg" class="img-fluid mb-3" alt="Okviri" style="width: 320px;">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="okvir" id="okvirBijeli" value="Bijeli">
                <label class="form-check-label" for="okvirBijeli">Bijeli klasični</label>
                <br>
                <input class="form-check-input" type="radio" name="okvir" id="okvirCrni" value="Crni">
                <label class="form-check-label" for="okvirCrni">Crni klasični</label>
              </div>
              <div class="d-none d-lg-block" style="margin-top: 20px;"></div>
              <div class="d-lg-none" style="margin-top: 10px;"></div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="okvir" id="okvirBijeliPaspartu" value="Bijeli s paspartuom">
                <label class="form-check-label" for="okvirBijeliPaspartu">Bijeli s paspartuom</label>
                <br>
                <input class="form-check-input" type="radio" name="okvir" id="okvirCrniPaspartu" value="Crni s paspartuom">
                <label class="form-check-label" for="okvirCrniPaspartu">Crni s paspartuom</label>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="full-width-bg second-section">
      <div class="container"> 
        <div class="col-md-12">
          <div class="hr-container">
            <h2 class="hr-title display-4 text-center">TIP ILUSTRACIJE</h2>
            <hr class="custom-hr">
          </div>
        </div>
        <div class="row">
          <div class="col-md-4 ">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="vrsta" id="portret1" value="Portret">
              <label class="form-check-label" for="portret1">Portret</label>
            </div>
          </div>
          <div class="col-md-4 ">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="vrsta" id="portret2" value="Portret">
              <label class="form-check-label" for="portret2">Apstraktni portret</label>
            </div>
          </div>
          <div class="col-md-4 ">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="vrsta" id="portret3" value="Portret">
              <label class="form-check-label" for="portret3">Karikatura</label>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-4 text-center">
            <img src="../images/slika1.jpg" class="img-fluid-offer mb-3" alt="Slika 1">
          </div>
          <div class="col-md-4 text-center">
            <img src="../images/slika3.jpg" class="img-fluid-offer mb-3" alt="Slika 2">
          </div>
          <div class="col-md-4 text-center">
            <img src="../images/slika2.jpg" class="img-fluid-offer mb-3" alt="Slika 3">
          </div>
        </div>

        <div class="row">
          <div class="col-md-4 ">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="vrsta" id="portret4" value="Portret">
              <label class="form-check-label" for="portret4">Digitalna ilustracija</label>
            </div>
          </div>
          <div class="col-md-4 ">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="vrsta" id="portret5" value="Portret">
              <label class="form-check-label" for="portret5">Minimalistička digitalna ilustracija</label>
            </div>
          </div>
          <div class="col-md-4 ">
            <div class="form-check">
              <input class="form-check-input" type="radio" name="vrsta" id="portret6" value="Portret">
              <label class="form-check-label" for="portret6">U potpunosti personalizirana ilustracija prema željama</label>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-4 text-center">
            <img src="../images/digitalna1.JPG" class="img-fluid-offer mb-3" alt="Slika 4">
          </div>
          <div class="col-md-4 text-center">
            <img src="../images/digitalna2.PNG" class="img-fluid-offer mb-3" alt="Slika 5">
          </div>
          <div class="col-md-4 text-center">
            <img src="../images/personalizirani.jpg" class="img-fluid-offer mb-3" alt="Slika 6">
          </div>
        </div>
      </div>
    </div>



    <div class="full-width-bg third-section-offer">
      <div class="container">
        <div class="hr-container">
          <span class="hr-title">DODATNE INFORMACIJE</span>
          <hr class="custom-hr">
        </div>
        <form>
          <div class="form-group">
            <label for="ime">Ime:</label>
            <input type="text" class="form-control" id="ime" placeholder="Unesite Vaše ime">
          </div>
          <div class="form-group">
            <label for="prezime">Prezime:</label>
            <input type="text" class="form-control" id="ime" placeholder="Unesite Vaše prezime">
          </div>
          <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" class="form-control" id="ime" placeholder="Unesite Vaš e-mail">
          </div>
          <div class="form-group">
            <label for="poruka">Poruka:</label>
            <textarea class="form-control" id="poruka" rows="3" placeholder="Ovdje unesite moguće dodatne informacije ili zahtjeve"></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Pošalji</button>
        </form>
      </div>
    </div>
  </main>


  <?php include('footer.php'); ?>
</body>

</html>