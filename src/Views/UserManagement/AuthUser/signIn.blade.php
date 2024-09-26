<form id="loginForm" action="{{$absolute_url}}/index.php?controller=authuser&do=login" method="post">
    <div class="align-content-md-center">
        <h2>Logowanie</h2>
        <label class="form-label" for="name">Nazwa:</label>
        <input class="form-control" type="text" id="name" name="name" required>
        <label class="form-label" for="email">Email:</label>
        <input class="form-control" type="email" id="email" name="email" required>
        <label class="form-label" for="password">Hasło:</label>
        <input class="form-control" type="password" id="password" name="password" required>
        <input class="btn btn-outline-success" type="submit" value="Zaloguj się">
    </div>
</form>
