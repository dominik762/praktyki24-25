<form id="userAddForm" action="{{$absolute_url}}/index.php?controller=usermanagement&do=create" method="GET">
    <div class="align-content-md-center">
        <input type="hidden" name="controller" value="usermanagement">
        <input type="hidden" name="do" value="create">
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
            <a href='{{$absolute_url}}/index.php?controller=usermanagement&do=editForm&id={{$user['id']}}'>Edytuj</a>
            <a href='{{$absolute_url}}/index.php?controller=usermanagement&do=delete&id={{$user['id']}}'>Usuń</a>

        </div>
    </div>
@endforeach
