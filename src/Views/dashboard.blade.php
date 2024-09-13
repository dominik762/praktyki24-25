<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
</head>
<body>
<h1>{{ $title }}</h1>
<form action="/praktyki24-25/public/index.php?controller=usermanagement&do=showAll" method="POST">
    <input type="submit" id="goUserManagement" value="Zarządzaj użytkownikami">
</form>
</body>
</html>