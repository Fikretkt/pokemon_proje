# ⚡ Pokemon-Verwaltungssystem (PHP CRUD & Docker)

Dieses Projekt implementiert eine modulare CRUD-Anwendung (Create, Read, Update, Delete) zur Verwaltung von Pokemon-Daten. Es verwendet einen PHP-Router und eine MariaDB-Datenbank, alles verpackt in einer Docker-Umgebung.

## 🌟 Projekt-Highlights

* **Daten-Quelle:** Die Datenbank wird beim ersten Zugriff automatisch mit Daten von der PokeAPI initialisiert (Seeding).
* **Technologie:** PHP 8.2 (Apache), MariaDB, Docker Compose.
* **Datenbank:** `pokedoc`
* **Zugangs-Port:** `8090` (für den Host-Zugriff).
* **Architektur:** Sauberes Routing-System, das alle Anfragen über die `public/index.php` abwickelt.

