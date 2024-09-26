<form id="userAddForm" action="{{$absolute_url}}/index.php?controller=usermanagement&do=create" method="post">
    <div class="align-content-md-center">
        <input class="btn btn-success" type="submit" value="Dodaj użytkownika">
    </div>
</form>


@foreach($users as $user)
    <br>
    <div class="container">
        <div class="row d-inline">
            <span class="col-1">{{ htmlspecialchars($user['id']) }}</span>
            <span class="col-1">{{ htmlspecialchars($user['name']) }}</span>
            <span class="col-1">{{ htmlspecialchars($user['email']) }}</span>
            <span class="col-1">{{ htmlspecialchars($user['password']) }}</span>
        </div>

        <div class="d-inline">
            <form id="editFormForm" class="d-inline"
                  action='{{$absolute_url}}/index.php?controller=usermanagement&do=editForm'
                  method='POST'>
                <input type='hidden' name='id' value='{{ htmlspecialchars($user['id']) }}'>
                <input class="btn btn-outline-primary" type='submit' value='Edytuj {{ $user["name"] }}'>
            </form>

            <form id="deleteForm" class="d-inline"
                  action='{{$absolute_url}}/index.php?controller=usermanagement&do=delete'
                  method='POST'>
                <input type='hidden' name='id' value='{{ htmlspecialchars($user['id']) }}'>
                <input class="btn btn-outline-danger" type='submit' value='Usuń {{ $user["name"] }}'>
            </form>

        </div>
    </div>
@endforeach
