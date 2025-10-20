<?php
/**
 * HTML-Tabellen-Generator für Daten
 * Zentralisiert, um Redundanz zu vermeiden (DRY).
 *
 * @param array $data - 2D-Array mit Daten
 * @param string $entity - Entity-Name ('pokemon') für Routing
 * @param string $farbe_1 - Hintergrundfarbe für gerade Zeilen
 * @param string $farbe_2 - Hintergrundfarbe für ungerade Zeilen
 * @return string - Fertige HTML-Tabelle
 */
function createTable(array $data, string $entity, string $farbe_1 = '#f2f2f2', string $farbe_2 = '#ffffff'): string
{
    // Eğer veri yoksa bilgilendirme mesajı döndür
    if (empty($data)) {
        return "<p>Henüz hiç kayıt bulunmamaktadır.</p>";
    }

    $string = "<table class='data-table'>";
    $string .= "<thead><tr>";

    // Başlık satırı oluşturma
    foreach ($data[0] as $key => $value) {
        // Başlıkları daha okunaklı hale getir
        $string .= "<th>" . htmlspecialchars(ucwords(str_replace('_', ' ', $key))) . "</th>";
    }
    // Eylem (Action) butonları için başlık
    $string .= "<th>Aksiyonlar</th>";
    $string .= "</tr></thead><tbody>";

    // Veri satırlarını oluşturma
    foreach ($data as $index => $row) {
        $color = ($index % 2 == 0) ? $farbe_1 : $farbe_2;

        $string .= "<tr style='background-color: $color'>";

        // Her sütunu yazdır
        foreach ($row as $key => $item) {
            $string .= "<td>";
            // Pokemon projesinde is_hiring yok, normal değer basılır
            $string .= htmlspecialchars($item);
            $string .= "</td>";
        }

        // Aksiyon Butonları (Düzenle ve Sil)
        $id = $row['id'];
        $string .= "<td class='actions'>";
        $string .= "<a href='/{$entity}/update/{$id}' class='update-btn'>Bearbeiten</a>";
        $string .= "<a href='/{$entity}/delete/{$id}' class='delete-btn'>Löschen</a>";
        $string .= "</td>";
        $string .= "</tr>";
    }
    $string .= "</tbody></table>";
    return $string;
}
?>