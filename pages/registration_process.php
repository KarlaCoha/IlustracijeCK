<?php
session_start();

// Spajanje na bazu podataka
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

// Prijava korisnika
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Podaci iz obrasca
    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];
    $korisnicko_ime = $_POST['korisnicko_ime'];
    $lozinka = $_POST['lozinka'];
    $email = $_POST['email'];
    $administratorska_prava = $_POST['administratorska_prava'];

    // Provjeri vrijednost administratorskih prava
    $administratorska_prava = ($administratorska_prava == '1') ? 1 : 0;

    // Stmt za unos korisnika
    $stmt = $conn->prepare("INSERT INTO korisnik (ime, prezime, korisnicko_ime, lozinka, email, administratorska_prava) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssi", $ime, $prezime, $korisnicko_ime, $hashed_password, $email, $administratorska_prava);

    // Hashiranje lozinke
    $hashed_password = password_hash($lozinka, PASSWORD_DEFAULT);

    // Izvršavanje stmt
    if ($stmt->execute()) {
        header("Location: registration_success.php");
        exit();
    } else {
        $registration_message = "Greška prilikom registracije: " . $stmt->error;
    }

    // Zatvaranje pstmt
    $stmt->close();
}

// Zatvaranje veze 
$conn->close();
?>
