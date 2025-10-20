<?php

if ($_SERVER["REQUEST_METHOD"] === 'GET'){
    // GET-Request: Formular anzeigen
    ?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Pokemon erstellen</title>
        <link rel="stylesheet" href="/style.css">
    </head>
    <body>
    <div class="container">
        <h1>Neues Pokemon manuell hinzufügen</h1>
        <form action='' method='post'>
            <input type='number' name='pokemon_id' placeholder='Pokemon ID (z.B. 1)' required>
            <input type='text' name='name' placeholder='Name (z.B. Bulbasaur)' required>
            <input type='text' name='type1' placeholder='Typ 1 (z.B. Grass)' required>
            <input type='text' name='type2' placeholder='Typ 2 (Optional, z.B. Poison)'>
            <input type='number' step='0.01' name='height_dm' placeholder='Höhe in Dezimetern (z.B. 7)' required>
            <input type='number' step='0.01' name='weight_hg' placeholder='Gewicht in Hektogramm (z.B. 69)' required>
            <input type='submit' value='Pokemon erstellen'>
        </form>
        <a href='/pokemon/read' class="back-link">Zurück zur Liste</a>
    </div>
    </body>
    </html>

    <?php
}elseif ($_SERVER['REQUEST_METHOD'] === 'POST'){
    // POST-Request: Pokemon in DB speichern
    $data = [
            'pokemon_id' => $_POST['pokemon_id'],
            'name' => ucwords($_POST['name']),
            'type1' => ucwords($_POST['type1']),
            'type2' => empty($_POST['type2']) ? null : ucwords($_POST['type2']),
            'height_dm' => $_POST['height_dm'],
            'weight_hg' => $_POST['weight_hg'],
    ];

    if (create('pokemon', $data)) {
        echo 'Pokemon wurde erfolgreich erstellt!';
        echo "<br><a href='/pokemon/read'>Zurück zur Liste</a>";
    } else {
        echo 'Fehler beim Erstellen des Pokemons! (Ist die ID schon vorhanden?)';
    }
}
?>