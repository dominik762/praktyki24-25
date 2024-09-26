<div class="md-3">
    <form id="EditForm" action='{{$absolute_url}}/index.php?controller=usermanagement&do=edit' method='POST'>
        <input class="form-control" type='hidden' name='id' value='{{ $user->getId() }}'>
        <label class="form-label" for="name">Nazwa:</label>
        <input class="form-control" type="text" id="name" name="name" required value="{{ $user->getName() }}">
        <label class="form-label" for="email">E-mail:</label>
        <input class="form-control" type="email" id="email" name="email" required value="{{ $user->getEmail() }}">
        <label class="form-label" for="password">Hasło:</label>
        <input class="form-control" type="password" id="password" name="password" required value="{{ $user->getPassword() }}">
        <input class="btn btn-success" type='submit' value='Zatwierdź zmiany dla {{ $user->getName() }}'>
    </form>
</div>
