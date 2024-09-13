<h1>Rejestracja nowego użytkownika</h1>
<form action="/praktyki24-25/public/index.php?controller=usermanagement&do=store" method="POST">
    <label for="name">Nazwa:</label>
    <input type="text" id="name" name="name" required>
    <br><br>
    <label for="email">E-mail:</label>
    <input type="email" id="email" name="email" required>
    <br><br>
    <label for="password">Hasło:</label>
    <input type="password" id="password" name="password" required>
    <br><br>
    <input type="submit" value="Zarejestruj">
</form>
