<?php
try {
    $sql = "SELECT * FROM uzytkownik";
    $stmt = $dbh->prepare($sql);

    // Wykonanie zapytania
    $stmt->execute();


    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "ID: " . $row['id'] . "<br>";
        echo "Nazwa: " . $row['nazwa uzytkownika'] . "<br>";
        echo "Login: " . $row['login'] . "<br>";
        echo "Email: " . $row['email'] . "<br>";
        echo "Haslo: " . $row['haslo'] . "<br>";
        echo "<hr>";
    }

} catch (PDOException $e) {
    echo "Błąd: " . $e->getMessage();
}
?>