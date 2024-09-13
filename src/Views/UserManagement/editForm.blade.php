@if(isset($user))
    <form action='/praktyki24-25/public/index.php?controller=usermanagement&do=edit' method='POST'>
        <input type='hidden' name='id' value='{{ $user->getId() }}'>
        <label for="name">Nazwa:</label>
        <input type="text" id="name" name="name" required value="{{ $user->getName() }}">
        <br><br>
        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required value="{{ $user->getEmail() }}">
        <br><br>
        <label for="password">Hasło:</label>
        <input type="password" id="password" name="password" required value="{{ $user->getPassword() }}">
        <br><br>
        <input type='submit' value='Zatwierdź zmiany dla {{ $user->getName() }}'>
    </form>
@endif
