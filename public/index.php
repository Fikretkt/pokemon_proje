<?php
// database funktion einmal hier laden für alle dateien
require_once '../config/loader.php';

// URL in einzelteile aufteilen
$request = explode('/', $_SERVER["REQUEST_URI"]);

// ... [Diğer değişken tanımlamaları aynı kalır] ...
$entity = $request[1] ?? "";
$method = $request[2] ?? null;
$id = $request[3] ?? null;
if ($id) {
    $_GET['id'] = $id;
}
// ...

// routing: entscheiden welche datei geladen wird
switch ($entity) {
    case 'pokemon':
        // Pokemon Bereich
        switch ($method) {
            case 'create':
                require '../src/pokemon/create.php';
                break;
            case 'read':
                require '../src/pokemon/read.php';
                break;
            case 'update':
                require '../src/pokemon/update.php';
                break;
            case 'delete':
                require '../src/pokemon/delete.php';
                break;
            default:
                http_response_code(404);
                echo "404 - NOT FOUND";
        }
        break;

    case '':
        // leere url = homepage
        require '../index.php';
        break;

    default:
        http_response_code(404);
        echo "404 - NOT FOUND";
}
?>