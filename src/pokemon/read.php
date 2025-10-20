<?php
// createTable fonksiyonu artık src/utils/html_utils.php'den yükleniyor.

// Daten aus der lokalen Datenbank laden
$pokemon_data = findAll('pokemon');

?>

<!doctype html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <title>Pokemon Übersicht</title>
    <link rel="stylesheet" href="/style.css">
</head>
<body>
<div class="container">
    <h1 class="page-title">Lokale Pokemon Datenbank</h1>
    <?= createTable($pokemon_data, 'pokemon') ?>
    <br>
    <a href='/pokemon/create' class="create-link">Neues Pokemon manuell hinzufügen</a>
    <a href='/' class="back-link">Zurück zur Startseite</a>
</div>
</body>
</html>