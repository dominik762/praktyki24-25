<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<form action="http://localhost/praktyki24-25/public/index.php?controller=authuser&do=register" method="post">
    <h2>Rejestracja</h2>

    <label for="name">Nazwa:</label>
    <input type="text" id="name" name="name" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>

    <label for="password">Hasło:</label>
    <input type="password" id="password" name="password" required>

    <label for="confirm_password">Potwierdź hasło:</label>
    <input type="password" id="password_confirmation" name="password_confirmation" required>

    <input type="submit" value="Zarejestruj się">
</form>