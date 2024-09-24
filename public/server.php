<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = isset($_POST['name']) ? $_POST['name'] : 'Nieznany';

    // Wyślij odpowiedź
    echo "Witaj, " . htmlspecialchars($name) . "!";
} else {
    echo "Błąd: Nieprawidłowe żądanie";
}
?>

