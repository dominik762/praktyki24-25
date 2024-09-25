<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING) ?? 'Nieznany';

    header('Content-Type: text/html; charset=UTF-8');
    echo "Witaj, " . htmlspecialchars($name) . "!";
} else {
    http_response_code(405);
    echo "Błąd: Nieprawidłowe żądanie";
}
?>
