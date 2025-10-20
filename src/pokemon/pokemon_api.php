<?php
/**
 * Hilfsfunktionen für die Pokemon-API und Dateninitialisierung
 */

/**
 * Ruft eine bestimmte Anzahl von Pokemon von der PokeAPI ab und speichert sie in der lokalen Datenbank.
 * @param int $limit - Anzahl der abzurufenden Pokemon
 * @return array|false - Array der gespeicherten IDs oder false bei Fehler
 */
function seedPokemonData(int $limit = 20): array|false
{
    $stored_ids = [];

    // 1. Hole die Liste der Pokemon
    $list_url = "https://pokeapi.co/api/v2/pokemon?limit={$limit}";
    $list_response = @file_get_contents($list_url);

    if ($list_response === FALSE) {
        return false;
    }

    $pokemon_list = json_decode($list_response, true)['results'];

    foreach ($pokemon_list as $p) {
        // 2. Hole Details für jedes Pokemon
        $detail_response = @file_get_contents($p['url']);

        if ($detail_response === FALSE) {
            continue;
        }

        $details = json_decode($detail_response, true);

        // 3. Daten für die lokale DB vorbereiten
        $data = [
            'pokemon_id' => $details['id'],
            'name'       => ucwords($details['name']),
            'type1'      => ucwords($details['types'][0]['type']['name']),
            'type2'      => $details['types'][1]['type']['name'] ?? null, 
            'height_dm'  => $details['height'],
            'weight_hg'  => $details['weight'],
        ];

        // 4. Lokale Daten erstellen (CRUD-Funktion)
        // create('pokemon', $data) fonksiyonu database.php'den gelmektedir.
        if (create('pokemon', $data)) {
            $stored_ids[] = $details['id'];
        }
    }

    return $stored_ids;
}

/**
 * Prüft, ob die 'pokemon' Tabelle leer ist und initialisiert sie gegebenenfalls.
 * @return void
 */
function checkAndSeedDatabase() {
    $data = findAll('pokemon');
    // Eğer tabloda hiç kayıt yoksa, ilk 20 Pokemon'u çek
    if (empty($data)) {
        seedPokemonData(20); 
    }
}
// Skript wird ausgeführt, sobald es geladen wird
checkAndSeedDatabase();

?>