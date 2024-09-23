
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
</head>
<body>
<h1>{{ $title }}</h1>
<?php if (isset($_SESSION['userId'])): ?>
<form action="{{$absolute_url}}/index.php?controller=usermanagement&do=showAll" method="POST">
    <input type="submit" id="goUserManagement" value="Zarządzaj użytkownikami">
</form>
<form action="{{$absolute_url}}/index.php?controller=authuser&do=signOut" method="POST">
    <input type="submit" id="signOut" value="Wyloguj się">
</form>
<?php else: ?>
<form action="{{$absolute_url}}/index.php?controller=authuser&do=signIn" method="POST">
    <input type="submit" id="signIn" value="Zaloguj się">
</form>
<?php endif; ?>
</body>
</html>