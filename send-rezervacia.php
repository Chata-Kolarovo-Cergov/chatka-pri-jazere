<?php
// Získanie údajov z formulára
$name = $_POST['name'];
$email = $_POST['email'];
$checkin = $_POST['check-in'];
$checkout = $_POST['check-out'];
$guests = $_POST['guests'];
$telefon = $_POST['telefón'];
$poznamka = $_POST['poznamka'];

// ----------------------
// E-MAIL MAJITEĽOVI
// ----------------------
$to_owner = "tvojemail@domena.sk"; // <- TU ZADAJ TVOJ EMAIL
$subject_owner = "Nová rezervácia z webu";
$message_owner = "
Bola odoslaná nová rezervácia:

Meno: $name
Email: $email
Telefón: $telefon
Check-in: $checkin
Check-out: $checkout
Počet osôb: $guests
Poznámka: $poznamka
";

$headers_owner = "From: noreply@tvojweb.sk";

// Pošli email majiteľovi
mail($to_owner, $subject_owner, $message_owner, $headers_owner);

// ----------------------
// POTVRDENIE ZÁKAZNÍKOVI
// ----------------------
$subject_client = "Potvrdenie rezervácie - Chatka pri jazere";
$message_client = "
Dobrý deň, $name,

ďakujeme za vašu rezerváciu chatky pri jazere.

Detaily vašej rezervácie:
Check-in: $checkin
Check-out: $checkout
Počet osôb: $guests

Čoskoro sa vám ozveme telefonicky alebo e-mailom. 
Tešíme sa na vašu návštevu!

S pozdravom,
Chatka pri jazere
";

$headers_client = "From: info@tvojweb.sk";

// Pošli email zákazníkovi
mail($email, $subject_client, $message_client, $headers_client);

// ----------------------
// POTVRDENIE NA STRÁNKE
// ----------------------
echo "<!DOCTYPE html>
<html lang='sk'>
<head>
  <meta charset='UTF-8'>
  <title>Rezervácia odoslaná</title>
</head>
<body>
  <h2>Ďakujeme, rezervácia bola odoslaná.</h2>
  <p>Poslali sme vám potvrdenie na e-mail: $email</p>
  <a href='index.html'>Späť na domovskú stránku</a>
</body>
</html>";
?>
