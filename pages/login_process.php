<?php
session_start();

// Spajanje na bazu podataka
$servername = "localhost";
$username = "root";
$password = "";
$database = "ilustracije";
$port = 3307;

$conn = new mysqli($servername, $username, $password, $database, $port);

// Provjera veze
if ($conn->connect_error) {
    die("Neuspješno povezivanje s bazom podataka: " . $conn->connect_error);
}

// Prijava korisnika
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $korisnicko_ime = $_POST['korisnicko_ime'];
    $lozinka = $_POST['lozinka'];

    // Priprema SQL upita koristeći prepared statement
    $sql = "SELECT * FROM korisnik WHERE korisnicko_ime = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $korisnicko_ime);
    $stmt->execute();
    $result = $stmt->get_result();
    // Prilikom registracije ili ažuriranja lozinke
$hashed_password = password_hash($unhashed_password, PASSWORD_DEFAULT);
// Spremanje $hashed_password u bazu umjesto $unhashed_password


    // Provjera rezultata upita
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        // Provjera lozinke
        if (password_verify($lozinka, $row['lozinka'])) {
            // Postavi sesijske varijable
            $_SESSION['korisnik_id'] = $row['id'];
            $_SESSION['korisnicko_ime'] = $korisnicko_ime;
            $_SESSION['ime'] = $row['ime'];
            $_SESSION['prezime'] = $row['prezime'];
            $_SESSION['administratorska_prava'] = $row['administratorska_prava'];

            // Provjera administratorskih prava
            if ($row['administratorska_prava'] == 1) {
                header("Location: administrator.php");
                exit();
            } else {
                header("Location: login_admin_fail.php");
                exit();
            }
        } else {
            header("Location: login_incorrect.php");
            exit();
        }
    } else {
        header("Location: login_failed.php");
        exit();
    }

    // Zatvaranje prepared statementa
    $stmt->close();
}

// Zatvaranje veze s bazom podataka
$conn->close();
?>
