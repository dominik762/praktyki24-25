<form action='/praktyki24-25/public/index.php?controller=usermanagement&do=create' method='POST'>
    <input type='submit' value='Dodaj użytkownika'>
</form>

@foreach($users as $user)
    <br>
    <div>
        <a>
            <span>{{ htmlspecialchars($user['id']) }}</span>
            <span>{{ htmlspecialchars($user['name']) }}</span>
            <span>{{ htmlspecialchars($user['email']) }}</span>
            <span>{{ htmlspecialchars($user['password']) }}</span>
        </a>
    </div>

    <form action='/praktyki24-25/public/index.php?controller=usermanagement&do=delete' method='POST'>
        <input type='hidden' name='id' value='{{ htmlspecialchars($user['id']) }}'>
        <input type='submit' value='Usuń {{ $user["name"] }}'>
    </form>

    <form action='/praktyki24-25/public/index.php?controller=usermanagement&do=editForm' method='POST'>
        <input type='hidden' name='id' value='{{ htmlspecialchars($user['id']) }}'>
        <input type='submit' value='Edytuj {{ $user["name"] }}'>
    </form>
@endforeach
