<?php

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Fehler: Keine gültige ID übergeben! <a href='/pokemon/read'>Zurück zur Liste</a>");
}

if (remove('pokemon', $_GET['id'])) {
    echo "Pokemon erfolgreich gelöscht!";
} else {
    echo "Fehler beim Löschen des Pokemons!";
}

echo "<br><a href='/pokemon/read'>Zurück zur Liste</a>";
?>