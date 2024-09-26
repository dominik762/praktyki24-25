<h2 class=" alert alert-danger ">Czy na pewno chcesz się wylogować, <span class="text-primary-emphasis">{{$name}}</span>?</h2>

<form id="logoutForm" action="{{$absolute_url}}/index.php?controller=authuser&do=logout" method="POST">
    <input class="btn btn-outline-danger" type="submit" value="Wyloguj się">
</form>