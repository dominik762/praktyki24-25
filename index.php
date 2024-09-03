<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moja Strona</title>
    <link rel="stylesheet" href="styles/styles-index.css">

</head>
<body>

<header>
    <h1>Witamy na Mojej Stronie</h1>
</header>

<nav>
    <ul>
        <li><a href="index.php?page=strona1">Strona 1</a></li>
        <li><a href="index.php?page=strona2">Strona 2</a></li>
        <li><a href="index.php?page=strona3">Strona 3</a></li>
    </ul>
</nav>

<main>
    <?php
    include 'pages/polaczenie_db.php';
    include 'pages/wyswietlanie_z_bazy.php';
    // Pobierz stronę z parametru URL lub ustaw na domyślną
    $page = isset($_GET['page']) ? $_GET['page'] : 'strona1';

    // Ścieżka do pliku z zawartością
    $file = 'pages/' . $page . '.php';

    // Sprawdzenie, czy plik istnieje
    if (file_exists($file)) {
        include($file);
    } else {
        echo "<h2>Strona nie została znaleziona</h2>";
        echo "<h2>$file</h2>";
        echo "<p>Przepraszamy, ale strona, którą próbujesz odwiedzić, nie istnieje.</p>";
    }
    ?>
</main>

</body>
</html>
