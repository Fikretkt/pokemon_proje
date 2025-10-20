<?php

if ($_SERVER["REQUEST_METHOD"] === 'GET') {
    // GET-Request: Bearbeitungs-Formular anzeigen
    if (!isset($_GET['id']) || empty($_GET['id'])) {
        die("Fehler: Keine gültige ID übergeben. <a href='/pokemon/read'>Zurück zur Liste</a>");
    }
    $pokemon = findByID('pokemon', $_GET['id']);
    if (!$pokemon) {
        die("Fehler: Kein Pokemon mit dieser ID gefunden. <a href='/pokemon/read'>Zurück zur Liste</a>");
    }

    // Daten für Formular vorbereiten
    $id = $pokemon['id'];
    $pokemon_id = $pokemon['pokemon_id'];
    $name = $pokemon['name'];
    $type1 = $pokemon['type1'];
    $type2 = $pokemon['type2'];
    $height_dm = $pokemon['height_dm'];
    $weight_hg = $pokemon['weight_hg'];

    ?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Pokemon bearbeiten</title>
        <link rel="stylesheet" href="/style.css">
    </head>
    <body>
    <div class="container">
        <h1>Pokemon bearbeiten: <?= htmlspecialchars($name) ?></h1>
        <form action='' method='post'>
            <input type='text' name='name' placeholder='Name' value='<?= htmlspecialchars($name) ?>' required>
            <input type='text' name='type1' placeholder='Typ 1' value='<?= htmlspecialchars($type1) ?>' required>
            <input type='text' name='type2' placeholder='Typ 2 (Optional)' value='<?= htmlspecialchars($type2) ?>'>
            <input type='number' step='0.01' name='height_dm' placeholder='Höhe (dm)' value='<?= htmlspecialchars($height_dm) ?>' required>
            <input type='number' step='0.01' name='weight_hg' placeholder='Gewicht (hg)' value='<?= htmlspecialchars($weight_hg) ?>' required>

            <input type='hidden' name='id' value='<?= $id ?>'>
            <input type='submit' value='Aktualisieren'>
        </form>
        <a href='/pokemon/read' class="back-link">Zurück zur Liste</a>
    </div>
    </body>
    </html>

    <?php
}elseif ($_SERVER['REQUEST_METHOD'] === 'POST'){
    // POST-Request: UPDATE durchführen
    $data = [
            'name' => ucwords($_POST['name']),
            'type1' => ucwords($_POST['type1']),
            'type2' => empty($_POST['type2']) ? null : ucwords($_POST['type2']),
            'height_dm' => $_POST['height_dm'],
            'weight_hg' => $_POST['weight_hg'],
    ];

    if (update('pokemon', $_POST['id'], $data)) {
        echo 'Pokemon erfolgreich aktualisiert!';
        echo "<br><a href='/pokemon/read'>Zurück zur Liste</a>";
    } else {
        echo 'Fehler beim Aktualisieren des Pokemons!';
    }
}
?>