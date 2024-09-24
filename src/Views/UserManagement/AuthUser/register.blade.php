<form action="{{$absolute_url}}/index.php?controller=authuser&do=register" method="post">
    <h2 class="display-4 text-xl-center">Rejestracja</h2>

    <div class="align-content-md-center">
        <label for="name" class="form-label">Nazwa:</label>
        <input class="form-control" type="text" id="name" name="name" required>

        <label for="email" class="form-label">Email:</label>
        <input class="form-control" type="email" id="email" name="email" required>

        <label for="password" class="form-label">Hasło:</label>
        <input class="form-control" type="password" id="password" name="password" required>

        <label for="confirm_password" class="form-label">Potwierdź hasło:</label>
        <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" required>
    </div>
    <br>
    <div class="align-content-md-center">
        <input class="btn btn-success" type="submit" value="Zarejestruj się">
    </div>
</form>