<?php
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

// Provjera primljenih parametara
if (isset($_GET['id']) && isset($_GET['field']) && isset($_GET['value'])) {
    $id = intval($_GET['id']);
    $field = $_GET['field'];
    $value = $_GET['value'];

    // Popis dozvoljenih polja za ažuriranje
    $allowed_fields = ['naslov', 'kratki_opis', 'kategorija'];

    if (in_array($field, $allowed_fields)) {
        // Priprema SQL upita
        $sql = "UPDATE ilustracije SET $field = ? WHERE id = ?";
        
        // Priprema upita
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $value, $id);

        // Izvršavanje SQL upita
        if ($stmt->execute() === TRUE) {
            // Uspješno ažurirano
            http_response_code(200);
            echo "Uspješno ažurirano.";
        } else {
            // Greška pri ažuriranju
            http_response_code(500);
            echo "Greška pri ažuriranju: " . $stmt->error;
        }

        // Zatvaranje statementa
        $stmt->close();
    } else {
        // Nedozvoljeno polje
        http_response_code(400);
        echo "Nedozvoljeno polje.";
    }
} else {
    // Nedostaju parametri
    http_response_code(400);
    echo "Nedostaju parametri za ažuriranje.";
}

// Zatvaranje veze s bazom podataka
$conn->close();
?>
