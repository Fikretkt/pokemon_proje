<?php
// Bu dosya, tüm CRUD (Create, Read, Update, Delete) fonksiyonlarını içerir ve MUTLAKA gereklidir.

// === KONFIGURATION ===
// Konfigürasyonlar (DB_HOST, DB_NAME, vs.) config/config.php'den yüklenmektedir.

// Veritabanı bağlantı fonksiyonu
function dbcon(string $host = DB_HOST, string $dbname = DB_NAME, string $dbuser = DB_USER, string $dbpass = DB_PASS): PDO
{
    $dsn = "mysql:host={$host};dbname={$dbname}";
    // Profesyonel Hata Yönetimi ve Ayarlar:
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Hataları istisna (Exception) olarak at
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Varsayılan fetch modunu assoc yap
        PDO::ATTR_EMULATE_PREPARES   => false,                  // Native Prepared Statements kullan
    ];
    $conn = new PDO($dsn, $dbuser, $dbpass, $options);
    return $conn;
}

// === CRUD FUNKTIONEN ===

/**
 * Alle datensätze aus einer tabelle holen
 */
function findAll(string $table): array
{
    $conn = dbcon();
    $sql = "SELECT * FROM {$table}";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Einen datensatz löschen
 */
function remove(string $table, int $id): bool
{
    try {
        $conn = dbcon();
        $sql = "DELETE FROM {$table} WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    } catch (Exception $e) {
        return false;
    }
}

/**
 * Neuen datensatz erstellen
 */
function create(string $table, array $data): bool
{
    try {
        $conn = dbcon();

        // spalten und platzhalter generieren
        $columns = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));

        $sql = "INSERT INTO {$table} ({$columns}) VALUES ({$placeholders})";
        $stmt = $conn->prepare($sql);

        // parameter binden
        foreach ($data as $key => $value) {
            $stmt->bindValue(":{$key}", $value);
        }

        return $stmt->execute();
    } catch (Exception $e) {
        return false;
    }
}

/**
 * Einen datensatz anhand der ID finden
 */
function findByID(string $table, int $id): ?array
{
    $conn = dbcon();
    $sql = "SELECT * FROM {$table} WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result ?: null;
}

/**
 * Einen datensatz aktualisieren
 */
function update(string $table, int $id, array $data): bool
{
    try {
        $conn = dbcon();

        // SET teil generieren: fname = :fname, lname = :lname
        $setParts = [];
        foreach (array_keys($data) as $column) {
            $setParts[] = "{$column} = :{$column}";
        }
        $setClause = implode(', ', $setParts);

        $sql = "UPDATE {$table} SET {$setClause} WHERE id = :id";
        $stmt = $conn->prepare($sql);

        // parameter binden
        foreach ($data as $key => $value) {
            $stmt->bindValue(":{$key}", $value);
        }
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    } catch (Exception $e) {
        return false;
    }
}
?>